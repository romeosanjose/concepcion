<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Conception Admin Password Reset</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{URL::asset('assets/css/signin.css')}}" rel="stylesheet">
  </head>

  
 <form class="form-signin" method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required autofocus>
    </div>

    <div>
        Password
        <input type="password" name="password" class="form-control" placeholder="Password" required autofocus>
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required autofocus>
    </div>

    <div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Reset Password
        </button>
    </div>
</form>
