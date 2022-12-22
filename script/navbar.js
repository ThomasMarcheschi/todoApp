let menuButton = document.getElementById('menu-button')
let menu = document.getElementById('menu')

menuButton.addEventListener('click',()=>{
    if(menu.style.left === '0px'){
        menuButton.className = 'bi bi-list'
        menu.style.left = '-100%'
    }else{
        menuButton.className = 'bi bi-x-lg'
        menu.style.left= '0px'
    }

})
