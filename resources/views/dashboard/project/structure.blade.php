@extends('layouts/dashboard')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Inline Form</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-xl">
                    <h4 class="m-b-md">Project Structure</h4>
                    <form method="post" >
                        <div class="structures-container">
                            @if($struct)
                            <div class="structure">
                                @foreach($struct->inputs as $key => $input)
                                    <div class="form-group row m-rl-0 ">
                                        <div class="col-xs-12 col-sm-5">
                                            <label for="title{{$key}}">Title</label>
                                            <input type="text" class="form-control" name="struct[{{$key}}][title]" id="title{{$key}}" value="{{ $input['title'] }}" placeholder="Example: End Date">
                                        </div>
                                        <div class="col-xs-12 col-sm-5">
                                            <label for="type{{$key}}">Type</label>
                                            <select class="form-control" id="type{{$key}}" name="struct[{{$key}}][type]" >
                                                <option {{ ($input['type'] == 'text') ? 'selected' : ''  }} value="text"> Text </option>
                                                <option {{ ($input['type'] == 'select') ? 'selected' : ''  }} value="select"> Select </option>
                                                <option {{ ($input['type'] == 'radio') ? 'selected' : ''  }} value="radio"> Radio </option>
                                                <option {{ ($input['type'] == 'checkbox') ? 'selected' : ''  }} value="checkbox"> CheckBox </option>
                                                <option {{ ($input['type'] == 'textarea') ? 'selected' : ''  }} value="textarea"> Textarea </option>
                                                <option {{ ($input['type'] == 'fileuploader') ? 'selected' : ''  }} value="fileuploader"> File Uploader </option>
                                                <option {{ ($input['type'] == 'date') ? 'selected' : ''  }} value="date"> Date </option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <label></label>
                                            <div>
                                            <button class="btn btn-success add_new_structure">New Structure</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                            <div class="structure">
                                <div class="form-group row m-rl-0 ">
                                    <div class="col-xs-12 col-sm-5">
                                        <label for="title1">Title</label>
                                        <input type="text" class="form-control" name="struct[0][title]" id="title1" placeholder="Example: End Date">
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <label for="type1">Type</label>
                                        <select class="form-control" id="type1" name="struct[0][type]" >
                                            <option value="text"> Text </option>
                                            <option value="select"> Select </option>
                                            <option value="radio"> Radio </option>
                                            <option value="checkbox"> CheckBox </option>
                                            <option value="textarea"> Textarea </option>
                                            <option value="fileuploader"> File Uploader </option>
                                            <option value="date"> Date </option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                        <label></label>
                                        <div>
                                        <button class="btn btn-success add_new_structure">New Structure</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row m-rl-0 form-group m-t-10">
                            <div class="col-xs-6 col-sm-4 ">
                                <button class="btn btn-success add_new_option">Set Structure</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>

@stop