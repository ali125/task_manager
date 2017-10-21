<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects(){
        return $this->belongsToMany('App\Project');
    }
    public function find_by_mobile($number){
        $users = DB::table('users as u')
                ->select('u.*')
                ->where('u.mobile', '=', $number)->first();
        return $users;
    }

    public function is_in_project($user_id, $project_id){
        $result = DB::table('project_user as p_u')
            ->where('p_u.project_id', '=', $project_id)
            ->where('p_u.user_id', '=', $user_id);
        return $result;
    }

    public function users_by_project($project_id){
        $users = DB::table('users as u')
                    ->select('u.*', 'p_u.role')
                    ->join('project_user as p_u', 'p_u.user_id', '=', 'u.id')
                    ->where('p_u.project_id', '=', $project_id)->get();
        return $users;
    }

}
