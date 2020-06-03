<!DOCTYPE html>
<html>

<head>
  <title>{{ config('app.name') }}</title>
</head>

<body>
  {{ dd($details)}}
  <h1>{{ $details['title'] }}</h1>
  <p>{{ $details['body'] }}</p>

  <p>Thank you</p>
</body>

</html>