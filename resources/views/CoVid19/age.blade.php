<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>各年齡層確診數</title>
</head>

<body>
    <div class="container">
    <div id="myTable">
        <table class="table display">
            <thead>
            <tr>
                <th>各年齡層</th>
                <th>確診數</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($result as $item => $value)
            <tr>
                <td>{{ $item }}</td>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
            <tr>
                <td>總數</td>
                <td>{{ $result->sum() }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</body>

</html>