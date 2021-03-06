@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='services_a'>
        <th scope="col" data-name="name" data-sort="asc">Nazwa</th>
        <th scope="col" data-name="price" data-sort="asc">Cena</th>
        <th scope="col" data-name="created_at" data-sort="asc">Utworzono</th>
        <th scope="col" data-name="active" data-sort="asc">Aktywny</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Dezaktywuj</th>
        <th scope="col">Aktywuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($services as $services)
      <tr class="table-light">
        <td>{{$services->name}}</td>
        <td>{{number_format($services->price,2)}} PLN</td>
        <td> {{$services->created_at}}</td>
        <td> {{$services->active == 1 ? 'tak' : 'nie'}}</td>
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