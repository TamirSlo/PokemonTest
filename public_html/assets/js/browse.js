var next;
var previous;

var cookie1 = getCookie("compare1");
var cookie2 = getCookie("compare2");
$(document).ready(function(){
    
    if(window.location.pathname == "/"){
        loadPokemons("https://pokeapi.co/api/v2/pokemon/?limit=5");
    }else{
        loadPokemons();
    }

    $("#browseNextPage").click(function(){
        var table = $('#browseContent');
        var spinner = $('#tableSpinner');
        table.toggleClass("d-none");
        spinner.toggleClass("d-none");
        loadPokemons(next);
    });

    $("#browsePreviousPage").click(function(){
        var table = $('#browseContent');
        var spinner = $('#tableSpinner');
        table.toggleClass("d-none");
        spinner.toggleClass("d-none");
        loadPokemons(previous);
    });
});

function loadPokemons(url = "https://pokeapi.co/api/v2/pokemon/") {
    $.get(url)
        .done(function(data){
            var pokemons = data.results;
            

            next = data.next;
            previous = data.previous;

            var table = $('#browseContent');
            var spinner = $('#tableSpinner');

            var content = "";
            table.html("<tr><th></th><th>Name</th><th>Height</th><th>Weight</th><th>Save</th></tr>");
            var last;
            
            for (var i = 0; i < pokemons.length; i++) {
                
                uri = pokemons[i].url;
                $.get(uri,function(data2){
                    var id = data2.id;
                    var name = data2.name;
                    var height = data2.height;
                    var weight = data2.weight;
                    var sprite = data2.sprites.front_default;
                    var ex = "";

                    if (cookie1 == id || cookie2 == id) ex = " selected";

                    content = content + "<tr><td><img src='"+sprite+"' class='rounded-circle' width='50px'/></td>";
                    content = content + "<td><a class='text-capitalize'>"+name+"</a></td>";
                    content = content + "<td><a>"+height+"</a></td>";
                    content = content + "<td><a>"+weight+"</a></td>";
                    content = content + "<td><a onclick='ComparePokemon(this,"+id+")' class='comparePokeBtn mx-2"+ex+"'><i class='fas fa-list fa-2x'></i></a> \
                    <a onclick='SavePokemon("+id+")' class='savePokeBtn mx-2'><i class='fas fa-heart fa-2x'></i></a></td></tr>";

                    if((content.split('<tr>').length-1)==limit){
                        table.append(content);
                        table.toggleClass("d-none");
                        spinner.toggleClass("d-none");
                    }
                });

                var limit = pokemons.length;
            }

            if (data.previous != null) {
                $("#browsePreviousPage").removeClass("disabled");
            }else{
                $("#browsePreviousPage").addClass("disabled");
            }
        });
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

function setCookie(cname,cvalue) {
    document.cookie = cname + "=" + cvalue + ";path=/";
}

function rmCookie(cname) {
    document.cookie = cname + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
}

function ComparePokemon(e,id){
    
    var c1 = getCookie("compare1");
    if (c1 != "") {
        if (c1 == id){
            rmCookie("compare1");
            $(e).removeClass("selected");
        }else{
            var c2 = getCookie("compare2");
            if (c2 == id){
                rmCookie("compare2");
                $(e).removeClass("selected");
            }else{
                setCookie("compare2", id);
                $("a[onclick='ComparePokemon(this,"+c2+")']").removeClass("selected");
                $(e).addClass("selected");
            }
        }
    } else {
        var c2 = getCookie("compare2");
        if (c2 == id){
            rmCookie("compare2");
            $(e).removeClass("selected");
        }else{
            setCookie("compare1", id);
            $("a[onclick='ComparePokemon(this,"+c1+")']").removeClass("selected");
            $(e).addClass("selected");
        }
    }
}