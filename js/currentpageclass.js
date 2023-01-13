let currentUrl = window.location;
let lastElementOfUrl = currentUrl.href.substring(currentUrl.href.lastIndexOf('/') + 1);
const headerLinks = document.querySelectorAll(".header-row-link");


headerLinks.forEach((link) => {

    if (link.getAttribute("href") === (lastElementOfUrl)) {

        link.classList.add("active-header-link");
    }
})