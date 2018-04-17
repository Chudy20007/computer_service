@extends('main') @section('content')
<div class='picture'>
  <div style="padding:0" class='col-md-12'>
    <div class="alert alert-danger text-center">
      <h3>Błąd! Brak dostępu do zasobów</h3>
      Powrót do
      <a href="{{URL::asset('/')}}" class="alert-link">strony głównej</a>.
    </div>
  </div>
</div>

@stop