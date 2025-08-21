<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    <title>FashionablyLate</title>
</head>
<body>
<div class="thankYou">
    <p>お問い合わせありがとうございました</p>
    <button class="home-button__btn" type="button" onclick="window.location.href='{{ url('/') }}'">HOME</button>
</div>
<div class="background-text">Thank you</div>
</body>
</html>