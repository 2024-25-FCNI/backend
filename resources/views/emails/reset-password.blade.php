<!DOCTYPE html>
<html>
<head>
    <title>Jelszó visszaállítás</title>
</head>
<body>
    <h1>Jelszó visszaállítás</h1>
    <p>Kattints az alábbi linkre a jelszó visszaállításához:</p>
    <a href="{{ env('FRONTEND_URL') }}/reset-password?token={{ $token }}">
        Jelszó visszaállítása
    </a>
</body>
</html>
