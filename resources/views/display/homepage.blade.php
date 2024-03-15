@extends('layout.layout')

@section('title')
    {{$title}}
@endsection

@section('content')

    @if(session('msg'))
    <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif

    <div>
        <a  href="{{route('home.add')}}" class="btn btn-primary">Thêm người dùng</a>
    </div>
    <hr>
    <form action="" method="GET" class="mb-6">
        <div class="row">
            <div class="col-4">
                <input name="keyword" type="search" class="form-control" placeholder="nhập tên hoặc email.." value="{{request()->keyword}}">
            </div>
            <div class="col-3" >
                <select name="status" id="" class="form-control"  >
                    <option value="0">Tất cả trạng thái</option>
                    <option value="active" {{request()->status=='active' ? 'selected' : false}}>Kích hoạt</option>
                    <option value="unactive" {{request()->status=='unactive' ? 'selected' : false}}>Chưa kích hoạt</option>
                </select>
            </div>
            <div class="col-3">
                <select name="group_id" id="" class="form-control">
                    <option value="0">Tất cả nhóm</option>
                    @if (!empty(getAllGroup()))
                        @foreach (getAllGroup() as $item)
                            <option value="{{$item->id}}" {{request()->group_id == $item->id ? 'selected':'false'}}>{{$item->group_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-2">
                <button  type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th width='5%'>STT</th>
            <th width='28%'><a href="?sort-by=fullname&sort-type={{$sortType}}">Tên</a></th>
            <th width='27%'><a href="?sort-by=email&sort-type={{$sortType}}">Email</th>
            <th width='10%'>Nhóm</th>
            <th width='10%'>Trạng thái</th>
            <th width='10%'>Thời gian</th>
            <th width='5%'>Sửa</th>
            <th width='5%'>Xóa</th>
        </tr>
        </thead>
        <tbody>
            @if (!empty($list))
                @foreach ($list as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->group_name}}</td>
                        <td>{!!$item->status== 0 ? '<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>' : '<button class="btn btn-info btn-sm">Đã kích hoạt</button>' !!}</td>
                        <td>{{$item->create_at}}</td>
                        <td>
                            <a href="{{route('home.edit',['id'=>$item->id])}}" class="btn btn-success btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a onclick="return confirm('bạn có chắc muốn xóa')" href="{{route('home.delete',['id'=>$item->id])}}" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có người dùng</td>
                </tr>
                
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{$list->links()}}
    </div>



@endsection