
@extends('layout.index')
@section('title', 'Loại Tin')
@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
{{--            @include('layout.menu')--}}
            <div class="col-md-9 " id="table_data">
                <input type="hidden" value="{{$theloai->id}}" name="idTheLoai" id="idTheLoai">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$theloai->Ten}}</b></h4>
                    </div>
                    {{ csrf_field() }}
                    <div class="panel-body" id="post_data">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Page Content -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var idTheLoai = $('#idTheLoai').val();
            var _token = $('input[name="_token"]').val();
            load_data(idTheLoai, '', _token);
            function load_data(idTheLoai, id, _token) {
                $.ajax({
                    url: "{{route('LoadTheloai')}}",
                    method: 'POST',
                    data:{idTheLoai:idTheLoai, id:id, _token:_token},
                    success: function (data) {
                        $('#load_more_button').remove();
                        $('#post_data').append(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');
                        $('#result').html('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');
                        console.log('jqXHR:');
                        console.log(jqXHR);
                        console.log('textStatus:');
                        console.log(textStatus);
                        console.log('errorThrown:');
                        console.log(errorThrown);
                    },
                });
            }

            $(document).on('click', '#load_more_button', function () {
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading...</b>');
                load_data(idTheLoai, id, _token);
            });
        });
    </script>
@endsection