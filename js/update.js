import FileData from "./FileData.js";

let userName = document.getElementById('userName');
let F_name = document.getElementById('F_name');
let L_name = document.getElementById('L_name');
let salry = document.getElementById('salry');
let imgs = document.getElementById('image-preview');
let updateBtn = document.getElementById('submit');

const file_Data = new FileData();

userName.onchange = () =>{

    file_Data.getData('../employesData.json' , getEmployes);
}


const getEmployes = (data) =>{


    let userNameArr = data.filter((x) => x.userName == userName.value);

    F_name.value = userNameArr[0].F_name;
    L_name.value = userNameArr[0].L_name;
    salry.value = userNameArr[0].salry;
    imgs.src = userNameArr[0].img


}

updateBtn.onclick = ()=>{
    let senOjg = {
        userName : userName.value,
        F_name : F_name.value,
        L_name : L_name.value,
        salry : salry.value,
    }

    file_Data.send_data('../php/update.php' , senOjg);

    file_Data.getData('../updateMsg.json' , (x) => alert(JSON.parse(x).massage))
}