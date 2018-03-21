<html lang="en">

<head>
  @include('partial_views.head')
</head>
<title>Invoice nr: {{$invoice->id}} {{$invoice->order->customer->name}}</title>
<div class='row' style='margin:50px'>
<div class='col-md-8'>
</div>
<div class="container2" style='background-color:white;'>
        <div class="col-md-12"><img src="{{URL::asset('css/img/logo.png')}}" alt="Image Soft" style="height:50px;  width:20%%" />
            <p style="float:right; margin:3px;text-align:right; font-size:12px;">ul. Krzywa 22, 42-200 Częstochowa<br/> 29 128 13 93 <br/>www.w-kom.pl <br/><br/> Częstochowa
                {{$invoice->updated_at}}
            </p>
        </div>
        <br/>
        <p style="float:top; margin:13px; font-weight:bold; text-align:center">
            <h3 style="text-align:center;">INVOICE TAX NR:
                {{$invoice->id}}
            </h3>
        </p>

        <p style="float:left; margin:13px; font-weight:bold; font-size:12px; text-align:left">
            Seller: W-KOM Sp. z.o.o<br/> 42-200 Częstochowa, ul.Krzywa 22 <br/> ING Bank S.A nr: 29 9999 9999 1111 1212 2931 8123
        </p>
        <br/><br/><br/>
        <br/>
        <p style="margin:13px; font-weight:bold; font-size:12px; text-align:left">
            Purchaser:<br/>
            {{$invoice->order->customer->name}}<br/>
            {{$invoice->order->customer->post_code}} {{$invoice->order->customer->city}} 
            {{$invoice->order->customer->street}}
            {{$invoice->order->customer->local_number}}<br/>
            {{$invoice->order->customer->email}}
        </p>

        <p style="margin:13px; text-align:left; font-size:12px;">
            Date:
            {{$invoice->created_at}}<br/> Payment method:
            {{$invoice->payment_method}}<br/> Payment date:
            {{$invoice->created_at}}<br/>

            <br/>

            <table class='table table-striped table-responsive table-bordered ' id='myTable' style='font-size:12px;'>
                <tr class='info'>
                    <th>L.p.</th>
                    <th>Item name/service</th>
                    <th>Amount</th>
                    
                    <th>Net amount</th>
                    <th>Gross amount</th>
                    <th>Tax</th>
                    <th>Total</th>

                </tr>
                @php $i=1; $price=0 @endphp
                @foreach($invoice->order_service as $service)
                <tr>
                    <td>{{$i}}</td>

                    @php $i++;
                     @endphp
                <td>{{$service->service->name}}</td>
                <td>1</td>
                <td>{{round($service->service->price-($service->service->price*$invoice->tax/100),2)}}$</td>
               
                <td>{{$service->service->price}}$</td>
                <td>{{$invoice->tax}}%</td>
                <td>{{round($service->service->price,2)}}$</td>
                <tr/>
                @php $price+=round($service->service->price,2,2) @endphp
                @endforeach
                @foreach($invoice->order_part as $part)
                <tr>
                        <td>{{$i}}</td>
                        @php $i++ @endphp
                <td>{{$part->part->name}}</td>
                <td>{{$part->count}}</td>
                <td>{{round($part->part->price-($part->part->price*$invoice->tax/100),2)}}$</td>
                
                <td>{{$part->part->price}}$</td>
                <td>{{$invoice->tax}}%</td>
                <td>{{$part->part->price*$part->count}}$</td>
                <tr/>
                @php $price+=round($part->part->price*$part->count,2) @endphp
                @endforeach    
          
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Subtotal</td>
                <td>{{round($price,2)}}$</td>
            </table>

        </p>
        <p style="margin:13px; font-weight:bold; font-size:12px; text-align:left">
                Subtotal :

            {{round($price,2)}}$<br/> Paid:
            {{$invoice->payment_method}} {{round($price,2)}}$ <br/>
        </p>
    </div>
    <div id="editor"></div>
  
<script src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('js/invoice.js')}}"></script>

    @php file_put_contents('yourpage.html', ob_get_contents()); @endphp
</html>