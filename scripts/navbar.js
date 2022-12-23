console.dir(document);

//selectionner un element:
let menuButton = document.querySelector("#menu-button");

//Ajouter un gestionnaire d'evenement a un element
menuButton.addEventListener("click", function(){
  let menu = document.querySelector('nav > ul');
  console.dir(menu);
  
  if(menu.style.left === "0px"){
   
    menuButton.className = 'bi bi-list'
    menu.style.left = "-100%";
  }else{
    menuButton.className = 'bi bi-x-lg'
    menu.style.left = "0px";

  }

});