
<div class="containerr">
    
    <div class="row">
        <div class='col-md-12 text-center'>
            <span class="form-header"> User registration </span>
        </div>
            <div class='col-md-1'>
                </div>
        <div class="col-md-10 picture ">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label label">Name</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus> @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required> @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label label">Phone number</label>

                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$user->phone}}" required autofocus> @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label label">Confirm Password</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                                                
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label label">Role</label>

                            <div class="col-md-12">
                                <select id="role" type="text" class="form-control" name="role" required autofocus>
                                   <option value="customer">customer</option>
                                   <option value="admin">admin</option> 
                                   <option value="supervisor">supervisor</option> 
                                   <option value="employee">employee</option> 
                                    </select>   @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        @if(Auth::user()->isAdmin())
                        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label label">Active</label>
                        
                            <div class="col-md-12">
                                <select id="active" type="text" class="form-control" name="active" required autofocus>
                                   <option value="1">yes</option>
                                   <option value="0">no</option> 
                                    </select>   @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                            
                        
                        @else
                        {!!Form::hidden('active',1)!!}
                        @endif

                        <div class="form-group{{ $errors->has('post-code') ? ' has-error' : '' }}">
                            <label for="post-code" class="col-md-4 control-label label">Post code number</label>

                            <div class="col-md-12">
                                <input id="post-code" type="text" class="form-control" name="post-code"  placeholder="XX-XXX"  value="{{$user->post_code}}" required autofocus> @if ($errors->has('post-code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('post-code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
{!!Form::hidden('id',$user->id)!!}
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label label">City</label>

                            <div class="col-md-12">
                                <input id="city" type="text" class="form-control" name="city" value="{{$user->city}}"  placeholder="city"  required autofocus> @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-4 control-label label">Street</label>
    
                                <div class="col-md-12">
                                    <input id="street" type="text" class="form-control" name="street" value="{{$user->street}}"  placeholder="street"  required autofocus> @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group{{ $errors->has('local-number') ? ' has-error' : '' }}">
                            <label for="local-number" class="col-md-4 control-label label">Local number</label>

                            <div class="col-md-12">
                                <input id="local-number" type="text" class="form-control" name="local-number" placeholder="number"  value="{{$user->local_number}}" required autofocus> @if ($errors->has('local-number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('local-number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label label">Avatar</label>

                            <div class="col-md-6">
                                {{ Form::file('file', array('multiple'=>false,'accept'=>'image/jpeg','class'=>'formOption')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-1">
                            </div>
                        </div>
                
                </div>
            </div>
        </div>
        <div class='col-md-1'>
            </div>
    </div>
</div>
