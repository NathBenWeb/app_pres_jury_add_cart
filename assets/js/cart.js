$(function(){
    const priceItem = document.getElementsByClassName('priceItem');
    const qtItem = document.getElementsByClassName('qteItem');
    const totalItem = document.getElementsByClassName('totalItem');
    let id = 0;
    let sum = 0;

    function getPrice() {
        sum = 0;
        for (let i = 0; i < priceItem.length; i++) {
            id = priceItem[i].parentElement.parentElement.children[7].value;
            // console.log(priceItem[i].parentElement.parentElement.children[7]);
            localStorage.setItem(`q${id}`, qtItem[i].value);
            totalItem[i].innerHTML = (priceItem[i].value * localStorage.getItem(`q${id}`)).toFixed(2);
            sum += priceItem[i].value * localStorage.getItem(`q${id}`);
            // console.log(qtItem[i]);
        };
        $('#totalMeals').val(sum.toFixed(2));
    }
    
    $('.qteItem').each(function (i,v) {
        id = $(this).closest('tr').children('#idMeal').val();
        if (localStorage.getItem(`q${id}`) <= 1) {
            localStorage.setItem(`q${id}`, 1);
            $(this).val(localStorage.getItem(`q${id}`));
        } else {
            $(this).val(localStorage.getItem(`q${id}`));
        }
        $(this).on('change', function () {
            getPrice();
        });
    });

    getPrice();

    
});

