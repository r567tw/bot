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
    <div class="alert alert-info">
      實際總數會和實時病例數會有一些差別，那是因為政府資料集的更新並不是即時性的，週期是一天。
    </div>
    <div class="col-md-12">
      <h1>總表</h1>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="/CoVid19/area" target="iframe">地區</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/CoVid19/gender" target="iframe">性別</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/CoVid19/age" target="iframe">年齡</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/CoVid19/foreign" target="iframe">境外移入</a>
        </li>
      </ul>
      <div class="tab-content">
        <iframe style="width:100%;min-height:50em" src="/CoVid19/area" name="iframe"></iframe>
      </div>
    </div>
  </div>
</body>

</html>