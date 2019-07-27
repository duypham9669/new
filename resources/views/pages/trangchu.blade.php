@extends('layout.index')
@section('title', 'Trang chủ')
@section('content')
    <?php
        $fontColor = "";
    ?>
    <!-- Page Content -->
    <div id="content" class="container">
        <!-- slider -->
{{--        @include('layout.slide')--}}
        <div class="space20"></div>
        <div class="row main-left">
            @include('layout.menu')
            <div id="content" class="col-md-9">
                <div id="content" class="panel panel-default">
                    <div id="content" class="panel-heading" style="background:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">TIN TỨC</h2>
                    </div>
                    <div id="content" class="panel-body">
                        <!-- item -->
                        <?php

                        $myDB = new mysqli('localhost', 'root','','blog');
                        $myDB->set_charset("utf8");
                        $sql = "SELECT * from tintuc WHERE (active=1) ORDER BY id DESC LIMIT 10";
                        $result =$myDB->query($sql);

                        ?>
                    <?php
                        while($r=$result->fetch_assoc()){

                            echo'<div id="content" class="row-item row" style="background-color:'.$fontColor.'  ">';
                            echo'<div id="content" class="col-md-12 border-right">';
                            echo '<div id="content" class="col-md-5">';

                            echo '<a href="detail.html">';
                            echo '   <img class="img-responsive" src="images/tintuc/'.$r["Hinh"].'" alt="">';
                            echo '</a>';
                        echo '</div>';

                        echo '<div id="content" class="col-md-7">';
                            echo '<a href="chitiet/'.$r["id"].'/'.$r["TieuDe"].'"><h3>'.$r["TieuDe"].'</h3></a>';
                        echo '<p>'.$r["TomTat"].'</p>';
                    echo '</div>';
                    echo'<div class="break"></div>';
                            echo'</div>';
                            echo'</div>';
                        }
                        ?>
                    </div>



{{--                                    <div class="col-md-4">--}}
{{--                                        @for($i = 0; $i < count($inf); $i++)--}}
{{--                                            <a href="chitiet/{{$inf[$i]['id']}}/{{$inf[$i]['TieuDe']}}">--}}
{{--                                                <h4>--}}
{{--                                                    <span class="glyphicon glyphicon-list-alt"></span>--}}
{{--                                                    {{$inf[$i]['TieuDe']}}--}}
{{--                                                </h4>--}}
{{--                                            </a>--}}
{{--                                        @endfor--}}
{{--                                    </div>--}}
                                    <div class="break"></div>
                                </div>
                                <!-- end item -->


                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection