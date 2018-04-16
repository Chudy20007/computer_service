@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='categories_a'>
        <th scope="col" data-name="name" data-sort="asc">Nazwa</th>
        <th scope="col" data-name="created_at" data-sort="asc">Utworzono</th>
        <th scope="col" data-name="updated_at" data-sort="asc">Zaktualizowano</th>
        <th scope="col" >Edytuj</th>
        <th scope="col" >Dezaktwuj</th>
        <th scope="col" >Aktywuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr class="table-light">
        <td>{{$category->name}}</td>
        <td> {{$category->created_at}}</td>
        <td> {{$category->updated_at}}</td>
        <td> {!! Form::open(['method'=>'GET','class'=>'form-horizontal','action'=>['CategoryController@showCategoryEditForm',$category->id]]) !!} {!!
            Form::hidden('id',$category->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj',['class'=>'btn btn-primary']) !!}
            {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateCategory',$category->id]])
            !!} {!! Form::hidden('id',$category->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
            !!} {!! Form::submit('Dezaktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateCategory',$category->id]])
            !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('id',$category->id,['class'=>'form-control'])
            !!} {!! Form::submit('Aktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
          </td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop