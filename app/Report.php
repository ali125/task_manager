<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    public function term_taxonomy(){
        return $this->belongsTo('App\TermTaxonomy');
    }

    public function get_reports_user($user_id){
        $reports = DB::select(DB::raw("SELECT * FROM reports WHERE user_id = :user_id"), array('user_id' => $user_id));
        return $reports;
    }
}
