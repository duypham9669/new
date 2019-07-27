@extends('admin.layout.index')
@section('title','LoaiTin - List')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại Tin
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
{{--                    @include('Error')--}}
{{--                    @include('success')--}}
{{--                    @include('alert')--}}
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>ID Thể Loại</th>
                        <th>Tên</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loaitin as $lt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$lt->id}}</td>
                            <td>{{$lt->idTheLoai}}</td>
                            <td>{{$lt->Ten}}</td>

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

{{--<script>--}}
    {{--$(document).ready(function(){--}}

        {{--var _token = $('input[name="_token"]').val();--}}

        {{--load_data('', _token);--}}

        {{--function load_data(id="", _token)--}}
        {{--{--}}
            {{--$.ajax({--}}
                {{--url:"{{ route('loadmore.load_data') }}",--}}
                {{--method:"POST",--}}
                {{--data:{id:id, _token:_token},--}}
                {{--success:function(data)--}}
                {{--{--}}
                    {{--$('#load_more_button').remove();--}}
                    {{--$('#post_data').append(data);--}}
                {{--}--}}
            {{--})--}}
        {{--}--}}

        {{--$(document).on('click', '#load_more_button', function(){--}}
            {{--var id = $(this).data('id');--}}
            {{--$('#load_more_button').html('<b>Loading...</b>');--}}
            {{--load_data(id, _token);--}}
        {{--});--}}

    {{--});--}}
{{--</script>--}}