<?php

include("conf.php");

class Poke{

    public function __construct(){
        
    }

    public function getPokemonList($limit,$page = 1){
        $result = array();

        $page--; // Make correct index
        $offset = $limit*$page; // Calculate offset if needed

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/?offset=".$offset."&limit=".$limit."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch); // JSON Format
        curl_close($ch); 
        $output = json_decode($output,true);
        
        foreach ($output['results'] as $i => $pokemon) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $pokemon['url']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output1 = curl_exec($ch); // JSON Format
            curl_close($ch); 

            $output1 = json_decode($output1,true);

            $result[$i]['id'] = $output1['id'];
            $result[$i]['name'] = $output1['name'];
            $result[$i]['height'] = $output1['height'];
            $result[$i]['weight'] = $output1['weight'];
            $result[$i]['sprite'] = $output1['sprites']['front_default'];
        }

        return $result;
    }
}

?>