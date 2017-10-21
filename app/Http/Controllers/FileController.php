<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\File;

class FileController extends Controller
{
    public function index(){
        $data = [];

        $project = new Project();
        $projects = $project->myProjects(Auth::id());
        foreach($projects as $key => $project){
            $file = new File();
           
            $projects[$key]->task = $file->file_task_by_project($project->id); 
            $projects[$key]->message = $file->file_message_by_project($project->id); 
        }
        $data['projects'] = $projects;
        return view('dashboard/file_manager/index', $data);
    }
}
