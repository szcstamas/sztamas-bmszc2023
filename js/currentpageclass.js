//az éppen aktuális oldal url-jének kimentése egy változóba
let currentUrl = window.location;
//az url-ben található utolsó tag kiszedése
let lastElementOfUrl = currentUrl.href.substring(currentUrl.href.lastIndexOf('/') + 1);
//a headerben található linkek kiszedése változóba
const headerLinks = document.querySelectorAll(".header-row-link");

//a linkek bejárása
headerLinks.forEach((link) => {
    const linkRef = link.getAttribute("href");

    //ha a link utolsó tagja tartalmazza a headerben található link hivatkozását, akkor az aktuális linknek adjon egy 'active-header-link' osztályt
    if (lastElementOfUrl.includes(linkRef)) {

        link.classList.add("active-header-link");
    }
})

