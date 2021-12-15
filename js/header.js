
const RatingEl = document.querySelector('[data-id="rating"]');
const MyRatingEl = document.querySelector('[data-rating="rating"]');
const MyCourseEl = document.querySelector('[data-id="course"]');
const CoursesEl = document.querySelector('[data-course="courses"]');
const PersonEl = document.querySelector('[data-person="person"]');

const BlockEl = document.querySelector('[data-block="block"]');
CoursesEl.style.display = 'none';
PersonEl.style.display = 'block';
MyRatingEl.style.display = 'none';
BlockEl.style.display='none';
RatingEl.onclick = () => {
    if(document.querySelector('[data-id="loader"]').style.display!='none'){
    setTimeout(()=>{
        document.querySelector('[data-id="loader"]').style.display='none'
        BlockEl.style.display='block';
    },3500);
    }
    MyCourseEl.style.background = 'Navy'
    MyCourseEl.style.color = 'white';
    RatingEl.style.background = 'white'
    RatingEl.style.color = 'black';
    CoursesEl.style.display = 'none';
    PersonEl.style.display = 'none';
    MyRatingEl.style.display = 'block';
}

MyCourseEl.onclick = () => {
    RatingEl.style.background = 'Navy'
    RatingEl.style.color = 'white';
    MyCourseEl.style.background = 'white'
    MyCourseEl.style.color = 'black';
    CoursesEl.style.display = 'block';
    PersonEl.style.display = 'none';
    PersonEl.style.display = 'none'
    MyRatingEl.style.display = 'none';
}

        const descripEl = document.querySelectorAll('[data-id="descrip"]');
        const descripBodyEl = document.querySelectorAll('[data-id="descripBody"]');

        descripEl.forEach((el,index) => {
            el.onclick = () => {
                if(descripBodyEl[index].style.display !== "block"){
                    descripBodyEl[index].style.display="block";
                }else{
                    descripBodyEl[index].style.display="none";
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