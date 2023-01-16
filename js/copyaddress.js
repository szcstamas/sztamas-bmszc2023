//a checkoutban található 'copydelivery' checkbox elmentése egy változóba
const copydelivery = document.getElementById('copydelivery');
//a 'szállítási cím megegyezik a számlázási címmel' funkció megírása
function billingFunction() {
    //ha be van jelölve a checkbox
    if (copydelivery.checked) {
        //szállítási címek kiszedése egy-egy változóba
        let deliveryPostalcode = document.getElementById('deliveryPostalcode').value;
        let deliveryCity = document.getElementById('deliveryCity').value;
        let deliveryStreet = document.getElementById('deliveryStreet').value;

        //ezeket egyenlővé tesszük a számlázási cím inputok értékével
        document.getElementById('billPostcode').value = deliveryPostalcode;
        document.getElementById('billCity').value = deliveryCity;
        document.getElementById('billStreet').value = deliveryStreet;
    }
    //ha a checkbox nincs bejelölve (pl. meggondolja magát a user, akkor kiveszi az értékeket)
    else {
        document.getElementById('billPostcode').value = '';
        document.getElementById('billCity').value = '';
        document.getElementById('billStreet').value = '';
    }
}

//ha rákattintok a copydelivery checkboxra, akkor lefut a function
copydelivery.addEventListener("click", () => {
    billingFunction();
});