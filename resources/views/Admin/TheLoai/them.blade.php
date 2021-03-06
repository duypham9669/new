@extends('admin.layout.index')
@section('title','TheLoai - Add')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể loại
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('Error')
                @include('success')
                <form action="admin/theloai/them" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Tên thể loại</label>
                        <input class="form-control" name="ten" placeholder="Nhập tên thể loại" />
                    </div>
                    <button type="submit" class="btn btn-default">Thêm thể loại</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection