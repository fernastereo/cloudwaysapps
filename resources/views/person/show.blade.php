@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-4">
    <h5 class="card-title">{{ $person->first_name . ' ' . $person->last_name }}</h5>
    <p>
      @foreach ($person->phone as $phone)
        @if ($phone->primary )
          {{ $phone->value }}
          @php
              $personPhone = $phone->value;
          @endphp                 
        @endif
      @endforeach
    </p>
    <p>
    @foreach ($person->email as $email)
      @if ($email->primary)
        <a href="mailto:{{ $email->value }}">{{ $email->value }}</a>
        @php
          $personEmail = $email->value;
        @endphp 
      @endif
    @endforeach
    </p>
  <p><small>{{ $person->{'35f00eb5ee0a5cec1fe2061cbc759fe72da4447c'} }}</small></p>
  <p><small>{{ $person->{'5f504213b4ac6207f8430a9c6618ad5d6dbcb233'} }}</small></p>
  </div>
  <div class="col-12 col-sm-8">
    <h6>Available Organizations</h6>
    <table class="table table-sm table-responsive">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">E-mail</th>
          <th scope="col">Phone</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($organizations as $organization)                        
          <tr>
            <td><small>{{ $organization->name }}</small></td>
            <td><small>{{ $organization->{'b9a9b40b7387cd9f7cafcc17969fae4eb695903d'} }}</small></td>
            <td><small>{{ $organization->{'1601d493c4d1578610678ffa123034bf7bb2bd78'} }}</small></td>
            <td><small><a href="{{ route('person.schedule', ['personid' => $person->id, 'organizationid' => $organization->id]) }}">Schedule Meeting</a></small></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
