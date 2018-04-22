@extends('main') @section('content') @if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
    <b> {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif

<div class="table-responsive2">
  <table class="table table-hover">
    <div class='col-md-12 text-center'>
    <ul class='order-sort'>
      <span class='main-search'>Wybierz, które zlecenia mają zostać wyświetlone</span><br/><br/>
      <li><button class='menuOption2' value='w toku'>Zlecenia w toku</li>
      <li><button class='menuOption2' value='aktywne'>Zlecenia aktywne</li>
      <li><button class='menuOption2' value='wstrzymane'>Zlecenia wstrzymane</li>
      <li><button class='menuOption2' value='zamkniete'>Zlecenia zamkniete</li>
    </ul>
  </div>
    <thead class="bg-primary text-center">
      <tr data-table='orders_s'>
        <th scope="col" data-name="id" data-sort="asc">ID</th>
        <th scope="col" data-name="customer_id" data-sort="asc">Klient</th>
        <th scope="col" data-name="email" data-sort="asc">E-mail</th>
        <th scope="col" data-name="phone" data-sort="asc">Telefon</th>
        <th scope="col" data-name="status" data-sort="asc">Status zamówienia</th>
        <th scope="col" data-name="description" data-sort="asc">Opis</th>
        <th scope="col" data-name="execution_time" data-sort="asc">Termin realizacji</th>
        <th scope="col" data-name="description" data-sort="asc">Przedmiot odebrano</th>
        <th scope="col" data-name="employee_id" data-sort="asc">Pracownik</th>
        <th scope="col" data-name="id" data-sort="asc">Utwórz wątek</th>
        <th scope="col">Usługi do zlecenia</th>
        <th scope="col">Części do zlecenia</th>
        <th scope="col">Przedmioty w zleceniu</th>

        <th scope="col">Edytuj</th>
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
        <td> {{$order->description}}</td>
        <td> {{$order->execution_time}}</td>
        <td> {{$order->received==true? 'tak':'nie'}}</td>
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
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj zamówienie',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>

        @endforeach
    </tbody>
  </table>
</div>

@stop