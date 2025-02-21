@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>{{ __('Task Details') }}</div>
                    <a href="{{ route('task.index') }}" class="btn btn-primary">Back</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Task Title:</th>
                                <td>{{ $task->title }}</td>
                            </tr>
                            <tr>
                                <th>Task Description:</th>
                                <td>{{ $task->description }}</td>
                            </tr>
                            <tr>
                                <th>Task Status:</th>
                                <td>
                                    @if($task->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-success">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
