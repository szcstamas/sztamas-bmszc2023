//checkout validálása (ha rossz billentyű érkezik, nem engedi)
let prevVal = "";
document.querySelector('.checkout-name').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});
document.querySelector('.bill-postal').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});
document.querySelector('.bill-city').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});
document.querySelector('.del-postal').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});
document.querySelector('.del-city').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});
document.querySelector('.card-number').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});
document.querySelector('.card-name').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});
document.querySelector('.cvv-checkout').addEventListener('input', function (e) {
    if (this.checkValidity()) {
        prevVal = this.value;
    } else {
        this.value = prevVal;
    }
});