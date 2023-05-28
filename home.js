document.querySelector("form").addEventListener("submit", Search);

function Search(event){
    event.preventDefault()
    const input = document.querySelector("form input");

    fetch("search_pokemon.php?pokemon="+encodeURIComponent(input.value)).then(Json).then(PrintPokemon);
}
function Json(response){
    return response.json();
}



function PrintPokemon(json){
    const section = document.querySelector("section");
    section.innerHTML = "";

    const card = document.createElement("div");

    const info = document.createElement("div");
    const pokedex_text =document.createElement("span");
    const pokedex = document.createElement("span");

    const pokemon = document.createElement("img");

    const text = document.createElement("div");
    const nome = document.createElement("span");
    
    const type_box = document.createElement("div");
    
    const pokeball = document.createElement("img");

    section.classList.add("sc_query1");
    card.classList.add("card");
    info.classList.add("inf");
    pokedex.classList.add("pokedex");
    pokemon.classList.add("img");
    text.classList.add("text");
    pokeball.classList.add("pokeball");
    
    pokedex_text.textContent = "N. pokedex: "
    pokedex.textContent = json.id;
    pokemon.src = json.sprites.front_default;
    nome.textContent = json.name;
    pokeball.src = "./image/SVG/pokeball.svg";

    fetch("search_pokemon_db.php?pokedex="+pokedex.textContent).then(Json).then((res)=>(ConfirmCatch(res, pokeball)));

    pokeball.addEventListener("click", Catch);


    for(let tipo of json.types){
        const type = document.createElement("span");
        type.textContent = tipo.type.name;
        type.classList.add(type.textContent);
        type_box.appendChild(type);
    }

    card.appendChild(info);
    card.appendChild(pokemon);
    card.appendChild(text);
    card.appendChild(pokeball);

    text.appendChild(nome);
    text.appendChild(type_box);

    info.appendChild(pokedex_text);
    info.appendChild(pokedex);

    section.appendChild(card);
}


function ConfirmCatch(json, pokeball){
    if(json.catch){
        pokeball.title = "free";
    }else{
        pokeball.title = "Catch";
    }
}


function Catch(event){
    const card = event.currentTarget.parentNode;
    const pokedex = card.querySelector(".pokedex").textContent;
    const name = card.querySelector(".text span").textContent;
    const pokemon = card.querySelector(".img").src;
    const pokeball = card.querySelector(".pokeball");

    if(pokeball.title == "Catch"){
        soundCatch();
        fetch("catch_pokemon.php?pokedex="+pokedex+"&pokemon="+name).then(Json).then(See);

        pokeball.title= "Free"; 

    }else
    {
        fetch("free_pokemon.php?pokedex="+pokedex+"&img="+pokemon);

        pokeball.title= "Catch";
    }
}


function soundCatch() {
    var snd = new Audio("./sound/Capture_song.mp3");
    snd.play();
}
