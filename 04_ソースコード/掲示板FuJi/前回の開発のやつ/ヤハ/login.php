<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>ログイン</title>
<style>
</style>
<script>
       
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    
    <nav class="navbar navbar-expand navbar-dark" style="background: #232f3e;" aria-label="2 番目のナビゲーション バーの例">
        <div class="container-fluid">
            <img src="./img/rogo.png"  width="80" height="30" class="img-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="ナビゲーションを切り替える">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
<div id="maindiv" class="container">
    <div class="row mt-5">
        <div class="offset-md-3 col-md-6">
            <h1 class="text-center mb-5">ログイン</h1>
            <div class="row">
                <div class="col-md-12 mt-1 mb-1 alert-danger text-center" id="errorMsg">
                    
                </div>
            </div>
            <form action="logincheck.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control"
                            pattern=".+\.[a-zA-Z0-9][a-zA-Z0-9-]{0,61}[a-zA-Z0-9]"
                            value="" required
                            name="mail"inputmode="numeric"
                            minlength="0"
                            maxlength="40">
                            <label for="lastname">メールアドレス</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="form-floating">
                            <input type="password" class="form-control" 
                            pattern="^[0-9A-Za-z]+$"
                            value="" required
                            name="pas"inputmode="numeric"
                            minlength="0"
                            maxlength="20">
                            <label for="lastname">パスワード</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="d-grid gap-2">
                            <!-- <button class="btn btn-dark btn-lg text-white" type="button" onclick="registClick()">ログイン</button> -->
                            <input class="btn btn-dark btn-lg text-white" type = "submit" value = "ログイン">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>