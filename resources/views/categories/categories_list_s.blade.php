@extends('main') @section('content') 
@if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
  <b>  {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Nazwa</th>
        <th scope="col">Utworzono</th>
        <th scope="col">Zaktualizowo</th>
        <th scope="col">Edytuj</th>
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
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop