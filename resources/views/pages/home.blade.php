@include('layout.header')
    @include('layout.carousel')
    <div class="content">
        <div class="row">
            <div class="home-welcome-title ">WELCOME TO CONCEPCION GLASS AND ALUMINUM SERVICE</div>
            <hr>
            <div class="home-welcom-content ">
                <p>
                     The company started in 1969 and the owner job is carpenter and the place is only in the house. Then later on the company started to grow in 1970’s they started selling jalousie and they find a Chinese contractor who provide materials in the business and the business grow bigger and bigger, as of now the one who handle the company are all children of Doroteo Concepcion they are Eddie, Jerry, Tessie, Leo and Larry.
                </p>
            </div>
        </div>
        <div class="row ">
            <div data-wow-duration="2s" data-wow-iteration="100" class="col-sm-3 home-panel wow zoomIn">
                <div class="home-icon-wrapper">
                    <img src="/assets/images/product_icon.png" class="home-icon">
                </div>
                <h3 class="home-title">Latest Product</h3>
                <h2 class="home-subtitle">{{$product->product_name}}</h2>
                <p class="home-desc">{{str_limit($product->product_desc,$limit=100, $end = '...')}}</p><br>
                <a href="/product/detail/{{$product->id}}" class="btn-bottom">
                    <button class="btn btn-success">View More</button>
                </a>
            </div>
            <div data-wow-duration="2s" data-wow-iteration="100" class="col-sm-3 home-panel wow zoomIn">
                <div class="home-icon-wrapper">    
                    <img src="/assets/images/project_icon.png" class="home-icon">
                </div>    
                <h3 class="home-title">Latest Project</h3>
                <h2 class="home-subtitle">{{$project->project_name}}</h2>
                <p class="home-desc">{{str_limit($project->project_desc,$limit=100, $end = '...')}}</p><br>
                <a href="/project/detail/{{$project->id}}">
                    <button class="btn btn-success">View More</button>
                </a>
            </div>
            <div data-wow-duration="2s" data-wow-iteration="100" class="col-sm-3 home-panel wow zoomIn">
                <div class="home-icon-wrapper">
                    <img src="/assets/images/news_icon.png" class="home-icon">
                </div>    
                <h3 class="home-title">Latest News</h3>
                <h2 class="home-subtitle">{{$news->title}}</h2>
                <?php $news->content =  htmlspecialchars_decode($news->content,ENT_NOQUOTES); $news->content = $news->content; ?>
                <p class="home-desc">{!! str_limit($news->content,$limit=100, $end = '...') !!}</p><br>
                <a href="/post/detail/{{$news->id}}/1">
                    <button class="btn btn-success">View More</button>
                </a>
            </div>
            <div data-wow-duration="2s" data-wow-iteration="100" class="col-sm-3 home-panel wow zoomIn">
                <div class="home-icon-wrapper">
                    <img src="/assets/images/hiring_icon.png" class="home-icon">
                </div>    
                <h3 class="home-title">Latest Hiring</h3>
                <h2 class="home-subtitle">{{$job->title}}</h2>
                <?php $job->content =  htmlspecialchars_decode($job->content,ENT_NOQUOTES); $job->content = $job->content; ?>
                <p class="home-desc">{!! str_limit($job->content,$limit=100, $end = '...') !!}</p><br>
                <a href="/post/detail/{{$job->id}}/2">
                    <button class="btn btn-success">View More</button>
                </a>
            </div>
        </div>
    </div>      
@include('layout.footer')
