const scrollLeftButtons = document.querySelectorAll('[leftbtn]');
const scrollRightButtons = document.querySelectorAll('[rightbtn]');


scrollLeftButtons.forEach((btn)=>{
    btn.addEventListener('click', (target)=>{
        target.preventDefault();
        let optionsToBoxes = btn.getAttribute("leftbtn");
        let parent = document.querySelector(`[carsole='${optionsToBoxes}']`);
        let carsole = parent.querySelector('.longcarsole');
        carsole.scrollLeft -= 200;
    })
})
scrollRightButtons.forEach((btn)=>{
    btn.addEventListener('click', (target)=>{
        target.preventDefault();
        let optionsToBoxes = btn.getAttribute("rightbtn");
        let parent = document.querySelector(`[carsole='${optionsToBoxes}']`);
        let carsole = parent.querySelector('.longcarsole');
        carsole.scrollLeft += 200;
    })
})