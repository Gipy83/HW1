document.querySelector(".trainer button").addEventListener("click", modalTrainer);
var trainer_img = "plus-square-dotted";

function modalTrainer(event){
    event.preventDefault();
    document.querySelector(".overlay").classList.remove("hidden");

    const images = document.querySelectorAll(".art img");
    
    for(let img of images){
        img.addEventListener("click", selectImage);
    }
}

function selectImage(event){
    const src = event.currentTarget;
    document.querySelector(".overlay").classList.add("hidden");
    const trainer = document.querySelector(".trainer img");
    trainer.src = src.src;
    trainer_img = src.dataset.id;
    trainer.classList.remove("unknown");
}
//------------------------------------------------------------------------------------------------------------------------------------

fetch("printProfile.php").then(JSON).then(print_Team);

function JSON(response){
    return response.json();
}


function print_Team(json){
    const span = document.querySelectorAll("#info span");
    const trainer = document.querySelector(".trainer img");

    if(json.img == "plus-square-dotted"){
        trainer.src = "./image/SVG/"+json.img+".svg";
        trainer.classList.add("unknown");
    }else{
        trainer.src = "./image/trainer/"+json.img+".png"
    }
    trainer_img = json.img; 

    for(let text of span){
        if(text.dataset.name == "nome"){
            text.textContent = json.nome+" "+json.cognome;
        }else if(text.dataset.name == "username"){
            text.textContent = json.username;
        }else if(text.dataset.name == "number"){
            text.textContent = json.N_catture;
        }
    }
    
    for(let a=0; a<json.team.length; a++){
        const pokemon_box = document.querySelector("#Team-view");
        const pokemon = document.createElement("img");
        pokemon.src = json.team[a];
        pokemon_box.appendChild(pokemon);
    }
}

const btn = document.querySelectorAll(".btn");
btn[1].addEventListener("click", Save);

function Save()
{
    fetch("save.php?src="+trainer_img);
}