@include('layout.adminheader')
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>About/Contacts/Service List</h3>
            <a href="/back/page/create" class="btn btn-success btn-sm" />Add About/Contacts/Service</a>
        </div>
        <div class="col-md-12">
            <form action="/back/page">
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
                    <th><a href="{{url()}}/back/page?sortby=id">ID</a></th>
                    <th><a href="{{url()}}/back/page?sortby=title">Type</a></th>
                    <th><a href="{{url()}}/back/page?sortby=is_active">Active</a></th>
                    <th><a href="{{url()}}/back/page?sortby=created_at">Created</a></th>
                </tr>
              </thead>
              <tbody>
               @foreach ($pages as $page)
                <tr>
                  <td><a href="{{url()}}/back/page/edit/{{$page->id}}" class="btn-success btn-sm"/>edit</a></td>
                  <td>{{$page->id}}</td>
                  <td>{{$page->type}}</td>
                  <td>{{$page->is_active}}</td>
                  <td>{{$page->created_at}}</td>
                </a>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
     {!! str_replace('/?', '?', $pages->render()) !!}
</div>
