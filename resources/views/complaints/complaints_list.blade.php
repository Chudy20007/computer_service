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
        <th scope="col">Order ID</th>
        <th scope="col">Customer</th>
        <th scope="col">Employee</th>
        <th scope="col">Total price</th>
        <th scope="col">Payment</th>
        <th scope="col">Tax</th>
        <th scope="col">Updated</th>
        <th scope="col">Edit</th>
        <th scope="col">Prepare HTML</th>
        <th scope="col">Send HTML to Server PDF</th>
        <th scope="col">Generate PDF</th>
      </tr>
    </thead>
    <tbody>
      @foreach($complaints as $complaint)
      <tr class="table-light">
       
        <td>{{$complaint->id}}</td>
        <td><a href="{{URL::asset('order/'.$complaint->order_id)}}"<td>{{$complaint->order_id}}</td>
        <td><a href="{{URL::asset('user/'.$complaint->order->customer->id)}}"> {{$complaint->order->customer->name}}</a></td>
        <td> {{$complaint->employee->name}}</td> 
        <td> {{$complaint->total_price}}</td> 
        <td> {{$complaint->payment_method}}</td> 
        <td> {{$complaint->tax}}</td> 
        <td> {{$complaint->updated_at}}</td> 
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['ComplaintController@showComplaintEditForm',$complaint->id]])
          !!} {!! Form::hidden('complaint_id',$complaint->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@deactivateComplaint',$invoice->id]])
          !!} {!! Form::hidden('invoice_id',$invoice->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activateComplaint',$invoice->id]])
          !!} {!! Form::hidden('_method','PATCH',['class'=>'form-control']) !!} {!! Form::hidden('invoice_id',$invoice->id,['class'=>'form-control'])
          !!} {!! Form::submit('Activate',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['ComplaintController@generateComplaint',$complaint->id]])
                !!} {!! Form::hidden('complaint_id',$complaint->id,['class'=>'form-control'])
                !!} {!! Form::submit('Prepare',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
              </td>

              <td> {!! Form::open(['method'=>'GET','class'=>'form-horizontal','action'=>['ComplaintController@showHTMLComplaintForm',$complaint->id]])
                !!} {!! Form::hidden('complaint_id',$complaint->id,['class'=>'form-control'])
                !!} {!! Form::submit('Send',['class'=>'btn btn-primary']) !!} {{ Form::close() }} </a>
              </td>

      </tr>
      @endforeach
     
    </tbody>
  </table>
</div>

@stop