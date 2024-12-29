let cart = {}; // Menyimpan status item yang dipesan

// Definisikan fungsi selectCategory di luar event listener
function selectCategory(categoryId) {
    const tabContents = document.querySelectorAll('.tab_content');
    tabContents.forEach(tabContent => {
        tabContent.classList.remove('active');
    });

    const activeTab = document.querySelector(`.tab_content[data-tab="${categoryId}"]`);
    if (activeTab) {
        activeTab.classList.add('active');
    }
    updateCart();
}

document.addEventListener('DOMContentLoaded', function() {
    const categoryTabs = document.querySelectorAll('.tabs li');
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-tab');
            selectCategory(categoryId);
        });
    });

    const defaultCategory = document.querySelector('.tabs .active').getAttribute('data-tab');
    selectCategory(defaultCategory);
});

function handleOrder(button) {
    const menuName = button.getAttribute('data-name');
    const pricePerItem = parseFloat(button.getAttribute('data-price'));
    const menuStock = parseInt(button.getAttribute('data-stock'));

    if (menuStock === 0) {
        alert('Menu ini tidak tersedia, stok habis.');
        return;
    }

    if (cart[menuName]) {
        if (cart[menuName].count < menuStock) {
            cart[menuName].count++;
        } else {
            alert('Stok menu ini tidak cukup.');
            return;
        }
    } else {
        cart[menuName] = {
            count: 1,
            price: pricePerItem,
            stock: menuStock
        };
    }

    updateCart();
    createOrderControls(button, menuName);
}

function increaseItem(menuName) {
    if (cart[menuName] && cart[menuName].count < cart[menuName].stock) {
        cart[menuName].count++;
    } else {
        alert('Stok menu ini tidak cukup.');
    }
    updateCart();
}

function decreaseItem(menuName) {
    if (cart[menuName].count > 1) {
        cart[menuName].count--;
    } else {
        delete cart[menuName];
        resetOrderButton(menuName);
    }
    updateCart();
}

function updateCart() {
    const cartItemCount = document.querySelector('.cart-item-count');
    const priceAmount = document.querySelector('.price-amount');
    let totalCount = 0;
    let totalPrice = 0;

    for (let menu in cart) {
        totalCount += cart[menu].count;
        totalPrice += cart[menu].count * cart[menu].price;

        const itemCountDisplay = document.getElementById(`itemCountDisplay-${menu}`);
        if (itemCountDisplay) {
            itemCountDisplay.textContent = cart[menu].count;
        }
    }

    cartItemCount.textContent = `${totalCount} item`;
    priceAmount.textContent = formatRupiah(totalPrice);
}

function resetOrderButton(menuName) {
    const orderControls = document.getElementById(`orderControls-${menuName}`);
    const orderButton = document.createElement('button');
    orderButton.className = "btn orderButton";
    orderButton.setAttribute('data-name', menuName);
    orderButton.setAttribute('data-price', orderControls.getAttribute('data-price'));
    orderButton.setAttribute('data-stock', orderControls.getAttribute('data-stock'));
    orderButton.setAttribute('onclick', 'handleOrder(this)');
    orderButton.textContent = "Pesan";
    orderControls.parentNode.replaceChild(orderButton, orderControls);
}

function createOrderControls(button, menuName) {
    const orderControls = document.createElement('div');
    orderControls.id = `orderControls-${menuName}`;
    orderControls.className = "orderControls"; // Tambahkan kelas CSS untuk gaya
    orderControls.setAttribute('data-name', button.getAttribute('data-name'));
    orderControls.setAttribute('data-price', button.getAttribute('data-price'));
    orderControls.setAttribute('data-stock', button.getAttribute('data-stock'));
    orderControls.innerHTML = `
        <button class="btn btnindec" onclick="decreaseItem('${menuName}')">-</button>
        <span id="itemCountDisplay-${menuName}">${cart[menuName].count}</span>
        <button class="btn btnindec" onclick="increaseItem('${menuName}')">+</button>
    `;
    button.parentNode.replaceChild(orderControls, button);
}




function openCartModal() {
    const modal = document.getElementById("cartModal");
    let modalCartDetails = document.getElementById('modalCartDetails');
    modalCartDetails.innerHTML = ''; // Reset isi modal
    let totalAmount = 0;

    for (let menu in cart) {
        let row = `
            <tr>
                <td>${menu}</td>
                <td>${cart[menu].count}</td>
                <td>${formatRupiah(cart[menu].count * cart[menu].price)}</td>
            </tr>
        `;
        modalCartDetails.insertAdjacentHTML('beforeend', row);
        totalAmount += cart[menu].count * cart[menu].price;
    }

    document.getElementById('totalAmount').textContent = 'Total: ' + formatRupiah(totalAmount);
    modal.style.display = "block";
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("cartModal");
    const span = document.getElementsByClassName("close")[0];

    // Fungsi untuk menyembunyikan modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Tutup modal jika klik di luar modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

// Fungsi formatRupiah harus sudah didefinisikan sebelumnya
function formatRupiah(angka) {
    let number_string = angka.toString().replace(/[^,\d]/g, '');
    let split = number_string.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return 'Rp ' + (split[1] ? rupiah + ',' + split[1] : rupiah);
}




