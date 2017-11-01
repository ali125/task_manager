<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Project;
use App\MetaProject;
use App\User;
use App\Task;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $project = new Project();
        $projects = $project->myProjects(Auth::id(), 0);

        foreach($projects as $key => $project){
            $user = new User();
            $projects[$key]->users = $user->users_by_project($project->id);
        }

        $data['projects'] = $projects;
        return view('dashboard/project/list' , $data );
    }

    public function archive(){
        $project = new Project();
        $projects = $project->myProjects(Auth::id(), 1);

        foreach($projects as $key => $project){
            $user = new User();
            $projects[$key]->users = $user->users_by_project($project->id);
        }

        $data['projects'] = $projects;
        return view('dashboard/project/list' , $data );
    }

    public function new(Request $request){
        $structures = new MetaProject();
        $structs = $structures->get_struct_global(Auth::id());
        $data['structs'] = array();
        if($structs){
            $structs->inputs = unserialize($structs->inputs);
            $data['structs'] = $structs->inputs;
        }
        // dd($structs->inputs);
        if($request->isMethod('post')){
            $this->validate($request, array(
                'title' => 'required|min:3'
            ));
            $project = new Project();
            $project->title = $request->input('title');
            $project->description = $request->input('description');
            $project->options = serialize($request->input('options'));
            $project->save();
            $project->users()->attach(Auth::id());
            if($structs){
                $project_meta = new MetaProject();
                $project_meta->meta_key = 'structure_project';
                $project_meta->meta_value = serialize($structs);
                $project_meta->type = 'individual_struct';
                $project_meta->project_id = $project->id;
                $project_meta->author = Auth::id();
                $project_meta->save();
            }
            
            
            return redirect()->route('projects');
        }
        
        
        
        $data['modify'] = 0;
        return view('dashboard/project/form', $data);
    }

    public function edit(Request $request, $project_id){
        
        $project = Project::findOrfail($project_id);
        $project->options = unserialize($project->options);
        $data['project'] = $project;
        // dd($project->options);
        if($request->isMethod('post')){
            $this->validate($request, array(
                'title' => 'required|min:3'
            ));
            $project = Project::find($project_id);
            $project->title = $request->input('title');
            $project->description = $request->input('description');
            
            $project->options = serialize($request->input('options'));
            $project->save();
            
            return redirect()->route('projects');
        }
        $structures = new MetaProject();
        $structs = $structures->get_struct($project_id);
        $data['structs'] = array();
        if($structs){
            $structs->inputs = unserialize($structs->inputs);
            $data['structs'] = $structs->inputs;
        }
        // dd($data);
        $data['modify'] = 1;
        return view('dashboard/project/edit', $data);
    }

    public function delete(Request $request,$project_id){
        $project = Project::find($project_id);
        $project->users()->detach(Auth::id());
        $project->delete();
        $structure = new MetaProject();
        $struct = $structure->get_struct($project_id);
        $project_meta = MetaProject::find($struct->id);
        $project_meta->delete();
        return redirect()->route('projects');
    }

    public function change_status(Request $request,$project_id){
        $project = Project::find($project_id);
        $project->status = ($project->status) ? 0 : 1;
        $project->save();
        if($project->status)
            return redirect()->route('projects_archive');
        else
            return redirect()->route('projects');
    }

    public function show($project_id){
        $project = new Project();
        $get_project = $project->details_project_id($project_id);
        $get_project->options = unserialize($get_project->options);
        $data['project'] = $get_project;
        
        $tasks = new Task();
        $data['tasks'] = $tasks->get_tasks_by_projct($project_id);

        $users = new User();
        $data['users'] = $users->users_by_project($project_id);
        
        // dd($data);
        return view('dashboard/project/view', $data);
    }

    // Project Structure
    public function structure(Request $request){
        $structure = new MetaProject();
        $get_struct = $structure->get_struct_global(Auth::id());
        if($get_struct)
            $get_struct->inputs = unserialize($get_struct->inputs);
            
        // dd($get_struct);
        $data['struct'] = $get_struct;
        
        if($request->isMethod('post')){
           
            $struct = $request->input('struct');
            
            $structs = array();
            if($struct){
                foreach($struct as $key => $val ){
                    $structs[] = array_merge(array('id' => $key), $val) ;
                }
            }
            
            if($get_struct)
                $project_meta = MetaProject::find($get_struct->id);
            else
                $project_meta = new MetaProject();
                
           
            $project_meta->meta_key = 'structure_project';
            $project_meta->meta_value = serialize($structs);
            $project_meta->type = 'global_struct';
            $project_meta->author = Auth::id();
            
            $project_meta->save();
            return redirect()->back();
        }
       
        return view('dashboard/project/structure', $data);
    }

    public function edit_structure(Request $request, $project_id){
        $structure = new MetaProject();
        $get_struct = $structure->get_struct($project_id);
        if($get_struct)
            $get_struct->inputs = unserialize($get_struct->inputs);
            // dd($get_struct->inputs);
        $data['struct'] = $get_struct->inputs;
        
        if($request->isMethod('post')){
        

            $struct = $request->input('struct');
            $structs = array();
            if($struct){
                foreach($struct as $key => $val ){
                    $structs[] = array_merge(array('id' => $key), $val);
                }
            }
            $structs_data = array();
            $structs_data = (object)$structs_data;
            $structs_data->id = $get_struct->inputs->id;
            $structs_data->inputs = $structs;
            // dd($structs_data);
            $project_meta = MetaProject::find($get_struct->id);
                
            $project_meta->meta_value = serialize($structs_data);

            
            $project_meta->save();
            return redirect()->back();
        }

        return view('dashboard/project/edit_structure', $data);
    }

}
