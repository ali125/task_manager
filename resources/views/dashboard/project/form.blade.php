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
                    @foreach($structs as $struct)
                    <div class="form-group">
                        <label for="{{$struct['type'] .'_'. $struct['id']}}" class="col-sm-3 col-md-2 control-label">{{$struct['title']}}:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="hidden" name="options[{{$struct['type'] .'_'. $struct['id']}}][title]" value="{{$struct['title']}}" />
                            @if($struct['type'] == 'text')
                                <input type="text" class="form-control" name="options[{{$struct['type'] .'_'. $struct['id']}}][value]" id="{{$struct['type'] . $struct['id']}}"  placeholder="{{$struct['title']}}">
                            @elseif($struct['type'] == 'select') 
                                <select class="form-control" name="options[{{$struct['type'] .'_'. $struct['id']}}][value]" id="{{$struct['type'] . $struct['id']}}">
                                    @foreach($struct['option'] as $key => $option)
                                        <option value="{{$key}}">{{$option}}</option>
                                    @endforeach
                                </select>
                            @elseif($struct['type'] == 'radio')
                            @elseif($struct['type'] == 'checkbox')
                            @elseif($struct['type'] == 'textarea')
                                <textarea class="form-control" name="options[{{$struct['type'] .'_'. $struct['id']}}][value]" id="{{$struct['type'] . $struct['id']}}" placeholder="{{$struct['title']}}" ></textarea>
                            @elseif($struct['type'] == 'fileuploader')
                                <input type="file" class="form-control" name="options[{{$struct['type'] .'_'. $struct['id']}}][value]" id="{{$struct['type'] . $struct['id']}}"  placeholder="{{$struct['title']}}">
                            @elseif($struct['type'] == 'date')
                                <input type="date" class="form-control" name="options[{{$struct['type'] .'_'. $struct['id']}}][value]" id="{{$struct['type'] . $struct['id']}}"  placeholder="{{$struct['title']}}">    
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