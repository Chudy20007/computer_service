<div class='container-fluid menu'>
<div class="topNav" id="mainNav">
        <a class="menuOption">
                <ol>
                  <li>
                    <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Orders</a>
                    <ul class='menuOl'>
                      <li>
                        <a href="{{URL::asset('show_orders')}}">Show</a>
                      </li>
                      <li>
                        <a href="{{URL::asset('add_order')}}">Add</a>
                      </li>
                    </ul>
                </ol>
              </a>
              
              <a class="menuOption">
                    <ol>
                      <li>
                        <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Services</a>
                        <ul class='menuOl'>
                          <li>
                            <a href="{{URL::asset('show_services')}}">Show</a>
                          </li>
                          <li>
                            <a href="{{URL::asset('add_service')}}">Add</a>
                          </li>
                        </ul>
                    </ol>
                  </a>  <a class="menuOption">
                        <ol>
                          <li>
                            <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Tasks</a>
                            <ul class='menuOl'>
                              <li>
                                <a href="{{URL::asset('show_employees')}}">Show</a>
                              </li>
                              <li>
                                <a href="{{URL::asset('show_services')}}">Add</a>
                              </li>
                            </ul>
                        </ol>
                      </a>  <a class="menuOption">
                            <ol>
                              <li>
                                <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Categories</a>
                                <ul class='menuOl'>
                                  <li>
                                    <a href="{{URL::asset('show_categories')}}">Show</a>
                                  </li>
                                  <li>
                                    <a href="{{URL::asset('add_category')}}">Add</a>
                                  </li>
                                </ul>
                            </ol>
                          </a>
                          <a class="menuOption">
                                <ol>
                                  <li>
                                    <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Parts</a>
                                    <ul class='menuOl'>
                                      <li>
                                        <a href="{{URL::asset('show_parts')}}">Show</a>
                                      </li>
                                      <li>
                                        <a href="{{URL::asset('add_part')}}">Add</a>
                                      </li>
                                    </ul>
                                </ol>
                              </a>
                              <a class="menuOption">
                                    <ol>
                                      <li>
                                        <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Employees</a>
                                        <ul class='menuOl'>
                                          <li>
                                            <a href="{{URL::asset('show_employees')}}">Show</a>
                                          </li>
                                          <li>
                                            <a href="{{URL::asset('register')}}">Add</a>
                                          </li>
                                        </ul>
                                    </ol>
                                  </a>
    </div>
</div>