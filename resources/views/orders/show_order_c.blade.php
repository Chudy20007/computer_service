@extends('main') @section('content') 
@if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
  <b>  {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif
<div class="table-responsive2">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Numer przedmiotu</th>      
        <th scope="col">Status zlecenia</th>
        <th scope="col">Nazwa przedmiotu</th>
        <th scope="col">Kod produktu</th>
        <th scope="col">Diagnoza</th>
        <th scope="col">Naprawiono</th>
        <th scope="col">Opis</th>
        <th scope="col">Pracownik</th>

      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      @foreach ($order->order_object as $object)
      <tr class="table-light">
        <td> <a href="{{URL::asset('show_order_objects/'.$order->id)}}"> {{$object->id}}</a></td>
        <td> {{$order->status}}</td>
        <td> {{$object->name}}</td>
        <td> {{$object->serial_number}}</td>
        <td> {{$object->diagnosis=="empty" ?'brak danych': $object->diagnosis}}</td>
        <td> {{$object->fixed==true ?'tak' :'nie'}}</td>
        <td> {{$order->description}}</td>
        <td> {{$order->employee->name}}</td>     

      </tr>
      @endforeach
      @endforeach
     
    </tbody>
  </table>
</div>

@stop