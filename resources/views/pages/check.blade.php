@extends('layout.index')
@section('title', 'Loại Tin')
@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('layout.menu')
            <div class="col-md-9 " id="table_data">
                <div class="panel panel-default">
                    {{--<div class="panel-heading" style="background-color:#337AB7; color:white;">--}}
                        {{--<h4><b>{{$loaitin->Ten}}</b></h4>--}}
                    {{--</div>--}}
                    {{ csrf_field() }}
                    <div class="infinite-scroll" id="post_data">
                        @foreach($tintuc as $tt)
                        <div class="row-item row">
                            <div class="col-md-3">
                                <a href="detail.html">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="images/tintuc/{{$tt->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h3><a href="chitiet/{{$tt->id}}/{{$tt->TieuDeKhongDau}}">{{$tt->TieuDe}}</a></h3>
                                <p>{{$tt->TomTat}}</p>
                                <a class="btn btn-primary" href="chitiet/{{$tt->id}}/{{$tt->TieuDeKhongDau}}">Xem tin <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                        @endforeach
                            {{$tintuc->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Page Content -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
    <script type="text/javascript">
        // ẩn thanh phân trang của laravel
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                debug: true,
                loadingHtml: '<img class="center-block" src="images/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    // xóa thanh phân trang ra khỏi html mỗi khi load xong nội dung
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--var idLoaiTin = $('#idLoaiTin').val();--}}
            {{--var _token = $('input[name="_token"]').val();--}}
            {{--load_data(idLoaiTin, '', _token);--}}
            {{--function load_data(idLoaiTin, id, _token) {--}}
                {{--$.ajax({--}}
                    {{--url: "{{route('LoadLoaitin')}}",--}}
                    {{--method: 'POST',--}}
                    {{--data:{idLoaiTin:idLoaiTin, id:id, _token:_token},--}}
                    {{--success: function (data) {--}}
                        {{--$('#load_more_button').remove();--}}
                        {{--$('#post_data').append(data);--}}
                    {{--},--}}
                    {{--error: function(jqXHR, textStatus, errorThrown) {--}}
                        {{--alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');--}}

                        {{--$('#result').html('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');--}}
                        {{--console.log('jqXHR:');--}}
                        {{--console.log(jqXHR);--}}
                        {{--console.log('textStatus:');--}}
                        {{--console.log(textStatus);--}}
                        {{--console.log('errorThrown:');--}}
                        {{--console.log(errorThrown);--}}
                    {{--},--}}
                {{--});--}}
            {{--}--}}

            {{--$(document).on('click', '#load_more_button', function () {--}}
                {{--var id = $(this).data('id');--}}
                {{--$('#load_more_button').html('<b>Loading...</b>');--}}
                {{--load_data(id, _token);--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection