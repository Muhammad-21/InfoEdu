const descripEl = document.querySelectorAll('[data-id="descrip"]');
const descripBodyEl = document.querySelectorAll('[data-id="descripBody"]');
const faEl = document.querySelectorAll('.fa');
        descripEl.forEach((el,index) => {
            el.onclick = () => {
                if(descripBodyEl[index].style.display !== "block"){
                    descripBodyEl[index].style.display="block";
                    faEl[index].className = "fa fa-angle-up fa-lg"
                }else{
                    descripBodyEl[index].style.display="none";
                    faEl[index].className = "fa fa-angle-down fa-lg"
                }
            }
        })

let queryString = window.location.href ? window.location.href.split('?')[1] : null;
const rootEl = document.querySelector('[data-id="root"]');
if(queryString && queryString.split('=')[1] === 'success'){
    const statusEl = document.createElement('div');
    statusEl.textContent="Вы успешно записались";
    statusEl.style.position="absolute";
    statusEl.style.background="rgba(8, 161, 8, 0.562)";
    statusEl.style.color="white";
    statusEl.style.padding="15px";
    statusEl.style.borderRadius="15px";
    statusEl.style.right="20px";
    statusEl.style.top="120px";
    rootEl.insertBefore(statusEl,rootEl.firstChild);
    setTimeout(() => {
        statusEl.remove();
    },2000)
    MyCourseEl.click();
}