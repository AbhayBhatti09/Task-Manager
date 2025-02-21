@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
        <div class="card">

            <div class="col-md-12 mb-2">
                    <div class="card-header text-center"><strong><h2>Task</h2></strong></div>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="row">
            <div class="card ">
                @session('success')
                  <div class="alert alert-success" role="alert"> 
                      {{ $value }}
                  </div>
                @endsession
                <div class="col-md-12 mb-2 mt-2 d-flex justify-content-end">
                    <a href="{{route('task.create')}}" class="btn btn-primary">Add Task</a>
                </div>
                
                <div class="col-md-12">
                    <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>status</th>
                                    <th>Action</th>                        
                                </tr>
                                <tr>
                                    @foreach($tasks as $task)
                                    <td>{{ $task->id}}</td>
                                    <td>{{$task->title}}</td>
                                    <td>{{$task->description}}</td>
                                    <td>
                                        @if($task->status='pending')
                                        <button class="btn btn-warning">Pending</button>
                                        @else
                                        <button class="btn btn-success">Comleted</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('task.show',$task->id)}}" class="btn btn-secondary">Show</a>
                                        <a href="{{route('task.edit',$task->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{route('task.delete',$task->id)}}"class="btn btn-danger">Delete</a>

                                    </td>
                                </tr>
                                @endforeach

                            </table>
                            

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
$(document).ready(function() {
  $('#tasksTable').DataTable({
    // Default configuration already includes pagination, search bar, and record count
    paging: true,       // enables pagination
    searching: true,    // adds a search bar
    ordering: true,     // enables sorting on columns
    info: true          // shows record count and other info
  });
});
</script>

@endsection
