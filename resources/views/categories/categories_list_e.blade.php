@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='categories_e'>
        <th scope="col" data-name="name" data-sort="asc">Nazwa</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr class="table-light">
        <td>{{$category->name}}</td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop