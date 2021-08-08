<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(){
        $tasks = DB::table('tasks')
        ->where('user_id', '=', Auth::user()->id)
        ->where('task_status', '=', 'doing')
        ->paginate(5);
        return view('task.index',compact('tasks'));
    }

    public function done(){
        $tasks = DB::table('tasks')
        ->where('user_id', '=', Auth::user()->id)
        ->where('task_status', '=', 'done')
        ->paginate(5);
        return view('task.done',compact('tasks'));
    }

    public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate([
            'task'=>'required|max:10'
        ],
        ['task.required'=>"กรุณากรอกข้อมูล",
        'task.max'=>"กรุณากรอกไม่เกิน 255 ตัวอักษร"]
    );
        //บันทึกข้อมูล
        $task = new Task;
        $task->task = $request->task;
        $task->user_id = Auth::user()->id;
        $task->task_status = 'doing';
        $task->save();
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function update(Request $request,$id){
        //ตรวจสอบข้อมูล
        $request->validate([
            'task'=>'required|max:255'
        ],
        ['task.required'=>"กรุณากรอกข้อมูล",
        'task.max'=>"กรุณากรอกไม่เกิน 255 ตัวอักษร"]
    );
        //บันทึกข้อมูล
        $update = Task::find($id)->update([
            'task'=>$request->task
        ]);
        return redirect()->route('taskAll')->with('success','อัพเดตข้อมูลเรียบร้อย');
    }

    public function edit($id){
        $task = Task::find($id);
        return view('task.edit',compact('task'));
    }

    public function Todone($id){
        $update = Task::find($id)->update([
            'task_status'=>'done'
        ]);
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }
}
