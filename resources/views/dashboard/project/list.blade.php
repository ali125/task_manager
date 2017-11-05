@extends('layouts/dashboard')

@section('content')

<div class="m-b-lg nav-tabs-horizontal">

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-3" role="tab" data-toggle="tab" aria-expanded="true">Projects Active</a></li>
        <li role="presentation" class=""><a href="#tab-2" aria-controls="tab-1" role="tab" data-toggle="tab" aria-expanded="false">Project Archived</a></li>
    </ul>


    <div class="tab-content p-md">
        <div role="tabpanel" class="tab-pane fade active in" id="tab-1">
            <h4 class="m-b-md">First Tab Content</h4>
            <div class="row projects-box">
                @foreach($projects as $key => $project)
                <div class="col-md-3 col-sm-6 project-box" >
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title"><a href="{{ route('view_project', ['project_id' => $project->id]) }}"></a>{{ $project->title }}</h4>
                            <ul>
                        <li class="dropdown ">
                        <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="fa fa-gear"></span>
                        </a>
                        <ul class="dropdown-menu animated flipInY">
                            <li>
                            <a class="text-color" href="{{ route('edit_project', ['project_id' => $project->id]) }}">
                                <span class="m-r-xs"><i class="fa fa-edit"></i></span>
                                <span>Edit</span>
                            </a>
                            </li>
                            <li>
                            <a class="text-color" href="{{ route('view_project', ['project_id' => $project->id]) }}">
                                <span class="m-r-xs"><i class="fa fa-eye"></i></span>
                                <span>View</span>
                            </a>
                            </li>
                            @if($project->status == 0)
                                <li>
                                <a class="text-color" href="{{ route('change_status_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-archive"></i></span>
                                    <span>Complete and Archive</span>
                                </a>
                                </li>
                            @else
                                <li>
                                <a class="text-color" href="{{ route('change_status_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-archive"></i></span>
                                    <span>Unarchive</span>
                                </a>
                                </li>
                            @endif
                            <li>
                                <a class="text-color" href="{{ route('edit_structure_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-archive"></i></span>
                                    <span>Edit Structure</span>
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a class="text-color" href="{{ route('delete_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-trash"></i></span>
                                    <span>Delete Project</span>
                                </a>
                            </li>
                        </ul>
                        </li>
                    </ul>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body text-center" data-href="{{ route('view_project', ['project_id' => $project->id]) }}">
                            <div class="project-box-desc">
                                <p class="text-muted m-b-lg">{{ $project->description }}</p>
                            </div>
                            <div class="actions-box-project row">
                                <div class="btn-group">
                                    <a href="{{ route('tasks', ['project_id' => $project->id]) }}"  data-delay="500" data-toggle="tooltip" title="Tasks" class="btn btn-sm btn-outline btn-inverse"><i class="fa fa-tasks"></i></a>
                                    <a href="" data-delay="500" data-toggle="tooltip" title="Nothing!" class="btn btn-sm btn-outline btn-dark"><i class="fa fa-file"></i></a>
                                </div>
                            </div>
                            <ul class="users-project-box row">
                                @foreach($project->users as $user)
                                <li data-container="body" data-title="{{ call_user($user) }}" data-toggle="popover" data-placement="top">
                                    <img src="{{ user_avatar($user->image) }}" />
                                </li>
                                @endforeach
                            </ul>
                            @if($project->status == 0)
                            <a href="{{ route('new_user', ['project_id' => $project->id]) }}"><span class="fa fa-plus-circle"><span> Invite More People</a>
                            @endif
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div>
                @endforeach
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab-2">
            <h4 class="m-b-md">Second Tab Content</h4>
            <div class="row projects-box">
                @foreach($projects_archived as $key => $project)
                <div class="col-md-3 col-sm-6 project-box" >
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title"><a href="{{ route('view_project', ['project_id' => $project->id]) }}"></a>{{ $project->title }}</h4>
                            <ul>
                        <li class="dropdown ">
                        <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="fa fa-gear"></span>
                        </a>
                        <ul class="dropdown-menu animated flipInY">
                            <li>
                            <a class="text-color" href="{{ route('edit_project', ['project_id' => $project->id]) }}">
                                <span class="m-r-xs"><i class="fa fa-edit"></i></span>
                                <span>Edit</span>
                            </a>
                            </li>
                            <li>
                            <a class="text-color" href="{{ route('view_project', ['project_id' => $project->id]) }}">
                                <span class="m-r-xs"><i class="fa fa-eye"></i></span>
                                <span>View</span>
                            </a>
                            </li>
                            @if($project->status == 0)
                                <li>
                                <a class="text-color" href="{{ route('change_status_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-archive"></i></span>
                                    <span>Complete and Archive</span>
                                </a>
                                </li>
                            @else
                                <li>
                                <a class="text-color" href="{{ route('change_status_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-archive"></i></span>
                                    <span>Unarchive</span>
                                </a>
                                </li>
                            @endif
                            <li>
                                <a class="text-color" href="{{ route('edit_structure_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-archive"></i></span>
                                    <span>Edit Structure</span>
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a class="text-color" href="{{ route('delete_project', ['project_id' => $project->id]) }}">
                                    <span class="m-r-xs"><i class="fa fa-trash"></i></span>
                                    <span>Delete Project</span>
                                </a>
                            </li>
                        </ul>
                        </li>
                    </ul>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body text-center" data-href="{{ route('view_project', ['project_id' => $project->id]) }}">
                            <div class="project-box-desc">
                                <p class="text-muted m-b-lg">{{ $project->description }}</p>
                            </div>
                            <div class="actions-box-project row">
                                <div class="btn-group">
                                    <a href="{{ route('tasks', ['project_id' => $project->id]) }}"  data-delay="500" data-toggle="tooltip" title="Tasks" class="btn btn-sm btn-outline btn-inverse"><i class="fa fa-tasks"></i></a>
                                    <a href="" data-delay="500" data-toggle="tooltip" title="Nothing!" class="btn btn-sm btn-outline btn-dark"><i class="fa fa-file"></i></a>
                                </div>
                            </div>
                            <ul class="users-project-box row">
                                @foreach($project->users as $user)
                                <li data-container="body" data-title="{{ call_user($user) }}" data-toggle="popover" data-placement="top">
                                    <img src="{{ user_avatar($user->image) }}" />
                                </li>
                                @endforeach
                            </ul>
                            @if($project->status == 0)
                            <a href="{{ route('new_user', ['project_id' => $project->id]) }}"><span class="fa fa-plus-circle"><span> Invite More People</a>
                            @endif
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@stop