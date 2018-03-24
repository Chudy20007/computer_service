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
        <th scope="col">Imię i nazwisko</th>
        <th scope="col">E-mail</th>
        <th scope="col">Telefon</th>
        <th scope="col">Rola</th>
        <th scope="col">Aktywny</th>
        <th scope="col">Wyślij wiadomość</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Dezaktywuj</th>
        <th scope="col">Aktywuj</th>

      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr class="table-light">
        <td><a href="{{URL::asset('user/'.$user->id)}}"<td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td> {{$user->phone}}</td>
        <td> {{$user->role}}</td> 
        <td> {{$user->active == 1 ? 'yes' : 'no'}}</td> 
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['OrderController@showMessageForm',$user->id]]) !!}
       {!! Form::submit('Send',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['EmployeeController@showEmployeeEditForm',$user->id]])
          !!} {!! Form::hidden('id',$user->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateEmployee',$user->id]])
          !!} {!! Form::hidden('id',$user->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateEmployee',$user->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('id',$user->id,['class'=>'form-control'])
          !!} {!! Form::submit('Activate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
     
    </tbody>
  </table>
</div>

@stop