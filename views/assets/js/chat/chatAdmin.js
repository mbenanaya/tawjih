
const chat_with_User =document.querySelector('.chat-area #chat_with_User');
const formChat = document.querySelector('.chat-area .chat-form #type-area');
const sendBtnChatAdm = document.querySelector('.chat-form #sendBtnChatAdm');
const inputFiedlChat = document.querySelector('.chat-form .input-field');
const photoUser =document.getElementById('photo');
const fullName =document.getElementById('fullName');
const isOnligne =document.getElementById('isOnligne');


formChat.onsubmit = (e) => {
   e.preventDefault();
}


chat_with_User.onmouseenter = ()=>{
   chat_with_User.classList.add('active');
}

chat_with_User.onmouseleave = ()=>{
   chat_with_User.classList.remove('active');
}

function scrollToBottom(){
   chat_with_User.scrollTop = chat_with_User.scrollHeight;
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

            if(data.typeUser == 'responsable') {

               chat_with_User.innerHTML = data.resultat;
               photoUser.src ='./views/assets/images/images-admin/'+data.infoResponsable.photo;
               fullName.textContent = data.infoResponsable.nomRes + ' ' + data.infoResponsable.prenomRes;
               // console.log(data.infoResponsable);

            } else {

               // chat_with_User.innerHTML = data.resultat;
               // photoUser.src = data.user.photo;
               // fullName.textContent = data.user.firstName + ' ' + data.user.lastName;

            }

            if(!chat_with_User.classList.contains('active')){
               scrollToBottom();
            }
            // console.log(data.resultat)
         }
      }
   }
   let formData = new FormData(formChat);
   formData.append('getAllMsgStudentOrRespForAdmin','getAllMsgStudentOrAdminForResp');
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

sendBtnChatAdm.onclick = ()=>{
   
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
   formData.append('sendAdmnMsgToEtudiantOrResp','sendAdmnMsgToEtudiantOrResp');
   xhr.send(formData);


}


