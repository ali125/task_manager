@extends('layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">{{ $project->title }}</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <strong> Description:</strong><small>
                        {{ $project->description }}
                    </small>
                    @foreach($project->options as $key => $option)
                    <br>
                    <strong>{{$option['title']}}: </strong><small> {{ $option['value']  }} </small>
                    @endforeach
                    <br>
                    <strong>Progress: </strong><small> {{ $project->tasks_done . ' / ' . $project->tasks_count  }} </small>
                
                    
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title pull-left">Project Tasks</h4>
                <a href="{{ route('new_task', ['project_id' => $project->id]) }}" type="button" class="btn pull-right btn-xs btn-success">Add New Task</a>
                <a href="{{ route('tasks', ['project_id' => $project->id]) }}" type="button" class="btn pull-right btn-xs btn-success">All Tasks</a>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        
                        @foreach($tasks as $key => $task)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ ($task->status == 1) ? 'open' : (($task->status == 2) ? 'as soon' : (($task->status == 3) ? 'pendding' : 'close')) }}</td>
                            <td>
                                <a href="{{ route('edit_task', ['project_id' => $task->id]) }}">
                                    <span class="fa fa-pencil"></span>
                                </a> 
                                <a href="{{ route('delete_task', ['task_id' => $task->id]) }}">
                                    <span class="fa fa-trash"></span>
                                </a>
                                <a href="{{ route('view_task', ['task_id' => $task->id]) }}">
                                    <span class="fa fa-eye"></span>
                                </a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="widget">
            <header class="widget-header">
            <h4 class="widget-title pull-left">Project Users</h4>
                <a href="{{ route('new_user', ['project_id' => $project->id]) }}" type="button" class="btn pull-right btn-xs btn-success">Add New User</a>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Role</th>
                        </tr>
                        
                        @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{  call_user($user) }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ role_type($user->role) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@stop