import FileData from "./FileData.js";
const userName = document.querySelector('#userName'),
userRules = document.querySelector('#userRules'),
Mail = document.querySelector('#Mail'),
Telefon = document.querySelector('#Telefon'),
salry = document.querySelector('#salry'),
status = document.querySelector('#status'),
img = document.querySelector('#img')


window.onload = () => {
  const personel = new FileData();
  personel.getData('../EmploData.json' , handlereq);
};

const handlereq = (data) =>{ 
    img.src = `${data.img}`;
    userName.textContent = `${data.F_name}  ${data.L_name}`;
    userRules.textContent = `${data.rules}`;
    Mail.textContent = `${data.email}`;
    Telefon.textContent = `${data.EmplNumber}`;
    salry.textContent = `${data.salry}`;
    status.textContent = `${data.userStatus}`;


}