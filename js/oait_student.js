const RatingEl = document.querySelector('[data-id="rating"]');
const MyRatingEl = document.querySelector('[data-rating="rating"]');
const PersonEl = document.querySelector('[data-lesson="lesson"]');

const BlockEl = document.querySelector('[data-block="block"]');
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
    RatingEl.style.background = 'white'
    RatingEl.style.color = 'black';
    PersonEl.style.display = 'none';
    MyRatingEl.style.display = 'block';
}
