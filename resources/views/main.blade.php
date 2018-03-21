<!DOCTYPE html>
<html lang="en">

<head>
  @include('partial_views.head')
</head>

<body>

  <div class='container-fluid'>
    @include('partial_views.header')
  </div>
  @if (Auth::user())
  @switch(Auth::user()->getRole())
    @case("admin")
    @include('partial_views.admin_menu')
      @break

      @case("employee")

      @break
      @include('partial_views.employee_menu')
      @case("supervisor")
      @include('partial_views.supervisor_menu')
      @break

      @endswitch
@endif
  <div class='container' id='container'>
     
      <div style='margin-top:2rem; margin-bottom:2rem;' class='row'>
          <div style='margin-right:0; padding-right:0' class='col-md-11 col-lg-11'>
              <input class='main-search' type='text' placeholder='Search..'>
          </div>
          <div style='margin-left:0; padding-left:0' ;class='col-md-1 col-lg-1'>
              <button id="find-button">
                  <img src="{{URL::asset('css/img/search-img.png')}}" width="30px" height="30px">
              </button>
          </div>
      </div>

    @yield('content')
  </div>
  </div>

  <footer id="footer">
    @include('partial_views.footer')
  </footer>

  @include('partial_views.scripts')
</body>

</html>