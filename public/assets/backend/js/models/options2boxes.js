window.onload = function() {
    const opt2box_options = document.querySelectorAll('[opt2box-option]');

    // loop on all options created in carsol, to link each one with its select box
    opt2box_options.forEach((option)=>{

        // add click on each option in the carsole
        option.addEventListener('click', ()=>{
            // Remove active from all other carsol options
            let parent = document.querySelector(`[carsole='${option.getAttribute("carsol-parent")}']`);
            let otherActive = parent.querySelector(".carsole-box.active")
            otherActive?.classList.remove('active');

            // add active on the choosed option in carsole
            option.classList.add('active');

            // start finding the same selectbox option to select it
            let selectBoxAtrribute = option.getAttribute("opt2box-option");
            let selectBox = document.getElementById(selectBoxAtrribute);
            
            let optionId = option.getAttribute("optionid");
            let selected_option = selectBox.querySelector(`[value='${optionId}']`);

            // run the change event of the select box
            selected_option.selected = true;
            let event = new Event("change");
            selectBox.dispatchEvent(event);
        })
    })
}


// var selectElement = document.getElementById("product_category");
// selectElement.options[1].selected = true;
// var event = new Event("change");
// selectElement.dispatchEvent(event);





// scrollLeftButton.addEventListener('click', () => {
//   row.style.transform = 'translateX(0)';
// });

// scrollRightButton.addEventListener('click', () => {
//   row.style.transform = 'translateX(-100%)';
// });
