<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            color: red;
        }
        .header {
            height: 200px;
            background: blue;
            /* padding: 5px; */
        }
        .content {
            height: 600px;
            background: yellow;
        }
        .footer {
            height: 200px;
            background: green;
        }
    </style>
</head>
<body>
    @include ('Blade_templates/header')

    @yield('noidung')
    @yield('login')

    @include ('Blade_templates/footer')
</body>
</html>