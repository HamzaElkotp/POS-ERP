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