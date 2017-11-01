@extends('layouts/dashboard')

@section('content')

        <div class="widget who-to-follow-widget row view-project">
            <div class="widget-header p-h-lg p-v-md">
                <h4 class="widget-title">Tasks List</h4>
            </div>
            <hr class="widget-separator m-0">
            <div class="col-md-9">
                <div class="widget" style="box-shadow: none;">
                    <div class="media-group">
                    @foreach($tasks as $key => $task)
                        <a href="{{ route('view_task', ['task_id' => $task->id]) }}" class="media-group-item">
                            <div class="media">
                                <div class="media-body ">
                                    <div class="media-heading">
                                        <h5 style="display: inline-block;">{{ $task->title }} </h5>
                                        @if($task->status == 1) <span class="label label-default">open</span>
                                        @elseif($task->status == 2) <span class="label label-warning">as soon</span> 
                                        @elseif($task->status == 3) <span class="label label-info">pendding</span> 
                                        @else <span class="label label-success">close</span> 
                                        @endif
                                    </div>
                                    <small class="media-meta">{{ $task->description }}</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                        
                    </div>
                </div>
                <div class="add-task-btn">
                    <div class="line-btn"></div>
                    <a href="{{ route('new_task', ['project_id' => $project->id]) }}" class="btn mw-md btn-success">New Task</a>             
                </div>
            
            </div>
            <div class="col-md-3">
                <div class="widget-header p-h-lg p-v-md">
                    <h4 class="widget-title">Project Info</h4>
                </div>
                <hr class="widget-separator m-0 m-b-sm">
                <ul class="list-group no-border">
                    <li class="list-group-item">
                        <span> Title:</span>
                        <small>{{ $project->title }}</small>
                    </li>
                    <li class="list-group-item">
                        <span> Description:</span>
                        <small>{{ $project->description }}</small>
                    </li>
                    @foreach($project->options as $key => $option)
                    <li class="list-group-item"><span>{{$option['title']}}: </span><small> {{ $option['value']  }} </small></li>
                    @endforeach
                    <li class="list-group-item">
                        <span>Progress: </span><small> {{ $project->tasks_done . ' / ' . $project->tasks_count  }} </small>
                    </li>
                </ul>
                
                <div class="widget-header p-h-lg p-v-md">
                    <h4 class="widget-title">Users in Project</h4>
                </div>
                <hr class="widget-separator m-0 m-b-sm">
                @foreach($users as $key => $user)
                    <span class="label label-default menu-label">{{  call_user($user) }}</span>
                @endforeach
            </div><!-- .widget -->
        </div><!-- END column -->
@stop