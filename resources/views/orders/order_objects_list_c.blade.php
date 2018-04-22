@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive2">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='order_objects_s'>
        <th scope="col" data-name="id" data-sort="asc">Numer przedmiotu</th>
        <th scope="col" data-name="order_id" data-sort="asc">Numer zlecenia</th>
        <th scope="col" data-name="name" data-sort="asc">Nazwa</th>
        <th scope="col" data-name="serial_number" data-sort="asc">Kod produktu</th>
        <th scope="col" data-name="diagnosis" data-sort="asc">Diagnoza</th>
        <th scope="col" data-name="fixed" data-sort="asc">Naprawiono</th>
        <th scope="col" data-name="created_at" data-sort="asc">Utworzono</th>
        <th scope="col" data-name="updated_at" data-sort="asc">Edytowano</th>

      </tr>
    </thead>
    <tbody>
      @foreach($objects as $object)
      <tr class="table-light">
          <td>{{$object->id}}</td>
        <td> <a href="{{URL::asset('order/'.$object->order_id)}}"> {{$object->order_id}}</a></td>
        <td>{{$object->name}}</td>
        <td> {{$object->serial_number}}</td>
        <td> {{$object->diagnosis}}</td>
        <td> {{$object->fixed==true ?'tak' :'nie'}}</td>
        <td> {{$object->created_at}}</td>     
        <td> {{$object->updated_at}}</td> 
        </td>  
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop