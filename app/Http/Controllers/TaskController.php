<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

use Mail;

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

    public function store(Request $request){
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
   // dd($id);
    $task=Task::find($id);
    $user_id=$task->user_id;
    $user=User::find($user_id);
    $email=$user->email;
   // dd($email);
   // dd($task->user_id);

    if($request->status=='completed'){
       // dd('completed');
        Mail::send('Email.task-tamplate',['user'=>$user,'task'=>$task],function($message) use ($email){
            $message->to($email);
            $message->subject('Task Completed Successfully');
        });
    }
    
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
