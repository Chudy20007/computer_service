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
        <th scope="col">Category</th>
        <th scope="col">Name</th>
        <th scope="col">Count</th>
        <th scope="col">Price</th>
        <th scope="col">Added</th>
        <th scope="col">Updated</th>
        <th scope="col">Edit</th>
        <th scope="col">Deactivate</th>
        <th scope="col">Activate</th>
      </tr>
    </thead>
    <tbody>
      @foreach($parts as $part)
      <tr class="table-light">
        <td>{{$part->category->name}}</td>
        <td>{{$part->name}}</td>
        <td> {{$part->count}}</td>
        <td> {{$part->price}}</td>
        <td> {{$part->created_at}}</td>
        <td> {{$part->updated_at}}</td>     
        <td> {!! Form::open(['method'=>'GET','class'=>'form-horizontal','action'=>['PartController@showPartEditForm',$part->id]]) !!} {!!
          Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@destroy',$part->id]]) !!}
          {!! Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activate',$part->id]]) !!}
          {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!}
          {!! Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::submit('Activate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>

@stop