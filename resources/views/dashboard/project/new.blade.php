@extends('layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">{{(!$modify) ? 'Add New Project' : 'Edit Project'}} </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        You Can Add Your Project Here. Please Fill all field and then add users and task to that you added. 
                    </small>
                </div>
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="title" class="col-sm-3 col-md-2 control-label">Title:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="title" id="title" value="{{ (!$modify) ? old('title') : $title }}" placeholder="Project Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 col-md-2 control-label">Description:</label>
                        <div class="col-sm-9 col-md-10">
                            <textarea class="form-control" name="description" id="description" placeholder="Project Description">{{ (!$modify) ? old('description') : $description }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-success">{{(!$modify) ? 'Add Project' : 'Edit Project'}}</button>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>


@stop