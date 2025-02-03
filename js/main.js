import menu from "./menu.js";
import FileData from "./FileData.js";
document.getElementById("menu").innerHTML = menu();



let submitBt = document.querySelector("#submit"),
  formData = document.querySelector("form"),
  objectData = {
    img: "../images/admin-logo.jpg",
    rules: "full satck Developer",
    email: "",
    salry:"",
    section : ""
  };

// let testobj = {
//     F_name : "jamalaldeen",
//     L_name : "khalil",
//     userName : "a1234567890",
//     passwrd : "jamal2612001",
//     img : "../images/admin-logo.jpg",
//     rules : "full stack Developer",
//     email: "hello",
//     PhoneNumber : 1,
//     section : "hello",
//     userStatus : "active"
//   }

submitBt.onclick = () => {
  // the first object it's for get data from form
  let FormObj = new FormData(formData);
  // the second object has been created by us for send and get data
  let JsonObject = new FileData();

  // to put keys and values of form in objectData
  FormObj.forEach((Value, Keys) => {
    objectData[Keys] = Value;
  });

  console.log(objectData);
  // send data by our object
  JsonObject.send_data("../php/insert.php", objectData);
  
  
};

/*upload img and preview in html*/

function handleFileInputChange() {
  const input = document.getElementById("image-input");
  const preview = document.getElementById("image-preview");

  const file = input.files[0];

  if (file) {
    const reader = new FileReader();
    if(file.size > 100000){
      alert("Fotograf boyut yuksek");
  }
    reader.onload = function (e) {
      preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
document
  .getElementById("image-input")
  .addEventListener("change", handleFileInputChange);
