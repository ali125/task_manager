<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Task extends Model
{
    //
    const STATUS_OPEN = 1;
    const STATUS_FORCE = 2;
    const STATUS_PENDDING = 3;
    const STATUS_CLOSE = 4;
    
    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function files(){
        return $this->belongsToMany('App\File');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function get_tasks_by_projct($project_id, $limit = 0 , $offset = 0 , $order='created_at', $order_by='desc'){
        $tasks = DB::table('tasks')->where('project_id', '=', $project_id)->limit(10)->orderBy('created_at', 'desc')->get();
        return $tasks;
    }

    public function get_tasks_by_user($user_id){
        $tasks = DB::table('tasks')
                    ->select('tasks.*', 'p.title as project_title')
                    ->join('projects as p', 'tasks.project_id', '=' , 'p.id' )
                    ->join('project_user as p_u', 'tasks.project_id', '=' , 'p_u.project_id' )
                    ->where('p_u.user_id', '=', $user_id)
                    ->limit(10)
                    ->orderBy('created_at', 'desc')->get();
        return $tasks;
    }
}
