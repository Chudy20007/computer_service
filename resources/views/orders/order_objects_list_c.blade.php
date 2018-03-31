@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Numer przedmiotu</th>
        <th scope="col">Numer zlecenia</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Kod produktu</th>
        <th scope="col">Diagnoza</th>
        <th scope="col">Naprawiono</th>
        <th scope="col">Utworzono</th>
        <th scope="col">Edytowano</th>

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