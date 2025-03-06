<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fizetési visszaigazolás</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <h3>Rendelési adatok:</h3>
    <ul>
        @foreach ($mailData['kosar'] as $termek)
            <li>{{ $termek['cim'] }} - {{ $termek['ar'] }} Ft</li>
        @endforeach
    </ul>
</body>
</html>
