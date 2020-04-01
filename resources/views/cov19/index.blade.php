<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>總表</title>
</head>

<body>
    <div class="container">
      <p></p>
      <div class="col-md-12">
        <h1>表格</h1>
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="/CoV19/area" target="iframe">地區</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/CoV19/gender" target="iframe">性別</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/CoV19/age" target="iframe">年齡</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/CoV19/foreign" target="iframe">境外移入</a>
            </li>
          </ul>
        <div class="tab-content">
              <iframe style="width:100%;min-height:50em" src="/CoV19/area" name="iframe"></iframe>
        </div>
    </div>
  </div>
</body>

</html>