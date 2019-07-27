@extends('layout.index')
@section('title', 'Trang chủ')
@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder" style="padding-top: 10vh;">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4><b>ĐĂNG KÝ TÀI KHOẢN</b></h4></div>
                    <div class="panel-body">
                        @include('Error')
                        <form method="post" action="dangky" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div>
                                <label>Họ tên</label>
                                <input value="{{old('name')}}" type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input value="{{old('email')}}" type="" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập mật khẩu</label>
                                <input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div style="text-align: center">
                                <button type="submit" class="btn btn-default">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection