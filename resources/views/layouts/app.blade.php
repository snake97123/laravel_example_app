<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  @vite('resources/css/app.css')
</head>
<body>
  <header style="background-color: blue">
    <h1>インスタグラム風アプリ</h1>
  </header>
  <div class="content">
    @yield('content');
  </div>
  <footer style="background-color: blue;">
    <p>2023 インスタグラム風アプリ</p>
  </footer>
  
</body>
</html>