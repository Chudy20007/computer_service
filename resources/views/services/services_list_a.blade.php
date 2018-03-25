@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Nazwa</th>
        <th scope="col">Cena</th>
        <th scope="col">Utworzono</th>
        <th scope="col">Aktywny</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Dezaktywuj</th>
        <th scope="col">Aktywuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($services as $services)
      <tr class="table-light">
        <td>{{$services->name}}</td>
        <td> {{$services->price}}</td>
        <td> {{$services->created_at}}</td>
        <td> {{$services->active == 1 ? 'yes' : 'no'}}</td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['ServiceController@showServiceEditForm',$services->id]])
          !!} {!! Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateService',$services->id]])
          !!} {!! Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Dezaktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateService',$services->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('id',$services->id,['class'=>'form-control'])
          !!} {!! Form::submit('Aktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
      </tr>

      @endforeach

    </tbody>
  </table>
</div>

@stop