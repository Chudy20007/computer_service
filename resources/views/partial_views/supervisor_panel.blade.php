<a class="menuOption">
    <ol>
      <li>
        <a class="menuOption admin-div" href="{{URL::asset('user/'.Auth::id())}}">supervisor panel</a>
        <ul class='menuOl'>
          <li>
            <a href="{{URL::asset('show_employees')}}">employees</a>
          </li>
          <li>
            <a href="{{URL::asset('show_services')}}">services</a>
          </li>
          <li class='z'>
            <a href="{{URL::asset('show_categories')}}">categories</a>
            
          </li>
          <li>
            <a href="{{URL::asset('show_tasks')}}">tasks</a>
          </li>
        </ul>
      </li>
    </ol>
  </a>
  
  