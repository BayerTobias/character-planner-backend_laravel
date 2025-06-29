<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>

  body{
    background-color: red;
  }
  
</style>
<body>
    <h1>Hallo {{ $notifiable->name }},</h1>
    <p>Du hast eine Anfrage zum Zurücksetzen deines Passworts gestellt.</p>
    <p>Klicke auf den Link, um dein Passwort zurückzusetzen:</p>
    <a href="{{ $url }}">Passwort zurücksetzen</a>
    <p>Wenn du diese Anfrage nicht gestellt hast, kannst du diese Mail ignorieren.</p>
</body>
</html>