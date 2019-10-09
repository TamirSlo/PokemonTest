<?php

include("assets/main.php");

$poke = new Poke();

$error = false;
if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tname = $_POST['tname'];

    $r = $poke->Register($username,$password,$tname);
    if(!$r['success']){
        $error = $r['error'];
    }
}

?>

<html>
    <head>
        <title>Simple Pokemon Site</title>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <link rel="icon" href="assets/images/icon.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <nav>
            <img class="rounded-circle" src="assets/images/logo.jpg" width="100px"/>
            <h4>PokeSite</h4>
            <ul class="navbar">
                <li class="item">
                    <a href="/">Home <i class="fas fa-chevron-right"></i></a>
                </li>
                <li class="item">
                    <a href="/browse.php">Browse <i class="fas fa-chevron-right"></i></a>
                </li>
                <li class="item">
                    <a href="/compare.php">Compare <i class="fas fa-chevron-right"></i></a>
                </li>
                <li class="item">
                    <a href="/login.php">Login <i class="fas fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
        <div class="content container-fluid py-2">
            <h2 class="mb-4">Register to PokeSite<br/>
                <small>Take your first step and create your personal trainer account!</small>
            </h2>
            <div class="container w-25 text-center">
                <form class="mb-1" method="post">
                    <?php if($error) echo "<span class='text-white font-weight-bold mb-4 d-block'>".$error."</span>"; ?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tname" placeholder="Trainer Name">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-danger text-warning font-weight-bold">Register</button>
                </form>
                <a href="/login.php" class="text-warning">Or login here...</a>
            </div>
        </div>
    </body>
</html>