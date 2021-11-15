const studensRegEl = document.querySelector('[data-id="students-reg"]');
const teachersRegEl = document.querySelector('[data-id="teachers-reg"]');
const personTypeEl = document.querySelector('[data-id="person-type"]');
const studentEl = document.querySelector('.student');
const teacherEl = document.querySelector('.teacher');
const backEl = document.querySelector('[data-id="back"]');
studensRegEl.style.display = "none";
teachersRegEl.style.display = "none";
backEl.style.display = "none";
studentEl.onclick = () => {
    personTypeEl.style.display="none"
    studensRegEl.style.display="block";
    backEl.style.display = "inline";
}

teacherEl.onclick = () => {
    personTypeEl.style.display = "none";
    teachersRegEl.style.display = "block"
    backEl.style.display = "inline";
}
