@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Numer zlecenia</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Kod produktu</th>
        <th scope="col">Diagnoza</th>
        <th scope="col">Naprawiono</th>
        <th scope="col">Utworzono</th>
        <th scope="col">Edytowano</th>
        <th scope="col">Aktywne</th>        
        <th scope="col">Edytuj</th>
        <th scope="col">Wyślij wiadomość</th>
        <th scope="col">Dezaktywuj</th>   
        <th scope="col">Aktywuj</th>    
      </tr>
    </thead>
    <tbody>
      @foreach($objects as $object)
      <tr class="table-light">
          <td>{{$object->id}}</td>
        <td> <a href="{{URL::asset('order/'.$object->order_id)}}"> {{$object->order_id}}</a></td>
        <td>{{$object->name}}</td>
        <td> {{$object->serial_number}}</td>
        <td> {{$object->diagnosis}}</td>
        <td> {{$object->fixed==true ?'tak' :'nie'}}</td>
        <td> {{$object->created_at}}</td>     
        <td> {{$object->updated_at}}</td> 
        <td> {{$object->active==true ?'tak' :'nie'}}</td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderObjectsEditForm',$object->order_id]]) !!} {!!
          Form::hidden('id',$object->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj przedmiot',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$object->id]]) !!} {!!
          Form::hidden('id',$object->id,['class'=>'form-control']) !!} {!! Form::submit('Wyślij wiadomość',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateOrderObject',$object->id]])
          !!} {!! Form::hidden('object_id',$object->id,['class'=>'form-control']) !!}
          {!! Form::hidden('order_id',$object->order_id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Dezaktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateOrderObject',$object->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!}
          {!! Form::hidden('order_id',$object->order_id,['class'=>'form-control']) !!} {!! Form::hidden('object_id',$object->id,['class'=>'form-control'])
          !!} {!! Form::submit('Aktywuj',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>  
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop