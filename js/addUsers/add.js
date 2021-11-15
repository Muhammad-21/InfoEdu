const modalEL = document.querySelectorAll('.modal');
const listEl = document.querySelectorAll('.list');
const exitEl = document.querySelectorAll('.modal__exit');
function click(modal,index) {
    modal.onclick = () => {
        modalEL[index].style.display="flex";
        modalEL[index].style.justifyContent="center";
        modalEL[index].style.alignItems = "center";
        window.onclick = function(event) {
            if(event.target.className === 'modal'){
                modalEL[index].style.display="none";    
            }
        }
        exitEl[index].onclick = () => {
            modalEL[index].style.display="none";
        }
    }
}

listEl.forEach((modal,index) => click(modal,index));

