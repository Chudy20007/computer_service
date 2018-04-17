<a class="menuOption">
    <ol>
      <li>
        <a class="menuOption admin-div" href="{{URL::asset('user/'.Auth::id())}}">panel admina</a>
        <ul class='menuOl'>
          <li>
            <a href="{{URL::asset('show_employees')}}">pracownicy</a>
          </li>
          <li>
            <a href="{{URL::asset('show_services')}}">usługi</a>
          </li>
          <li class='z'>
            <a href="{{URL::asset('show_categories')}}">kategorie</a>
            
          </li>
          <li>
            <a href="{{URL::asset('show_tasks')}}">wątki</a>
          </li>
        </ul>
      </li>
    </ol>
  </a>