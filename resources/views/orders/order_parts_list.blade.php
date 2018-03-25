@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
          <th scope="col">Numer zlecenia</th>
          <th scope="col">Nazwa</th>
          <th scope="col">Kod produktu</th>
          <th scope="col">Sztuk</th>
          <th scope="col">Aktywne</th>
          <th scope="col">Dezaktywuj</th>
          <th scope="col">Aktywuj</th>
      </tr>
    </thead>
    <tbody>
      @foreach($parts as $part)
      <tr class="table-light">
        <td> <a href="{{URL::asset('order/'.$part->order_id)}}"> {{$part->order_id}}</a></td>
        <td>{{$part->part->name}}</td>
        <td> {{$part->part->serial_number}}</td>
        <td> {{$part->count}}</td>  
        <td> {{$part->active==true ?'yes' :'no'}}</td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateOrderPart',$part->id]])
          !!} {!! Form::hidden('part_id',$part->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateOrderPart',$part->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('part_id',$part->id,['class'=>'form-control'])
          !!} {!! Form::submit('Activate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>   
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop