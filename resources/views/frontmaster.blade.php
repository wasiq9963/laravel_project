<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="height:1500px">
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Logo</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/mart')}}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/mart')}}">Card</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a href="{{url('/')}}" class="nav-link"><span class="glyphicon glyphicon-user"></span> Back To Admin</a></li>
      <li class="nav-item"><button type="button" id="cartid" class="nav-link"><i class="fa fa-shopping-cart fa-2x text-info"></i></button></li>
    </ul>
  </nav>

  
<div class="container" style="margin-top:50px">
  @yield('maincontent')
</div>



</body>
</html>
