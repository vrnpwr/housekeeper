<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>House Keeper</title>
</head>

<body>
  <img src="{{ asset('images/logo.png')}}" alt="{{config('app.name') }}">
  <h1>{{ config('app.name') }}</h1>
  <h4>{{ $details['title'] }}</h4>
  <p>{{ $details['body'] }}</p>
  <p>Thanks!</p>
</body>

</html>