@include('layout.adminheader')
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Post List</h3>
            <a href="/back/post/create" class="btn btn-success btn-sm" />Add Post</a>
        </div>
        <div class="col-md-12">
            <form action="/back/post">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input name="search" type="text" class="  search-query form-control" placeholder="Search" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger" type="button">
                                            <span class=" glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><a href="{{url()}}/back/post?sortby=id">ID</a></th>
                    <th><a href="{{url()}}/back/post?sortby=title">Title</a></th>
                    <th><a href="{{url()}}/back/post?sortby=post_type">Post Type</a></th>
                    <th><a href="{{url()}}/back/post?sortby=is_published">Published</a></th>
                    <th><a href="{{url()}}/back/post?sortby=is_active">Active</a></th>
                    <th><a href="{{url()}}/back/post?sortby=created_at">Created</a></th>
                </tr>
              </thead>
              <tbody>
               @foreach ($posts as $post)
                <tr>
                  <td><a href="{{url()}}/back/post/edit/{{$post->id}}" class="btn-success btn-sm"/>edit</a></td>
                  <td>{{$post->id}}</td>
                  <td>{{$post->title}}</td>
                  @if ($post->post_type == 1)
                    <td>News</td>
                  @else
                        <td>Hiring</td>
                  @endif
                  <td>{{$post->is_published}}</td>
                  <td>{{$post->is_active}}</td>
                  <td>{{$post->created_at}}</td>
                </a>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
     {!! str_replace('/?', '?', $posts->render()) !!}
</div>
