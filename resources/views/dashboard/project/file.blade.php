@extends('layouts/dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4 class="m-b-lg">Hover rows</h4>
            <p class="m-b-lg docs">
                Add <code>.table-hover</code> to enable a hover state on table rows within a <code>&lt;tbody&gt;</code>.
            </p>
            <div id="gallery" class="gallery file-manager m-b-lg">
                
                <h3>{{ $project->title }}</h3>
                <div class="clearfix"></div>
                    <div class="row">
                    @foreach($files_task as $image)
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="gallery-item">
                            <div class="thumb">
                                <a href="/upload/files/{{ $image->filename }}" data-lightbox="gallery-1" data-title="gallery image">
                                    <img class="img-responsive" src="/upload/files/{{ $image->filename }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($files_message as $image)
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="gallery-item">
                            <div class="thumb">
                                <a href="/upload/files/{{ $image->filename }}" data-lightbox="gallery-1" data-title="gallery image">
                                    <img class="img-responsive" src="/upload/files/{{ $image->filename }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                
            </div>
        </div><!-- .widget -->
    </div>
</div>

@stop