let inputCount = document.querySelector('.input-count');
const inputButtons = document.querySelectorAll('.count-button');

let countItem = 1;

inputButtons.forEach((button) => {

    inputValue = Number(inputCount.value);

    button.addEventListener('click', () => {

        if (button.classList.contains('decrease')) {

            if (inputCount.value > 0) {

                inputValue--;
                inputCount.value = inputValue;
                inputCount.setAttribute("value", inputValue);
            } else {
                return;
            }

        } else {

            inputValue++;
            inputCount.value = inputValue;
            inputCount.setAttribute("value", inputValue);
        }
    })
})