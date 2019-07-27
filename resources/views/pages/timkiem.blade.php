@extends('layout.index')
@section('title', 'Tìm Kiếm')
@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('layout.menu')
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Tìm thấy <span id="total_records">{{$num}}</span> kết quả</b></h4>
                        <?php
                        function changeColor($str, $obj){
                            return str_replace($obj, "<span style='color:red;'>$obj</span>", $str);
                        }
                        ?>
                    </div>
                    <div class="panel-body infinite-scroll" >
                        @foreach($tintuc as $tt)
                            <div class="row-item row">
                                <div class="col-md-3">
                                    <a href="detail.html">
                                        <br>
                                        <img width="200px" height="200px" class="img-responsive" src="images/tintuc/{{$tt->Hinh}}" alt="">
                                    </a>
                                </div>

                                <div class="col-md-9">
                                    <h3><a href="chitiet/{{$tt->id}}/{{$tt->TieuDeKhongDau}}">{!! changeColor($tt->TieuDe, $search) !!}</a></h3>
                                    <p>{{$tt->TomTat}}</p>
                                    <a class="btn btn-primary" href="chitiet/{{$tt->id}}/{{$tt->TieuDeKhongDau}}">Xem tin <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <div class="break"></div>

                            </div>
                        @endforeach
                            {{$tintuc->links()}}
                    </div>
                    <!-- Pagination -->
                    <div class="text-center">

                    </div>
                    <!-- /.row -->

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
@endsection

