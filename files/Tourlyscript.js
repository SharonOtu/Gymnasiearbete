const images = document.querySelectorAll(".albumImg-container");
const getStarted = document.getElementById("getStarted");

window.addEventListener("load", function() {
    images.forEach(function(image,index){

        const randomX = Math.random()* 80 + 10;
        const randomY = Math.random()* 65 + 15;
        const rotation = Math.random()* 50 - 25;
        const scale = Math.random()* 0.4 + 0.8;
        image.style.left = randomX + "%";
        image.style.top = randomY + "%";

        image.style.transform = `rotate(${rotation}deg) scale(${scale})`;
        image.style.transitionDelay = (index * 0.12) + "s";

        setTimeout(function() {
            image.classList.add("scattered");
        }, 100);
    });
}