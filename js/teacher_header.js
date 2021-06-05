const MyCourseEl = document.querySelector('[data-id="course"]');
const CoursesEl = document.querySelector('[data-course="courses"]');
const PersonEl = document.querySelector('[data-person="person"]');
CoursesEl.style.display = 'none';
PersonEl.style.display = 'block';
MyCourseEl.onclick = () => {
    MyCourseEl.style.background = 'white'
    MyCourseEl.style.color = 'black';
    CoursesEl.style.display = 'block';
    PersonEl.style.display = 'none';
    PersonEl.style.display = 'none'
}