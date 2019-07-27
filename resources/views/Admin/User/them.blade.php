@extends('admin.layout.index')
@section('title','User - Add')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('Error')
                @include('success')
                @include('alert')
                <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="ten" placeholder="Nhập tên người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" placeholder="Nhập email người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="matkhau" placeholder="Nhập password người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Phân quyền:&nbsp</label>
                        <label class="radio-inline">
                            <input name="level" value="1" type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="level" value="0" checked type="radio">User
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
