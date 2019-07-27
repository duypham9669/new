@extends('admin.layout.index')
@section('title','TinTuc - Add')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('Error')
                @include('success')
                @include('alert')
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Tên thể loại</label>
                        <select class="form-control" name="theloai" id="theloai">
                            @foreach($theloai as $tl)
                                <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên loại tin</label>
                        <select class="form-control" name="loaitin" id="loaitin">
                            @foreach($loaitin as $lt)
                                <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="tieude" placeholder="Nhập tiêu đề cho tin" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <input class="form-control" name="tomtat" placeholder="Nhập tóm tắt cho tin" />
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea class="form-control ckeditor" rows="3" name="noidung" id="demo"></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="Hinh">Hình ảnh</label>
                        <input class="form-control" type="file" name="Hinh" id="Hinh">
                    </div>
                    <div class="form-group">
                        <label>Nổi bật:&nbsp</label>
                        <label class="radio-inline">
                            <input name="noibat" value="1" checked type="radio">Có
                        </label>
                        <label class="radio-inline">
                            <input name="noibat" value="0" type="radio">Không
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm tin tức</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
           $("#theloai").change(function(){
               var idTheloai = $(this).val();
               $.get("admin/ajax/loaitin/"+idTheloai, function(data){
                   $("#loaitin").html(data);
               });
           });
        });
    </script>
@endsection