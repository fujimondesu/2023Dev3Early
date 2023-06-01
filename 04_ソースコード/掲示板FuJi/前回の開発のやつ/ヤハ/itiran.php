<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>商品一覧試作</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <?php
    require_once './DBManager.php';
    $dbmng = new DBManager();
    $deviceNamesAll = $dbmng->getDeviceNames();
    $devicePricesAll = $dbmng->getDevicePrices();
    $deviceEvaluationValueAll = $dbmng->getDeviceEvaluationValue();
    $deviceEvaluationNumberAll = $dbmng->getDeviceEvaluationNumber();
    $deviceNamesArr;
    $devicePriceArr;
    $deviceEvaluationValueArr;
    $deviceEvaluationNumberArr;
    $i = 0;
    $cart_id = $_SESSION['cart_id'];

    //index番号で指定できるように配列に格納
    foreach ($deviceNamesAll as $row) {
        $deviceNamesArr[$i] = $row['device_name'];
        $i++;
    }
    $i = 0;
    foreach ($devicePricesAll as $row) {
        $price;
        $Dprice = $row['default_price'];
        $Sprice = $row['sale_price'];
        if ($Sprice == 0) {
            $price = $Dprice;
        } else {
            $price = $Sprice;
        }
        $devicePriceArr[$i] = "￥" . number_format($price);
        $i++;
    }
    $i = 0;
    foreach ($deviceEvaluationValueAll as $row) {
        $deviceEvaluationValueArr[$i] = $row['evaluation_value'];
        $i++;
    }
    $i = 0;
    foreach ($deviceEvaluationNumberAll as $row) {
        $deviceEvaluationNumberArr[$i] = number_format($row['number_of_evaluation']);
        $i++;
    }
    ?>

    <nav class="navbar navbar-expand navbar-dark" style="background: #232f3e;margin-bottom:30px;height:auto;" aria-label="2 番目のナビゲーション バーの例">
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

                    <a class="nav-link" href="./ka-to.php">
                        <img src="./img/カート.png" width="80" height="30" class="img-fluid">
                    </a>

                </form>
            </div>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                    <form action="./syosai.php" method="post" name="a_form1">
                        <input type="hidden" name="device" value="1">
                        <a href="javascript:a_form1.submit();" style="text-decoration:none;">
                            <img class="card-img-top itiran-photo-size" src="./img/ゲーミングキーボード1.png">
                            <div class="card-body">
                                <p class="card-title text-height" style="flex-grow: 1;">
                                    <?php
                                    echo $deviceNamesArr[0];

                                    //確認用
                                    // echo $_SESSION['cart_id'];
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[0] . '"></span>';
                                    echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[0] . '</span>';
                                    ?>
                                </p>
                                <p class="text-danger">
                                    <?php
                                    echo $devicePriceArr[0];
                                    ?>
                                </p>
                            </div>
                        </a>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                    <form action="./syosai.php" method="post" name="a_form2">
                        <input type="hidden" name="device" value="2">
                        <a href="javascript:a_form2.submit();" style="text-decoration:none;">
                            <img class="card-img-top itiran-photo-size" src="./img/ゲーミングキーボード2.png">
                            <div class="card-body">
                                <p class="card-title text-height">
                                    <?php
                                    echo $deviceNamesArr[1];
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[1] . '"></span>';
                                    echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[1] . '</span>';
                                    ?>
                                </p>
                                <p class="text-danger">
                                    <?php
                                    echo $devicePriceArr[1];
                                    ?>
                                </p>
                            </div>
                        </a>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                    <form action="./syosai.php" method="post" name="a_form3">
                        <input type="hidden" name="device" value="3">
                        <a href="javascript:a_form3.submit();" style="text-decoration:none;">
                            <img class="card-img-top itiran-photo-size" src="./img/ゲーミングキーボード3.png">
                            <div class="card-body">
                                <p class="card-title text-height">
                                    <?php
                                    echo $deviceNamesArr[2];
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[2] . '"></span>';
                                    echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[2] . '</span>';
                                    ?>
                                </p>
                                <p class="text-danger">
                                    <?php
                                    echo $devicePriceArr[2];
                                    ?>
                                </p>
                            </div>
                        </a>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                    <form action="./syosai.php" method="post" name="a_form4">
                        <input type="hidden" name="device" value="4">
                        <a href="javascript:a_form4.submit();" style="text-decoration:none;">
                            <img class="card-img-top itiran-photo-size" src="./img/ゲーミングヘッドフォン1.png">
                            <div class="card-body">
                                <p class="card-title text-height">
                                    <?php
                                    echo $deviceNamesArr[3];
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[3] . '"></span>';
                                    echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[3] . '</span>';
                                    ?>
                                </p>
                                <p class="text-danger">
                                    <?php
                                    echo $devicePriceArr[3];
                                    ?>
                                </p>
                            </div>
                        </a>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                    <form action="./syosai.php" method="post" name="a_form5">
                        <input type="hidden" name="device" value="5">
                        <a href="javascript:a_form5.submit();" style="text-decoration:none;">
                            <img class="card-img-top itiran-photo-size" src="./img/ゲーミングヘッドフォン2.png">
                            <div class="card-body">
                                <p class="card-title text-height">
                                    <?php
                                    echo $deviceNamesArr[4];
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[4] . '"></span>';
                                    echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[4] . '</span>';
                                    ?>
                                </p>
                                <p class="text-danger">
                                    <?php
                                    echo $devicePriceArr[4];
                                    ?>
                                </p>
                            </div>
                        </a>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                    <form action="./syosai.php" method="post" name="a_form6">
                        <input type="hidden" name="device" value="6">
                        <a href="javascript:a_form6.submit();" style="text-decoration:none;">
                            <img class="card-img-top itiran-photo-size" src="./img/ゲーミングヘッドフォン3.png">
                            <div class="card-body">
                                <p class="card-title text-height">
                                    <?php
                                    echo $deviceNamesArr[5];
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[5] . '"></span>';
                                    echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[5] . '</span>';
                                    ?>
                                </p>
                                <p class="text-danger">
                                    <?php
                                    echo $devicePriceArr[5];
                                    ?>
                                </p>
                        </a>
                </div>
                </form>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                <form action="./syosai.php" method="post" name="a_form7">
                    <input type="hidden" name="device" value="7">
                    <a href="javascript:a_form7.submit();" style="text-decoration:none;">
                        <img class="card-img-top itiran-photo-size" src="./img/ゲーミングマウス1.png">
                        <div class="card-body">
                            <p class="card-title text-height">
                                <?php
                                echo $deviceNamesArr[6];
                                ?>
                            </p>
                            <p>
                                <?php
                                echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[6] . '"></span>';
                                echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[6] . '</span>';
                                ?>
                            </p>
                            <p class="text-danger">
                                <?php
                                echo $devicePriceArr[6];
                                ?>
                            </p>
                        </div>
                    </a>
                </form>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                <form action="./syosai.php" method="post" name="a_form8">
                    <input type="hidden" name="device" value="8">
                    <a href="javascript:a_form8.submit();" style="text-decoration:none;">
                        <img class="card-img-top itiran-photo-size" src="./img/ゲーミングマウス2.png">
                        <div class="card-body">
                            <p class="card-title text-height">
                                <?php
                                echo $deviceNamesArr[7];
                                ?>
                            </p>
                            <p>
                                <?php
                                echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[7] . '"></span>';
                                echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[7] . '</span>';
                                ?>
                            </p>
                            <p class="text-danger">
                                <?php
                                echo $devicePriceArr[7];
                                ?>
                            </p>
                        </div>
                    </a>
                </form>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="card itiran-card-margin" style="height: 550px; margin-bottom:20px;">
                <form action="./syosai.php" method="post" name="a_form9">
                    <input type="hidden" name="device" value="9">
                    <a href="javascript:a_form9.submit();" style="text-decoration:none;">
                        <img class="card-img-top itiran-photo-size" src="./img/ゲーミングマウス3.png">
                        <div class="card-body">
                            <p class="card-title text-height">
                                <?php
                                echo $deviceNamesArr[8];
                                ?>
                            </p>
                            <p>
                                <?php
                                echo '<span class="star5_rating" data-rate="' . $deviceEvaluationValueArr[8] . '"></span>';
                                echo '<span style="margin-left: 10px;">' . $deviceEvaluationNumberArr[8] . '</span>';
                                ?>
                            </p>
                            <p class="text-danger">
                                <?php
                                echo $devicePriceArr[8];
                                ?>
                            </p>
                        </div>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>