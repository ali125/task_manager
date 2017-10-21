<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Task;
use App\Message;
use App\File;

class TaskController extends Controller
{
    //
    public function index(){
        $tasks = new Task();
        $data['tasks'] = $tasks->get_tasks_by_user(Auth::id());
        return view('dashboard\task\index', $data);
    }

    public function list($project_id){
        $tasks = new Task();
        $data['tasks'] = $tasks->get_tasks_by_projct($project_id );
        return view('dashboard\task\list', $data);
    }

    public function edit_task(Request $request, $id){
        $task = Task::findOrfail($id);
        if($request->isMethod('post')){
            $this->validate($request, array(
                'title' => 'required|min:3',
                'status'    => 'required|integer'
            ));
            $files_attached = $request->file('file_attached');
            $file_upload = array();
            if($files_attached){
                foreach($files_attached as $key => $file){
                    if($file){
                        $filename = time(). $key .'.'.$file->getClientOriginalExtension();
                        
                        $destinationPath = public_path('/upload/files/');
                    
                        $file->move($destinationPath, $filename);
                    }
                    $file_upload[] = $filename;
                }
            }
            $project_id = $task->project_id;
            $task->title = $request->input('title');
            $task->file_attached = serialize($file_upload);
            $task->status = $request->input('status');
            $task->description = $request->input('description');
            $task->save();
            
            return redirect()->route('tasks', ['project_id' => $project_id]);
        }
        $data['task'] = $task;
        $data['modify'] = 1;
        return view('dashboard\task\form', $data);
    }
    
    public function add(Request $request, $project_id){
        if($request->isMethod('post')){
            $this->validate($request, array(
                'title'     => 'required|min:3',
                'status'    => 'required|integer'
            ));
            $files_attached = $request->file('file_attached');
            $file_upload = array();
            
            $task = new Task();
            $task->title = $request->input('title');
            // $task->file_attached = serialize($file_upload);
            $task->status = $request->input('status');
            $task->description = $request->input('description');
            $task->author = Auth::id();
            $task->project_id = $project_id;
            $task->save();

            if($files_attached){
                
                foreach($files_attached as $key => $file){
                    if($file){
                        $filename = time(). $key .'.'.$file->getClientOriginalExtension();
                        
                        $destinationPath = public_path('/upload/files/');
                    
                        $file->move($destinationPath, $filename);

                        $file_manager = new File();
                        
                        $file_manager->filename = $filename;
                        $file_manager->author = Auth::id();
                       
                        $file_manager->save();
                        
                        $task->files()->attach($file_manager->id);
                    }
                    
                    // $file_upload[] = $filename;
                }
            }
            
            
            return redirect()->route('tasks', ['project_id' => $project_id]);
        }

        $data['modify'] = 0;
        return view('dashboard\task\form', $data);
    }

    public function show($task_id){
        $task = Task::find($task_id);

        $messages = new Message();

        $messages = $messages->message_by_task($task_id);
        // dd($messages);
        // foreach($messages as $key => $value){
        //     $messages[$key]->file_attached = unserialize( $messages[$key]->file_attached);
        // }

        // $task->file_attached = unserialize( $task->file_attached);
        
        foreach($messages as $key => $value){
            $file_manager = new File();
            $files = $file_manager->file_by_message($messages[$key]->id);
            $messages[$key]->file_attached = $files;
        }
        // dd($messages);
        $file_manager = new File();
        $data['messages'] = $messages;
        $data['task'] = $task;
        
        return view('dashboard\task\view', $data);
    }

    public function new_message(Request $request , $task_id){
        $this->validate($request, array(
            'text' => 'required'
        ));
        $files_attached = $request->file('file_attached');
        $file_upload = array();
        // if($files_attached){
        //     foreach($files_attached as $key => $file){
        //         if($file){
        //             $filename = time(). $key .'.'.$file->getClientOriginalExtension();
                    
        //             $destinationPath = public_path('/upload/files/');
                
        //             $file->move($destinationPath, $filename);
        //         }
        //         $file_upload[] = $filename;
        //     }
        // }
        
        
        
        $task = new Message();
        $task->text = $request->input('text');
        // $task->file_attached = serialize($file_upload);
        $task->task_id = $task_id;
        $task->author = Auth::id();
        $task->save();
        
        if($files_attached){
            
            foreach($files_attached as $key => $file){
                if($file){
                    $filename = time(). $key .'.'.$file->getClientOriginalExtension();
                    
                    $destinationPath = public_path('/upload/files/');
                
                    $file->move($destinationPath, $filename);

                    $file_manager = new File();
                    
                    $file_manager->filename = $filename;
                    $file_manager->author = Auth::id();
                   
                    $file_manager->save();
                    
                    $task->files()->attach($file_manager->id);
                }
                
                // $file_upload[] = $filename;
            }
        }

        return redirect()->route('view_task', ['task_id' => $task_id]);
    }

    public function delete($task_id){
        $task = Task::findOrfail($task_id);
        $task->files()->detach($task_id);
        
        $task->delete();
            
        return redirect()->route('all_tasks');
        
    }

    
}
