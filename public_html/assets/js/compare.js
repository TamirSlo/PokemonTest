var demo = false;
var r1;
var r1;
$(document).ready(function(){
    if(window.location.pathname == "/"){
        demo = true;

        poke1id = randomInt();
        poke2id = randomInt();

        while(poke1id==poke2id){
            poke2id = randomInt();
        }

        poke1 = getPokemonInfo(poke1id);
        poke2 = getPokemonInfo(poke2id);

        //console.log(poke1);

        $.when( r1, r2 ).done(function(){
            var table = $('#compareTable');
            var spinner = $('#tableSpinner2');

            content = "<tr><th></th><th><a class='text-capitalize'>"+poke1.name+"</a></th><th><a class='text-capitalize'>"+poke2.name+"</a></th></tr> \
                <tr><td></td><td><img src='"+poke1.sprite+"' class='rounded-circle' width='50px'/></td><td><img src='"+poke2.sprite+"' class='rounded-circle' width='50px'/></td></tr> \
                <tr><td>Height</td><td><a>"+poke1.height+"</a></td><td><a>"+poke2.height+"</a></td></tr> \
                <tr><td>Weight</td><td><a>"+poke1.weight+"</a></td><td><a>"+poke2.weight+"</a></td></tr> \
                <tr><td>HP</td><td><a>Base Stat: "+poke1.stats.hp[0]+" | Effort: "+poke1.stats.hp[1]+"</a></td><td><a>Base Stat: "+poke2.stats.hp[0]+" | Effort: "+poke2.stats.hp[1]+"</a></td></tr> \
                <tr><td>Attack</td><td><a>Base Stat: "+poke1.stats.attack[0]+" | Effort: "+poke1.stats.attack[1]+"</a></td><td><a>Base Stat: "+poke2.stats.attack[0]+" | Effort: "+poke2.stats.attack[1]+"</a></td></tr> \
                <tr><td>Defence</td><td><a>Base Stat: "+poke1.stats.defense[0]+" | Effort: "+poke1.stats.defense[1]+"</a></td><td><a>Base Stat: "+poke2.stats.defense[0]+" | Effort: "+poke2.stats.defense[1]+"</a></td></tr>";

            table.html(content);
            table.toggleClass("d-none");
            spinner.toggleClass("d-none");
        });
    }else{
        var table = $('#compareTable');
        var spinner = $('#tableSpinner2');
        if (getCookie("compare1") && getCookie("compare2")) {
            var c1 = getCookie("compare1");
            var c2 = getCookie("compare2");
            
            poke1 = getPokemonInfo(c1);
            poke2 = getPokemonInfo(c2);

            $.when( r1, r2 ).done(function(){
                var table = $('#compareTable');
                var spinner = $('#tableSpinner2');
    
                content = "<tr><th></th><th><a class='text-capitalize'>"+poke1.name+"</a></th><th><a class='text-capitalize'>"+poke2.name+"</a></th></tr> \
                    <tr><td></td><td><img src='"+poke1.sprite+"' class='rounded-circle' width='50px'/></td><td><img src='"+poke2.sprite+"' class='rounded-circle' width='50px'/></td></tr> \
                    <tr><th>Height</th><td><a>"+poke1.height+"</a></td><td><a>"+poke2.height+"</a></td></tr> \
                    <tr><th>Weight</th><td><a>"+poke1.weight+"</a></td><td><a>"+poke2.weight+"</a></td></tr> \
                    <tr><th>HP</th><td><a>Base Stat: "+poke1.stats.hp[0]+" | Effort: "+poke1.stats.hp[1]+"</a></td><td><a>Base Stat: "+poke2.stats.hp[0]+" | Effort: "+poke2.stats.hp[1]+"</a></td></tr> \
                    <tr><th>Attack</th><td><a>Base Stat: "+poke1.stats.attack[0]+" | Effort: "+poke1.stats.attack[1]+"</a></td><td><a>Base Stat: "+poke2.stats.attack[0]+" | Effort: "+poke2.stats.attack[1]+"</a></td></tr> \
                    <tr><th>Defence</th><td><a>Base Stat: "+poke1.stats.defense[0]+" | Effort: "+poke1.stats.defense[1]+"</a></td><td><a>Base Stat: "+poke2.stats.defense[0]+" | Effort: "+poke2.stats.defense[1]+"</a></td></tr> \
                    <tr><th>Spec. Attack</th><td><a>Base Stat: "+poke1.stats.sattack[0]+" | Effort: "+poke1.stats.sattack[1]+"</a></td><td><a>Base Stat: "+poke2.stats.sattack[0]+" | Effort: "+poke2.stats.sattack[1]+"</a></td></tr> \
                    <tr><th>Spec. Defence</th><td><a>Base Stat: "+poke1.stats.sdefense[0]+" | Effort: "+poke1.stats.sdefense[1]+"</a></td><td><a>Base Stat: "+poke2.stats.sdefense[0]+" | Effort: "+poke2.stats.sdefense[1]+"</a></td></tr> \
                    <tr><th>Speed</th><td><a>Base Stat: "+poke1.stats.speed[0]+" | Effort: "+poke1.stats.speed[1]+"</a></td><td><a>Base Stat: "+poke2.stats.speed[0]+" | Effort: "+poke2.stats.speed[1]+"</a></td></tr>";
    
                table.html(content);
                table.toggleClass("d-none");
                spinner.toggleClass("d-none");
            });
        }else{
            table.toggleClass("d-none");
            spinner.toggleClass("d-none");
            table.html("Please select two Pokemon in Browse to compare.");
        }
    }

    $("#clearComparison").click(function(e){
        e.preventDefault();
        rmCookie("compare1");
        rmCookie("compare2");
        $("#clearComparison").toggleClass("btn-primary btn-warning disabled");
        $("#clearComparison").html("Cleared!");
    })
});

function getPokemonInfo(id){
    var poke = [];
    poke.stats = [];
    poke.stats.hp = [];
    poke.stats.attack = [];
    poke.stats.defense = [];
    poke.stats.sattack = [];
    poke.stats.sdefense = [];
    poke.stats.speed = [];
    var req = $.get("https://pokeapi.co/api/v2/pokemon/"+id,function(data2){
        poke.id = data2.id;
        poke.name = data2.name;
        poke.height = data2.height;
        poke.weight = data2.weight;
        poke.sprite = data2.sprites.front_default;
        poke.stats.hp[0] = data2.stats[5].base_stat;
        poke.stats.hp[1] = data2.stats[5].effort;
        poke.stats.attack[0] = data2.stats[4].base_stat;
        poke.stats.attack[1] = data2.stats[4].effort;
        poke.stats.defense[0] = data2.stats[3].base_stat;
        poke.stats.defense[1] = data2.stats[3].effort;
        if(!demo){
            poke.stats.sattack[0] = data2.stats[2].base_stat;
            poke.stats.sattack[1] = data2.stats[2].effort;
            poke.stats.sdefense[0] = data2.stats[1].base_stat;
            poke.stats.sdefense[1] = data2.stats[1].effort;
            poke.stats.speed[0] = data2.stats[0].base_stat;
            poke.stats.speed[1] = data2.stats[0].effort;
        }
    }).fail(function(){
        /*if(r2 == null) r1 = null;
        var t_poke = getPokemonInfo(id);
        return t_poke;*/
    });

    if(r1 == null) r1 = req;
    if(r1 != null) r2 = req;

    return poke;
}

function randomInt(){
    return Math.floor(Math.random() * 500) + 1;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return decodeURI(c.substring(name.length, c.length));
        }
    }
    return "";
}

function rmCookie(cname) {
    document.cookie = cname + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
}