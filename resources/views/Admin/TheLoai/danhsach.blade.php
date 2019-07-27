@extends('admin.layout.index')
@section('title','TheLoai - List')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
{{--                @include('Error')--}}
{{--                @include('success')--}}
{{--                @include('alert')--}}
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Tên</th>

                    <th>Xóa</th>
                    <th>Sửa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($theloai as $tl)
                    <tr class="even gradeC" align="center">
                        <td>{{$tl->id}}</td>
                        <td>{{$tl->Ten}}</td>

                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                            <a onclick="return confirm('Are you sure to delete?')" href="admin/theloai/xoa/{{$tl->id}}">Xóa</a>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/theloai/sua/{{$tl->id}}">Sửa</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection