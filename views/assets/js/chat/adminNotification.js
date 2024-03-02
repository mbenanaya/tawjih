

function notificationAdmin(){

   const messagesForAdmin = document.getElementById('messagesForAdmin');
   const nbrNotifacationMsgForAdm = document.getElementById('nbrNotifacationMsgForAdm');

   const xhr = new XMLHttpRequest();

   xhr.open('POST','./controllers/ChatController.php',true);
      // Set the content type header
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      // Define the data to send
      const data = new URLSearchParams();
      data.append('getMsgsNotificationForAdmin','getMsgsNotificationForAdmin');
   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE)
      {
         if(xhr.status == 200)
         {
            const data =JSON.parse(xhr.response);
            messagesForAdmin.innerHTML = data.resultat;
            nbrNotifacationMsgForAdm.textContent = data.nbrNotifacationMsg;
            // console.log(data.resultat);
         }
      }
   }

   xhr.send(data);
}

window.onload = function(){
   notificationAdmin()
   setInterval(notificationAdmin,5000);
}