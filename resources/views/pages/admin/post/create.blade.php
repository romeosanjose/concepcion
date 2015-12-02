@include('layout.adminheader')
<div class="container">
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::get('message'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('message') }}</li>
                </ul>
            </div>
        @endif
        <div class="class="class="col-md-12">

            <h2>New Post</h2>
            <form action="/back/post/store" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">enter title: *</label>
                    <input type="title" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="content">enter content: *</label>
                    <textarea  class="form-control" name="content"></textarea>
                </div>
                <select class="form-control" name="post_type">
                    <option selected disabled>Please select one option</option>
                    @foreach($postTypes as $postType)
                        <option value="{{$postType->id}}">{{$postType->name}}</option>
                    @endforeach
                </select>
                <div class="checkbox">
                    @if ($user->is_admin)
                        <label><input type="checkbox" name="is_published">publish</label>
                    @endif
                </div>

                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Create</button>
                </div>
                <div class="form-group">
                    <a href="/back/material" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>



