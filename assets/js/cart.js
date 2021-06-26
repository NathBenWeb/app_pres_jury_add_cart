const itemPrice = document.getElementsByClassName('itemPrice');
const itemQt = document.getElementsByClassName('itemQt');
const itemTotal = document.getElementsByClassName('itemTotal');
let sum = 0;

$('.itemQt').each(function (i) {
    console.log(localStorage.getItem(`qt${i}`));
    if (localStorage.getItem(`qt${i}`) <= 1) {
        localStorage.setItem(`qt${i}`, 1);
        $(this).val(localStorage.getItem(`qt${i}`));
    } else {
        $(this).val(localStorage.getItem(`qt${i}`));
    }
    $(this).on('change', function () {
        getPrices();
    });
});

getPrices();
function getPrices() {
    sum = 0;
    for (let i = 0; i < itemPrice.length; i++) {
        localStorage.setItem(`qt${i}`, itemQt[i].value);
        itemTotal[i].innerText = (itemPrice[i].value * localStorage.getItem(`qt${i}`)).toFixed(2);
        sum += itemPrice[i].value * localStorage.getItem(`qt${i}`);
    };
    $('#totalMenu').text(sum.toFixed(2));
   
}

console.log(itemPrice.length);