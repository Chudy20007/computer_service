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
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Added</th>
        <th scope="col">Updated</th>
        <th scope="col">Edit</th>
        <th scope="col">Send Message</th>
      </tr>
    </thead>
    <tbody>
      @foreach($services as $services)
      <tr class="table-light">

        <td>{{$services->id}}</td>
        <td>{{$services->name}}</td>
        <td> {{$services->price}}</td>
        <td> {{$services->created_at}}</td>
        <td> {{$services->updated_at}}</td>     
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$services->id]]) !!} {!!
          Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$services->id]]) !!} {!!
          Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::submit('Send',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
      @if (Auth::user()->isAdmin())
  <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@edit',$services->id]]) !!} {!!
          Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-info']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@destroy',$services->id]]) !!}
          {!! Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activate',$services->id]]) !!}
          {!! Form::hidden('_method','PATCH',['class'=>'form-control'])
          !!}
          {!! Form::hidden('id',$services->id,['class'=>'form-control']) !!} {!! Form::submit('Activate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
     @endif
    </tbody>
  </table>
</div>

@stop