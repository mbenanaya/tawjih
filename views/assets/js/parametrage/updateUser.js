const formUserUpdate = document.getElementById('formUserUpdate');
const btnUpdateUser = document.getElementById('btnUpdateUser');
const messageError = document.getElementById('messageError');
const messageSuccess = document.getElementById('messageSuccess');
const buttonCloseError = document.querySelector('#messageError button');
const buttonCloseSuccess = document.querySelector('#messageSuccess button');

buttonCloseError.onclick = ()=>{
   messageError.style.display = 'none';
}

function  CloseSuccess(){
   messageSuccess.style.display = 'none';
}

formUserUpdate.onsubmit = (e) => {
   e.preventDefault();
}

btnUpdateUser.onclick = () => {
   const xhr = new XMLHttpRequest();
   xhr.open('POST', './controllers/settings/UserController.php', true);
   xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
         if (xhr.status == 200) {
            let response =JSON.parse(xhr.response);
            if (response.message == 'update_success') {
               messageSuccess.style.display ='block';
            }
            if (response.message == 'error_photo') {
               messageError.querySelector('button').insertAdjacentText('afterend',"Erreur : le logo n'a pas pu être enregistré.")
               messageError.style.display = 'block';
               // console.log(response.message);
            }
            if(response.message == 'update_failed'){
               messageError.querySelector('button').insertAdjacentText('afterend',"Erreur :update_failed ")
               messageError.style.display = 'block';
            }

            // console.log(response.message)

         }
      }
   }
   let formdata = new FormData(formUserUpdate);
   formdata.append('updateUser','updateUser');
   xhr.send(formdata);
}


$(document).ready(function(){

   function validatePassword(password){
      if(password.length < 8){
         return false;
      }

      // Password must contain at least one uppercase letter, one lowercase letter, and one number
      var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{8,}$/;
      if(!regex.test(password)){
         return false;
      }

      return true;
   }

   $('#changePassword').click(function(){
         Swal.fire({
            title:' ',
            width:'800px',
            html:`
            <style>
                      body {
                      background-color: #F1F5FE;
                      }
                      .card-header {
                      background-color: #1862ab;
                      color: #fff;
                      }
                      .card-body {
                      background-color: #fff;
                      border: 1px solid #ccc;
                      border-top: none;
                      }
                      .form-label {
                      font-weight: 500;
                      color: #1862ab;
                     text-align:left;
                      
                      }
                      .form-control[readonly] {
                      background-color: #F1F5FE;
                      color: #555;
                      }
                  </style>
                  <div class="container">
                      <div class="card">
                      <div class="card-header">
                          <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i>Changer le mot de passe</h4>
                      </div>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="student-name" class="form-label">Mot de passe actuel</label>
                                      <input type="password" class="form-control" id="modPassActuel" placeholder='Mot de passe actuel'>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="student-name" class="form-label">Nouveau mot de passe</label>
                                      <input type="password" class="form-control" id="newPassword" placeholder='Nouveau mot de passe'>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="student-name" class="form-label">Confirmer le Nouveau mot de passe</label>
                                      <input type="password" class="form-control" id="confirmPassword" placeholder='Confirmer le Nouveau mot de passe'>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                  </div>
            `,
              showCloseButton: true,
              showConfirmButton: true,
              confirmButtonText: 'Modifier',
              allowOutsideClick: false,
              confirmButtonColor: '#1862ab',
              preConfirm:()=>{
                  const oldPassword  =Swal.getPopup().querySelector('#modPassActuel').value;
                  const newPassword  =Swal.getPopup().querySelector('#newPassword').value;
                  const confirmPassword  =Swal.getPopup().querySelector('#confirmPassword').value;
                  if(oldPassword == '' && newPassword == '' &&confirmPassword == ''){
                     Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                  }
                  if(newPassword !== confirmPassword){
                     Swal.showValidationMessage('Le nouveau mot de passe ne correspond pas au mot de passe de confirmation');
                  }

                  if(!validatePassword(newPassword)){
                     Swal.showValidationMessage('Password must contain at least one uppercase letter, one lowercase letter, and one number')
                  }
                  return{
                        oldPassword:oldPassword,
                        newPassword:newPassword,
                        confirmPassword:confirmPassword
                  }
              }
         }).then((result)=>{
            $.ajax({
               type:'POST',
               url:'./controllers/settings/UserController.php',
               dataType:'json',
               data:{
                  idUser:$('#idUser').val(),
                  oldPassword:result.value.oldPassword,
                  newPassword:result.value.newPassword,
                  confirmPassword:result.value.confirmPassword,
                  changePassword:'changePassword'
               },
               success:(data)=>{
                  if(data.message == 'password_update'){
                        Swal.fire({
                              position: 'bottom-end',
                              width: '500px',
                              icon: 'success',
                              text: 'le password a été Modifié.',
                              showCloseButton: false,
                              showConfirmButton: false,
                              timer: 2500,
                        })
                  }
                  if(data.message == 'password_not_update'){
                     Swal.fire({
                     icon:"error",
                     title:"une erreur est survenue!"
                  })}
                  if(data.message == 'password_not_equal'){
                     Swal.fire({
                     icon:"error",
                     title:"`Mot de passe incorrect`"
                  })}
               }
            })
         })
   })

})
