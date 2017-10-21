<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    //
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function myProjects($id, $archive = 0){
        // $projects = DB::table('projects as p')
        //             ->select('p.*')
        //             ->join('project_user as p_u', 'p.id', '=', 'p_u.project_id')
        //             ->join('users as u', 'u.id', '=', 'p_u.user_id')
        //             ->where('u.id', $id)->get();
        $projects = DB::select(DB::raw("SELECT p.*, 
                                            (SELECT count(*) from project_user as p_u where project_id = p.id) as users_count, 
                                            (SELECT count(*) from tasks as t where project_id = p.id) as tasks_count,
                                            (SELECT count(*) from tasks as t where project_id = p.id and status = 3) as tasks_done
                                        FROM projects as p 
                                        inner join project_user as p_u on p.id = p_u.project_id 
                                        inner join users as u on u.id = p_u.user_id
                                        where u.id = :user_id AND p.status = :archive"), array('user_id' => $id, 'archive' => $archive));
        return $projects;
    }

    public function details_project_id($id){
        $projects = DB::select(DB::raw("SELECT p.*, 
                                (SELECT count(*) from project_user as p_u where project_id = p.id) as users_count, 
                                (SELECT count(*) from tasks as t where project_id = p.id) as tasks_count,
                                (SELECT count(*) from tasks as t where project_id = p.id and status = 3) as tasks_done
                            FROM projects as p 
                            where p.id = :project_id"), array('project_id' => $id))[0];
        return $projects;
    }

   
}
