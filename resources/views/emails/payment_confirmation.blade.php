
<!DOCTYPE html>
<html>
<head>
    <title>Fizetés Visszaigazolása</title>
</head>
<body>
    <h1>Kedves {{ $user->name }}!</h1>
    <p>Köszönjük a rendelését! Az alábbi termékek kerültek kosarába:</p>
    <ul>
        @foreach ($kosar as $termek)
            <li>{{ $termek['cim'] }} - {{ $termek['ar'] }} Ft</li>
        @endforeach
    </ul>
    <p>Végösszeg: {{ $total }} Ft</p>
    <p>Köszönjük, hogy nálunk vásárolt!</p>
</body>
</html>
