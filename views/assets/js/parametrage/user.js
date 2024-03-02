const formUser = document.getElementById('formUser');
const btnSaveChange = document.getElementById('btnSaveChange');
const messageError = document.getElementById('messageError');
const messageSuccess = document.getElementById('messageSuccess');
const buttonCloseError = document.querySelector('#messageError button');
const buttonCloseSuccess = document.querySelector('#messageSuccess button');
const nbrUsersActive = document.getElementById('nbrUsersActive');
const nbrUsers = document.getElementById('nbrUsers');

buttonCloseError.onclick = ()=>{
   messageError.style.display = 'none';
}

function  CloseSuccess(){
   messageSuccess.style.display = 'none';
}

formUser.onsubmit = (e) => {
   e.preventDefault();
}
btnSaveChange.onclick = () => {
   const xhr = new XMLHttpRequest();
   xhr.open('POST', './controllers/settings/UserController.php', true);
   xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
         if (xhr.status == 200) {
             let response =JSON.parse(xhr.response);
            if (response.message == 'bien_inserer') {
               
               window.location.assign(response.url+'/users');
            }
            if (response.message == 'error_photo') {
               messageError.querySelector('button').insertAdjacentText('afterend',"Erreur : le photo n'a pas pu être enregistré.")
               messageError.style.display = 'block';
               console.log('error_logo');
            }
            // console.log(response.message)
         }
      }
   }
   let formdata = new FormData(formUser);
   formdata.append('addUser','addUser');
   if(formdata.get('fname') == '' || formdata.get('lname') == ''
   || formdata.get('email') == '') {
      Swal.fire({
         icon: 'error',
         title: "Assurez-vous que le nom,le prénom et l'email sont entrés",
      })
   }  else {
      xhr.send(formdata);
   }
}

function changeActive(id){
   const xhr = new XMLHttpRequest();
   xhr.open('GET','./controllers/settings/UserController.php?changeActiveUser=changeActiveUser&id='+id,true);
   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE){
         if(xhr.status == 200){
            let data = JSON.parse(xhr.response);
            if(data.message == 'change_active'){
               nbrUsersActive.textContent = data.nbrUsersActive;
               messageSuccess.style.display = 'block';
               // console.log(data.message);
            }else{
               console.log(data.message);
            }
         }
      }
   }
   xhr.send();
}

// DELETE USER
function deleteUser(event,idUser){
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
         xhr.open('GET','./controllers/settings/UserController.php?deleteUser=deleteUse&id='+idUser,true);
         xhr.onload = ()=>{
            if(xhr.readyState == XMLHttpRequest.DONE){
               if(xhr.status == 200){
                  let data = JSON.parse(xhr.response);
                  if(data.message == 'succuss'){
                     nbrUsersActive.textContent = data.nbrUsersActive;
                     nbrUsers.textContent = data.nbrUsers;
                     const tr = event.target.closest('tr');
                     tr.remove();
                     messageSuccess.style.display = 'block';
                  }else{
                     console.log(data.message);
                  }
               }
            }
         }
         xhr.send();
      }
    })
}
