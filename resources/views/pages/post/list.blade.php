@include('layout.header')  
@include('layout.banner')

<div class="content">
    <div class="row">
   
           <!-- Menu -->
          <div class="side-menu col-sm-3">    
              <!-- Search body -->
              <div id="search" >
                        <div class="">
                            <form class="form-horizontal" role="search" action="/post/{{$postType}}" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control text-search" placeholder="Search" name="search">
                                    <button type="submit" class="btn btn-search"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                                
                            </form>
                        </div>
              </div>

              <!-- Main Menu -->
              <div class="filters">
                    <h3>Sort By</h3>
                    <div class="list-group">
                      <a class="list-group-item" href="/post/{{$postType}}?sortby=post.title"><span class="glyphicon"></span>Post Title</a>
                      <a class="list-group-item" href="/post/{{$postType}}?sortby=post.updated_at"><span class="glyphicon"></span>Creation Date</a>
                    </div>
              </div>
      
    
          </div><!--end of menu -->    



          <!-- Main Content -->
          <div class="container-fluid">
              <div class="side-body">
                    <div class="col-lg-9" style="text-align:center;">
                      @if ($postType == 1)
                        <h1 class="page-header">NEWS</h1>
                      @else
                        <h1 class="page-header">JOB POSTINGS</h1>
                      @endif
                    </div>
                    <div class="list-group col-lg-9">
                       @foreach ($posts as $post)  
                        <div class="list-group box-glow">
                            <a href="/post/detail/{{$post->id}}/{{$postType}}" class="list-group-item ">
                                   @if ($post->disk_name != '')
                                    <img class="img-responsive img-rounded item-thumb" src="{{url().'/images/'. $post->disk_name}}" alt="" width="150" height="150" >
                                   @else
                                    <img class="img-responsive img-rounded item-thumb" src="/assets/images/noimage.png" alt="NO IMAGE" width="150" height="150" style="float:left;">
                                   @endif
                                
                                  <h3>{{$post->title}}</h3>
                                  <?php $post->content = htmlspecialchars_decode($post->content,ENT_NOQUOTES); $post->content=$post->content; ?> 
                                  <p>{!! str_limit($post->content,$limit=50, $end = '...') !!}</p>                                
                            </a>
                        </div>
                       @endforeach 
                    </div>
              </div>
          </div>  

  </div><!--end of row -->
</div>

@include('layout.footer')
