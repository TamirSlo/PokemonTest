<?php

include("assets/main.php");

$poke = new Poke();

if(isset($_POST['action'])){
    $action = $_POST['action'];

    if($action == "toggle"){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $r = $poke->toggleFave($id,$name,$height,$weight);
        die(json_encode($r));
    }
}

$s = $poke->getFaves();
if(count($s['results']) > 0){
    $faves = $s['results'];
}else{
    $faves = false;
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
            <h2 class="mb-4">Saved Pokemon<br/>
                <small>Check the stats of your saved Pokemon as a Trainer and keep track of your lists!</small>
            </h2>
            <div class="card">
                <div class="card-header py-1">
                    Saved Pokemons
                </div>
                <div class="card-body p-0">
                    
                    <table class="table table-hover table-bordered m-0 text-center">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Compare / Save</th>
                        </tr>
                        <?php foreach ($faves as $pokemon) {
                            //echo $pokemon;
                            echo "<tr><td><img src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/".$pokemon['PID'].".png' class='rounded-circle' width='50px'/></td>";
                            echo "<td><a class='text-capitalize'>".$pokemon['Name']."</a></td>";
                            echo "<td><a>".$pokemon['Height']."</a></td>";
                            echo "<td><a>".$pokemon['Weight']."</a></td>";
                            echo "<td><a onclick='ComparePokemon(this,".$pokemon['PID'].")' class='comparePokeBtn mx-2'><i class='fas fa-list fa-2x'></i></a>";
                            echo "<a onclick='SavePokemon(this,".$pokemon['PID'].",\"".$pokemon['Name']."\",".$pokemon['Height'].",".$pokemon['Weight'].")' class='savePokeBtn mx-2 selected'><i class='fas fa-heart fa-2x'></i></a></td></tr>";
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>