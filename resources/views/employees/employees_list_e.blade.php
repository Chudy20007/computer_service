@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive2">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='employees_e'>
        <th scope="col" data-name="name" data-sort="asc">Imię i nazwisko</th>
        <th scope="col" data-name="email" data-sort="asc">E-mail</th>
        <th scope="col" data-name="phone" data-sort="asc">Telefon</th>
        <th scope="col" >Wyślij wiadomość</th>

      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr class="table-light">
        <td><a href="{{URL::asset('user/'.$user->id)}}"<td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td> {{$user->phone}}</td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['OrderController@showMessageForm',$user->id]]) !!}
       {!! Form::submit('Wyślij wiadomość e-mail',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
     
    </tbody>
  </table>
</div>

@stop