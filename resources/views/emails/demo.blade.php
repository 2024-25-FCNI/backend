<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fizetési visszaigazolás</title>
</head>
<body>
    <h1>Fizetési visszaigazolás</h1>

    <p>Köszönjük a vásárlását, {{ $mailData['name'] }}!</p> <!-- 🔥 A felhasználó neve bekerül -->
    
    <h3>Rendelési adatok:</h3>
    <ul>
        @foreach ($mailData['kosar'] as $termek)
            <li>{{ $termek['cim'] }} - {{ number_format($termek['ar'], 0, ',', ' ') }} Ft</li>
        @endforeach
    </ul>

    <p><strong>Összesen:</strong> {{ number_format($mailData['total'], 0, ',', ' ') }} Ft</p> <!-- 🔥 Az összesített fizetendő összeg -->
</body>
</html>
