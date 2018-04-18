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
        <th scope="col">Klient</th>      
        <th scope="col">Status zlecenia</th>
        <th scope="col">Nazwa przedmiotu</th>
        <th scope="col">Kod produktu</th>
        <th scope="col">Diagnoza</th>
        <th scope="col">Naprawiono</th>
        <th scope="col">Opis</th>
        <th scope="col">Pracownik</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Dodaj część</th>
        <th scope="col">Dodaj usługę</th>
        <th scope="col">Dodaj wątek</th>
        <th scope="col">Usługi do zlecenia</th>
        <th scope="col">Części do zlecenia</th>
        <th scope="col">Przedmioty w zleceniu</th>

      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      @foreach ($order->order_object as $object)
      <tr class="table-light">
        <td> <a href="{{URL::asset('order/'.$order->id)}}"> {{$order->id}}</a></td>
        <td><a href="{{URL::asset('user/'.$order->customer->id)}}">{{$order->customer->name}}</a></td>
        <td> {{$order->status}}</td>
        <td> {{$object->name}}</td>
        <td> {{$object->serial_number}}</td>
        <td> {{$object->diagnosis}}</td>
        <td> {{($object->fixed==true?'tak':'nie')}}</td>
        <td> {{$order->description}}</td>
        <td> {{$order->employee->name}}</td>     
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderEditForm',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Edytu zlecenie',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>

        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showPartsOrderForm',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Dodaj część',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showServicesOrderForm',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Dodaj usługę',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                        
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Utwórz wątek',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
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

      </tr>
      @endforeach
      @endforeach
     
    </tbody>
  </table>
</div>

@stop