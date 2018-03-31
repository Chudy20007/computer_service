<div class="topNav" id="mainNav">
  
  <a class='logo' href="{{URL::asset('/')}}">
    <img src="{{URL::asset('css/img/logo.png')}}" alt="Image Soft" />
  </a>
  <a class='menuOption' href="{{URL::asset('add_order')}}">Utwórz zlecenie </a>
  <a class='menuOption' href="{{URL::asset('show_services')}}">Usługi</a>
  <a class='menuOption' href="{{URL::asset('contact')}}">Kontakt</a>
  <a class='menuOption ' href="{{URL::asset('about')}}">O nas</a>

  @if (Auth::user()!=null && Auth::user()->isAdmin())
    @include('partial_views.admin_panel')
  @endif
  @if (Auth::user()!=null && Auth::user()->isSupervisor())
    @include('partial_views.supervisor_panel')
  @endif
  
    @if (Auth::user()!=null && Auth::user()->isEmployee())
    @include('partial_views.employee_panel')
  @endif

  @if (Auth::user()!=null && Auth::user()->isCustomer())
  @include('partial_views.customer_panel')
@endif
 @if (Auth::user()) @php $src =explode("@",Auth::user()->id); @endphp

  <a class='menuOptionRight' href="{{URL::asset('logout')}}">
    Wyloguj</a>
    <a class='menuOptionRight' href="{{URL::asset('user/'.Auth::user()->id)}}">
        <img class="small-img" src="{{ URL::asset('css/img/avatars/'.$src[0].".jpg ")}}">
        </a>
  @else
  <a class='menuOptionRight' href="{{URL::route('login')}}">Zaloguj</a>
  @endif

</div>