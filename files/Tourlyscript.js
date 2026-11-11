const images = document.querySelectorAll(".albumImg-container img");
const getStarted = document.getElementById("getStarted");

window.addEventListener("load", function() {
    images.forEach(function(image,index){ //För varje bild. Går igenom en i taget o ger olika positioner

        const randomX = Math.random()* 80 + 10;
        const randomY = Math.random()* 65 + 15;
        const rotation = Math.random()* 50 - 25;
        const scale = Math.random()* 0.4 + 0.8;
        image.style.left = randomX + "%";
        image.style.top = randomY + "%";

        image.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(${scale})`;
        image.style.transitionDelay = (index * 0.12) + "s";

        setTimeout(function() { //Startar
            image.classList.add("scattered");
        }, 100);
    });

    const animationDuriation = 2000;
    const staggerDelay = 120;

    const totalAnimationTime = animationDuriation +
    (images.length -1) * staggerDelay;

    setTimeout(function(){
      getStarted.classList.add("visible");
        }, totalAnimationTime);
});

