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

            <h2>New Project</h2>
            <form action="/back/project/store" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="project_name">Enter Project Name: *</label>
                    <input type="text" class="form-control" name="project_name" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required>
                </div>
                <div class="form-group">
                    <label for="project_desc">Enter Project Description: *</label>
                    <textarea  class="form-control" name="project_desc" maxlength="500" minlength="10" title="minimum characters: 10,  maximum characters: 500 " required></textarea>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        @if ($user->is_admin)
                            <label><input type="checkbox" name="is_public">public</label>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Create</button>
                </div>
                <div class="form-group">
                    <a href="/back/project" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>



