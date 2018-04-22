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
      <tr data-table='tasks_a'>
        <th scope="col" data-name="order_id" data-sort="asc">Zamówienie </th>
        <th scope="col" data-name="title" data-sort="asc">Tytuł</th>
        <th scope="col" data-name="supervisor_id" data-sort="asc">Kierownik/Utworzył</th>
        <th scope="col" data-name="employee_id" data-sort="asc">Pracownik</th>
        <th scope="col" data-name="message" data-sort="asc">Wiadomość</th>
        <th scope="col" data-name="created_at" data-sort="asc">Utworzono</th>
        <th scope="col" data-name="updated_at" data-sort="asc">Zaktualizowano</th>
        <th scope="col" data-name="active" data-sort="asc">Aktywny</th>
        <th scope="col">Szczegóły</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Dezaktywuj</th>
        <th scope="col">Aktywuj</th>
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
        <td> {{$task->active == 1 ? 'tak' : 'nie'}}</td> 
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskDetails',$task->id]]) !!}
         {!! Form::submit('Szczegóły',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskEditForm',$task->id]]) !!}
          {!! Form::submit('Edytuj',['class'=>'btn btn-primary']) !!}
           {{ Form::close() }} </a>
         </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateTask',$task->id]])
          !!} {!! Form::hidden('id',$task->id,['class'=>'form-control']) !!} 
          {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Dezaktywuj',['class'=>'btn btn-primary']) !!} 
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateTask',$task->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} 
          {!! Form::hidden('id',$task->id,['class'=>'form-control'])
          !!} {!! Form::submit('Aktywuj',['class'=>'btn btn-primary']) !!} 
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
   
    </tbody>
  </table>
</div>

@stop