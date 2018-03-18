<a class="menuOption">
    <ol>
      <li>
        <a class="menuOption admin-div" href="{{URL::asset('user/'.Auth::id())}}">user panel</a>
        <ul class='menuOl'>
          <li>
            <a href="{{URL::asset('user/'.Auth::id())}}">Profile</a>
          </li>
          <li>
            <a href="{{URL::asset('user_panel')}}">Pictures</a>
          </li>
          <li class='z'>
            <a href="{{URL::asset('albums/user/'.Auth::id())}}">Albums</a>
            
          </li>
          <li>
            <a href="{{URL::asset('pictures/create')}}">Add pictures</a>
          </li>
          <li class='z'>
            <a href="{{URL::asset('albums/create')}}">Add albums</a>
            
          </li>
        </ul>
      </li>
    </ol>
  </a>
  
  