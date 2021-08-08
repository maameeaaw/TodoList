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
                    <div class="card">
                        <div class="card-header">แก้ไขสิ่งที่ต้องทำ</div>
                        <div class="card-body">
                            <form action="{{url('task/update/'.$task->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">สิ่งที่ต้องทำ</label>
                                    <input type="text" class="form-control" value="{{$task->task}}" name="task">
                                </div>
                                @error('task')
                                <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                </div>    
                                @enderror
                                <br>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
