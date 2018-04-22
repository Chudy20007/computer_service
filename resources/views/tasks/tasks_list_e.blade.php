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
      <tr data-table='tasks_e'>
        <th scope="col" data-name="order_id" data-sort="asc">Zamówienie </th>
        <th scope="col" data-name="title" data-sort="asc">Tytuł</th>
        <th scope="col" data-name="supervisor_id" data-sort="asc">Kierownik/Utworzył</th>
        <th scope="col" data-name="employee_id" data-sort="asc">Pracownik</th>
        <th scope="col" data-name="message" data-sort="asc">Wiadomość</th>
        <th scope="col" data-name="created_at" data-sort="asc">Utworzono</th>
        <th scope="col" data-name="updated_at" data-sort="asc">Zaktualizowano</th>
        <th scope="col">Szczegóły</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr class="table-light">
        <td><a href="{{URL::asset('order/'.$task->order->id)}}">{{$task->order->id}}</a></td>
        <td>{{$task->title}}</td>
        <td> {{$task->supervisor->name}}</td>
        <td> {{$task->employee->name}}</td>
        <td> {{$task->message}}</td>
        <td> {{$task->created_at}}</td>
        <td> {{$task->updated_at}}</td>     
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskDetails',$task->id]]) !!}
         {!! Form::submit('Szczegóły',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
   
    </tbody>
  </table>
</div>

@stop