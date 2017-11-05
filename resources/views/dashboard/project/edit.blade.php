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
                    @if($structs && count($structs->inputs))
                        @foreach($structs->inputs as $key => $input)
                        <div class="form-group">
                            <label for="{{$key}}" class="col-sm-3 col-md-2 control-label">{{$input['title']}}:</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="hidden" name="options[{{$input['name']}}][title]" value="{{$input['title']}}" />
                                @if($input['type'] == 'textarea')
                                    <textarea class="form-control" name="options[{{$input['name']}}][value]" id="{{$key}}" placeholder="{{$input['title']}}" >{{ (isset($project->options[$input['name']]['value'])) ? $project->options[$input['name']]['value'] : ''  }}</textarea>
                                    
                                @elseif($input['type'] == 'select')
                                    <select class="form-control" name="options[{{$input['name']}}][value]" id="{{$key}}">
                                        @foreach($input['option'] as $key_option => $option)
                                            <option {{ ($key_option == $project->options[$input['name']]['value']) ? 'selected' : '' }} value="{{ $key_option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @elseif($input['type'] == 'radio')
                                    @foreach($input['option'] as $key_option => $option)
                                        <input type="radio" name="options[{{$input['name']}}][value]" {{ (isset($project->options[$input['name']]['value']) && $key_option == $project->options[$input['name']]['value']) ? 'checked' : '' }} value="{{ $key_option }}" /> {{ $option }}
                                    @endforeach
                                @elseif($input['type'] == 'checkbox')
                                    @foreach($input['option'] as $key_option => $option)
                                        <input type="checkbox" name="options[{{$input['name']}}][value]" {{ (isset($project->options[$input['name']]['value']) && $key_option == $project->options[$input['name']]['value']) ? 'checked' : '' }} value="{{ $key_option }}" /> {{ $option }}
                                    @endforeach
                                @elseif($input['type'] == 'text')
                                    <input type="text" class="form-control" name="options[{{$input['name']}}][value]" id="{{$key}}" value="{{ (isset($project->options[$input['name']]['value'])) ? $project->options[$input['name']]['value'] : ''  }}" placeholder="{{$input['title']}}">
                                @elseif($input['type'] == 'fileuploader')
                                    <input type="file" class="form-control" name="options[{{$input['name']}}][value]" id="{{$key}}" value="{{ (isset($project->options[$input['name']]['value'])) ? $project->options[$input['name']]['value'] : ''  }}" placeholder="{{$input['title']}}">
                                @elseif($input['type'] == 'date')
                                    <input type="date" class="form-control" name="options[{{$input['name']}}][value]" id="{{$key}}" value="{{ (isset($project->options[$input['name']]['value'])) ? $project->options[$input['name']]['value'] : ''  }}"  placeholder="{{$input['title']}}">    
                                @elseif($input['type'] == 'number')
                                    <input type="number" class="form-control" name="options[{{$input['name']}}][value]" id="{{$key}}" value="{{ (isset($project->options[$input['name']]['value'])) ? $project->options[$input['name']]['value'] : ''  }}"  placeholder="{{$input['title']}}">    
                                @endif
                                
                            </div>
                        </div>
                        @endforeach
                    @endif
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