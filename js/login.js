import FileData from "./FileData.js";

let submitBt = document.getElementById("button"),
  formData = document.querySelector("form"),
  objectData = {};

let testReg = (pattern, value) => {
  if (!pattern) console.error("the pattern value is null");
  if (!value) console.error("the value is null" + value);

  return pattern.test(value);
};

submitBt.onclick = () => {
  // the first object it's for get data from form
  let FormObj = new FormData(formData);
  //  the second object has been created by us for send and get data
  let JsonObject = new FileData();

  // input format
  if (!testReg(/^[ea]{1}[0-9]{10}/, formData[0].value)) {
    alert("Hesapınız Bulunmadı.");
    return;
  }
  // to put keys and values of form in objectData
  FormObj.forEach((Value, Keys) => {
    objectData[Keys] = Value;
  });

  // send data by our object
  JsonObject.send_data("../php/login.php", objectData);

  // get data from json file
  if (objectData.userName[0] == "a") {
    JsonObject.getData("../Data.json", handleReq);
  }

  if (objectData.userName[0] == "e") {
    JsonObject.getData("../EmploData.json", handleReq);
  }
  return;
};

let handleReq = (data) => {
  let formObj = new FormData(formData);

  if (formObj.has("userName") && formObj.has("password")) {
    if (formObj.get("userName") == data.userName) {
      if (data.passwrd) {
        if (data.userName[0] == "a") {
          window.location.href = window.location.href.replace(
            `html/login.html`,
            `html/dashboard.html`
          );
        }

        if (data.userName[0] == "e") {
          window.location.href = window.location.href.replace(
            `html/login.html`,
            `html/personelSayfasi.html`
          );
        }
      }
    }
  }
};
