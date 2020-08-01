<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <script src="https://kit.fontawesome.com/f406a7473d.js" crossorigin="anonymous"></script>
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
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>