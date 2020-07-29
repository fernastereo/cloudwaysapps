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
      </div>
    </div>
  </div>
</body>
</html>