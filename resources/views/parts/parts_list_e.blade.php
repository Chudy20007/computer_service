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
        <th scope="col">Category</th>
        <th scope="col">Name</th>
        <th scope="col">Count</th>
        <th scope="col">Price</th>
        <th scope="col">Updated</th>
      </tr>
    </thead>
    <tbody>
      @foreach($parts as $part)
      <tr class="table-light">
        <td>{{$part->category->name}}</td>
        <td>{{$part->name}}</td>
        <td> {{$part->count}}</td>
        <td> {{$part->price}}</td>
        <td> {{$part->updated_at}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@stop