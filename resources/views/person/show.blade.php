<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Show</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <style>
    p {
      margin-bottom: 0;
    }
  </style>
</head>
<body>
  <div class="container mt-3">
    <div class="card">
      <h5 class="card-header">Schedule Meeting</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
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
          <div class="col-8">
            <h6>Available Organizations</h6>
            <table class="table table-sm">
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
                    <td><small><a href="https://calendly.com/adu-resource-center/adu-resource-center-contractor-booking-clone?a1={{ urlencode($personPhone) }}&name={{ urlencode($organization->name) }}%20Meeting%20{{ urlencode($person->first_name) }}%20{{ urlencode($person->last_name) }}&a2={{ urlencode($personEmail) }}&email={{ urlencode($organization->{'b9a9b40b7387cd9f7cafcc17969fae4eb695903d'}) }}&location={{ urlencode($person->{'35f00eb5ee0a5cec1fe2061cbc759fe72da4447c'}) }}&a3={{ urlencode($person->{'5f504213b4ac6207f8430a9c6618ad5d6dbcb233'}) }}">Schedule meeting</a></small></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>