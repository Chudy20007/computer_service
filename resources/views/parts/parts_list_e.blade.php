@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='parts_e'>
        <th scope="col" data-name="category" data-sort="asc">Kategoria</th>
        <th scope="col" data-name="name" data-sort="asc">Nazwa</th>
        <th scope="col" data-name="count" data-sort="asc">Sztuk</th>
        <th scope="col" data-name="price" data-sort="asc">Cena</th>
        <th scope="col" data-name="updated_at" data-sort="asc">Edytowano</th>
      </tr>
    </thead>
    <tbody>
      @foreach($parts as $part)
      <tr class="table-light">
        <td>{{$part->category->name}}</td>
        <td>{{$part->name}}</td>
        <td> {{$part->count}}</td>
        <td> {{number_format($part->price,2)}} PLN</td>
        <td> {{$part->updated_at}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@stop