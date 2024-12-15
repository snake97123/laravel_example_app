<!DOCTYPE html>
<html lang="ja">
</head>
<body>
  <header style="background-color: #add8e6; text-align: center; padding: 10px;">
    <h1 style="font-size: 2em;">
      <a href="{{ url('/admin') }}" style="text-decoration: none; color: inherit;">
        管理者ページ
      </a>
    </h1>
  </header>

  <main style="text-align: center; padding: 20px;">
    <h2>管理者ログイン</h2>
    <form method="POST" action="{{ route('admin.login') }}" style="max-width: 50%; margin: 0 auto;">
      @csrf
      <div class="form-group" style="margin-bottom: 15px;">
        <label for="email">メールアドレス</label>
        <input type="email" class="form-control" id="email" name="email" required style="width: 100%; padding: 10px; margin-top: 5px;">
      </div>
      <div class="form-group" style="margin-bottom: 15px;">
        <label for="password">パスワード</label>
        <input type="password" class="form-control" id="password" name="password" required style="width: 100%; padding: 10px; margin-top: 5px;">
      </div>
      <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">ログイン</button>
    </form>
  </main>

  <footer style="background-color: #add8e6; padding: 10px; text-align: center;">
    <p>2024 管理者ページ</p>
  </footer>
</body>
</html>