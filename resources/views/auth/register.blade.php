<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/favicon.png">
    <title>Create an Account</title>
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
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{ route('register.save') }}" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control form-control-user" id="name" value="{{ old('name') }}" placeholder="Name">
                                    @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <input name="email" type="email" class="form-control form-control-user" id="email" value="{{ old('email') }}" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="password" type="password" class="form-control form-control-user" id="password" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                    <input name="password_confirmation" type="password" class="form-control form-control-user" id="password_confirmation" placeholder="Repeat Password">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-reg btn-primary btn-user btn-block">Register Account</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
