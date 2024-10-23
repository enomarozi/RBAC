<!DOCTYPE html>
<html>
<head>
    <title>caripropertyindonesia.com</title>
</head>
<style>
    p{
        font-size: 22px;
    }
    h2{
        font-weight: normal;
    }
</style>
<body>
    <h1 align='center'>{{ $content['title'] }}</h1>
    <div>
        <h3 align='left'>Hai, {{ $content['email'] }}</h3>
        <p align='justify'>Sepertinya anda melakukan permintaan untuk mengatur ulang password. Jika benar, silahkan klik tombol berikut untuk mengatur ulang password anda.</p>
        <h2>Berikut linknya : {{ $content['body'] }}</h2>
    </div>
    <p>Thank you</p>
</body>
</html>