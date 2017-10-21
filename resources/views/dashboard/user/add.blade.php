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
                    @if(Session::has('error_message')) 
                        <div class="alert alert-danger">
                            {{ Session::get('error_message') }}
                        </div>
                    @endif
                </div>
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="mobile" class="col-sm-3 col-md-2 control-label">Mobile:</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="Mobile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-sm-3 col-md-2 control-label">Role:</label>
                        <div class="col-sm-9 col-md-10">
                            <select class="form-control" name="role" id="role" >
                                <option value="2"> -- employee -- </option>
                                <option value="1"> -- manager -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-success">Add User</button>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>


@stop