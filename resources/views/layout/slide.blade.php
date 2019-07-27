<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $count=0; ?>
                @foreach($slide as $sl)
                    <?php $count++; ?>
                        <li data-target="#carousel-example-generic" data-slide-to="{{$count}}" class="@if($count == 1) active @endif"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                <?php $count=0; ?>
                @foreach($slide as $sl)
                <?php $count++; ?>
                    <div class="item @if($count == 1) active @endif">
                        <img class="slide-image" src="images/slide/{{$sl->Hinh}}" alt="">
                    </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>
<!-- end slide -->