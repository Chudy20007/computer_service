@extends('main') @section('content')
<div class="containerr">
    <div class="row">
            <div class="col-md-12 text-center">
                    <span class="form-header">Zgłoś przedmiot do naprawy</span>
            </div>
            <div class='col-md-1'>
                </div>
        <div class="col-md-10 picture ">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                        @include('pictures.error_form') 
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ URL::asset('store_order') }}">
                      
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label label">Imię i nazwisko</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="imię i nazwisko" autofocus>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                              
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post-code" class="col-md-4 control-label label">Kod pocztowy</label>

                            <div class="col-md-12">
                                <input id="post-code" type="text" class="form-control" name="post-code"  placeholder="XX-XXX"  value="{{ old('post-code') }}" required autofocus>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                              
                            </div>
                        </div>

                        <div class="form-group}">
                            <label for="city" class="col-md-4 control-label label">Miasto</label>

                            <div class="col-md-12">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"  placeholder="miasto"  required autofocus>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                                
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="street" class="col-md-4 control-label label">Ulica</label>
    
                                <div class="col-md-12">
                                    <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}"  placeholder="ulica"  required autofocus>
                                    <span class="help-block">
                                        <strong></strong>
                                    </span>
                                    
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="local-number" class="col-md-4 control-label label"> Numer lokalu</label>

                            <div class="col-md-12">
                                <input id="local-number" type="text" class="form-control" name="local-number" placeholder="numer lokalu"  value="{{ old('local-number') }}" required autofocus> 
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label label">Adres e-mail</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="np. adam@xx.xx"  required>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label label">Telefon</label>

                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}"  placeholder="minimum 9 znaków"  required autofocus> 
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label style='margin-left:.3rem' for="device" class="col-md-4 control-label label">Dodaj urządzenie</label>
<div class='row'>
                            <div style='margin-left:1rem;' class="col-md-10">
                                <input id="add-device" type="text" class="form-control" name="add-device" value="{{ old('add-device') }}" autofocus>
                               
                             
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                               
                            </div>
                          
                                <input type="button" class='small-img2'>
                                <input type="button" class='small-img3'>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="device" class="col-md-4 control-label label">Urządzenia zgłoszone do naprawy</label>

                            <div class="col-md-12">
                                <select id="device" class="form-control" name="device[]" value="{{ old('') }}" required multiple autofocus>
                                    
                                    </select>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label label">Opis problemów</label>

                            <div class="col-md-12">
                                <textarea id="description" type="textarea" class="form-control" name="description"  placeholder="opisz tutaj swoje problemy z urządzeniem/urządzeniami"  value="{{ old('description') }}" required autofocus></textarea>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Zgłoś naprawę
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class='col-md-1'>
            </div>
    </div>
</div>

@endsection