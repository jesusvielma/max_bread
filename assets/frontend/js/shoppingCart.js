// ***************************************************
// Shopping Cart functions

var shoppingCart = (function () {
    // Private methods and properties
    var cart = [];

    function Item(name, itemId, price, image, count) {
        this.name = name
        this.price = price
        this.count = count
        this.image = image
        this.itemId = itemId
    }

    function saveCart() {
        localStorage.setItem("maxbreadShoppinCart", JSON.stringify(cart));
    }

    function loadCart() {
        cart = JSON.parse(localStorage.getItem("maxbreadShoppinCart"));
        if (cart === null) {
            cart = []
        }
    }

    loadCart();



    // Public methods and properties
    var obj = {};

    obj.addItemToCart = function (name, itemId, price, image, count) {
        for (var i in cart) {
            if (cart[i].itemId === itemId) {
                cart[i].count += count;
                saveCart();
                return;
            }
        }

        //console.log("addItemToCart:", name, price, image, count);

        var item = new Item(name, itemId, price, image, count);
        cart.push(item);
        saveCart();
    };

    obj.setCountForItem = function (itemId, count) {
        for (var i in cart) {
            if (cart[i].itemId === itemId) {
                cart[i].count = count;
                break;
            }
        }
        saveCart();
    };


    obj.removeItemFromCart = function (itemId) { // Removes one item
        for (var i in cart) {
            if (cart[i].itemId === itemId) { // "3" === 3 false
                cart[i].count--; // cart[i].count --
                if (cart[i].count === 0) {
                    cart.splice(i, 1);
                }
                break;
            }
        }
        saveCart();
    };


    obj.removeItemFromCartAll = function (itemId) { // removes all item itemId
        for (var i in cart) {
            if (cart[i].itemId === itemId) {
                cart.splice(i, 1);
                break;
            }
        }
        saveCart();
    };


    obj.clearCart = function () {
        cart = [];
        saveCart();
    }


    obj.countCart = function () { // -> return total count
        var totalCount = 0;
        for (var i in cart) {
            totalCount += cart[i].count;
        }

        return totalCount;
    };

    obj.totalCart = function () { // -> return total cost
        var totalCost = 0;
        for (var i in cart) {
            totalCost += cart[i].price * cart[i].count;
        }
        return totalCost.toFixed(2);
    };

    obj.listCart = function () { // -> array of Items
        var cartCopy = [];
        // console.log("Listing cart");
        // console.log(cart);
        for (var i in cart) {
            // console.log(i);
            var item = cart[i];
            var itemCopy = {};
            for (var p in item) {
                itemCopy[p] = item[p];
            }
            itemCopy.total = (item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy);
        }
        return cartCopy;
    };

    // ----------------------------
    return obj;
})();
