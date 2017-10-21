@extends('layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Add New Project</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        You Can Add Your Project Here. Please Fill all field and then add users and task to that you added. 
                    </small>
                </div>
                <form class="form-horizontal" method="post" action="{{ ($modify) ? route('edit_project', ['projcet_id' => $project->id]) : route('add_project') }}" >
                    <div class="form-group">
                        <label for="title" class="col-sm-3 col-md-2 control-label">Title:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="title" id="title" value="{{ (!$modify) ? old('title') : $project->title }}" placeholder="Project Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 col-md-2 control-label">Description:</label>
                        <div class="col-sm-9 col-md-10">
                            <textarea class="form-control" name="description" id="description" placeholder="Project Description">{{ (!$modify) ? old('description') : $project->description }}</textarea>
                        </div>
                    </div>
                    @foreach($project->options as $key =>$option)
                    <div class="form-group">
                        <label for="{{$key}}" class="col-sm-3 col-md-2 control-label">{{$option['title']}}:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="hidden" name="options[{{$key}}][title]" value="{{$option['title']}}" />
                            @if(strstr($key,'textarea') != false)
                                <textarea class="form-control" name="options[{{$key}}][value]" id="{{$key}}" placeholder="{{$option['title']}}" >{{$option['value']}}</textarea>
                                
                            @elseif(strstr($key,'select') != false)
                                <select class="form-control" name="options[{{$key}}][value]" id="{{$key}}">
                                    @foreach({{$option['value']}} as $key => $option)
                                        <option value="{{$option['value']}}">{{$option}}</option>
                                    @endforeach
                                </select>
                            @elseif(strstr($key,'radio') != false)
                            @elseif(strstr($key,'checkbox') != false)
                            @elseif(strstr($key,'text') != false)
                                <input type="text" class="form-control" name="options[{{$key}}][value]" id="{{$key}}" value="{{$option['value']}}" placeholder="{{$option['title']}}">
                            @elseif(strstr($key,'fileuploader') != false)
                                <input type="file" class="form-control" name="options[{{$key}}][value]" id="{{$key}}" value="{{$option['value']}}" placeholder="{{$option['title']}}">
                            @elseif(strstr($key,'date') != false)
                                <input type="date" class="form-control" name="options[{{$key}}][value]" id="{{$key}}" value="{{$option['value']}}"  placeholder="{{$option['title']}}">    
                            @endif
                            
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-success">Add Project</button>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>


@stop