const messageSuccess = document.getElementById('messageSuccess');
const buttonCloseSuccess = document.querySelector('#messageSuccess button');
const nbrResponsablesActive = document.getElementById('nbrResponsablesActive');
const nbrResponsables = document.getElementById('nbrResponsables');

function  CloseSuccess(){
   messageSuccess.style.display = 'none';
}

function getAllResposables() {
   const displayResponsables = document.getElementById('displayResponsables');
   const xhrRer = new XMLHttpRequest();
   xhrRer.open('GET' ,'./controllers/settings/ResponsableController.php?getAllResposables=getAllResposables',true);
   xhrRer.onload = ()=> {
      if(xhrRer.readyState == XMLHttpRequest.DONE) {
         if(xhrRer.status == 200) {
            const data = JSON.parse(xhrRer.response);
            displayResponsables.innerHTML = data.resultat;
            nbrResponsablesActive.textContent = data.nbrResActive;
            nbrResponsables.textContent =  data.nbrResponsables;
         }
      }
   }

   xhrRer.send();
}
// DELETE responsable
function deleteResponsable(event,idResponsable){
   Swal.fire({
      title: 'vous êtes sûre?',
      text: "Vous ne pourrez pas revenir en arrière!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Supprimer!'
    }).then((result) => {
      if (result.isConfirmed) {

         const xhr = new XMLHttpRequest();
         xhr.open('GET','./controllers/settings/ResponsableController.php?deleteResposable=deleteResposable&idResponsable='+idResponsable,true);
         xhr.onload = ()=>{
            if(xhr.readyState == XMLHttpRequest.DONE){
               if(xhr.status == 200){
                  let data = JSON.parse(xhr.response);
                  if(data.resultat == 'responsable_deleted'){
                     // nbrUsersActive.textContent = data.nbrUsersActive;
                     // nbrUsers.textContent = data.nbrUsers;
                     const tr = event.target.closest('tr');
                     tr.remove();
                     nbrResponsablesActive.textContent = data.nbrResActive;
                     nbrResponsables.textContent =  data.nbrResponsables;
                     messageSuccess.style.display = 'block';
                  }else{
                     console.log(data.resultat);
                  }
               }
            }
         }
         xhr.send();
      }
    })
}

function changeActiveRes(idResponsable){
   const xhrChange = new XMLHttpRequest();
   xhrChange.open('GET','./controllers/settings/ResponsableController.php?changeActiveRes=changeActiveRes&idResponsable='+idResponsable,true);
   xhrChange.onload = ()=>{
      if(xhrChange.readyState == XMLHttpRequest.DONE){
         if(xhrChange.status == 200){
            let data = JSON.parse(xhrChange.response);
            if(data.resultat == 'change_active_resp'){
               
               messageSuccess.style.display = 'block';
               nbrResponsablesActive.textContent = data.nbrResActive;
               nbrResponsables.textContent =  data.nbrResponsables;
               // console.log(data.message);
            }else{
               console.log(data.message);
            }
         }
      }
   }
   xhrChange.send();

}
getAllResposables();