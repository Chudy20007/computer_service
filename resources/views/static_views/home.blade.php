@extends('main') @section('content')
<div class='row'>

<div class='col-md-3'>
        <img src="{{URL::asset('css/img/ok.png')}}" class="img-fluid" alt="Responsive image">
    Rok gwarancji to nasz standard.
</div>
<div class='col-md-3'>
        <img src="{{URL::asset('css/img/timer.jpg')}}" class="img-fluid" alt="Responsive image">
    W wyjątkowych okolicznościach możemy wykonać dla Ciebie naprawę w ciągu doby!
</div>

<div class='col-md-3'>
        <img src="{{URL::asset('css/img/fast.png')}}" class="img-fluid" alt="Responsive image">
    Sami odbierzemy laptopa i dostarczymy go z powrotem!
</div>
<div class='col-md-3'>
        <img src="{{URL::asset('css/img/lock.jpg')}}" class="img-fluid" alt="Responsive image">
    Śpij spokojnie. Twój laptop pojedzie w świat bezpieczny.
</div>
</div>
@stop