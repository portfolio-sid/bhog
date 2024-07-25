

const cartItemContainer = document.querySelector(".cart-items");




let cart = JSON.parse(localStorage.getItem("CART")) || [];
updateCart();

function addToCart(id) {
if (cart.some((item) => item.id === id)) {
    quantityChanged("add", id);
} else {
    const item = menu.find((menu) => menu.id === id);
    cart.push({
        ...item, 
        quantity: 1,
    });
    updateCart();
}

}

function updateCart() {
renderCartItems();
totalChanged();

localStorage.setItem("CART", JSON.stringify(cart));
}

function renderCartItems() {

cartItemContainer.innerHTML = "";
cart.forEach( (item) => {



    cartItemContainer.innerHTML += ` <div class="cart-row">
                <div class="cart-item cart-column">
                                    <img class="cart-item-image" src="${item.img}" width="100" height="100">
                                    <span class="cart-item-title">${item.title}</span>
                                </div>
                                <span class="cart-price cart-column">${item.price}</span>
                                <div class="cart-quantity cart-column">
                                    <div class="btn add" onclick="quantityChanged('add',${item.id})">+</div>
                                    <div class="cart-quantity-input">${item.quantity}</div>
                                    <div class="btn sub" onclick="quantityChanged('sub',${item.id})">-</div>
                                    
                                    <button class="btn-danger cart-quantity-button" onclick="removeCartItem(${item.id})" type="button">REMOVE</button>
                                </div>
                                </div>`;


});

}

function quantityChanged(task, id) {
cart = cart.map((item) => {
    
    if (item.id === id) {

        if (task === "add")
            item.quantity = item.quantity + 1;
        else if (task == "sub" && item.quantity > 1)
            item.quantity = item.quantity - 1;
    }
    return item;

});
updateCart();
}

function totalChanged() {
let total = 0;

cart.forEach( (item) => {
    total += item.price * item.quantity;
})
document.getElementsByClassName('cart-total-price')[0].innerText = 'Rs. ' + total;
document.querySelector('.total').value= total;
}

function removeCartItem(id) {
cart = cart.filter((item) => item.id !== id);
updateCart();
}
