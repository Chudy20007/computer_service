@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Kategoria</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Sztuk</th>
        <th scope="col">Cena</th>
        <th scope="col">Edytowano</th>
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