var map = new Map();
document.querySelector(".username input").addEventListener("keyup", checkUsername);
map.set("username", false);
map.set("password", false);

function checkUsername(event){
    const input = event.currentTarget
    const user_box = document.querySelector(".username");
    user_box.querySelector(".error").classList.add('hidden');
    map.set("username", true);

    if(input.value.length < 4){
        user_box.querySelector('span').textContent = "Il nome deve avere minimo 4 caratteri";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("username", false);
    }else if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        user_box.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("username", false);
    }
}

//------------------------------------------------------------------------------------------------------------------------------------
document.querySelector(".password input").addEventListener("keyup", checkPassword);

function checkPassword(event){
    const input = event.currentTarget
    const user_box = document.querySelector(".password");
    user_box.querySelector(".error").classList.add('hidden');
    map.set("password", true);

    if(input.value.length < 8){
        user_box.querySelector('span').textContent = "La password deve contenere almeno 8 caratteri";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("password", false);
    }else if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        user_box.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("password", false);
    }
}

//----------------------------------------------------------------------------------------------------------------------------------
document.querySelector("form").addEventListener("submit", checkForm);

function checkForm(event){
    document.querySelector(".error-form").classList.add("hidden");
    if(!(map.get("username") && map.get("password"))){
        event.preventDefault();
        document.querySelector(".error-form").classList.remove("hidden");
    }
}