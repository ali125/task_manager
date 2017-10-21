<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MetaProject extends Model
{
    //
    public function get_struct_global($user_id, $type = 'global_struct'){
        $struct = DB::select(DB::raw("SELECT id, meta_value as inputs  FROM meta_projects  
                                        WHERE author = :user_id AND type = :type"),
                                        array('user_id' => $user_id, 'type' => $type));
        if(count($struct)){
            $struct = $struct[0];
        } 
        return $struct;
    }
    public function get_struct($project_id, $type = 'individual_struct'){
        $struct = DB::select(DB::raw("SELECT id, meta_value as inputs  FROM meta_projects  
                WHERE project_id = :project_id AND type = :type"),
                array('project_id' => $project_id, 'type' => $type));
        if(count($struct)){
            $struct = $struct[0];
        } 
        return $struct;
    }
}
