<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index(){
        $tasks=Task::all();
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
