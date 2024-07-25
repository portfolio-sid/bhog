const menu = [{
        id: 1,
        title: "Pav Bhaji",
        category: "Appetizer",
        price: 100,
        img: "images/1.jpg",
        desc: `Mashed vegetable curry, served with buttery bread and chopped onions and lime!`,
    }, 
    {
        id: 2,
        title: "Bhel Puri",
        category: "Appetizer",
        price: 130,
        img: "images/2.jpg",
        desc: `Bhel mix and puffed rice, combined with chickpeas and chopped potatoes, and homemade chutneys!`,
    },
    {
        id: 3,
        title: "Dahi Puri",
        category: "Appetizer",
        price: 120,
        img: "images/3.jpg",
        desc: `8 pc of crispy puri. Chickpeas / chopped potatoes tamarind mix. Yoghurt, tamarind and cilantro chutney!`,
    },
    {
        id: 4,
        title: "Papdi Chaat",
        category: "Appetizer",
        price: 150,
        img: "images/4.jpg",
        desc: `Papdi indulged with chickpeas / chopped potatoes tamarind mix, homemade tangy chutneys and savory garnishes!`,
    },
    {
        id: 5,
        title: "Butter Chicken",
        category: "Entree",
        price: 250,
        img: "images/5.jpg",
        desc: `Butter chicken is mouth-watering, tender chicken, cooked in a spiced tomato sauce.`,
    },
    {
        id: 6,
        title: "Rogan Josh",
        category: "Entree",
        price: 300,
        img: "images/6.jpg",
        desc: `Rogan Josh consists of braised lamb chunks cooked with gravy. Known for its brilliant red color, a classic rogan josh uses liberal amounts of dried Kashmiri chilies.`,
    },
    {
        id: 7,
        title: "Aloo Gobi",
        category: "Entree",
        price: 200,
        img: "images/7.jpg",
        desc: `Aloo Gobi is a dry, vegan Indian dish, made with potatoes, cauliflower, and Indian spices.`,
    },
    {
        id: 8,
        title: "Matar Paneer",
        category: "Entree",
        price: 250,
        img: "images/8.jpg",
        desc: `Matar paneer comes from regions of northern India. It’s made up of a yummy tomato sauce over paneer (farmer’s cheese) and peas, and spiced with garam masala.`,
    },
    {
        id: 9,
        title: "Masala Chai",
        category: "Drinks",
        price: 50,
        img: "images/9.jpg",
        desc: `There’s nothing like the experience of stopping at a chaiwala on an Indian street and ordering a steaming cup of masala chai.`,
    },
    {
        id: 10,
        title: "Lassi",
        category: "Drinks",
        price: 50,
        img: "images/10.jpg",
        desc: `Lassi’s are yogurt-based drinks made with water, spices, and sometimes fruit. Mango or cardamom-flavored lassis are some of the most popular.`,
    },
    {
        id: 11,
        title: "Gajar Ka Halwa",
        category: "Desserts",
        price: 200,
        img: "images/11.jpg",
        desc: `Carrot pudding is a North Indian dessert that’s popular during Diwali — a religious festival celebrating the triumph of good over evil.`,
    },
    {
        id: 12,
        title: "Kheer",
        category: "Desserts",
        price: 150,
        img: "images/12.jpg",
        desc: `Grab your spoons for this Indian pudding. Served warm or cold, creamy rice kheer is a staple in many Indian homes.`,
    },
    {
        id: 13,
        title: "Rasmalai",
        category: "Desserts",
        price: 80,
        img: "images/13.jpg",
        desc: `Rasmalai is a juicy and creamy dessert that’ll melt right in your mouth. Expect explosive flavors from sugar, saffron, cardamom, creamed milk, and nuts.`,
    },
    {
        id: 14,
        title: "Kulfi",
        category: "Desserts",
        price: 100,
        img: "images/14.jpg",
        desc: `This spiced, nutty custard is melt-in-your-mouth delicious. Kulfi is very similar to ice cream, but just a tad thicker and creamier.`,
    },
];

const sectionCenter = document.querySelector('.section-center');

const filterBtns = document.querySelectorAll('.filter-btn');

const cartItemContainer = document.querySelector(".cart-items");

window.addEventListener('DOMContentLoaded', function () {
    displayMenuItems(menu);
});


filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        const category = e.currentTarget.dataset.id;
        const menuCategory = menu.filter(function (menuItem) {
            if (menuItem.category == category)
                return menuItem;
        });
        if (category == "All")
            displayMenuItems(menu);
        else
            displayMenuItems(menuCategory);
    });
});





function displayMenuItems(menuItems) {
    let displayMenu = menuItems.map(function (item) {
        return `<article class="menu-item">
        <div class="about-item">
            <img src="${item.img}" class="photo" alt="${item.title}">

                    <h2 class="title">${item.title}</h2>
                    <p class="item-text">${item.desc}</p>
                    </div>
                    <h2 class="price">Rs. ${item.price}</h2>
                
                
           
            <button class="add-cart" onclick="addToCart(${item.id})">Add to cart</button>
            </article>`;
    });
    displayMenu = displayMenu.join("");
    sectionCenter.innerHTML = displayMenu;
}


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

    totalChanged();

    localStorage.setItem("CART", JSON.stringify(cart));
}


function quantityChanged(task, id) {
    cart = cart.map((item) => {
        q = item.quantity;
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
    

}

function removeCartItem(id) {
    cart = cart.filter((item) => item.id !== id);
    updateCart();
}