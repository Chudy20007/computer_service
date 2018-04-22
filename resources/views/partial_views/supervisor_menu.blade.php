<div class='container2 menu'>
<div class="topNav" id="mainNav">
        <a class="menuOption">
                <ol>
                  <li>
                    <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Zlecenia</a>
                    <ul class='menuOl'>
                      <li>
                        <a href="{{URL::asset('show_orders')}}">Lista</a>
                      </li>
                      <li>
                        <a href="{{URL::asset('add_order')}}">Dodaj</a>
                      </li>
                    </ul>
                </ol>
              </a>
              
              <a class="menuOption">
                    <ol>
                      <li>
                        <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Usługi</a>
                        <ul class='menuOl'>
                          <li>
                            <a href="{{URL::asset('show_services')}}">Lista</a>
                          </li>
                          <li>
                            <a href="{{URL::asset('create_service')}}">Dodaj</a>
                          </li>
                        </ul>
                    </ol>
                  </a>  <a class="menuOption">
                        <ol>
                          <li>
                            <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Wątki</a>
                            <ul class='menuOl'>
                              <li>
                                <a href="{{URL::asset('show_tasks')}}">Lista</a>
                              </li>
                            </ul>
                        </ol>
                      </a>  <a class="menuOption">
                            <ol>
                              <li>
                                <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Kategorie</a>
                                <ul class='menuOl'>
                                  <li>
                                    <a href="{{URL::asset('show_categories')}}">Lista</a>
                                  </li>
                                  <li>
                                    <a href="{{URL::asset('create_category')}}">Dodaj</a>
                                  </li>
                                </ul>
                            </ol>
                          </a>
                          <a class="menuOption">
                                <ol>
                                  <li>
                                    <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Część</a>
                                    <ul class='menuOl'>
                                      <li>
                                        <a href="{{URL::asset('show_parts')}}">Lista</a>
                                      </li>
                                      <li>
                                        <a href="{{URL::asset('add_part')}}">Dodaj</a>
                                      </li>
                                    </ul>
                                </ol>
                              </a>
                              <a class="menuOption">
                                    <ol>
                                      <li>
                                        <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Pracownicy</a>
                                        <ul class='menuOl'>
                                          <li>
                                            <a href="{{URL::asset('show_employees')}}">Lista</a>
                                          </li>
                                          <li>
                                            <a href="{{URL::asset('register')}}">Dodaj</a>
                                          </li>
                                        </ul>
                                    </ol>
                                  </a>
                                  <a class="menuOption">
                                    <ol>
                                      <li>
                                        <a class="menuOption supervisor-div" href="{{URL::asset('user/'.Auth::id())}}">Historia zleceń</a>
                                        <ul class='menuOl'>
                                          <li>
                                            <a href="{{URL::asset('show_invoices')}}">Lista</a>
                                          </li>
                                        </ul>
                                    </ol>
                                  </a>
    </div>
</div>