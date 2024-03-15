@extends('layout.layout')

@section('title')
    {{$title}}
@endsection

@section('content')

    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">Dữ liệu nhập không hợp lệ</div>
    @endif


    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control" name="fullname" placeholder="nhập họ tên ..." value="{{old('fullname')}}">
            @error('fullname')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" placeholder="nhập email ..." value="{{old('email')}}">
            @error('email')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Nhóm</label>
            <select name="group_id" class="form-control">
                <option value="0">Chọn nhóm</option>
                @if (!empty($allGroup))
                    @foreach ($allGroup as $item)
                        <option value="{{$item->id}}" {{old('group_id')==$item->id?'selected':false}}>{{$item->group_name}}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
            <span style="color:red">{{$message}}</span> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control" {{old('status'==1?'selected':false)}}>
                <option value="0">Chưa kích hoạt</option>
                <option value="1">Kích hoạt</option>
            </select>
            @error('status')
            <span style="color:red">{{$message}}</span> 
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{route('home.index')}}" class="btn btn-warning">Quay lại</a>
        @csrf
    </form>

@endsection