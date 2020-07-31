@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <h6>Persons</h6>
    <table class="table table-sm">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">name</th>
          <th scope="col">url</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($persons as $person)                        
          <tr>
            <td><small>{{ $person['id'] }}</small></td>
            <td><small>{{ $person['name'] }}</small></td>
            <td><small>{{ $person['95b1079caeebef34531a005163806761856fc2a6'] }}</small></td>
            <td></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
