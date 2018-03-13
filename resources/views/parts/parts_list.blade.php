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
        <th scope="col">ID</th>
        <th scope="col">Category</th>
        <th scope="col">Name</th>
        <th scope="col">Count</th>
        <th scope="col">Price</th>
        <th scope="col">Added</th>
        <th scope="col">Updated</th>
        <th scope="col">Edit</th>
        <th scope="col">Send Message</th>
      </tr>
    </thead>
    <tbody>
      @foreach($parts as $part)
      <tr class="table-light">

        <td>{{$part->id}}</td>
        <td>{{$part->category->name}}</td>
        <td>{{$part->name}}</td>
        <td> {{$part->count}}</td>
        <td> {{$part->price}}</td>
        <td> {{$part->created_at}}</td>
        <td> {{$part->updated_at}}</td>     
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$part->id]]) !!} {!!
          Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$part->id]]) !!} {!!
          Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::submit('Send',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
      @if (Auth::user()->isAdmin())
  <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@edit',$part->id]]) !!} {!!
          Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-info']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@destroy',$part->id]]) !!}
          {!! Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activate',$part->id]]) !!}
          {!! Form::hidden('_method','PATCH',['class'=>'form-control'])
          !!}
          {!! Form::hidden('id',$part->id,['class'=>'form-control']) !!} {!! Form::submit('Activate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
     @endif
    </tbody>
  </table>
</div>

@stop