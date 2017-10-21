@extends('layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Horizontal Form</h4>
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
                        <label for="image" class="col-sm-3 col-md-2 control-label">Image:</label>
                        <div class="col-sm-9 col-md-10">
                            @if($image)
                            <img src="/upload/avatar/{{ $image }}" />
                            @endif
                            <input type="file" class="form-control" name="image" id="image" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 col-md-2 control-label">Name:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ? old('name') : $name }}" placeholder="Your first name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col-sm-3 col-md-2 control-label">Last Name:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') ? old('last_name') : $last_name }}" placeholder="Your last name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-3 col-md-2 control-label">Username:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="username" id="username" value="{{ old('username') ? old('username') : $username }}" placeholder="Your username" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-3 col-md-2 control-label">Mobile:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') ? old('mobile') : $mobile }}"  placeholder="Eamil address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 col-md-2 control-label">Email:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') ? old('email') : $email }}"  placeholder="Eamil address">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-success">Edit Profile</button>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>


@stop