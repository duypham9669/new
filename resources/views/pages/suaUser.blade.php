
@extends('layout.index')
@section('title', 'Sửa người dùng')
@section('content')
    <!-- Page Content -->
    <div class="container">
        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8" style="padding-top: 10vh;">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4><b>THÔNG TIN TÀI KHOẢN</b></h4></div>
                    <div class="panel-body">
                        @include('Error')
                        @include('success')
                        <form action="suaUser/{{$user->id}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div>
                                <label>Họ tên</label>
                                <input value="{{$user->name}}" type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input value="{{$user->email}}" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
                                       disabled>
                            </div>
                            <br>
                            <div>
                                <input id="check" type="checkbox" class="" name="check">
                                <label>Đổi mật khẩu</label>
                                <input id="password" type="password" class="form-control" name="password" aria-describedby="basic-addon1" disabled>
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input id="passwordAgain" type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1" disabled>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-default">Sửa</button>
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
@section('script')
    <script>
        document.getElementById('check').onclick = function () {
            if(this.checked){
                document.getElementById('password').removeAttribute('disabled');
                document.getElementById('passwordAgain').removeAttribute('disabled');
                this.value = 1;
            }else{
                document.getElementById('password').setAttribute('disabled', '');
                document.getElementById('passwordAgain').setAttribute('disabled', '');
            }
        }
    </script>
@endsection