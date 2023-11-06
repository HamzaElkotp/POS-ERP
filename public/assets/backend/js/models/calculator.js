

const main_calculator = document.getElementById("calculator");

const btnCalculator = document.getElementById("btnCalculator")
if(btnCalculator){
    btnCalculator.addEventListener('click', ()=>{
        main_calculator.classList.toggle('notActive')
    })
}

let isDragging = false;
let offsetX, offsetY;
let maxX, maxY;

main_calculator.addEventListener('mousedown', (e) => {
    isDragging = true;
    offsetX = e.clientX - main_calculator.getBoundingClientRect().left;
    offsetY = e.clientY - main_calculator.getBoundingClientRect().top;

    // Calculate maximum bounds
    maxX = window.innerWidth - main_calculator.offsetWidth;
    maxY = window.innerHeight - main_calculator.offsetHeight;
});

document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;

    const x = e.clientX - offsetX;
    const y = e.clientY - offsetY;

    // Restrict within bounds
    const clampedX = Math.min(Math.max(x, 0), maxX);
    const clampedY = Math.min(Math.max(y, 0), maxY);

    main_calculator.style.left = `${clampedX}px`;
    main_calculator.style.top = `${clampedY}px`;
});

document.addEventListener('mouseup', () => {
    isDragging = false;
});
