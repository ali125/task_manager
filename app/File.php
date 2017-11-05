<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Task;
class File extends Model
{
    public function tasks(){
        return $this->belongsToMany('App\Task');
    }
    public function messages(){
        return $this->belongsToMany('App\Message');
    }

    public function file_by_message($message_id){
        $files = DB::select(DB::raw("SELECT f.filename
            FROM files as f
            INNER JOIN file_message as f_m on f.id = f_m.file_id
            WHERE f_m.message_id = :message_id"), array('message_id' => $message_id));
        return $files;
    }

    public function file_task_by_project($project_id){
        $files = DB::select(DB::raw("SELECT DISTINCT f.filename
            FROM files as f
            INNER JOIN file_task as f_t on f.id = f_t.file_id
            INNER JOIN tasks as t on t.id = f_t.task_id
            WHERE t.project_id = :project_id"), array('project_id' => $project_id));
        return $files;
    }

    public function file_message_by_project($project_id){
        $files = DB::select(DB::raw("SELECT DISTINCT f.filename
            FROM files as f
            INNER JOIN file_message as f_m on f.id = f_m.file_id
            INNER JOIN messages as m on m.id = f_m.message_id
            INNER JOIN tasks as t on t.id = m.task_id
            WHERE t.project_id = :project_id"), array('project_id' => $project_id));
        return $files;
    }

    public function file_task($task_id){
        $files = DB::select(DB::raw("SELECT DISTINCT f.filename
            FROM files as f
            INNER JOIN file_task as f_t on f.id = f_t.file_id
            INNER JOIN tasks as t on t.id = f_t.task_id
            WHERE t.id = :task_id"), array('task_id' => $task_id));
        return $files;
    }

    public function file_message_by_task($task_id){
        $files = DB::select(DB::raw("SELECT DISTINCT f.filename
            FROM files as f
            INNER JOIN file_message as f_m on f.id = f_m.file_id
            INNER JOIN messages as m on m.id = f_m.message_id
            INNER JOIN tasks as t on t.id = m.task_id
            WHERE t.id = :task_id"), array('task_id' => $task_id));
        return $files;
    }
}
