window.scrollTo(0, document.body.scrollHeight);
const rootEl = document.querySelector('[data-id=message_list]');
const mesEl = document.querySelectorAll('[data-id="message"]');
const blockEl = document.querySelectorAll('[data-id="block"]');
const messBox =[];
let next = 1;
mesEl.forEach((el,index) => {
    el.onclick = () =>{
        const DelEl = document.querySelector('[data-id=delete]');
        const NumMesEl = document.querySelector('[data-id=number]');
        if(blockEl[index].style.background === ''){
            blockEl[index].style.background="#ebe6e6";
            messBox.push(Number(el.id));
            if(DelEl === null){
                const delEl = document.createElement('div');
                const numMesEl = document.createElement('small');
                delEl.dataset.id='delete';
                numMesEl.dataset.id='number';
                delEl.style.position='fixed';
                const delButEl = document.createElement('button');
                delButEl.textContent='удалить';
                delButEl.classList.add('btn-info');
                delButEl.style.border='none';
                delEl.style.background="black";
                delEl.appendChild(numMesEl);
                delEl.appendChild(delButEl);
                rootEl.insertBefore(delEl,rootEl.firstChild);
                numMesEl.style.color='white';
                numMesEl.textContent=next+' сообщение';

                delButEl.onclick = () => {
                    // alert(messBox);
                    const json_messBox = JSON.stringify(messBox);
                    $.ajax({
                        url: '../mail/delete_message.php',
                        type: "POST",
                        data: {messages:json_messBox},
                        success: function(){
                            location.href='../mail/iframe.php';
                        },
                    });
                }
            }else{
                next++;
                NumMesEl.textContent=next+' сообщение';
            }
        }else{
            next--;
            if(next===0){
                DelEl.remove();
                next = 1;
            }
            NumMesEl.textContent=next+' сообщение';
            blockEl[index].style.background='';
            messBox.forEach((elem,index)=>{
                if(elem === Number(el.id)){
                    messBox.splice(index,1);
                }
            })
        }
    }
})
