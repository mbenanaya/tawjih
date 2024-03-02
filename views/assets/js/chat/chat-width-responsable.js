
const chat_with_admin =document.querySelector('.chat-area #chat_with_admin');
const formChat = document.querySelector('.chat-area .chat-form #type-area');
const sendBtnChatStudent = document.querySelector('.chat-form #sendBtnChatStudent');
const inputFiedlChat = document.querySelector('.chat-form .input-field');
const photoStudent =document.getElementById('photoStudent');
const fullName =document.getElementById('fullName');
const isOnligne =document.getElementById('isOnligne');


formChat.onsubmit = (e) => {
   e.preventDefault();
}


chat_with_admin.onmouseenter = ()=>{
   chat_with_admin.classList.add('active');
}

chat_with_admin.onmouseleave = ()=>{
   chat_with_admin.classList.remove('active');
}

function scrollToBottom(){
   chat_with_admin.scrollTop = chat_with_admin.scrollHeight;
}

function chatStdWidtResponsable(){
   const xhr1 = new XMLHttpRequest();

   xhr1.open('POST','./controllers/ChatController.php',true);

   xhr1.onload = ()=>{
      if(xhr1.readyState == XMLHttpRequest.DONE)
      {
         if(xhr1.status == 200)
         {
            const data =JSON.parse(xhr1.response);
            chat_with_admin.innerHTML = data.resultat;
            photoStudent.src = "./views/assets/images/images-admin/"+data.infoResp.photo;
            fullName.textContent = data.infoResp.nomRes + ' ' + data.infoResp.prenomRes;
            if(!chat_with_admin.classList.contains('active')){
               scrollToBottom();
            }
            console.log(data.resultat)
            console.log(data.infoResp)
         }
      }
   }
   let formData = new FormData(formChat);
   formData.append('getAllMsgComeFromResp','getAllMsgComeFromResp');
   xhr1.send(formData);
}

chatStdWidtResponsable();
setInterval(chatStdWidtResponsable,5000)


function  playAudio(){
   const audio = new Audio('./sounds/sound_1.mp3');

   audio.play()
}

sendBtnChatStudent.onclick = ()=>{
   
   const xhr = new XMLHttpRequest();

   xhr.open('POST','./controllers/ChatController.php',true);

   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE)
      {
         if(xhr.status == 200){
            const data =JSON.parse(xhr.response);
            // console.log(data.resultat)
            inputFiedlChat.value = '';
            playAudio()
         }
      }
   }
   const formData = new FormData(formChat);
   formData.append('sendStudentMsgToResp','sendStudentMsgToResp');
   if (inputFiedlChat !== '') {
      xhr.send(formData);
   }
}


