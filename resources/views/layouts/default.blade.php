<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TO Do')</title>

    <!-- ✅ Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
<style>
    .navbar{
        background: linear-gradient(90deg, #f8f9fa, #e2e6ea);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 10px 0;
    }
    .navbar-brand{
        font-weight: 700;
        font-size: 24px;
        color: #2c3e50 !important;
        letter-spacing: 0.5px;
        transition: color 0.3s ease;
    }
    .navbar-brand{
        color: #007bff ! important;
    }
    .navbaar-nav .nav-link{
        font-size: 18px;
        font-weight: 500;
        color: #333 !important;
        margin: 0px 18px;
        transition: color 0.3s ease transform 0.2s ease;
    }
    .navbar-nav .nav-link:hover{
        color: #007bff !important;
        transform: translate(-2px);
    }
    .navbar-nav .nav-link.active{
        color: #dc3545 !important;
        font-weight: 600;
    }
    .btn-danger{
        border: none;
        background-color: #dc3545;
        transition: background-color 0.3s ease transform 0.2s ease;
    }
    .btn-danger:hover{
        background: #b02a37;
        transform: translate(-2px);
    }
    .btn-danger a {
        text-decoration: none;
        color: #fff;
        font-weight: 500;
    }
    @media (max-width: 992px) {
  .navbar-nav {
    text-align: center;
  }
  .navbar-nav .nav-item {
    margin-bottom: 8px;
  }
  .btn-danger {
    width: 100%;
  }
}

</style>


  </head>

  <body>

    <!-- ✅ Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">DoItNow 🚀</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            @auth
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('todo')}}">All Task</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('create')}}">New Task</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('edit')}}">Update Todo</a>
            </li>
            @endauth
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{url('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('register')}}">Register</a>
            </li>
            @endguest
          </ul>
          @auth
          <div class="d-flex">
           <button class="btn btn-danger ms-auto " type="submit"> <a  href="{{ url('logout') }}" class="text-decoration-none text-white ms-auto ">Logout</a></button>
         </div>
         @endauth
      
        </div>
      </div>
    </nav>

    <!-- ✅ Optional top bar -->
   

    <!-- ✅ Page content -->
    <div class="container my-4">
      @yield('content')
    </div>

    <!-- ✅ Bootstrap JS (Bundle includes Popper) -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
