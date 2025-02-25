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
                                        <a href="{{route('task.delete',$task->id)}}"class="btn btn-danger"><i class="bx bx-trash" title="Delete"></i> </a>

                                    </td>
                                </tr>
                                <?php $i++;?>

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">No Data Available</td>
                                    </tr>
                                @endif