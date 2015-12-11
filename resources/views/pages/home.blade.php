@include('layout.header',['post'=> $post, 'product'=>$product, 'project'=>$project])

 <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        @if ($product)
          <div class="col-lg-4">
            <img class="img-circle" src="/assets/images/product140.png" alt="Generic placeholder image" width="140" height="140" >
            <h2>Latest Product</h2>
            <p>
              <h3>{{$product->product_name}}</h3>
                  {{$product->product_desc}}
            </p>
            <p><a class="btn btn-default" href="{{url()}}/product/detail/{{$product->id}}" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        @endif
        @if ($post)
          <div class="col-lg-4">
            <img class="img-circle" src="/assets/images/news140.png" alt="Generic placeholder image" width="140" height="140" >
            <h2>Latest News</h2>
            <p>
                <h3>{{$post->title}}</h3>
                  {{$post->content}}
            </p>
            <p><a class="btn btn-default" href="{{url()}}/post/detail/{{$post->id}}" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        @endif
        @if ($project)
          <div class="col-lg-4">
            <img class="img-circle" src="/assets/images/project140.png" alt="Generic placeholder image" width="140" height="140">
            <h2>Latest Project</h2>
            <p>
                <h3>{{$project->project_name}}</h3>
                  {{$project->project_desc}}
            </p>
            <p><a class="btn btn-default" href="{{url()}}/project/detail/{{$project->id}}" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        @endif
      </div><!-- /.row -->

      
@include('layout.footer')
</div>