const StudentEl = document.querySelector('[data-id="student"]');
const typeLessonEl = document.querySelector('[data-id="type_lesson"]');
const ListEl = document.querySelector('[data-student="students"]');
const loadEl =document.querySelector('[data-id="loader"]');
ListEl.style.display='none';
typeLessonEl.style.display='none';
loadEl.style.display='block';
    setTimeout(()=>{
        loadEl.style.display='none';
        typeLessonEl.style.display = 'block';
    },3500);
StudentEl.onclick = () => {
    StudentEl.style.background = 'white'
    StudentEl.style.color = 'black';
    loadEl.style.display='block';
    setTimeout(()=>{
        loadEl.style.display='none';
        ListEl.style.display = 'block';
    },3500);
    typeLessonEl.style.display = 'none';
}