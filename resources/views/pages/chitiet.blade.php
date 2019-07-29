@extends('layout.index')
@section('title', 'Trang chủ')
@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-9">
                <!-- Blog Post -->
                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>
                <!-- Author -->
                <p class="lead">
                    by <a>HL</a>
                </p>
                <!-- Preview Image -->
                <div class="text-center">
                    <img class="img-responsive" src="images/tintuc/{{$tintuc->Hinh}}" alt="">
                </div>
                <!-- Date/Time -->
{{--                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$time}}</p>--}}
{{--                <hr>--}}

                <!-- Post Content -->
                <p class="lead">{{$tintuc->TomTat}}</p>
                {!!$tintuc->NoiDung!!}
                <p></p>

                <hr>

                <!-- Comments AJAX Form -->
                <div class="well">
                    <input type="hidden" value="{{$tintuc->id}}" name="idTinTuc" id="idTinTuc">
                    <h4>Viết bình luận  <span class="glyphicon glyphicon-pencil"></span></h4>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="alert alert-success print-success-msg" style="display:none">
                        <ul></ul>
                    </div>
                    {{csrf_field()}}
                    <form>
                        @if(\Illuminate\Support\Facades\Auth::check() == false)
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" id="name" placeholder="Tên của bạn">
                            </div>
                        @else
                            <input id="name" type="hidden" value="{{\Illuminate\Support\Facades\Auth::user()->name}}" name="name">
                        @endif
                        <div class="form-group">
                            <textarea name="noidung" id="noidung" class="form-control" rows="3" placeholder="Nhập bình luận của bạn"></textarea>
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary">Gửi bình luận</button>
                    </form>
                </div>

                <hr>
            </div>


            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @for($i = 0; $i< count($lienquan); $i++)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="images/tintuc/{{$lienquan[$i]['Hinh']}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="chitiet/{{$lienquan[$i]['id']}}/{{$lienquan[$i]['TieuDe']}}"><b>{{$lienquan[$i]['TieuDe']}}</b></a>
                            </div>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                         @endfor
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @for($i = 0; $i< count($noibat); $i++)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="detail.html">
                                        <img class="img-responsive" src="images/tintuc/{{$noibat[$i]['Hinh']}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="chitiet/{{$noibat[$i]['id']}}/{{$noibat[$i]['TieuDe']}}"><b>{{$noibat[$i]['TieuDe']}}</b></a>
                                </div>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endfor
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
           $(document).on('click', '#submit', function (e) {
               e.preventDefault();
              var name = $('#name').val();
              var noidung = $('#noidung').val();
              var _token = $('input[name="_token"]').val();
              var idTinTuc = $('#idTinTuc').val();
           {{--   $.ajax({--}}
           {{--       url: "{{route('CommentAjax')}}",--}}
           {{--       method: "POST",--}}
           {{--       data: {name:name, noidung:noidung, _token:_token, idTinTuc:idTinTuc},--}}
           {{--       dataType: 'json',--}}
           {{--       success: function (data) {--}}
           {{--           if($.isEmptyObject(data.error)){--}}
           {{--               $(".print-error-msg").css('display','none');--}}
           {{--                 printSuccessMsg(data.success);--}}
           {{--               $('#CommentContainer').html(data.output);--}}
           {{--               $('#noidung').val('');--}}

           {{--           }else{--}}
           {{--               printErrorMsg(data.error);--}}
           {{--               $(".print-success-msg").css('display','none');--}}
           {{--           }--}}
           {{--       },--}}
           {{--       error: function(jqXHR, textStatus, errorThrown) {--}}
           {{--           alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');--}}

           {{--           $('#result').html('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');--}}
           {{--           console.log('jqXHR:');--}}
           {{--           console.log(jqXHR);--}}
           {{--           console.log('textStatus:');--}}
           {{--           console.log(textStatus);--}}
           {{--           console.log('errorThrown:');--}}
           {{--           console.log(errorThrown);--}}
           {{--       },--}}
           {{--   })--}}
           {{--});--}}
            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
            function printSuccessMsg (msg) {
                $(".print-success-msg").find("ul").html('');
                $(".print-success-msg").css('display','block');
                $(".print-success-msg").find("ul").append('<li>'+msg+'</li>');
            }

            function clearSuccessMsg (msg) {
                $(".print-success-msg").find("ul").html('');
                $(".print-success-msg").css('display','none');
            }
        });
    </script>
@endsection
