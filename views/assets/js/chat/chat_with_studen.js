
const chat_with_studen =document.querySelector('.chat-area #chat_with_studen');
const formChat = document.querySelector('.chat-area .chat-form #type-area');
const sendBtnChatResponsable = document.querySelector('.chat-form #sendBtnChatResponsable');
const inputFiedlChat = document.querySelector('.chat-form .input-field');
const photoStudent =document.getElementById('photoStudent');
const fullName =document.getElementById('fullName');
const isOnligne =document.getElementById('isOnligne');


formChat.onsubmit = (e) => {
   e.preventDefault();
}


chat_with_studen.onmouseenter = ()=>{
   chat_with_studen.classList.add('active');
}

chat_with_studen.onmouseleave = ()=>{
   chat_with_studen.classList.remove('active');
}

function scrollToBottom(){
   chat_with_studen.scrollTop = chat_with_studen.scrollHeight;
}

function chatWithStudent(){
   const xhr1 = new XMLHttpRequest();

   xhr1.open('POST','./controllers/ChatController.php',true);

   xhr1.onload = ()=>{
      if(xhr1.readyState == XMLHttpRequest.DONE)
      {
         if(xhr1.status == 200)
         {
            const data =JSON.parse(xhr1.response);

            if(data.typeUser == 'admin') {

               chat_with_studen.innerHTML = data.resultat;
               photoStudent.src ='./views/assets/images/images-admin/'+data.infoAdmin.photo;
               fullName.textContent = data.infoAdmin.fname + ' ' + data.infoAdmin.lname;

            } else {

               chat_with_studen.innerHTML = data.resultat;
               photoStudent.src = data.etudiante.photo;
               fullName.textContent = data.etudiante.firstName + ' ' + data.etudiante.lastName;

            }

            if(!chat_with_studen.classList.contains('active')){
               scrollToBottom();
            }
            // console.log(data.resultat)
         }
      }
   }
   let formData = new FormData(formChat);
   formData.append('getAllMsgStudentOrAdminForResp','getAllMsgStudentOrAdminForResp');
   xhr1.send(formData);
}

// window.onload = function(){
   chatWithStudent();
   setInterval(chatWithStudent,5000)
// }

function  playAudio(){
   const audio = new Audio('./sounds/sound_1.mp3');

   audio.play()
}

sendBtnChatResponsable.onclick = ()=>{
   
   const xhr = new XMLHttpRequest();

   xhr.open('POST','./controllers/ChatController.php',true);

   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE)
      {
         if(xhr.status == 200){
            const data =JSON.parse(xhr.response);
            console.log(data.resultat)
            inputFiedlChat.value = '';
            playAudio()
         }
      }
   }
   const formData = new FormData(formChat);
   formData.append('sendRespMsgToEtudiantOrAdmin','sendRespMsgToEtudiantOrAdmin');
   xhr.send(formData);
}


