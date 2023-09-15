<!DOCTYPE html>
<html data-theme="light" id="tema" class="bg-base-100">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @inertiaHead
    @routes
</head>

<body class="overflow-hidden">
    @inertia
</body>

</html>
