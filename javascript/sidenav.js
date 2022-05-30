function openNav() {
    const itemsdiv = document.querySelector(".cartItems");
    itemsdiv.innerHTML = '';
    const keys = Object.keys(window.sessionStorage);
    for(const key of keys){
        const dish = JSON.parse(key);
        const ammount = window.sessionStorage.getItem(key);
        const article = document.createElement('article')
        const name = document.createElement('p');
        const ammountText = document.createElement('p');
        name.textContent = dish.name;
        ammountText.textContent = ammount;
        article.appendChild(name);
        article.appendChild(ammountText);
        itemsdiv.appendChild(article);
    }


    document.getElementById("mySidenav").style.width = "350px";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  function addToCart(dish){ //dish is a json encoded dish with id, price, ...
    const key = JSON.stringify(dish)
    if(window.sessionStorage.getItem(key) == null){
        window.sessionStorage.setItem(key, "1");
    }
    else{
        window.sessionStorage.setItem(key, parseInt(window.sessionStorage.getItem(key))+1)
    }
    openNav();
  }

  function clearSession(){
      window.sessionStorage.clear();
  }