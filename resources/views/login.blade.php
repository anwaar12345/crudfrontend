<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>

<div class="container">




<form class="bg-dark text-white mt-4 p-4" action="{{url('/post-login')}}" method="post" enctype="multipart/form-data">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card mb-4">
  <div class="card-body">
<h3 class="text-center text-dark">Please Login Here</h3><hr><h4 class="text-dark text-center">Need an Account ?? <b><a href="{{url('/register')}}">Register</a></b></h4>
  </div>
</div>
   @csrf
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>    


</div>

</body>
</html>