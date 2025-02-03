import FileData from "./FileData.js";



let tableDta = document.querySelector("table");
let file = new FileData();



const handleReq = (data) => {
  tableDta.innerHTML += data.map((info, InfoINdex) => {
    return `
    <tr>
    <td>${InfoINdex + 1}</td>
    <td>${info.F_name} ${info.L_name}</td>
    <td>${info.email}</td>
    <td>${info.rules}</td>
    <td>${info.section}</td>
    <td>${info.userStatus}</td>
    <td><button class="btn" id="delete">Sil</button></td>
</tr>
    `;
  });

   


  let btn = document.querySelectorAll(".btn");

  btn.forEach((x , y) => {
    x.addEventListener("click", (e) => {
      // this line to get row
      let Row = e.target.parentElement.parentElement,
          userName = data[y].userName;

          file.send_data('../php/delete.php' , {userName});

          file.getData('../DeleteMsg.json' , (x) => alert(JSON.parse(x).message))

          Row.style.display = "none";
          
    });
  });
};


file.getData("../employesData.json", handleReq);