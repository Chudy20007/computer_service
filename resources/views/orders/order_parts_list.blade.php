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
        <th scope="col">Order ID</th>
        <th scope="col">Name</th>
        <th scope="col">Serial number</th>
        <th scope="col">Count</th>
        <th scope="col">Active</th>
        <th scope="col">Deactivate</th>   
        <th scope="col">Activate</th>  

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