<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>各縣市確診數</title>
</head>

<body>
    <div id="myTable">
        <table class="display">
            <tr>
                <td>縣市</td>
                <td>確診數</td>
            </tr>
            @foreach ($result as $item => $value)
            <tr>
                <td>{{ $item }}</td>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>