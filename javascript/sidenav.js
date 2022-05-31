function openNav() {
  const badge = document.querySelector("#badge");
  const total = document.querySelector("#total");
  const itemslist = document.querySelector(".cartItems");
  itemslist.innerHTML = '';
  var total_val = 0;
  const keys = Object.keys(window.sessionStorage);
  badge.textContent = keys.length;
  for (const key of keys) {
    const dish = JSON.parse(key);
    const ammount = window.sessionStorage.getItem(key);
    total_val += parseInt(dish.price) * parseInt(ammount);
    assembleCartItem(dish, ammount);
  }
  total.textContent = "$" + total_val + ",00";
  document.getElementById("mySidenav").style.width = "350px";
  if (total_val == 0) {
    document.querySelector(".checkout-button").style.display = "none"
  }
  else {
    document.querySelector(".checkout-button").style.display = ""
  }
}

function assembleCartItem(dish, ammount) {
  const itemslist = document.querySelector(".cartItems");
  const itemBox = document.createElement('li');
  const img = document.createElement('img');
  const name = document.createElement('span');
  const price = document.createElement('span');
  const quantity = document.createElement('span');
  const deleteitem = document.createElement('i');

  name.className = "item-name";
  price.className = "item-price";
  quantity.className = "item-quantity";

  img.src = 'https://picsum.photos/200/200?business'

  name.textContent = capitalizeFirstLetter(dish.name);
  price.textContent = "$" + dish.price + ",00";
  quantity.textContent = "X " + ammount;

  quantity.id = dish.name;

  deleteitem.className = "fa fa-trash trash-icon";
  deleteitem.onclick = function () {
    deleteitem.parentNode.parentNode.removeChild(itemBox);
    removeFromCart(dish);
    openNav();
  }

  itemBox.appendChild(img);
  itemBox.appendChild(name);
  itemBox.appendChild(price);
  itemBox.appendChild(quantity);
  itemBox.appendChild(deleteitem);
  itemslist.appendChild(itemBox);
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function addToCart(dish) { //dish is a json encoded dish with id, price, ...
  const keys = Object.keys(window.sessionStorage);
  if (keys.length == 0 || JSON.parse(keys[0]).idRestaurant == dish.idRestaurant) {
    const key = JSON.stringify(dish)
    if (window.sessionStorage.getItem(key) == null) {
      window.sessionStorage.setItem(key, "1");
      assembleCartItem(dish, 1)
    }
    else {
      window.sessionStorage.setItem(key, parseInt(window.sessionStorage.getItem(key)) + 1)
      const ammount = document.querySelector('#' + dish.name);
      if (ammount)
        ammount.textContent = "X " + window.sessionStorage.getItem(key);
    }
    openNav();
  }
  else {
    alert("You can only chose 1 restaurant per order!"); //TODO: fazer isso ser mais bonito
  }
}

function removeFromCart(dish) {
  const key = JSON.stringify(dish);
  if (window.sessionStorage.getItem(key) == "1") {
    window.sessionStorage.removeItem(key);
  }
  else {
    window.sessionStorage.setItem(key, parseInt(window.sessionStorage.getItem(key)) - 1);
  }
}


function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function clearSession() {
  window.sessionStorage.clear();
}

async function checkout(){
  const keys = Object.keys(window.sessionStorage);
  var rawBody = {}
  for(var i = 0; i<keys.length; i++){
    var prevDish = JSON.parse(keys[i]);
    prevDish["quantity"] = window.sessionStorage.getItem(keys[i]);
    rawBody[i] = prevDish;
  }
  // console.log(rawBody);
  const response = await fetch('../actions/action_checkout.php', {
    method: "POST",
    headers: {"Content-type": "application/x-www-form-urlencoded; charset=UTF-8"},
    body: JSON.stringify(rawBody),
});
  const responseText = await response.text();
  console.log(responseText); // logs 'OK'

}