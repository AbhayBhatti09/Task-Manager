<tr>
                                    @if($tasks)
                                    <?php         $i = ($tasks->currentPage() - 1) * $tasks->perPage() + 1;?>
                                    
                                    @foreach($tasks as $task)
                                    
                                    <td>{{ $i}}</td>
                                    <td>{{$task->title}}</td>
                                    <td>{{$task->description}}</td>
                                    <td>
                                        @if($task->status=='pending')
                                            <button class="btn btn-warning">Pending</button>
                                        @else
                                            <button class="btn btn-success">Comleted</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('task.show',$task->id)}}" class="btn btn-secondary"><i class="bx bx-show" title="Show"></i> </a>
                                        <a href="{{route('task.edit',$task->id)}}" class="btn btn-primary"><i class="bx bx-edit-alt" title="Edit"></i></a>
                                        <a href="{{route('task.delete',$task->id)}}"class="btn btn-danger show_confirm"><i class="bx bx-trash" title="Delete"></i> </a>

                                    </td>
                                </tr>
                                <?php $i++;?>

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">No Data Available</td>
                                    </tr>
                                @endif


                    
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">

$('.show_confirm').click(function(event) {
    event.preventDefault();  // Prevent default link action

    var url = $(this).attr('href');  // Get the URL to redirect to after confirmation
    var name = $(this).data("name");

    swal({
        title: `Are you sure you want to delete this task?`,
        text: "This action will soft delete the Task.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = url;  // Redirect to the delete route after confirmation
        }
    });
});


</script>
