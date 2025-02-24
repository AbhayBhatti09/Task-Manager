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
                <div class="col-md-12 mb-2 mt-2 d-flex justify-content-between">
                <a href="{{route('task.create')}}" class="btn btn-primary">Add Task</a>

                <form method="GET" action="{{ url()->current() }}" >

                    <div class=" ">
                        <input type="text" id="search" name="search" placeholder="Search..." class="p-2 border rounded  md:w-3/4 " value="{{ request('search') }}">

                        <select name="status" class="ml-4 p-2 border rounded">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed"{{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>

                        </select>

                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('task.index') }}"  class="btn btn-primary">Reset</a>

                    </div>
                </form>
                </div>
                
                <div class="col-md-12">
                    <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>status</th>
                                    <th>Action</th>                        
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                        @include('partials.task-table', ['tasks' => $tasks])
                                </tbody>


                            </table>
                            

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                {{ $tasks->links('pagination::bootstrap-5') }}

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
<script>
       $(document).ready(function () {
    $('#search').on('keyup', function () {
        let query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                url: "{{ route('task.index') }}",
                type: "GET",
                data: { search: query },
                success: function (data) {
                    $('#table-body').html(data);
                }
            });
        } else {
            // Optionally, you might want to re-load all tasks if no query is provided
            $.ajax({
                url: "{{ route('task.index') }}",
                type: "GET",
                data: { search: '' },
                success: function (data) {
                    $('#table-body').html(data);
                }
            });
        }
    });
});

    </script>

@endsection
