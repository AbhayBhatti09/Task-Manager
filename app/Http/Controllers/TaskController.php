<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index(Request $request){

        $search = $request->input('search');
        $status=$request->input('status');
       
      //  $tasks=Task::latest()->paginate(10);

        $tasks = Task::when($search, function ($query) use ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('status','LIKE',"%{$search}%");
            });
                       
                         
        })
        ->when($status ,function($query) use ($status){
            return $query->where('status','=',$status);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        if ($request->ajax()) {
            // Return only the partial view for the table rows
            return view('partials.task-table', compact('tasks'));
        }
      

       // dd($tasks);
        return view('task.index',compact('tasks'));
    }

    public function create(){
        return view('task.create');
    }

    public function store(request $request){
        $userId=auth()->id();
       // dd($userId);
       // dd($request->all());
        $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);

        $task=new Task();
        $task->title=$request->title;
        $task->description=$request->description;
        $task->user_id=$userId;

        $task->save();

        return redirect()->route('task.index')->with('success','New Task Added Successfully!!');



    }

    public function show($id){
        //dd($id);
        $task=Task::where('id',$id)->first();
        return view('task.show',compact('task'));
        
    }
    public function edit($id){
        //dd($id);
        $task=Task::where('id',$id)->first();
        return view('task.edit',compact('task'));
        
    }

    public function update($id,request $request){

       // dd($id);
       //dd($request->all());
       $request->validate([
        'title'=>'required',
        'description'=>'required'
    ]);
    
    $task=Task::where('id',$id)->update([
        'title'=>$request->title,
        'description'=>$request->description,
        'status'=>$request->status,
    ]);
    return redirect()->route('task.index')->with('success',' Task Updated Successfully!!');



    }

    public function delete($id){
        $task=Task::find($id);
        $task->delete();

        return redirect()->route('task.index')->with('success',' Task deleted Successfully!!');
        //dd($task);
       // dd($id);
    }
}
