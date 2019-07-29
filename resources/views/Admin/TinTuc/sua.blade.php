@extends('admin.layout.index')
@section('title','TinTuc - Edit')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>{{$tintuc->TieuDe}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('Error')
                    @include('success')
                    @include('alert')
                    <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tên thể loại</label>
                            <select class="form-control" name="theloai" id="theloai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}" @if($tl->id == $tintuc->loaitin->theloai->id) selected @endif>{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên loại tin</label>
                            <select class="form-control" name="loaitin" id="loaitin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}" @if($lt->id == $tintuc->loaitin->id) selected @endif>{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="tieude" placeholder="Nhập tiêu đề cho tin" value="{{$tintuc->TieuDe}}" />
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <input class="form-control" name="tomtat" placeholder="Nhập tóm tắt cho tin" value="{{$tintuc->TomTat}}"/>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control ckeditor" rows="3" name="noidung" id="demo" >{{$tintuc->NoiDung}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="Hinh">Hình ảnh</label>
                            <div>
                                <img src="images/tintuc/{{$tintuc->Hinh}}" width="200px" alt="">
                            </div>
                            <input class="form-control" type="file" name="newImage" id="newImage">
                        </div>
                        <div class="form-group">
                            <label>Nổi bật:&nbsp</label>
                            <label class="radio-inline">
                                <input name="noibat" value="1" @if($tintuc->NoiBat == 1) checked @endif type="radio">Có
                            </label>
                            <label class="radio-inline">
                                <input name="noibat" value="0" type="radio" @if($tintuc->NoiBat == 0) checked @endif >Không
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>

                <div class="col-lg-12">
                    <h1 class="page-header">Comment
                        <small>Danh sách</small>
                    </h1>
                </div>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    @foreach($comment as $cm)--}}
{{--                        <tr class="odd gradeX" align="center">--}}
{{--                            <td>{{$cm->id}}</td>--}}
{{--                            <td>{{$cm->user->name}}</td>--}}
{{--                            <td>{{$cm->NoiDung}}</td>--}}
{{--                            <td>{{$cm->created_at}}</td>--}}
{{--                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('Are you sure to delete?')" href="admin/comment/xoa/{{$cm->id}}"> Xóa</a></td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
                    </tbody>
                </table>
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
<style>
    #dataTables-example_wrapper{
        padding-bottom: 10vh;
    }
</style>