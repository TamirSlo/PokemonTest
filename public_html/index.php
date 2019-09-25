<?php

include("assets/main.php");

$poke = new Poke();

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
                    <a href="#">Home <i class="fas fa-chevron-right"></i></a>
                </li>
                <li class="item">
                    <a href="#">Browse <i class="fas fa-chevron-right"></i></a>
                </li>
                <li class="item">
                    <a href="#">Compare <i class="fas fa-chevron-right"></i></a>
                </li>
                <li class="item">
                    <a href="#">Login <i class="fas fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </body>
</html>