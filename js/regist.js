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


let queryString = window.location.href ? window.location.href.split('?')[1] : null;

if(queryString && queryString.split('=')[1] === 'success'){
    alert('Ваш запрос на регистрацию принят и направлен администратору')
}