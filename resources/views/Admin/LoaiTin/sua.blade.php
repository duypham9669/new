@extends('admin.layout.index')
@section('title','LoaiTin - Edit')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại Tin
                        <small>{{$loaitin->Ten}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('Error')
                    @include('success')
                    @include('alert')
                    <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tên thể loại</label>
                            <select class="form-control" name="Theloai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}"
                                        @if($loaitin->idTheLoai == $tl->id)
                                            {{"selected"}}
                                                @endif
                                    >
                                        {{$tl->Ten}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên loại tin</label>
                            <input class="form-control" name="Ten" placeholder="Nhập tên loại tin mới" />
                        </div>
                        <button type="submit" class="btn btn-default">Sửa loại tin</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection