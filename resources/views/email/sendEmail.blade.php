<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <h1>{{ $mailData['subject'] }}</h1>
    <p> {{ $mailData['name'] }}</p>
    <p> {{ $mailData['email'] }}</p>
    <p> {{ $mailData['message'] }}</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ipsum tempore, amet, molestias, cupiditate doloremque sequi maiores suscipit ad deleniti a delectus. Aspernatur rem ea iure quas eos ipsum maxime.</p>
  </body>
</html>