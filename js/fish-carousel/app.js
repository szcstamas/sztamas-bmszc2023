//VARIABLES
const prevButton = document.querySelector(".prev-button");
const fishBookBg = document.querySelector(".fishbook-bg");
const nextButton = document.querySelector(".next-button");
const circles = [...document.querySelectorAll(".circle")];
const imgMain = document.querySelector(".img-main");
const imgCont = document.querySelector(".img-container");
const imgHeader = document.querySelector(".img-article-h1");
const imgParagraph = document.querySelector(".img-article-p");
const imgLink = document.querySelector(".img-link");
const imgLinkFish = document.getElementById("img-link-fish");
const imgSubHead = document.querySelector(".img-subtext-h1");
const imgSub = document.querySelector(".img-subtext-p");
const imgMaxAge = document.querySelector(".img-subtext-maxage");
const imgMaxAgePar = document.querySelector(".img-subtext-maxage-p");
const languageButtons = document.querySelectorAll(".language");
const headerCont = document.querySelector(".header-container");
const header = document.getElementById("header");
const leiras = document.getElementById("leiras");
const chooseLang = document.querySelector(".chooselang");
const images = [
    "img/ponty.jpg",
    "img/amur.jpg",
    "img/csuka.jpg",
    "img/harcsa.jpg",
    "img/tokhal.jpg",
];
const imageSubText = [
    "110 cm (3.6 ft), 38 kg (83 lb)",
    "200 cm (6.6 ft), 45 kg (99 lb)",
    "150 cm (4.9 ft), 28.4 kg (63 lb)",
    "250 cm (8.2 ft), 100 (220 lb)",
    "720 cm (23 ft), 1500 kg (3463 lb)",
];
const hunImageHeaderText = [
    "Ponty",
    "Amur",
    "Csuka",
    "Harcsa",
    "Tokhal",
];
const hunImageParagraphText = [
    "A ponty (Cyprinus carpio) a sugarasúszójú csontos halak közé tartozó típusfaj, a pontyalakúak rendjének és a pontyfélék családjának névadója. Eredeti őshazája Ázsia, valamint Európa keleti fele.",
    "Az amur a csontos halak osztályába, a pontyalakúak rendjébe, a pontyfélék családjába tartozó Ctenopharyngodon nem egyetlen faja. Kína északi részén és Szibériában őshonos. Nevét az Amur folyóról kapta.",
    "A csuka a sugarasúszójú halak osztályának csukaalakúak rendjébe, ezen belül a csukafélék családjába tartozó faj. A Föld északi féltekéjének hideg és mérsékelt éghajlati övében minden kontinensen megtalálható.",
    "Az európai harcsa a sugarasúszójú halak osztályába, a harcsaalakúak rendjébe és a harcsafélék családjába tartozó faj. Európa édesvizeinek (a viza után) második legnagyobbra növő hala, a magyarországi halfauna „óriása”.",
    "A tokfélék vagy valódi tokfélék a sugarasúszójú halak osztályába tartozó tokalakúak rendjének névadó családja. Az egyik legrégebbi halfaj, hiszen a dinoszauruszokig, azaz, több mint 200 millió évvel ez előttre vezethető vissza kialakulásuk.",
];
const hunImageMaxAgePar = [
    "36-38 év",
    "9-11 év",
    "10-15 év",
    "38-40 év",
    "100-104 év",
];
const hunImageLinkFish = [
    "a pontyról",
    "az amurról",
    "a csukáról",
    "a harcsáról",
    "a tokhalról",
];
const hunImageLinkWiki = [

    "https://hu.wikipedia.org/wiki/Ponty",
    "https://hu.wikipedia.org/wiki/Amur_(hal)",
    "https://hu.wikipedia.org/wiki/Csuka",
    "https://hu.wikipedia.org/wiki/Eur%C3%B3pai_harcsa",
    "https://hu.wikipedia.org/wiki/Val%C3%B3di_tokf%C3%A9l%C3%A9k",
];
const engImageHeaderText = [
    "Carp",
    "Grass carp",
    "Pike",
    "Catfish",
    "Sturgeon",
];
const engImageParagraphText = [
    "Carp are various species of oily freshwater fish from the family Cyprinidae, a very large group of fish native to Europe and Asia. Carps are generally considered an invasive species in parts of Africa, Australia and most of the United States.",
    "The grass carp is a large, herbivorous, freshwater fish species of the family Cyprinidae native to eastern Asia, with an original range from northern Vietnam to the Amur River on the Siberia-China border.",
    "The northern pike is a species of carnivorous fish of the genus Esox. They are typical of brackish and fresh waters of the Northern Hemisphere (i.e. holarctic in distribution).",
    "Catfish are a diverse group of ray-finned fish. Named for their prominent barbels, which resemble a cat's whiskers, catfish range in size and behavior from the three largest species alive.",
    "Sturgeon is the common name for the 27 species of fish belonging to the family Acipenseridae. The earliest sturgeon fossils date to the Late Cretaceous, and are descended from other, earlier acipenseriform fish.",
];
const engImageMaxAgePar = [
    "36-38 years",
    "9-11 years",
    "10-15 years",
    "38-40 years",
    "100-104 years",
];
const engImageLinkFish = [
    "about carp",
    "about grass carp",
    "about pike",
    "about catfish",
    "about sturgeon",
];
const engImageLinkWiki = [

    "https://en.wikipedia.org/wiki/Carp",
    "https://en.wikipedia.org/wiki/Grass_carp",
    "https://en.wikipedia.org/wiki/Northern_pike",
    "https://en.wikipedia.org/wiki/Catfish",
    "https://en.wikipedia.org/wiki/Sturgeon",
];


