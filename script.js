let cart = [];

function toggleMerch() {
  const merch = document.getElementById('merch-section');
  merch.classList.toggle('active');
}

function addToCart(productName, price) {
  const item = cart.find(i => i.name === productName);
  if (item) {
    item.quantity += 1;
  } else {
    cart.push({ name: productName, price, quantity: 1 });
  }
  updateCart();
}

function updateCart() {
  const cartItems = document.getElementById('cart-items');
  const totalSpan = document.getElementById('total');
  cartItems.innerHTML = '';
  let total = 0;

  cart.forEach((item, index) => {
    total += item.price * item.quantity;

    const div = document.createElement('div');
    div.innerHTML = `
      <p><strong>${item.name}</strong></p>
      <p>Ціна: ₴${item.price}</p>
      <p>
        Кількість:
        <button onclick="changeQuantity(${index}, -1)">-</button>
        ${item.quantity}
        <button onclick="changeQuantity(${index}, 1)">+</button>
      </p>
      <button onclick="removeFromCart(${index})">Видалити</button>
      <hr>
    `;
    cartItems.appendChild(div);
  });

  totalSpan.textContent = total;
}

function changeQuantity(index, delta) {
  cart[index].quantity += delta;
  if (cart[index].quantity <= 0) {
    cart.splice(index, 1);
  }
  updateCart();
}

function removeFromCart(index) {
  cart.splice(index, 1);
  updateCart();
}

function openCart() {
  updateCart();
  document.getElementById('cart-modal').classList.remove('hidden');
}

function closeCart() {
  document.getElementById('cart-modal').classList.add('hidden');
}
