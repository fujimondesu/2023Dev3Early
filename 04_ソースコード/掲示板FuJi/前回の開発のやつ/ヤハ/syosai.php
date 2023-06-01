<!DOCTYPE html>
<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>商品詳細試作</title>
    <style>
    </style>
    <script type="text/javascript">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php
    // session_start();
    // $syosai = $_SESSION['syosai'];
    $syosai = (int)$_POST['device'];
    // echo "<h1>".$syosai."</h1>";
    require_once './DBManager.php';
    $dbmng = new DBManager();
    $deviceInfomation = $dbmng->deviceSearch($syosai);
    $photo;
    $device_name;
    $default_price;
    $sale_price;
    $manufacturer;
    $brand;
    $connection_method;
    $recommended_use;
    $deviceEvaluationValue;
    $deviceEvaluationNumber;
    foreach ($deviceInfomation as $row) {
        $photo = $row['photo'];
        $device_name = $row['device_name'];
        $default_price = $row['default_price'];
        $sale_price = $row['sale_price'];
        $manufacturer = $row['manufacturer'];
        $brand = $row['brand'];
        $connection_method = $row['connection_method'];
        $recommended_use = $row['recommended_use'];
        $deviceEvaluationValue = $row['evaluation_value'];
        $deviceEvaluationNumber = $row['number_of_evaluation'];
    }
    ?>

    <nav class="navbar navbar-expand navbar-dark" style="background: #232f3e;" aria-label="2 番目のナビゲーション バーの例">
        <div class="container-fluid">
            <a class="nav-link" href="./itiran.php">
                <img src="./img/rogo.png" width="80" height="30" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="ナビゲーションを切り替える">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarsExample02">
                <ul class="navbar-nav">
                    <a class="nav-link" href="./logout.php">
                        ログアウト
                    </a>
                </ul>
                <form role="search">
                    <a class="nav-link" href="./ka-to.php"><img src="img/カート.png" width="80" height="30" class="img-fluid"></a>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <span>
                    <div class="img-left">
                        <?php
                        echo '<img src="img/' . $photo . '" class="img-size">';
                        ?>
                    </div>
                </span>
            </div>
            <div class="col-sm-6 col-xs-12">
                <span style="width: auto; margin-left:0%;">
                    <div class="box-text">
                        <br>
                        <h2>
                            <?php
                            echo $device_name;
                            ?>
                        </h2>
                        <p>
                            <?php
                            echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValue . '"></span>';
                            echo '<span style="margin-left: 10px;">' . number_format($deviceEvaluationNumber) . '</span>';
                            ?>
                        </p>
                        <p>参考価格：
                            <?php
                            $default_priceStr = "￥" . number_format($default_price);
                            echo $default_priceStr;
                            ?>
                        </p>
                        <p>
                            セール特価：
                            <?php
                            $sale_priceStr = "￥" . number_format($sale_price);
                            echo $sale_priceStr;
                            ?>
                        </p>
                        <p>
                            OFF：
                            <?php
                            if ($sale_price == 0) {
                                echo "￥0";
                            } else {
                                $priceStr = "￥" . number_format($default_price - $sale_price);
                                echo $priceStr;
                            }
                            ?>
                        </p>
                        <br>
                        <p>
                            商品詳細
                            <?php
                            // echo '"￥".number_format($default_price - $sale_price)';
                            ?>
                        </p>
                        <p>
                            メーカー:
                            <?php
                            echo $manufacturer;
                            ?>
                        </p>
                        <p>
                            ブランド:
                            <?php
                            echo $brand;
                            ?>
                        </p>
                        <p>
                            接続方法:
                            <?php
                            echo $connection_method;
                            ?>
                        </p>
                        <p>
                            商品推奨用途:
                            <?php
                            echo $recommended_use;
                            ?>
                        </p>

                        <form action="./ka-to.php" method="post">
                            <input type="hidden" name="device_id" value="
                            <?php
                            echo $syosai;
                            ?>
                            ">
                            <input class="btn btn-warning btn-lg text-dark" type="submit" value="カートに入れる">
                        </form>
                        <!-- <button class="btn btn-warning btn-lg text-dark" type="button" onclick="location.href='ka-to.php'">カートに入れる</button> -->
                    </div>
                </span>
            </div>
        </div>
    </div>
    <div class="box yoko" style="margin-bottom: 10%;">
    </div>
</body>

</html>