const menuButton = document.getElementById("menu-button");
const navLinks = document.getElementById("nav-links");
const closeMenu = document.getElementById("close-menu");

menuButton.addEventListener("click", () => {
    navLinks.classList.remove("-translate-x-full");
    navLinks.classList.add("translate-x-0");
});

closeMenu.addEventListener("click", () => {
    navLinks.classList.remove("translate-x-0");
    navLinks.classList.add("-translate-x-full");
});

// BTC anlık değişim
function fetchBtcPrice(){
    fetch('/api/crypto')
        .then(response => response.json())
        .then(data => {
            if(!Array.isArray(data)) return;

            const bitcoin = data.find(coin => coin.id === 'bitcoin');
            const ethereum = data.find(coin => coin.id === 'ethereum');

            const btcEl = document.getElementById('price-btc');
            const ethEl = document.getElementById('price-eth');

            if(bitcoin && btcEl) btcEl.innerText = '$' + bitcoin.current_price.toLocaleString();
            if(ethereum && ethEl) ethEl.innerText = '$' + ethereum.current_price.toLocaleString();
        });
}

fetchBtcPrice();
setInterval(fetchBtcPrice, 30000);

function fetchGoldPrice(){
    fetch('/api/gold')
        .then(response => response.json())
        .then(data => {
            document.getElementById('price-gold-gram-try').innerText = '₺' + data.gram_try;
        });
}

fetchGoldPrice();
setInterval(fetchGoldPrice, 30000);


