﻿<?php

	require_once("session.php");
	
	require_once("func.php");
	$auth_user = new USER();
	$user_req = new USER();
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM customer WHERE id=:id");
	$stmt->execute(array(":id"=>$user_id));
	
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    
    if(isset($_POST['offer_id']))
    {
        $_SESSION['off_rid'] = $_POST['offer_id'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    
    <!--
		*********************************
        * Created by Luca Colagiorgio   *
        * and Remo Steinmann            *
        * as part of an Assignement     *
        *********************************
	-->

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Stylesheets-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- For IE 9 and below. ICO should be 32x32 pixels in size -->
    <!--[if IE]><link rel="shortcut icon" href="img/favicon.ico"><![endif]-->
    <!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. -->
    <link rel="apple-touch-icon-precomposed" href="img/mobile_favicon.png">
    <!-- Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size. -->
    <link rel="icon" href="img/favicon.ico">	    
    <!-- Titel Declaration -->
    <title>WebShop</title>
    <!-- Stylesheet Firefox, Chrome, Safari, Opera -->
    <link rel="stylesheet" type="text/css" href="css/default.css" />    
</head>

<body> 
    <!-- NAVIGATION BAR -->
    <nav>
        <ul id="nav">
            <li class="home"><a href="home.php"><img src="img/home.png"></a></li>
            <li><a href="#s1">Menu</a>
                <span id="s1"></span>
                <ul class="subs">
                    <li><a href="request.php">Post a new Request</a>
                    </li>
                    <li><a href="search.php">Search for Requests</a>
                        <ul>
                            <li><a href="all_requests.php">Show all requests</a></li>
                            <li><a href="home.php">View your own Requests</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="login"><a href="#6"><?php print($userRow['username']); ?></a>
            <span id="s6"></span>
                <ul class="subs">
                    <li><a href="logout.php?logout=true">logoff</a>
                        <ul>

                        </ul>
                    </li>
                </ul>
            </li>
                
        </ul>
        
    </nav>

    <div class="signin-form">
	<div class="container">
        <h2 class="form-signin-heading">All Offers for Request ID <?php echo $_SESSION['off_rid']; ?></h2><hr />
        <?php
            
            $stmt = $user_req->runQuery("SELECT * FROM offers where r_id=:id");
            $stmt->bindValue(":id",$_SESSION['off_rid']);
            $stmt->execute();
        
            while($userReq=$stmt->fetch(PDO::FETCH_ASSOC)){    
                ?><h6> Offer ID </h6><?php echo($userReq['id']);  ?> <br /><br />
                <h6> Offered Price </h6><?php echo($userReq['price']);  ?> <br /><br /> 
                <h6> Offered Quantity </h6><?php echo($userReq['quantity']);  ?>
                <br />
                <hr />
                <?php
            }
                ?>
            <br />
        </form>
    </div>
    </div>
    <footer>
        <p>© 2018 Copyright</p>
</footer>
</body>

</html>
