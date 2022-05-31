function openNav() {
    const badge = document.querySelector("#badge");
    const total = document.querySelector("#total");
    const itemslist = document.querySelector(".cartItems");
    itemslist.innerHTML = '';
    var total_val = 0;
    const keys = Object.keys(window.sessionStorage);
    badge.textContent = keys.length;
    for(const key of keys){
        const dish = JSON.parse(key); 
        const ammount = window.sessionStorage.getItem(key);
        total_val += parseInt(dish.price) * parseInt(ammount);
        assembleCartItem(dish, ammount);
    }
    total.textContent = "$" +total_val+",00";
    document.getElementById("mySidenav").style.width = "350px";
  }
  
  function assembleCartItem(dish, ammount){
    const itemslist = document.querySelector(".cartItems");
    const itemBox = document.createElement('li');
    const img = document.createElement('img');
    const name = document.createElement('span');
    const price = document.createElement('span');
    const quantity = document.createElement('span');
    name.className = "item-name";
    price.className = "item-price";
    quantity.className = "item-quantity";
    img.src = 'https://picsum.photos/200/200?business'
    name.textContent = capitalizeFirstLetter(dish.name);
    price.textContent = "$" + dish.price + ",00";
    quantity.textContent = "X " + ammount;
    quantity.id = dish.name;
    itemBox.appendChild(img);
    itemBox.appendChild(name);
    itemBox.appendChild(price);
    itemBox.appendChild(quantity);
    itemslist.appendChild(itemBox);
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  function addToCart(dish){ //dish is a json encoded dish with id, price, ...
    const key = JSON.stringify(dish)
    if(window.sessionStorage.getItem(key) == null){
        window.sessionStorage.setItem(key, "1");
        assembleCartItem(dish, 1)
    }
    else{
        window.sessionStorage.setItem(key, parseInt(window.sessionStorage.getItem(key))+1)
        const ammount = document.querySelector('#' + dish.name);
        ammount.textContent = "X " + window.sessionStorage.getItem(key);
    }
    // const keys = Object.keys(window.sessionStorage);
    // for(const key of keys){
    //   const dish = JSON.parse(key); 
    //   assembleCartItem(dish, window.sessionStorage.getItem(key))
    // }
    openNav();
  }





  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  function clearSession(){
      window.sessionStorage.clear();
  }