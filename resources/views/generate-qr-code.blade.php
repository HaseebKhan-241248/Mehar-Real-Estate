<!DOCTYPE html>
<html>
<head>
    <title>How to Generate QR Code in Laravel 8 - Online Web Tutor</title>
    <style>
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>

<div class="visible-print text-center">
    <h1>Laravel 8 - QR Code Generator Example</h1>

    {!! QrCode::size(250)->generate('Online Web Tutor'); !!}

    <p>Simple Basic Example by onlinewebtutorblog.com</p>
</div>

</body>
</html>
