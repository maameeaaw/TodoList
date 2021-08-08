<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี , {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session("success"))
                        <div class="alert alert-success" role="alert" >
                                {{session('success')}}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header fs-2" >รายการสิ่งที่ต้องทำ</div>
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">สิ่งที่ต้องทำ</th>
                            <th scope="col">ระยะเวลา</th>
                            <th scope="col">แก้ไข</th>
                            <th scope="col">เสร็จสิ้น</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tasks->count() == 0)
                                <tr>
                                    <td colspan="5" style="text-align: center;">ไม่มีสิ่งที่ต้องทำ</td>
                                </tr>
                            @else
                                @php($i=1)
                                @foreach($tasks as $row)
                                <tr>
                                    <th>{{$tasks->firstItem()+$loop->index}}</th>
                                    <td>{{$row->task}}</td>
                                    <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{url('/task/edit/'.$row->id)}}" class="btn btn-warning">แก้ไข</a>
                                    </td>
                                    <td>
                                        <a href="{{url('/task/done/'.$row->id)}}" class="btn btn-danger">เสร็จสิ้น</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                        {{$tasks->onEachSide(0)->links()}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Todolist</div>
                        <div class="card-body">
                            <form action="{{route('addTask')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">สิ่งที่ต้องทำ</label>
                                    <input type="text" class="form-control" name="task">
                                </div>
                                @error('task')
                                <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                </div>    
                                @enderror
                                <br>
                                <input type="submit" value="เพิ่ม" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
