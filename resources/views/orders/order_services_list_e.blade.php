@extends('main') @section('content') 
@if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
  <b>  {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Numer zlecenia</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Cena</th>

      </tr>
    </thead>
    <tbody>
      @foreach($services as $service)
      <tr class="table-light">
        <td> <a href="{{URL::asset('order/'.$service->order_id)}}"> {{$service->order_id}}</a></td>
        <td>{{$service->service->name}}</td>
        <td>{{$service->service->price}}</td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop