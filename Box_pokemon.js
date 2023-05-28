fetch("print_box.php").then(Json).then(PrintCatch);

function Json(response){
    return response.json();
}

function PrintCatch(json){
    const box = document.querySelector("section");

    for(let image of json){
        const img = document.createElement("img");
        img.src = image;
        img.classList.add("img");
        box.appendChild(img);
        img.addEventListener("click", Modal);
    }
}

function Modal(event){
    const img = event.currentTarget;
    fetch("modal.php?img="+img.src).then(Json).then(SeeModal);
}

function SeeModal(json){
    window.scrollTo({top: 0});
    const bd = document.querySelector("body");
    const art = bd.querySelector("article");
    
    bd.classList.add("no-scroll");
    art.classList.remove("hidden");
    
    const pokedex = document.querySelector(".pokedex");
    const pokemon = document.querySelector(".card-section-left img");
    const name_pokemon = document.querySelector(".name");
    const type_box = document.querySelector(".type-box");   
    const moves_box = document.querySelector(".moves-box");
    
    pokedex.textContent = json.pokedex;
    pokemon.src = json.src;
    name_pokemon.textContent = json.pokemon;
    type_box.innerHTML="";
    moves_box.innerHTML="";
    
    for(let a of json.types){
        if(a.type != ""){
            const type_pokemon = document.createElement("span");
            type_pokemon.textContent = a.type;
            type_pokemon.classList.add(type_pokemon.textContent);
            type_box.appendChild(type_pokemon);
        }
    }

    for(let a of json.moves){
        const move_element = document.createElement("div");
        const move = document.createElement("span");
        const type = document.createElement("span");
        move.textContent = a.move;
        type.textContent = a.type;
        
        move_element.classList.add("move-element");
        type.classList.add(a.type);
        
        move_element.appendChild(move);
        move_element.appendChild(type);
        moves_box.appendChild(move_element);
    }
    
}

document.querySelector(".pokeball").addEventListener("click", Free);
document.querySelector(".exit").addEventListener("click", CloseModal);

function Free(){
    const pokemon = document.querySelector(".card-section-left img").src;
    const pokedex = document.querySelector(".pokedex").textContent;
    
    const art = document.querySelector("article");
    art.classList.add("hidden");
    
    const image = document.querySelectorAll(".img");
    for(let a of image){
        if(a.src == pokemon){
            a.remove();
        }
    }

    fetch("free_pokemon.php?pokedex="+pokedex+"&img="+pokemon);
}

function CloseModal(){
    const bd = document.querySelector("body");
    const art = document.querySelector("article");
    art.classList.add("hidden");
    bd.classList.remove("no-scroll");
}

document.querySelector(".add").addEventListener("click", SaveInTeam);

function SaveInTeam(){
    CloseModal();
    const pokedex = document.querySelector(".pokedex").textContent;
    fetch("./add_team.php?pokedex="+pokedex);
}