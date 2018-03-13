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
        <th scope="col">E-mail</th>
        <th scope="col">Phone</th>
        <th scope="col">Role</th>
        <th scope="col">Task</th>
        <th scope="col">Message</th>

      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr class="table-light">

        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td> {{$user->phone}}</td>
        <td> {{$user->role}}</td>
        
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$user->id]]) !!} {!!
          Form::hidden('id',$user->id,['class'=>'form-control']) !!} {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$user->id]]) !!} {!!
          Form::hidden('id',$user->id,['class'=>'form-control']) !!} {!! Form::submit('Send',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
      @if (Auth::user()->isAdmin())
  <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@edit',$user->id]]) !!} {!!
          Form::hidden('id',$user->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-info']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@destroy',$user->id]]) !!}
          {!! Form::hidden('id',$user->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activate',$user->id]]) !!}
          {!! Form::hidden('_method','PATCH',['class'=>'form-control'])
          !!}
          {!! Form::hidden('id',$user->id,['class'=>'form-control']) !!} {!! Form::submit('Activate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
     @endif
    </tbody>
  </table>
</div>

@stop