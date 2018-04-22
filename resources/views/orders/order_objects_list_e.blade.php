@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive2">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Numer zlecenia</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Kod produktu</th>
        <th scope="col">Diagnoza</th>
        <th scope="col">Naprawiono</th>
        <th scope="col">Utworzono</th>
        <th scope="col">Edytowano</th>
        <th scope="col">Edytuj</th>

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
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderObjectsEditForm',$object->order_id]]) !!} {!!
          Form::hidden('id',$object->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj przedmiot',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>

        </td>  
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop