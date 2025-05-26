<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        @font-face {
            font-family: 'Allura';
            src: url("{{ $fontPath }}") format('truetype');
        }

        h1 {
            font-family: 'Allura', cursive;
        }

        p {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1 style="color:red; font-size:small; font-family:cursive">{{ $title }}</h1>
    <p>{{ $message }}</p>
</body>
</html>
