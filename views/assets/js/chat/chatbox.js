
const myChat =document.querySelector('.chat-area .chat-box');
const formChat = document.querySelector('.chat-area .chat-form #type-area');
const sendBtnChat = document.querySelector('.chat-form #sendBtnChat');
const inputFiedlChat = document.querySelector('.chat-form .input-field');



formChat.onsubmit = (e) => {
   e.preventDefault();
}


myChat.onmouseenter = ()=>{
   myChat.classList.add('active');
}

myChat.onmouseleave = ()=>{
   myChat.classList.remove('active');
}

function scrollToBottom(){
   myChat.scrollTop = myChat.scrollHeight;
}


setInterval(() => {
   
   const xhr = new XMLHttpRequest();

   xhr.open('POST','./controllers/ChatController.php',true);

   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE)
      {
         if(xhr.status == 200)
         {
            const data =JSON.parse(xhr.response);
            myChat.innerHTML = data.resultat;

            if(!myChat.classList.contains('active')){
               scrollToBottom();
            }

         }
      }
   }
   let formData = new FormData(formChat);
   formData.append('getAllMessage','getAllMessage');
   xhr.send(formData);

}, 5000);


function  playAudio(){
   const audio = new Audio('./sounds/sound_1.mp3');

   audio.play()
}

sendBtnChat.onclick = ()=>{
   
   const xhr = new XMLHttpRequest();

   xhr.open('POST','./controllers/ChatController.php',true);

   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE)
      {
         if(xhr.status == 200){
            const data =JSON.parse(xhr.response);
            inputFiedlChat.value = '';
            playAudio()
            console.log(data.resultat)
         }
      }
   }
   const formData = new FormData(formChat);
   formData.append('isertMessage','isertMessage');
   xhr.send(formData);
}


