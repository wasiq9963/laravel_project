<!DOCTYPE html>
<html lang="en">
<head>
  <title>Subway Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('style/bootstrap.min.css')}}">
  <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('style/popper.min.js')}}"></script>
  <script src="{{asset('style/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">

</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#"><img src="{{asset("images/shop.png")}}" class="rounded" style="width:40px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/subway')}}">Reset <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}">Dashboard</a>
        </li>
        <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Categories
      </a>
      <div class="dropdown-menu">
        @foreach ($categories as $item)
                <a data-post-id="{{$item -> id}}" class="dropdown-item catid" href="#">{{$item -> categoryname}}</a>
            @endforeach
      </div>
    </li>
    <li class="nav-item">
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" id="contact" name="contact" type="number" placeholder="Type Contact Number">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
    </li>
      </ul>
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" id="searchproduct" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
  
  <div class="container-fluid" style="margin-top:80px">
    @yield('maincontent')
</div>



</body>
</html>
