@include('layout.header',['post'=> $post, 'product'=>$product, 'project'=>$project])


        <!-- Full Page Image Background Carousel Header -->
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for Slides -->
    <div class="carousel-inner">
        <div class="item active">
            <!-- Set the first background image using inline CSS below. -->
            <div class="fill" style="background-image:url('/assets/images/product.jpg');"></div>
                <div class="carousel-caption">
                    <h1 style="font-size: 3em;">Latest Product</h1>
                    <h1 style="font-size: 4em;">{{$product->product_name}}</h1>
                    <h5>{{ str_limit($product->product_desc, $limit = 50, $end = '...') }}</h5>
                    <p>
                        <a class="btn btn-lg btn-primary" href="{{url()}}/product/detail/{{$product->id}}" role="button">View details &raquo;</a>
                    </p>
                </div>
        </div>
        <div class="item">
            <!-- Set the second background image using inline CSS below. -->
            <div class="fill" style="background-image:url('/assets/images/news.jpg');"></div>
            <div class="carousel-caption">

                    <h1 style="font-size: 3em;">Latest Product</h1>
                    <h1 style="font-size: 4em;">{{$post->title}}</h1>
                    <h5>{{ str_limit($post->content, $limit = 50, $end = '...') }}</h5>
                    <p>
                        <a class="btn btn-lg btn-primary" href="{{url()}}/post/detail/{{$post->id}}/1" role="button">View details &raquo;</a>
                    </p>

            </div>
        </div>
        <div class="item">
            <!-- Set the third background image using inline CSS below. -->
            <div class="fill" style="background-image:url('/assets/images/project.jpg');"></div>
               <div class="carousel-caption">
                        <h1 style="font-size: 3em;">Latest Project</h1>
                        <h1 style="font-size: 4em;">{{$project->project_name}}</h1>
                        <h5>{{ str_limit($project->project_desc, $limit = 50, $end = '...') }}</h5>
                        <p>
                        <p><a class="btn btn-lg btn-primary" href="{{url()}}/project/detail/{{$project->id}}" role="button">View details &raquo;</a></p>
                         </p>
                </div>

            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>

</header>


<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>

      
@include('layout.footer')
