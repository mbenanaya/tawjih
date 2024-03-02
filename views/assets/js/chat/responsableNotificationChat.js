
function getNotifMsgForResponsable(){
   const messagesNotificationsForResponsable = document.getElementById('messagesNotificationsForResponsable');
   const nbrNotifacationMsgForResponsable = document.getElementById('nbrNotifacationMsgForResponsable');

   const xhr = new XMLHttpRequest();

   xhr.open('POST','./controllers/ChatController.php',true);
   // Set the content type header
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   // Define the data to send
   const data = new URLSearchParams();
   data.append('getNotifMsgForResponsable','getNotifMsgForResponsable');
   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE)
      {
         if(xhr.status == 200)
         {
            const data =JSON.parse(xhr.response);
            messagesNotificationsForResponsable.innerHTML = data.resultat;
            nbrNotifacationMsgForResponsable.textContent = data.nbrNotifacationMsg;
            // console.log(data.resultat);
         }
      }
   }

   xhr.send(data);
}



window.onload = function() {
   getNotifMsgForResponsable();
   setInterval(getNotifMsgForResponsable, 5000);
}
