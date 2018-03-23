@extends('main') @section('content')
<div class='picture'>
  <div style="padding:0" class='col-md-12'>
    <div class="alert alert-danger text-center">
      <h3>The order has been closed!</h3>
      Return to
      <a href="{{URL::asset('/')}}" class="alert-link">home page</a>.
    </div>
  </div>
</div>

@stop