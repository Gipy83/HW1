fetch("search_stone.php").then(onJson).then(Stone);

function onJson(response){
    return response.json();
}


function Stone(json){
    let cont = 1;
    for(let stone of json){
        let index = 0;
        const sc = document.querySelector("section");
        const box_esterno = document.createElement("div");
        const box = document.createElement("div");
        
        const div_num =  document.createElement("div");
        const img =  document.createElement("img");
        
        const div_info = document.createElement("div");
        
        const title_box = document.createElement("div");
        const title = document.createElement("h1");
        const costo =  document.createElement("span");
        
        const text =  document.createElement("span");
        const text2 =  document.createElement("span");
        
        box_esterno.classList.add("box");
        box.classList.add("dv-1");
        div_num.classList.add("enumerazione");
        div_info.classList.add("text");
        img.classList.add("im");
        

        title.textContent = stone.name;
        costo.textContent = "Costo: "+stone.cost;
        text.textContent = "Effect: "+stone.effect_entries[0].short_effect;
        for(let a of stone.flavor_text_entries) {
            if(a.language.name == "en" && index < 1){
                text2.textContent = a.text;
                index++;
            }
        }
        img.src = stone.sprites.default;

        sc.appendChild(box_esterno);

        box_esterno.appendChild(box);

        box.appendChild(div_num);
        box.appendChild(div_info);

        div_num.appendChild(img);
        
        title_box.appendChild(title);
        title_box.appendChild(costo);

        div_info.appendChild(title_box);
        div_info.appendChild(text);
        div_info.appendChild(text2);
        cont++;
    }

}


