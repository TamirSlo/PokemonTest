var next;
var previous;
$(document).ready(function(){
    loadPokemons();

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
            console.log(url);
            

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

                    content = content + "<tr><td><img src='"+sprite+"' class='rounded-circle' width='50px'/></td>";
                    content = content + "<td><a class='text-capitalize'>"+name+"</a></td>";
                    content = content + "<td><a>"+height+"</a></td>";
                    content = content + "<td><a>"+weight+"</a></td>";
                    content = content + "<td><a><a onclick='SavePokemon("+id+")' class='savePokeBtn'><i class='far fa-heart fa-2x'></i></a></td></tr>";
                    if(last==name){
                        table.append(content);
                        table.toggleClass("d-none");
                        spinner.toggleClass("d-none");
                    }
                });

                if(i==19){
                    last = pokemons[i].name;
                }
            }

            if (data.previous != null) {
                $("#browsePreviousPage").removeClass("disabled");
            }else{
                $("#browsePreviousPage").addClass("disabled");
            }
        });
}