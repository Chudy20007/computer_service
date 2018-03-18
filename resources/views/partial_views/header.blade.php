<div class="topNav" id="mainNav">
  
  <a class='logo' href="{{URL::asset('/')}}">
    <img src="{{URL::asset('css/img/logo.png')}}" alt="Image Soft" />
  </a>
  <a class='menuOption' href="{{URL::asset('add_order')}}">Add order </a>
  <a class='menuOption' href="{{URL::asset('show_services')}}">Services</a>
  <a class='menuOption' href="{{URL::asset('contact')}}">Contact</a>
  <a class='menuOption ' href="{{URL::asset('about')}}">About</a>

  @if (Auth::user()!=null && Auth::user()->isAdmin())
    @include('partial_views.admin_panel')
  @endif
  @if (Auth::user()!=null && Auth::user()->isSupervisor())
    @include('partial_views.supervisor_panel')
  @endif
  
    @if (Auth::user()!=null && Auth::user()->isEmployee())
    @include('partial_views.employee_panel')
  @endif
 @if (Auth::user()) @php $src =explode("@",Auth::user()->id); @endphp

  <a class='menuOptionRight' href="{{URL::asset('logout')}}">
    Logout</a>
    <a class='menuOptionRight' href="{{URL::asset('user/'.Auth::user()->id)}}">
        <img class="small-img" src="{{ URL::asset('css/img/avatars/'.$src[0].".jpg ")}}">
        </a>
  @else
  <a class='menuOptionRight' href="{{URL::route('login')}}">Login</a>
  @endif

</div>