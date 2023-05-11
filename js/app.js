let offeredText = document.getElementById("offered-courses-text");

window.addEventListener("scroll", function () {
    let value = window.scrollY;

    if (value >= 545) {
        offeredText.style.letterSpacing = "21.8 px";
    } else {
        offeredText.style.letterSpacing = value / 25 + "px";
    }
});
