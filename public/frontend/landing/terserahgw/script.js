var love_uwu = document.getElementsByClassName("love-uwu");
for (var i = 0; i < love_uwu.length; i++) {
    love_uwu[i].addEventListener("click", function () {
        this.classList.toggle("bi-heart-fill");
        this.classList.toggle("bi-heart");
    });
}

// set currency

var button_currency = document.getElementById('change-currency');
// var button_currency = document.getElementsByClassName('change-currency-inc');
var current_currency = localStorage.getItem('current_currency');
var usd = document.getElementsByClassName('currency-usd');
var idr = document.getElementsByClassName('currency-idr');

if (current_currency == null) {
    localStorage.setItem('current_currency', 'USD');
}

if (button_currency) {
    button_currency.addEventListener('click', function () {
        if (localStorage.getItem('current_currency') == 'USD') {
            button_currency.innerHTML = "IDR";
            localStorage.setItem('current_currency', 'IDR');
            siiimpleToast.message('<i class="bi bi-wallet2"></i> Change currency to idr.', {
                position: "bottom|left",
                margin: 12,
                delay: 0,
                duration: 1000,
            });
            show_idr()
        } else {
            button_currency.innerHTML = "USD";
            localStorage.setItem('current_currency', 'USD');
            siiimpleToast.message('<i class="bi bi-wallet2"></i> Change currency to usd.', {
                position: "bottom|left",
                margin: 12,
                delay: 0,
                duration: 1000,
            });
            show_usd()
        }
    });
}

window.onload = function () {
    var current_set_forex = localStorage.getItem('current_currency');

    if (current_set_forex == 'USD') {
        show_usd()
        if (button_currency) {
            button_currency.innerHTML = "USD";
        }
    } else if (current_set_forex == 'IDR') {
        show_idr()
        if (button_currency) {
            button_currency.innerHTML = "IDR";
        }
    }
};


function show_usd() {
    for (let i = 0; i < usd.length; i++) {
        idr[i].style.display = "none";
        usd[i].style.display = "block";
    }
}

function show_idr() {
    for (let i = 0; i < usd.length; i++) {
        usd[i].style.display = "none";
        idr[i].style.display = "block";
    }
}

console.log("%cNGAPAIN DEK", "color: red; font-size: 50px; font-weight: bold;");
console.log("%cBy Ilysaa", "color: blue; font-size: 30px; font-weight: bold;");
console.log("%cgithub https://github.com/ilsyaa", "color: blue; font-size: 30px; font-weight: bold;");
document.addEventListener("keydown", function (event) {
    if (event.ctrlKey && event.keyCode == 75) {
        document.getElementById("button-search").click();
        event.preventDefault();
    }
});

var options = {
    classname: 'nanobar'
};
var nanobar = new Nanobar(options);
window.addEventListener('beforeunload', function () {
    nanobar.go(30);
});
nanobar.go(60);
window.addEventListener('load', function () {
    nanobar.go(70);
    nanobar.go(100);
});
