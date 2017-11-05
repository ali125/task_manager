<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Project;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request){

        if($request->isMethod('post')){
            $this->validate($request, array(
                'description' => 'required|min:3',
                'date' => 'required',
                'time' => 'required'
            ));
            $report = new Report();
            $report->description = $request->input('description');
            $report->date = $request->input('date');
            $report->time = $request->input('time');
            $report->task_id = $request->input('task_id');
            $report->user_id = Auth::id();
            $report->save();
            
            return redirect()->route('reports');
        }
        $data = array();
        $projects_data = new Project();
        $projects = $projects_data->myProjects(Auth::id(), 0);
        $data['projects'] = $projects;
        $data['modify'] = 0;
        return view('dashboard/report/new', $data);
    } 
    public function list(){
        $data = array();
        $reports_data = new Report();
        $reports = $reports_data->get_reports_user(Auth::id());
        $data['reports'] = $reports;
        return view('dashboard/report/list', $data);
    }   
}
