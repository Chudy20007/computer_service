<a class="menuOption">
    <ol>
      <li>
        <a class="menuOption admin-div" href="admin_panel">admin panel</a>
        <ul class='menuOl'>
          <li>
            <a href="{{URL::asset('show_employees')}}">Users</a>
          </li>
          <li>
            <a href="{{URL::asset('pictures_list')}}">Pictures</a>
          </li>
          <li class='z'>
            <a href="{{URL::asset('albums_list')}}">Albums</a>
            <ul class='x'>
            <li>
                <a href="{{URL::asset('album_comments_list')}}">Albums comments</a>
              </li>
          </ul>
          </li>
          <li>
            <a href="{{URL::asset('comments_list')}}">Comments</a>
          </li>
          <li>
            <a href="{{URL::asset('albums_ratings_list')}}">Albums ratings</a>
          </li>
          <li>
            <a href="{{URL::asset('pictures_ratings_list')}}">Pictures ratings</a>
          </li>
        </ul>
      </li>
    </ol>
  </a>