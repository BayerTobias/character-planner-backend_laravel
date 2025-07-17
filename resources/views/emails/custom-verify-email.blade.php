<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bestätige deine E-Mail</title>
</head>
<style>

  body{
    background-color: red;
  }
  
</style>
<body>
    <h1>Hallo {{ $user->name }},</h1>
    <p>Bitte bestätige deine E-Mail-Adresse mit folgendem Link:</p>
    <a href="{{ $url }}">E-Mail bestätigen</a>
    <p>Danke!</p>
</body>
</html>