@extends('layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title pull-left">{{ $task->title }} 
                    @if ($task->status == 1) 
                        <span class="label label-primary">Open</span>
                    @elseif($task->status == 2)
                        <span class="label label-warning">Soon</span>
                    @elseif($task->status == 3)
                        <span class="label label-info">Pendding</span>
                    @else
                        <span class="label label-success">Close</span>
                    @endif
                </h4>
                <a href="{{ route('task_file', ['task_id' => $task->id]) }}" class="btn mw-md btn-success btn-xs pull-right">Task's Files</a> 
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <p>
                        <small>
                            {{ $task->description }}
                        </small>
                    </p>
                    @if($task->files !== null) 
                    <ul class="file-attached row">
                        @foreach($task->files as $file)
                        <li><a href="/upload/files/{{$file->filename}}"><span class="fa fa-file-archive-o"></span></a></li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table mail-list">
                <tbody>
                    <tr>
                        <td>
                            @foreach($messages as $key => $message)
                            <!-- a single mail -->
                            <div class="mail-item">
                                <table class="mail-container">
                                    <tbody><tr>
                                        <td class="mail-left">
                                            <div class="avatar avatar-lg avatar-circle">
                                                <a href="#"><img src="/upload/avatar/{{ ($message->user_image) ? $message->user_image : 'default.jpg' }}" alt="{{ ($message->username) ? $message->username 
                                                                                                        : ($message->last_name) ? $message->last_name 
                                                                                                        : ($message->name) ? $message->name:
                                                                                                        $message->mobile  }}"></a>
                                            </div>
                                        </td>
                                        <td class="mail-center">
                                            <div class="mail-item-header">
                                                <h4 class="mail-item-title"><a href="mail-view.html" class="title-color">{{ call_user($message) }}</a></h4>
                                                <a href="#"><span class="label label-success hide">client</span></a>
                                                <a href="#"><span class="label label-primary hide">work</span></a>
                                            </div>
                                            <p class="mail-item-excerpt">{{ $message->text }}</p>
                                            
                                            @if(count($message->file_attached))
                                            <ul class="file-attached row">
                                                @foreach($message->file_attached as $file)
                                                <li><a href="/upload/files/{{$file->filename}}"><span class="fa fa-file-archive-o"></span></a></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </td>
                                        <td class="mail-right">
                                            <p class="mail-item-date">{{ $message->created_at  }}</p>
                                            <p class="mail-item-star {{($message->role == 1) ? 'starred' : ''}}">
                                                <a href="#"><i class="zmdi zmdi-star{{($message->role == 1) ? '' : '-outline'}}"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div><!-- END mail-item -->
                            @endforeach

                            <!-- a single mail -->
                            <div class="mail-item hide">
                                <table class="mail-container">
                                    <tbody><tr>
                                        <td class="mail-left">
                                            <div class="avatar avatar-lg avatar-circle">
                                                <a href="#"><img src="../assets/images/209.jpg" alt="sender photo"></a>
                                            </div>
                                        </td>
                                        <td class="mail-center">
                                            <div class="mail-item-header">
                                                <h4 class="mail-item-title"><a href="mail-view.html" class="title-color">Account Activity</a></h4>
                                                <a href="#"><span class="label label-warning">personal</span></a>
                                            </div>
                                            <p class="mail-item-excerpt">A login activity detected from unusual location. please check this mail</p>
                                        </td>
                                        <td class="mail-right">
                                            <p class="mail-item-date">1 minute ago</p>
                                            <p class="mail-item-star">
                                                <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div><!-- END mail-item -->

                            <!-- a single mail -->
                            <div class="mail-item hide">
                                <table class="mail-container">
                                    <tbody><tr>
                                        <td class="mail-left">
                                            <div class="avatar avatar-lg avatar-circle">
                                                <a href="#"><img src="../assets/images/210.jpg" alt="sender photo"></a>
                                            </div>
                                        </td>
                                        <td class="mail-center">
                                            <div class="mail-item-header">
                                                <h4 class="mail-item-title"><a href="mail-view.html" class="title-color">Sales Report 2014</a></h4>
                                                <a href="#"><span class="label label-primary">work</span></a>
                                            </div>
                                            <p class="mail-item-excerpt">Lorem ipsum. ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, accusamus</p>
                                        </td>
                                        <td class="mail-right">
                                            <p class="mail-item-date">2 hours ago</p>
                                            <p class="mail-item-star">
                                                <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div><!-- END mail-item -->

                            <!-- a single mail -->
                            <div class="mail-item hide">
                                <table class="mail-container">
                                    <tbody><tr>
                                        <td class="mail-left">
                                            <div class="avatar avatar-lg avatar-circle">
                                                <a href="#"><img src="../assets/images/211.jpg" alt="sender photo"></a>
                                            </div>
                                        </td>
                                        <td class="mail-center">
                                            <div class="mail-item-header">
                                                <h4 class="mail-item-title"><a href="mail-view.html" class="title-color">Sales Report 2014</a></h4>
                                                <a href="#"><span class="label label-danger">business</span></a>
                                            </div>
                                            <p class="mail-item-excerpt">Lorem ipsum. ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, accusamus</p>
                                        </td>
                                        <td class="mail-right">
                                            <p class="mail-item-date">Just now</p>
                                            <p class="mail-item-star starred">
                                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div><!-- END mail-item -->

                            <!-- a single mail -->
                            <div class="mail-item hide">
                                <table class="mail-container">
                                    <tbody><tr>
                                        <td class="mail-left">
                                            <div class="avatar avatar-lg avatar-circle">
                                                <a href="#"><img src="../assets/images/212.jpg" alt="sender photo"></a>
                                            </div>
                                        </td>
                                        <td class="mail-center">
                                            <div class="mail-item-header">
                                                <h4 class="mail-item-title"><a href="mail-view.html" class="title-color">Sales Report 2014</a></h4>
                                                <a href="#"><span class="label label-warning">personal</span></a>
                                            </div>
                                            <p class="mail-item-excerpt">Lorem ipsum. ipsum dolor sit consectetur adipisicing elit. Eveniet, accusamus</p>
                                        </td>
                                        <td class="mail-right">
                                            <p class="mail-item-date">a minute ago</p>
                                            <p class="mail-item-star">
                                                <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div><!-- END mail-item -->

                            <!-- a single mail -->
                            <div class="mail-item hide">
                                <table class="mail-container">
                                    <tbody><tr>
                                        <td class="mail-left">
                                            <div class="avatar avatar-lg avatar-circle">
                                                <a href="#"><img src="../assets/images/213.jpg" alt="sender photo"></a>
                                            </div>
                                        </td>
                                        <td class="mail-center">
                                            <div class="mail-item-header">
                                                <h4 class="mail-item-title"><a href="mail-view.html" class="title-color">Sales Report 2012</a></h4>
                                                <a href="#"><span class="label label-primary">work</span></a>
                                            </div>
                                            <p class="mail-item-excerpt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, accusamus</p>
                                        </td>
                                        <td class="mail-right">
                                            <p class="mail-item-date">10 days ago</p>
                                            <p class="mail-item-star starred">
                                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div><!-- END mail-item -->

                            <!-- a single mail -->
                            <div class="mail-item hide  ">
                                <table class="mail-container">
                                    <tbody><tr>
                                        <td class="mail-left">
                                            <div class="avatar avatar-lg avatar-circle">
                                                <a href="#"><img src="../assets/images/214.jpg" alt="sender photo"></a>
                                            </div>
                                        </td>
                                        <td class="mail-center">
                                            <div class="mail-item-header">
                                                <h4 class="mail-item-title"><a href="mail-view.html" class="title-color">Sales Report 2011</a></h4>
                                                <a href="#"><span class="label label-success">client</span></a>
                                            </div>
                                            <p class="mail-item-excerpt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, accusamus</p>
                                        </td>
                                        <td class="mail-right">
                                            <p class="mail-item-date">2 years ago</p>
                                            <p class="mail-item-star">
                                                <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div><!-- END mail-item -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default new-message">						
            <form method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <textarea name="text" class="form-control full-wysiwyg"></textarea>
                </div><!-- .panel-body -->

                <div class="panel-footer clearfix">
                    <div class="pull-right">
                        <input type="file" name="file_attached[]" multiple="multiple" />
                        <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <button type="button" class="btn btn-success"><i class="fa fa-save"></i></button>
                        <button type="submit" class="btn btn-primary">Send <i class="fa fa-send"></i></button>
                    </div>
                </div><!-- .panel-footer -->
            </form>
        </div><!-- .panel -->
    </div>
</div>


@stop
