<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form | <?php echo $_ENV['APP_NAME'] ?></title>
</head>

<body>
  <form style="display: flex; flex-direction: column; max-width: 600px; margin: 0 auto;" method="POST" action="/api/contact">
    <input type="hidden" name="firstname">
    <label for="name">Imię</label>
    <input type="text" name="name" id="name" placeholder="Stefan" value="Stefan">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="stefan@kowalski.pl" value="stefan@kowalski.pl">
    <label for="message">Wiadomość</label>
    <textarea id="message" name="message" placeholder="Wpisz wiadomość">Wpisz wiadomość</textarea>
    <button type="submit">Wyślij</button>
  </form>
</body>

</html>
