

function NotificationMessagesForStd(){

      const NotificationMessagesForStd = document.getElementById('NotificationMessagesForStd');
      const nbrNotifacationMsgForStd = document.getElementById('nbrNotifacationMsgForStd');

      const xhr = new XMLHttpRequest();
   
      xhr.open('POST','./controllers/ChatController.php',true);
      // Set the content type header
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      // Define the data to send
      const data = new URLSearchParams();
      data.append('getAllMsgSendFromResp_Ntf','getAllMsgSendFromResp_Ntf');
      xhr.onload = ()=>{
         if(xhr.readyState == XMLHttpRequest.DONE)
         {
            if(xhr.status == 200)
            {
               const data =JSON.parse(xhr.response);
               NotificationMessagesForStd.innerHTML = data.resultat;
               nbrNotifacationMsgForStd.textContent = data.nbrNotifacationMsg;
               // console.log(data.resultat);
            }
         }
      }
   
      xhr.send(data);

}

NotificationMessagesForStd()

setInterval(NotificationMessagesForStd(),5000)
