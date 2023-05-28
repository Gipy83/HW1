fetch("game_pokemon.php?").then(onJson).then(Pokemon);
var pokemon;
count = 0;


function onJson(response){
    return response.json();
}

function Pokemon(json){
    document.querySelector("#card img").classList.add("hide");
    document.querySelector("#risposte div").innerHTML = "";
    document.querySelector("#risposte div").classList.remove("scroll");
    pokemon = json.name;
    document.querySelector("#card img").src = json.sprites;
}

document.querySelector("#card form").addEventListener("submit", verify);

function verify(event){
    event.preventDefault();
    const input = document.querySelector("#card input").value;
    if(input != ""){
        if(input == pokemon){
            stampText(true, input);
        }else{
            stampText(false, input);
        }
    }
}

function stampText(result, input){
    const risposte = document.querySelector("#risposte div");
    const risposta = document.createElement("span");

    risposta.textContent = input;
    if(result){
        risposta.classList.add("giusta");
        document.querySelector(".hide").classList.add("esatto");
        document.querySelector(".hide").classList.remove("hide");
        document.querySelector(".btn").textContent = "Reload";
    }else{
        risposta.classList.add("errata");
        count++;
        if(count > 14){
            document.querySelector("#risposte div").classList.add("scroll");
        }
    }
    risposte.appendChild(risposta);
}

document.querySelector(".btn").addEventListener("click", Reload);

function Reload(){
    fetch("game_pokemon.php?").then(onJson).then(Pokemon);
}