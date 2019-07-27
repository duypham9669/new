@extends('layout.index')
@section('title', 'Đăng nhập')
@section('content')
    <div class="container">
        <!-- slider -->
        <div class="row carousel-holder" style="padding-top: 15vh;">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4><b>ĐĂNG NHẬP</b></h4></div>
                    <div class="panel-body">
                        @include('Error')
                        <form method= "post" action="dangnhap">
                            {{csrf_field()}}
                            <div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                            </div>
                            <br>
                            <div>
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <br>
                            <div class="text-center">
                                <button  type="submit" class="btn btn-default">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
@endsection
