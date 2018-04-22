@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive2">
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
        <td>{{number_format($service->service->price,2)}} PLN</td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop