@extends('main') @section('content')
<div class='picture'>
  <div style="padding:0" class='col-md-12'>
    <div class="alert alert-danger text-center">
      <h3>Error! Please, put html file with "invoice.css" to path C:\Invoices\ or to path C:\Complaints\</h3>
      Return to
      <a href="{{URL::asset('/')}}" class="alert-link">home page</a>.
    </div>
  </div>
</div>

@stop