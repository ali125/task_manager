

@extends('layouts/dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="widget p-lg">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Report</th>
                        <th>Task</th>
                        <th>Actions</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Created at</th>
                    </tr>
                    @foreach($reports as $key => $report)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->task_id }}</td>
                            <td>
                                <a href="{{ route('edit_report', ['project_id' => $report->id]) }}">
                                    <span class="fa fa-pencil"></span>
                                    Edit 
                                </a> 
                                <a href="{{ route('delete_report', ['report_id' => $report->id]) }}">
                                    <span class="fa fa-trash"></span>
                                    Delete 
                                </a>
                            </td>
                            <td>{{ $report->date }}</td>
                            <td>{{ $report->time }}</td>
                            <td>{{ $report->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- .widget -->
    </div>
</div>

@stop