const copydelivery = document.getElementById('copydelivery');

function billingFunction() {
    if (copydelivery.checked) {
        let deliveryPostalcode = document.getElementById('deliveryPostalcode').value;
        let deliveryCity = document.getElementById('deliveryCity').value;
        let deliveryStreet = document.getElementById('deliveryStreet').value;

        document.getElementById('billPostcode').value = deliveryPostalcode;
        document.getElementById('billCity').value = deliveryCity;
        document.getElementById('billStreet').value = deliveryStreet;
    } else {
        document.getElementById('billPostcode').value = '';
        document.getElementById('billCity').value = '';
        document.getElementById('billStreet').value = '';
    }
}

copydelivery.addEventListener("click", () => {
    billingFunction();
});