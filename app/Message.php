<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    
    public function message_by_task($task_id){
        // $messages = DB::table('messages as m')
        //                 ->select('m.*', 'u.username', 'u.name', 'u.last_name', 'u.mobile', 'u.email', 'u.image as user_image', 'p_u.role')
        //                 ->join('users as u', 'u.id', '=' , 'm.author')
        //                 ->join('tasks as t', 't.id', '=' , 'm.task_id')
        //                 ->leftJoin('project_user as p_u', 'u.id', '=' , 'p_u.user_id')
        //                 ->leftJoin('projects as p', 'p.id', '=' , 't.project_id')
        //                 ->where('m.task_id', '=', $task_id)->get();
        $messages = DB::select(DB::raw("SELECT m.* , u.username, u.name, u.last_name , u.image AS user_image,
            (SELECT p_u.role 
                    FROM project_user AS p_u 
                    INNER JOIN projects AS p ON p.id = p_u.project_id
                    WHERE p.id = t.project_id) AS role
            FROM messages AS m
            INNER JOIN tasks AS t ON m.task_id = t.id
            INNER JOIN users AS u ON u.id = m.author
            WHERE m.task_id = :task_id"), array('task_id' => $task_id));
        return $messages;
    }


    public function files(){
        return $this->belongsToMany('App\File');
    }
    public function task(){
        return $this->belongsTo('App\Task');
    }
}
