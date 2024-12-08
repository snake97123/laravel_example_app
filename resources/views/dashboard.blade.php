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
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  <title>@yield('title')</title>
  @vite('resources/css/app.css') @vite('resources/js/app.js')
</head>
<body>
  <header style="background-color: #add8e6; text-align: center; padding: 10px;">
    <h1 style="font-size: 2em;">
      <a href="{{ url('/posts') }}" style="text-decoration: none; color: inherit;">
        インスタグラム風アプリ
      </a>
    </h1>
  </header>

  <main style="text-align: center; padding: 20px;">
    <h2>ようこそ、インスタグラム風アプリへ</h2>
    <p>ここであなたの思い出を共有し、新しいつながりを見つけましょう。</p>
    <div style="margin-top: 20px;">
      <a href="{{ route('login') }}" 
         style="display: inline-block; margin: 10px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
        ログイン
      </a>
      <a href="{{ route('register') }}" 
         style="display: inline-block; margin: 10px; padding: 10px 20px; background-color: #008CBA; color: white; text-decoration: none; border-radius: 5px;">
        会員登録
      </a>
    </div>
  </main>

  <footer style="background-color: #add8e6; padding: 10px; text-align: center;">
    <p>2024 インスタグラム風アプリ</p>
  </footer>
</body>
</html>
