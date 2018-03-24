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
        <th scope="col">Kod produktu</th>
        <th scope="col">Sztuk</th>

      </tr>
    </thead>
    <tbody>
      @foreach($parts as $part)
      <tr class="table-light">
        <td> <a href="{{URL::asset('order/'.$part->order_id)}}"> {{$part->order_id}}</a></td>
        <td>{{$part->part->name}}</td>
        <td> {{$part->part->serial_number}}</td>
        <td> {{$part->count}}</td>  
    
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop