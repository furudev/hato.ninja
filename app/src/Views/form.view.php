<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form | Hato.ninja</title>
</head>
<!--
  text: name;
  email: email;
  textarea: message;
-->

<body>
  <form style="display: flex; flex-direction: column; max-width: 600px; margin: 0 auto;" method="POST" action="/api/message/send">
    <input type="hidden" name="firstname">
    <label for="name">Imię</label>
    <input type="text" name="name" id="name" placeholder="Jan Kowalski" value="Jan Kowalski">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="jan@kowalski.pl" value="jan@kowalski.pl">
    <label for="message">Wiadomość</label>
    <textarea id="message" name="message" placeholder="Wpisz wiadomość">Wpisz wiadomość</textarea>
    <button type="submit">Wyślij</button>
  </form>
</body>

</html>
