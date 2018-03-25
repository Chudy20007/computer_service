@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Nazwa</th>
        <th scope="col">Cena</th>
        <th scope="col">Utworzono</th>
        <th scope="col">Edytuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($services as $services)
      <tr class="table-light">
        <td>{{$services->name}}</td>
        <td> {{$services->price}}</td>
        <td> {{$services->created_at}}</td>   
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['ServiceController@showServiceEditForm',$services->id]]) !!} {!!
            Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj',['class'=>'btn btn-primary']) !!}
            {{ Form::close() }} </a>
          </td>
      </tr>

      @endforeach
      
    </tbody>
  </table>
</div>

@stop