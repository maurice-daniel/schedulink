<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/favicon.png">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="body-log d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <div class="text-center">
                                <h1 class="h4 mb-4">Schedulink</h1>
                            </div>
                            <form action="{{ route('login.action') }}" method="POST" class="user">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control form-control-user" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
