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

        if($request->isMethod('post')){
            $this->validate($request, array(
                'title' => 'required|min:3'
            ));
            $project = new Project();
            $project->title = $request->input('title');
            $project->description = $request->input('description');
            $project->options = serialize($request->input('options'));
            $project->save();

            // $structures = new MetaProject();
            
            $project->users()->attach(Auth::id());
            
            return redirect()->route('projects');
        }
        $structures = new MetaProject();
        $structs = $structures->get_struct_global(Auth::id());
        $structs->inputs = unserialize($structs->inputs);
        $data['structs'] = $structs->inputs;
        $data['modify'] = 0;
        return view('dashboard/project/form', $data);
    }

    public function edit(Request $request, $project_id){
        
        $project = Project::findOrfail($project_id);
        $project->options = unserialize($project->options);
        $data['project'] = $project;
        dd($project->options);
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
        // $structures = new MetaProject();
        // $structs = $structures->get_struct($project_id);
        // $structs->inputs = unserialize($structs->inputs);
        // $data['structs'] = $structs->inputs;
        $data['modify'] = 1;
        return view('dashboard/project/edit', $data);
    }

    public function delete(Request $request,$project_id){
        $project = Project::find($project_id);
        $project->users()->detach(Auth::id());
        $project->delete();
        return redirect()->route('projects');
    }

    public function change_status(Request $request,$project_id){
        $project = Project::find($project_id);
        $project->status = ($project->status) ? 0 : 1;
        $project->save();
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
    public function structure(Request $request, $project_id = 0){
        $structure = new MetaProject();
        $get_struct = $structure->get_struct_global(Auth::id());
        if($get_struct)
            $get_struct->inputs = unserialize($get_struct->inputs);
            
        $data['struct'] = $get_struct;
        
        if($request->isMethod('post')){
           
            $struct = $request->input('struct');
            $structs = array();
            foreach($struct as $key => $val ){
                $structs[] = array_merge(array('id' => $key), $val) ;
            }
        //    dd($structs);
            // dd(serialize($structs));
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
}
