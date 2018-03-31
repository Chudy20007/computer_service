@extends('main') @section('content') 
@include ("pictures.success_form")
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