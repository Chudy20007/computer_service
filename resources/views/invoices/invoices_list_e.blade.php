@extends('main') @section('content') @if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
    <b> {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif
<div class="table-responsive2">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Numer zlecenia</th>
        <th scope="col">Klient</th>
        <th scope="col">Pracownik</th>
        <th scope="col">Całkowity koszt</th>
        <th scope="col">Metoda płatności</th>
        <th scope="col">Zaktualizowano</th>
        <th scope="col">Przygotuj HTML</th>
        <th scope="col">Wyślij plik HTML na serwer</th>
        <th scope="col">Utwórz dokument</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoices as $invoice)
      <tr class="table-light">

        <td>{{$invoice->id}}</td>
        <td>
          <a href="{{URL::asset('order/'.$invoice->order_id)}}" <td>{{$invoice->order_id}}</td>
        <td>
          <a href="{{URL::asset('user/'.$invoice->order->customer->id)}}"> {{$invoice->order->customer->name}}</a>
        </td>
        <td> {{$invoice->employee->name}}</td>
        <td>{{number_format($invoice->total_price,2)}} PLN</td>
        <td> {{$invoice->payment_method}}</td>
        <td> {{$invoice->updated_at}}</td>

        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['InvoiceController@generateInvoice',$invoice->id]])
          !!} {!! Form::hidden('invoice_id',$invoice->id,['class'=>'form-control']) !!} {!! Form::submit('Przygotuj',['class'=>'btn
          btn-primary']) !!} {{ Form::close() }}
        </td>

        <td> {!! Form::open(['method'=>'GET','class'=>'form-horizontal','action'=>['InvoiceController@showHTMLInvoiceForm',$invoice->id]])
          !!} {!! Form::hidden('invoice_id',$invoice->id,['class'=>'form-control']) !!} {!! Form::submit('Wyślij',['class'=>'btn
          btn-primary']) !!} {{ Form::close() }}
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['ComplaintController@showComplaintForm',$invoice->id]])
          !!} {!! Form::hidden('invoice_id',$invoice->id,['class'=>'form-control']) !!} {!! Form::submit('Utwórz',['class'=>'btn
          btn-primary']) !!} {{ Form::close() }}
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>

@stop