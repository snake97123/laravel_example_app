<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <title>@yield('title')</title>
  @vite('resources/css/app.css')
</head>
<body>
  <header style="background-color: #add8e6; text-align: center; padding: 10px;">
    <h1 style="font-size: 2em;">
    <a href="{{ url('/posts') }}" style="text-decoration: none; color: inherit;">
        インスタグラム風アプリ
      </a>
    </h1>
  </header>
  <div class="content">
    @yield('content')
  </div>
  <footer style="background-color: #add8e6; padding: 10px;">
    <p>2023 インスタグラム風アプリ</p>
  </footer>
</body>
</html>