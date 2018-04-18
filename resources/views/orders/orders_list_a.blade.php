@extends('main') @section('content')
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='orders_a'>
        <th scope="col" data-name="id" data-sort="asc">ID</th>
        <th scope="col" data-name="customer_id" data-sort="asc">Klient</th>
        <th scope="col" data-name="email" data-sort="asc">E-mail</th>
        <th scope="col" data-name="phone" data-sort="asc">Telefon</th>
        <th scope="col" data-name="status" data-sort="asc">Status zamówienia</th>
        <th scope="col" data-name="active" data-sort="asc">Aktywne</th>
        <th scope="col" data-name="description" data-sort="asc">Opis</th>
        <th scope="col" data-name="employee_id" data-sort="asc">Pracownik</th>
        <th scope="col" >Utwórz wątek</th>
        <th scope="col">Usługi do zlecenia</th>
        <th scope="col">Części do zlecenia</th>
        <th scope="col">Przedmioty w zleceniu</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Aktywuj</th>
        <th scope="col">Dezaktywuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr class="table-light">
        <td>
          <a href="{{URL::asset('order/'.$order->id)}}"> {{$order->id}}</a>
        </td>
        <td>
          <a href="{{URL::asset('user/'.$order->customer->id)}}">{{$order->customer->name}}</a>
        </td>
        <td>{{$order->customer->email}}</td>
        <td> {{$order->customer->phone}}</td>
        <td> {{$order->status}}</td>
        <td> {{$order->active == true ?'tak' : 'nie'}}</td>
        <td> {{$order->description}}</td>
        <td> {{$order->employee->name}}</td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Utwórz wątek',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderServicesList',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż usługi',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderPartsList',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż części',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderObjectsList',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż przedmiot',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderEditForm',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj zlecenie',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateOrder',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Dezaktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateOrder',$order->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('id',$order->id,['class'=>'form-control'])
          !!} {!! Form::submit('Aktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@stop