@extends('main') @section('content') @if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
    <b> {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='orders_c'>
        <th scope="col" data-name="id" data-sort="asc">Numer zlecenia</th>
        <th scope="col" data-name="status" data-sort="asc">Status zlecenia</th>
        <th scope="col" data-name="description" data-sort="asc">Opis</th>
        <th scope="col" data-name="employee_id" data-sort="asc">Pracownik</th>
        <th scope="col" data-name="created_at" data-sort="asc">Utworzono</th>
        <th scope="col" data-name="updated_at" data-sort="asc">Edytowano</th>
        <th scope="col" data-name="services" data-sort="asc">Usługi</th>
        <th scope="col" data-name="parts" data-sort="asc">Części</th>
        <th scope="col" data-name="objects" data-sort="asc">Przedmioty</th>
        
    {{--    <th scope="col">Wyślij wiadomość</th> --}}
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr class="table-light">
        <td>
          <a href="{{URL::asset('order/'.$order->id)}}"> {{$order->id}}</a>
        </td>
        <td> {{$order->status}}</td>
        <td> {{$order->description}}</td>
        <td> {{$order->employee->name}}</td>
        <td> {{$order->created_at}}</td>
        <td> {{$order->updated_at}}</td>
     {{--   <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['OrderController@showMessageForm',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Wyślij wiadomość',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
        --}}
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderServicesList',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż usługi',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderPartsList',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż części',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderObjectsList',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż przedmioty',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        @endforeach
    </tbody>
  </table>
</div>

@stop