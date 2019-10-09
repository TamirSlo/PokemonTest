<?php

include("assets/main.php");

$poke = new Poke();

//$pokemons = $poke->getPokemonList(20);
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

        <script src="/assets/js/browse.js"></script>
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
                <?php if(!$poke->logged_in){ ?>
                    <li class="item">
                        <a href="/login.php">Login <i class="fas fa-chevron-right"></i></a>
                    </li>
                <?php }else{ ?>
                    <li class="item">
                        <a href="/fave.php">Saved <i class="fas fa-chevron-right"></i></a>
                    </li>
                    <li class="item">
                        <a href="/logout.php">Logout <i class="fas fa-chevron-right"></i></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <div class="content container-fluid py-2">
            <h2 class="mb-4">Browse Pokemon<br/>
                <small>Explore the wild world of pokemon and find different species!</small>
            </h2>
            <div class="card">
                <div class="card-header py-1">
                    Browse Pokemons
                    <a class="btn btn-primary py-0 px-2 float-right mx-1 mt-1" id="browseNextPage"><i class="fas fa-arrow-right"></i></a>
                    <a class="btn btn-primary py-0 px-2 float-right mx-1 mt-1 disabled" id="browsePreviousPage"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="card-body p-0" id="browseContainer">
                    <div class="spinner-border text-warning my-3 tableSpinner" role="status" id="tableSpinner">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <table class="table table-hover table-bordered m-0 text-center d-none" id="browseContent">
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>