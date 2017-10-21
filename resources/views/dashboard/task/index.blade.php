@extends('layouts/dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4 class="m-b-lg">Hover rows</h4>
            <p class="m-b-lg docs">
                Add <code>.table-hover</code> to enable a hover state on table rows within a <code>&lt;tbody&gt;</code>.
            </p>

            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Project</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($tasks as $key => $task)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->project_title }}</td>
                            <td>
                                <a href="{{ route('edit_task', ['project_id' => $task->id]) }}">
                                    <span class="fa fa-pencil"></span>
                                    Edit 
                                </a> 
                                <a href="{{ route('delete_task', ['task_id' => $task->id]) }}">
                                    <span class="fa fa-trash"></span>
                                    Delete 
                                </a>
                                <a href="{{ route('view_task', ['task_id' => $task->id]) }}">
                                    <span class="fa fa-eye"></span>
                                    View 
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- .widget -->
    </div>
</div>

@stop