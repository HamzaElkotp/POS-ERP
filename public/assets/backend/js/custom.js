const openNavParent_Btn = document.getElementById("openBtnParentNav")
const navParent = document.getElementById("btnparent")
const closeNavParent_Btn = document.getElementById("closeBtnParentNav")
if(openNavParent_Btn && closeNavParent_Btn && navParent){
    openNavParent_Btn.addEventListener('click', ()=>{
        navParent.classList.toggle('d-none');
        openNavParent_Btn.classList.toggle('d-none');
        closeNavParent_Btn.classList.toggle('d-none');
    })

    closeNavParent_Btn.addEventListener('click', ()=>{
        navParent.classList.toggle('d-none');
        openNavParent_Btn.classList.toggle('d-none');
        closeNavParent_Btn.classList.toggle('d-none');
    })
}




const statistics_parent = document.getElementById("statistics-parent");
const checkpoint_bottom = document.getElementById("checkpoint_bottom")
const pinunpin = document.getElementById("pinunpin");
if(statistics_parent && checkpoint_bottom){
    window.addEventListener("scroll", function () {
        if (window.scrollY >= statistics_parent.offsetTop) {
            if(!statistics_parent.classList.contains("forceRelative")){
                statistics_parent.classList.add("sticky", "cusPos");
            } else{
                statistics_parent.classList.remove("cusPos");
            }
        } else {
            statistics_parent.classList.remove("sticky", "cusPos");
        }

        // console.log(checkpoint_bottom.offset)
        if(window.scrollY + (statistics_parent.offsetHeight / 2.5) >= checkpoint_bottom.offsetHeight){
            statistics_parent.classList.remove("sticky", "cusPos");
        }
    });     
}
if(pinunpin && statistics_parent){
    pinunpin.addEventListener('click', ()=>{
        pinunpin.classList.toggle("pinned");
        statistics_parent.classList.toggle("forceRelative");
        statistics_parent.classList.toggle("cusPos");
    })
}

