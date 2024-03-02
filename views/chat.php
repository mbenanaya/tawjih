   <!-- CHAT AREAT FOR STUDENT -->

   <section class="chat-area">
      <button class="" id="open-chatbox" style="background-color:#4F91E8;"><i class="fa-solid fa-message"></i></button>
      <div class="chat-form">
         <header>
            <div class="content">
               <img src="./views/assets/images/students/photo-profile.jpg" alt="" id="chatStdPhotoResponsable">
               <div class="details">
                  <span class="nameResponsable" id='nameResponsable'>Nom</span>
                  <span class="statusResponsable" id="statusResponsable" style="text-align: left;"></span>
               </div>
            </div>
            <button id="close-chatbox"><i class="fa-solid fa-xmark"></i></button>
         </header>
         <div class="chat-box" style="background-color: #F7E6DE;">
            <!-- MESSAGES -->
         </div>
         <form action="#" class="type-area" id="type-area" autocomplete="off" style="background-color: #F7E6DE;">
            <input type="text" value="<?php echo $_SESSION['unique_id_student'] ?>" name="outgoing_id" hidden>
            <input type="text" value="102541541" name="incoming_id" hidden>
            <input type="text" placeholder="Type a message here..." class="input-field" name="message">
            <button id="sendBtnChat"><i class="fab fa-telegram-plane"></i></button>
         </form>
      </div>
   </section>

   <script>
      const btnMessage = document.querySelector('.chat-area button');
      const chatBox = document.querySelector('.chat-area .chat-form');
      // const btnCloseChat = document.querySelector('.chat-area .chat-form btn-close');
      const closeChatBox = document.querySelector('.chat-area .chat-form #close-chatbox');
      btnMessage.onclick = () => {
         btnMessage.classList.toggle('active')
         chatBox.classList.toggle('active');
      }
      closeChatBox.onclick = () => {
         chatBox.classList.toggle('active');
         btnMessage.classList.toggle('active')
      }

      function getResponsableStd() {

         const chatStd_Photo_Responsable =document.getElementById('chatStdPhotoResponsable');
         const nameResponsable =document.getElementById('nameResponsable');
         const statusResponsable =document.getElementById('statusResponsable');
         const xhr = new XMLHttpRequest();
         xhr.open('GET','./controllers/ChatController.php?chatStdInfoResponsable=chatStdPhotoResponsable',true);

         xhr.onload = ()=>{
            if (xhr.readyState == XMLHttpRequest.DONE) {
               if (xhr.status == 200) {
                  const data =JSON.parse(xhr.response);
                  chatStd_Photo_Responsable.src ='./views/assets/images/images-admin/'+data.resultat.photo;
                  nameResponsable.textContent =data.resultat.nomRes + ' ' + data.resultat.prenomRes;
                  statusResponsable.textContent =data.resultat.isOnlige;

                  console.log(data);
               }
            }
         }

         xhr.send();

      }
      getResponsableStd();
   </script>
   <script src="./views/assets/js/chat/chatbox.js"></script>
   <script src="./views/assets/js/chat/studentChat.js"></script> 