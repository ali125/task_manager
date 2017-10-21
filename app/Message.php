<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    
    public function message_by_task($task_id){
        $messages = DB::table('messages as m')
                        ->select('m.*', 'u.username', 'u.name', 'u.last_name', 'u.mobile', 'u.email', 'u.image as user_image', 'p_u.role')
                        ->join('users as u', 'u.id', '=' , 'm.author')
                        ->join('tasks as t', 't.id', '=' , 'm.task_id')
                        ->join('project_user as p_u', 'u.id', '=' , 'p_u.user_id')
                        ->join('projects as p', 'p.id', '=' , 't.project_id')
                        ->where('m.task_id', '=', $task_id)->get();
        return $messages;
    }


    public function files(){
        return $this->belongsToMany('App\File');
    }
    public function task(){
        return $this->belongsTo('App\Task');
    }
}
