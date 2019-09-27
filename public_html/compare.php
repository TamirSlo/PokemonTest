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

        <script src="/assets/js/compare.js"></script>
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
            <h2 class="mb-4">Compare Pokemons<br/>
                <small>Find out the differences between pokemons and their species.</small>
            </h2>
            <div class="card">
                <div class="card-header py-1">
                    Compare two species
                    <a class="btn btn-primary py-0 px-2 float-right" href="/browse.php">Browse Pokemon</a>
                </div>
                    <div class="card-body p-0">
                        <div class="spinner-border text-warning my-3 tableSpinner" role="status" id="tableSpinner2">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <table class="table table-hover table-bordered m-0 text-center compareTable d-none" id="compareTable">
                        
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>