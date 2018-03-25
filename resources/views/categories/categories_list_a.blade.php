@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Nazwa</th>
        <th scope="col">Utworzono</th>
        <th scope="col">Zaktualizowano</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Dezaktwuj</th>
        <th scope="col">Aktywuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr class="table-light">
        <td>{{$category->name}}</td>
        <td> {{$category->created_at}}</td>
        <td> {{$category->updated_at}}</td>
        <td> {!! Form::open(['method'=>'GET','class'=>'form-horizontal','action'=>['CategoryController@showCategoryEditForm',$category->id]]) !!} {!!
            Form::hidden('id',$category->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-primary']) !!}
            {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateCategory',$category->id]])
            !!} {!! Form::hidden('id',$category->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
            !!} {!! Form::submit('Deactivate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateCategory',$category->id]])
            !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('id',$category->id,['class'=>'form-control'])
            !!} {!! Form::submit('Activate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
          </td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop