
const RatingEl = document.querySelector('[data-id="rating"]');
const MyCourseEl = document.querySelector('[data-id="course"]');
const CoursesEl = document.querySelector('[data-course="courses"]');
CoursesEl.style.display = 'none';
RatingEl.onclick = () => {
    MyCourseEl.style.background='Navy'
    MyCourseEl.style.color = 'white';
    RatingEl.style.background='white'
    RatingEl.style.color = 'black';
    CoursesEl.style.display = 'none';
}

MyCourseEl.onclick = () => {
    RatingEl.style.background='Navy'
    RatingEl.style.color = 'white';
    MyCourseEl.style.background='white'
    MyCourseEl.style.color = 'black';
    CoursesEl.style.display = 'block';
}