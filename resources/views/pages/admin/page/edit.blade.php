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
            <div class="alert alert-info">
                <ul>
                    <li>{{ Session::get('message') }}</li>
                </ul>
            </div>
        @endif
        <div class="col-md-12">
            <h2>Edit Page</h2>
            <form action="/back/page/update/{{$page->id}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <select class="form-control" name="type">
                        <option  value="{{$page->type}}">{{$page->type}}</option>
                        <option value="about">about</option>
                        <option value="contacts">contacts</option>
                        <!-- <option value="service">service</option> -->
                    </select>
                </div>    

                <div class="form-group">
                    <label for="content">Enter content: *</label>
                    <textarea  class="form-control" id="content" name="content"  minlength="10" title="minimum characters: 10,  maximum characters: 500 " required>{{$page->content}}</textarea>
                </div>
                
                <div class="checkbox">
                    @if ($page->is_active)
                        <label><input type="checkbox" name="is_active" checked>active</label>
                    @else
                        <label><input type="checkbox" name="is_active">active</label>
                    @endif
                </div>


                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Update</button>
                </div>
                <div class="form-group">
                    <a href="/back/page" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>
                <div class="form-group">
                    <a href="/back/page/create" class="btn btn-info" style="width:100%;"/>Add Another Page</button></a>
                </div>

            </form>




        </div>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('content');
    CKEDITOR.config.allowedContent = true;
</script>


