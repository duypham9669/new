@extends('admin.layout.index')
@section('title','User - Edit')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>{{$user->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('Error')
                    @include('success')
                    @include('alert')
                    <form action="admin/user/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="ten" value="{{$user->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" value="{{$user->email}}" />
                        </div>
                        <div class="form-group">
                            <label for="check">Đổi mật khẩu  </label>
                            <input type="checkbox" name="check" id="check">
                        </div>
                        <div class="form-group" >
                            <label>Mật khẩu mới</label>
                            <input type="password" class="form-control" id="matkhau" name="matkhau" value="" disabled />
                        </div>
                        <div class="form-group">
                            <label>Phân quyền:&nbsp</label>
                            <label class="radio-inline">
                                <input name="level" value="1" type="radio"
                                    @if($user->level == 1)
                                        checked
                                    @endif
                                >Admin
                            </label>
                            <label class="radio-inline">
                                <input name="level" value="0" type="radio"
                                    @if($user->level == 0)
                                    checked
                                    @endif
                                >User
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
@section('script')
    <script>
        document.getElementById('check').onclick = function () {
            if(this.checked){
                document.getElementById('matkhau').removeAttribute('disabled');
                this.value = 1;
            }else{
                document.getElementById('matkhau').setAttribute('disabled', '');
            }
        }
    </script>
@endsection
