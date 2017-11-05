@extends('layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">{{ ($modify) ? 'Edit Report' : 'Add New Report' }}</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="project" class="col-sm-3 col-md-2 control-label">Project:</label>
                        <div class="col-sm-9 col-md-10">
                            <select class="form-control" name="project" id="project" >
                                <option> -- Choose -- </option>
                                @foreach($projects as $key => $project)
                                    <option value="{{ $project->id }}"> {{ $project->title }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="task" class="col-sm-3 col-md-2 control-label">Task:</label>
                        <div class="col-sm-9 col-md-10">
                            <select class="form-control" name="task" id="task" >
                                <option> -- Choose -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 col-md-2 control-label">Description:</label>
                        <div class="col-sm-9 col-md-10">
                            <textarea class="form-control" name="description" id="description" placeholder="Project Description">{{ ($modify) ? $task->description : old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-3 col-md-2 control-label">Date:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="time" class="col-sm-3 col-md-2 control-label">Time:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="number" class="form-control" name="time" id="time" placeholder="Time">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-success">{{ ($modify) ? 'Edit Report' : 'Add Report' }}</button>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>


@stop