const MyCourseEl = document.querySelector('[data-id="course"]');
const CoursesEl = document.querySelector('[data-course="courses"]');
const PersonEl = document.querySelector('[data-person="person"]');
const UsersEl = document.querySelector('[data-id="users"]');
const UsEl = document.querySelector('[data-id="us"]');
const loadEl =document.querySelector('[data-id="loader"]');
CoursesEl.style.display = 'none';
PersonEl.style.display = 'block';
UsEl.style.display='none';

MyCourseEl.onclick = () => {
    loadEl.style.display='block';
    setTimeout(()=>{
        loadEl.style.display='none';
        CoursesEl.style.display = 'block';
    },3500);
    MyCourseEl.style.background = 'white'
    MyCourseEl.style.color = 'black';
    UsersEl.style.background = 'navy'
    UsersEl.style.color = 'white';
    PersonEl.style.display = 'none';
    UsEl.style.display='none';
}

UsersEl.onclick = () => {
    loadEl.style.display='block';
    setTimeout(()=>{
        loadEl.style.display='none';
        UsEl.style.display='block';
    },3500);
    UsersEl.style.background = 'white'
    UsersEl.style.color = 'black';
    CoursesEl.style.display = 'none';
    PersonEl.style.display = 'none';
    MyCourseEl.style.background = 'navy'
    MyCourseEl.style.color = 'white';
}

const groups = document.querySelectorAll('[data-id="group"]');
const courses = document.querySelectorAll('[data-id="courses"]');


groups.forEach((el,index) => {
    el.onclick = () => {
        if(courses[index].style.display === 'none'){
            courses[index].style.display = 'block';
        }else{
            courses[index].style.display = 'none';
        }
    }
})