//LET VARIABLES
let timer;
let current = circles.findIndex(circle => {
    circle.classList.contains('active');
});
let i = -1;
let hunClicked = false;
let engClicked = false;


//EVENTLISTENERS
prevButton.addEventListener("click", prevCircle);
nextButton.addEventListener("click", nextCircle);
circles.forEach((circle) => {

    //ha rákattintunk egy kép alatt lévő gombra (körre), akkor a kör indexével egyenlő indexű képet és tartalmat jelenítünk meg
    circle.addEventListener('click', () => {

        //a timeout szüneteltetése
        clearTimeout(timer);

        //hozzáadja az aktuális körhöz az 'active' osztályt
        const currentCircle = document.getElementsByClassName("active");
        let circleIndex = circles.indexOf((circle));

        current = circleIndex;
        i = circleIndex;

        //az előző körtől elveszi az active osztályt
        currentCircle[0].className = currentCircle[0].className.replace(" active", "");
        circle.className += " active";
        //beállítja a magyar oldalt
        hunOnCurrent();
        //beállítja az aktuális képnek megfelelő hátteret
        setFishBackground();

        //ha az engClicked változónak true az értéke, akkor angol tartalmat jelenít meg
        if (engClicked == true) {

            engOnCurrent();
        };
    });

});
//a linkre történő hover megszünteti a timeoutot ami a képek váltakozásáért felelős
imgLink.addEventListener("mouseover", () => {
    clearTimeout(timer);
});
//ha az egér már nincs a linken, a timeout folytatódik
imgLink.addEventListener("mouseout", () => {

    resumeChangeByTime();
});
//a képre történő hover megszünteti a timeoutot ami a képek váltakozásáért felelős
imgCont.addEventListener("mouseover", () => {
    clearTimeout(timer);
});
//ha az egér már nincs a képen, a timeout folytatódik
imgCont.addEventListener("mouseout", () => {

    resumeChangeByTime();
});
//nyelvi gombok bejárása
languageButtons.forEach((button) => {

    //a kattintás után a következő történik: a gomb megkapja a .language-active class-t, illetve ha a gomb osztályában megtalálható a 'hungarian' kifejezés, akkor átváltja az adott html elemek contentjét magyar nyelvű elemekre (illetve elveszi a másik gombtól a language-active class-t). Az 'english' osztállyal rendelkező gombra kattintáskor ugyanez történik meg, csak angol nyelvű contentet kap a rész
    button.addEventListener("click", () => {

        const current = document.getElementsByClassName("language-active");

        if (button.classList.contains('hungarian')) {

            current[0].className = current[0].className.replace(" language-active", "");
            button.className += " language-active";

            engClicked = false;
            hunClicked = true;
            leiras.textContent = "Vidd az egeret a hal fölé";
            imgSubHead.innerHTML = "Maximális méret";
            imgMaxAge.textContent = "Maximális életkor";
            hunIsClicked();
        }

        if (button.classList.contains('english')) {

            current[0].className = current[0].className.replace(" language-active", "");
            button.className += " language-active";

            hunClicked = false;
            engClicked = true;
            leiras.textContent = "Hover on images to get more info!";
            imgSubHead.innerHTML = "Maximum size";
            imgMaxAge.textContent = "Maximum age";

            engIsClicked();
        }
    });
})

//FUNCTIONS
//ha egy gombra kattintunk a hal képe alatt, akkor az éppen aktuális gomb megkapja az 'active' osztályt
function moveCircle() {

    circles.forEach((circle, index) => {

        circle.classList.toggle('active', index === current);
    })
}

