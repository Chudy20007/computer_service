@if (Session::has('message'))
<div class="alert alert-success text-center">
    <h4>{{Session::get('message')}}</h4>
</div>
{{Session::forget('message')}}
@endif