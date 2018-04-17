@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='services_s'>
        <th scope="col" data-name="name" data-sort="asc">Nazwa</th>
        <th scope="col" data-name="price" data-sort="asc">Cena</th>
        <th scope="col" data-name="created_at" data-sort="asc">Utworzono</th>
        <th scope="col">Edytuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($services as $services)
      <tr class="table-light">
        <td>{{$services->name}}</td>
        <td>{{number_format($services->price,2)}} PLN</td>
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