<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'classes/user.php';

$objUser = new User();

// GET
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $stmt = $objUser->runQuery("SELECT * FROM crud_users WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $id = null;
    $rowUser = null;
}

//POST

if (isset($_POST['btn'])) {
    $email = strip_tags($_POST['email']);

    try {
        if ($id != null) {
            if ($objUser->update($email, $id)) {
                $objUser->redirect('success.html?updatet');
            }
        } else {
            if ($objUser->insert($email)) {
                $objUser->redirect('success.html?inserted');
            } else {
                $objUser->redirect('index.php?error');
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magebit</title>
    <link rel="stylesheet" href="css/libs.min.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/media.min.css">
</head>

<body>

    <header class="header">

        <div class="header__mobile">

            <nav class="header__nav-mobile">
                <img src="images/logo_pineapple_mobile.svg" alt="" class="header__logo">
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">How it works</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>

            <!-- <div class="header__mobile-bg">
                
                <div class="header__mobile-content">
                    
                    <h1 class="header__content-heading">Subscribe to newsletter</h1>
                    <p class="header__content-text">Subscribe to our newsletter and get 10% discount on pineapple
                        glasses.</p>
                    <form>
                        <input type="email" placeholder="Type your email address here…">
                        <button type="submit">
                            <img src="images/ic_arrow.svg" alt="">
                        </button>
                    </form>

                    <label class="label__container">I agree to <a href="#">terms of service</a>
                        <input type="checkbox" checked="checked">
                        <span class="header__content-checkmark"></span>
                    </label>

                    <div class="header__baseline"></div>

                    <div class="header__social">

                        <a class="header__social-facebook" href="#"></a>


                        <a class="header__social-instagram" href="#"></a>



                        <a class="header__social-twitter" href="#"></a>


                        <a class="header__social-youtube" href="#"></a>

                    </div>
                </div>
            </div> -->



        </div>


        <div class="header__inner">
            <nav class="header__nav">
                <img src="images/logo_pineapple.svg" alt="" class="header__logo">
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">How it works</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>

            <div class="header__content" id='header__content'>
                <div class="wrapper" id='content'>

                    <h1 class="header__content-heading">Subscribe to newsletter</h1>
                    <p class="header__content-text">Subscribe to our newsletter and get 10% discount on pineapple
                        glasses.
                    </p>
                    <div class="wrapper">
                        <div class="form">
                            <form action="#" id="form" class="form__input" method="post">
                                <input type="text" id="formEmail" name="email" placeholder="Type your email address here…" class="form__input _req _email" value="<?php print($rowUser['email']); ?>">

                                <button class="input_btn" type="submit" name="btn">
                                    <img src="images/ic_arrow.svg" alt="">
                                </button>

                                <span id="errorSpan"></span>

                                <div class="wrapper">
                                    <div class="checkbox">
                                        <input id="formAgreement" type="checkbox" name="agreement" class="checkbox__input _req">
                                        <label for="formAgreement" class="checkbox__lable"><span> I agree to <a href="#">terms of service</a></span></label>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="header__baseline"></div>

                <div class="header__social">

                    <a class="header__social-facebook" href="#"></a>


                    <a class="header__social-instagram" href="#"></a>



                    <a class="header__social-twitter" href="#"></a>


                    <a class="header__social-youtube" href="#"></a>

                </div>
            </div>

        </div>
        <div class="header__pinapple">
            <img src="images/bg.jpg" alt="pineappleimg" class="header__pineapple-img">
        </div>

    </header>

    <script src="js/libs.min.js"></script>
    <script src="js/main.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>