<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="trangchu">Trang chủ</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul  class="nav navbar-nav">
                <li>
                    <a href="#">Điện thoại</a>
                </li>
                <li>
                    <a href="#">PC</a>
                </li>
                <li>
                    <a href="#">Xe</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" role="search" method="get" action="timkiem" style="margin-top: 10px">
                {{csrf_field()}}
                <div class="form-group">
                    <input name="search" type="text" class="form-control" placeholder="Search" required>
                </div>
                <button type="submit" class="btn btn-default">Tìm kiếm</button>
            </form>

            <ul class="nav navbar-nav pull-right" style="margin-top: 15px">
                @if (Route::has('login'))
                    <div class="top-right links whitetext">
                        @auth
                            <a style="color: white"; href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Đăng nhập</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Đăng ký</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </ul>
            <div class="them" style=" float: right; margin-right: 30px;">
                <button type="button" id="btn1" class="btn btn-light">Light</button>
                <button type="button" id="btn2" class="btn btn-dark">Dark</button>

            </div>
        </div>

{{--/.navbar-collapse -->--}}
    </div>
    <!-- /.container -->

</nav>