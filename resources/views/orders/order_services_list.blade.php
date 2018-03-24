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
        <th scope="col">Numer zlecenia</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Cena</th>
        <th scope="col">Aktywne</th>
        <th scope="col">Dezaktywuj</th>   
        <th scope="col">Aktywuj</th>  
      </tr>
    </thead>
    <tbody>
      @foreach($services as $service)
      <tr class="table-light">
        <td> <a href="{{URL::asset('order/'.$service->order_id)}}"> {{$service->order_id}}</a></td>
        <td>{{$service->service->name}}</td>
        <td>{{$service->service->price}}</td>
        <td> {{$service->active==true ?'tak' :'nie'}}</td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateOrderService',$service->id]])
          !!} {!! Form::hidden('service_id',$service->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateOrderService',$service->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('service_id',$service->id,['class'=>'form-control'])
          !!} {!! Form::submit('Activate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>  

      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop