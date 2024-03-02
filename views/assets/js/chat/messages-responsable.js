

//gell all messages students for responsable

function getAllMessagesStudentToPgMessagesForRes(){
   const sideBarMessagesStudent = document.getElementById('sideBarMessagesStudent');
   const sideBarTwoListAmins = document.getElementById('sideBarTwoListAmins');
   const xhr = new XMLHttpRequest();

   xhr.open('POST','./controllers/ChatController.php',true);
   // Set the content type header
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   // Define the data to send
   const data = new URLSearchParams();
   data.append('getAllMessagesStudentToPgMessagesForRes','getAllMessagesStudentToPgMessagesForRes');
   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE)
      {
         if(xhr.status == 200)
         {
            const data =JSON.parse(xhr.response);
            sideBarMessagesStudent.innerHTML = data.resultat;
            sideBarTwoListAmins.innerHTML = data.listAdmins;
         }
      }
   }

   xhr.send(data);
}



window.onload = function() {
   getAllMessagesStudentToPgMessagesForRes();
   setInterval(getAllMessagesStudentToPgMessagesForRes, 5000);
}
