<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี , {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header fs-2" >รายการที่เสร็จสิ้น</div>
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">สิ่งที่ทำ</th>
                            <th scope="col">เสร็จสิ้นเมื่อ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tasks->count() == 0)
                                <tr>
                                    <td colspan="3" style="text-align: center;">ไม่มีสิ่งที่ทำแล้ว</td>
                                </tr>
                            @else
                                @php($i=1)
                                @foreach($tasks as $row)
                                <tr>
                                    <th>{{$tasks->firstItem()+$loop->index}}</th>
                                    <td>{{$row->task}}</td>
                                    <td>{{Carbon\Carbon::parse($row->updated_at)->diffForHumans()}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                        {{$tasks->onEachSide(0)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>