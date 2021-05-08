
const RatingEl = document.querySelector('[data-id="rating"]');
const MyRatingEl = document.querySelector('[data-rating="rating"]');
const MyCourseEl = document.querySelector('[data-id="course"]');
const CoursesEl = document.querySelector('[data-course="courses"]');
const PersonEl = document.querySelector('[data-person="person"]');
CoursesEl.style.display = 'none';
PersonEl.style.display = 'block';
MyRatingEl.style.display = 'none';
RatingEl.onclick = () => {
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