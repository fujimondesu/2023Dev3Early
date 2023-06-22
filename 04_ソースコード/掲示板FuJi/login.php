<!-- ログイン画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FuJi</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />
  </head>

  <body class="text-center">
    <!-- ヘッダー -->
    <div class="container-fluid" style="padding-left: 0">
      <div class="row header-style">
        <div class="col-9 header-L">
          <img src="./img/logo.png" width="auto" height="100%" alt="logo" />
        </div>
        <div class="col-3 header-R-parent">
          <div class="header-R-child-on">
            home
          </div>
          <div class="header-R-child-on">
            user
          </div>
          <div class="header-R-child-off">
            logout
          </div>
        </div>
      </div>
    </div>

    <!-- 戻るボタン -->
    <a
      href="#" class="btn-back">＜戻る</a>

    <!-- 掲示板FuJi -->
    <h1 class="board">
      掲示板FuJi
    </h1>

    <!-- フォーム -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <form class="border rounded bg-white col-lg-4 col-md-6 col-10 p-3">
          <h2 class="mt-3 mb-5">ログインして会話に参加しましょう!</h2>
          <div class="mb-3">
            <input
              type="email"
              class="form-control rounded-pill w-75 m-auto"
              id="inputMail"
              placeholder="メールアドレス"
            />
          </div>
          <div class="mb-3">
            <input
              type="password"
              class="form-control rounded-pill w-75 m-auto"
              id="inputPass"
              placeholder="パスワード"
            />
          </div>
          <div>
            <a href="./home.php">
              <button
                type="button"
                class="btn btn-primary rounded-pill my-4 px-5"
              >
                ログイン
              </button>
            </a>
          </div>
          <div>
            <a href="./pass_change_1.html">
              <button type="button" class="btn btn-link">
                パスワードを忘れた方はこちら
              </button>
            </a>
          </div>
          <div>
            <a href="./sign_up_1.html">
              <button type="button" class="btn btn-link">新規登録</button>
            </a>
          </div>
        </form>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
