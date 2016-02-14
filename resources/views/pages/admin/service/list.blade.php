@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Service List</h3>
            <a href="/back/service/create" class="btn btn-success btn-sm" />Add Service</a>
        </div>
        <div class="col-md-12">
            <form action="/back/service">
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
                    <th><a href="/back/service?sortby=id">Service ID</a></th>
                    <th><a href="/back/service?sortby=service_name">Service Name</a></th>
                    <th><a href="/back/service?sortby=is_active">State</a></th>
                    <th><a href="/back/service?sortby=created_at">Created</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td><a href="/back/service/edit/{{$service->id}}" class="btn-success btn-sm"/>edit</a></td>
                        <td>{{$service->id}}</td>
                        <td>{{$service->service_name}}</td>
                        <td>{{($service->is_active)?'Active':'In-Active'}}</td>
                        <td>{{$service->created_at->format('M j, Y')}}</td>
                        </a>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


     {!! str_replace('/?', '?', $services->render()) !!}
</div>
