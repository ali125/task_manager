@extends('layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">{{ ($modify) ? 'Edit Task' : 'Add New Task' }}</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Use Bootstrap's predefined grid classes to align labels and groups of form controls in a horizontal layout by adding <code>.form-horizontal</code> to the form (which doesn't have to be a <code>&lt;form&gt;</code>). Doing so changes <code>.form-groups</code> to behave as grid rows, so no need for <code>.row</code>.
                    </small>
                </div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="title" class="col-sm-3 col-md-2 control-label">Title:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="title" id="title" value="{{ ($modify) ? $task->title : old('title')}}" placeholder="Project Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-3 col-md-2 control-label">Status:</label>
                        <div class="col-sm-9 col-md-10">
                            <select class="form-control" name="status" id="status" >
                                <option> -- Choose -- </option>
                                <option value="1"> -- Open -- </option>
                                <option value="2"> -- As soon as possible -- </option>
                                <option value="3"> -- Pendding -- </option>
                                <option value="4"> -- Close -- </option>
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
                        <label for="description" class="col-sm-3 col-md-2 control-label">File Attach:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="file" name="file_attached[]" multiple="multiple" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-success">{{ ($modify) ? 'Edit Task' : 'Add Task' }}</button>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>


@stop