//a 'következő' gombra kattinva a soron következő gomb kapja meg az 'active' osztályt, illetve a hal képe is megváltozik
function nextCircle() {

    //a képeket váltakoztató timeout megszüntetése
    clearTimeout(timer);

    //a kép alatti gömb léptetése
    current += 1;
    moveCircle()

    //a kép léptetése
    i += 1;
    changeImgText();

    //ha a végére ért a léptetésnek, akkor kezdje előlről (gömb)
    if (current > circles.length - 1) {

        current = 0;
        moveCircle()
    }

    //ha a végére ért a léptetésnek, akkor kezdje előlről (kép)
    if (i > images.length - 1) {

        i = 0;
        changeImgText();
    }
}

//az 'előző' gombra kattinva az előző gomb kapja meg az 'active' osztályt, illetve a hal képe is megváltozik
function prevCircle() {

    clearTimeout(timer);

    current += -1;
    moveCircle()

    i += -1;
    changeImgText();

    //ha az elejére ért a léptetésnek, akkor folytassa hátulról (gömb)
    if (current < 0) {

        current = circles.length - 1;
        moveCircle()
    }

    //ha az elejére ért a léptetésnek, akkor folytassa hátulról (kép)
    if (i < 0) {

        i = images.length - 1;
        changeImgText();
    }
}

//minden léptetés után kezdődjön újra a timeout (ez indul el alapértelmezetten az oldal betöltésekor)
function changeByTime() {

    current += 1;
    moveCircle();

    i += 1;
    changeImgText();


    if (current > circles.length - 1) {

        current = 0;
        moveCircle()
    }

    if (i > images.length - 1) {

        i = 0;
        changeImgText();
    }

    timer = setTimeout("changeByTime()", 2000);
};

//képek léptetése
function changeImgText() {

    imgMain.src = images[i];

    //ez a funkció váltja át az angol tartalmat magyar nyelvűre
    hunIsClicked();

    if (engClicked == true) {

        //ez a funkció váltja át a magyar tartalmat angol nyelvűre
        engIsClicked();
    }

    if (hunClicked == true) {

        hunIsClicked();
    }

    setFishBackground();

}

//ez a funkció az éppen soron következő hal szöveges tartalmát váltja át magyarra
function hunIsClicked() {

    imgHeader.textContent = hunImageHeaderText[i];
    imgParagraph.textContent = hunImageParagraphText[i];
    imgSub.textContent = imageSubText[i];
    imgMaxAgePar.textContent = hunImageMaxAgePar[i];
    imgLinkFish.textContent = hunImageLinkFish[i];
    imgLink.href = hunImageLinkWiki[i];
}

//ez a funkció az éppen soron következő hal szöveges tartalmát váltja át angolra
function engIsClicked() {

    imgHeader.textContent = engImageHeaderText[i];
    imgParagraph.textContent = engImageParagraphText[i];
    imgMaxAgePar.textContent = engImageMaxAgePar[i];
    imgLinkFish.textContent = engImageLinkFish[i];
    imgLink.href = engImageLinkWiki[i];
}

//ha nem sorban lépkedünk, hanem rákattintunk egy általunk választott gombra, akkor a gomb indexének megfelelő indexű képet és tartalmat jelenítjük meg (magyarul)
function hunOnCurrent() {

    imgMain.src = images[current];
    imgHeader.textContent = hunImageHeaderText[current];
    imgParagraph.textContent = hunImageParagraphText[current];
    imgSub.textContent = imageSubText[current];
    imgMaxAgePar.textContent = hunImageMaxAgePar[current];
    imgLinkFish.textContent = hunImageLinkFish[current];
    imgLink.href = hunImageLinkWiki[current];
}

//ha nem sorban lépkedünk, hanem rákattintunk egy általunk választott gombra, akkor a gomb indexének megfelelő indexű képet és tartalmat jelenítjük meg (angolul)
function engOnCurrent() {

    imgHeader.textContent = engImageHeaderText[current];
    imgParagraph.textContent = engImageParagraphText[current];
    imgMaxAgePar.textContent = engImageMaxAgePar[current];
    imgLinkFish.textContent = engImageLinkFish[current];
    imgLink.href = engImageLinkWiki[current];
}

//a kép mögött látható halvány háttérkép léptetése
function setFishBackground() {

    fishBookBg.style.background = `url(${images[i]})`;
    fishBookBg.style.backgroundRepeat = "no-repeat";
    fishBookBg.style.backgroundSize = "cover";
}

//ez az a funkció, ami folytatja a timeoutot ha elvesszük az egeret a linkről vagy a képről
function resumeChangeByTime() {

    current += -1;
    i += -1;
    changeByTime();
}

//az oldal betöltésekor elindul a képeket léptető timeout
window.onload = changeByTime();