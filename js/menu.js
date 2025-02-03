function menu(){
    return `
    <div  class="menu" id="menu">
    <ul>
        
    <li class="profile">
        <div class="img-profile">
            <img src="../images/admin-logo.jpg" alt="admin-profile">
        </div>
        <h2>Admin</h2>
    </li> 

    <li>
       <a class="active" href="dashboard.html">
          <i class="fa-solid fa-house" data-content="Dashboard"></i>
          
       </a>
    </li>
    <li>
        <a href="addprs.html">

        <i class="fa-solid fa-plus" data-content="Ekle"></i>
        </a>
     </li>
     <li>
     <a href="update.html">

     <i  class="fa-regular fa-pen-to-square" data-content="Düzelt"></i>
     </a>
  </li>

     <li class="log-out">
        <a href="/html/login.html">
           <i  class="fas fa-sign-out"></i>
           <p>çıkış</p>
        </a>
     </li>
</ul>
</div>
    `;}
    export default menu;