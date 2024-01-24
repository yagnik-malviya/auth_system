<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Mail</title>
</head>

<body>
    <div style="text-align: center">
        <img src="{{ asset('public/admin/img/logo.png') }}" alt="">
    </div>
    <h4><b>Name</b>:- {{ $details->name }}</h4>
    <h4><b>Email</b>:- {{ $details->email }}</h4>
    <h4><b>Mobile</b>:- {{ $details->number }}</h4>
    @if ($details->message)
        <h4><b>Message</b>:- {{ $details->message }}</h4>
    @endif
</body>

</html>
