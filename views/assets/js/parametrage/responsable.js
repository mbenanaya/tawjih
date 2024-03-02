const formResponsable = document.getElementById('formResponsable');
const btnSaveChange = document.getElementById('btnSaveChange');
const messageError = document.getElementById('messageError');
const messageSuccess = document.getElementById('messageSuccess');
const buttonCloseError = document.querySelector('#messageError button');
const buttonCloseSuccess = document.querySelector('#messageSuccess button');
// const nbrUsersActive = document.getElementById('nbrUsersActive');
// const nbrUsers = document.getElementById('nbrUsers');

buttonCloseError.onclick = ()=>{
   messageError.style.display = 'none';
}

function  CloseSuccess(){
   messageSuccess.style.display = 'none';
}

formResponsable.onsubmit = (e) => {
   e.preventDefault();
}

btnSaveChange.onclick = () => {
   const xhr = new XMLHttpRequest();
   xhr.open('POST', './controllers/settings/ResponsableController.php', true);
   xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
         if (xhr.status == 200) {
             let response =JSON.parse(xhr.response);
            
            if (response.message == 'bien_inserer_responsable') {
               
               window.location.assign(response.url+'/responsables');
            }
            if (response.message == 'error_photo') {
               messageError.querySelector('button').insertAdjacentText('afterend',"Erreur : le logo n'a pas pu être enregistré.")
               messageError.style.display = 'block';
               console.log('error_logo');
            }
            console.log(response.message)
         }
      }
   }
   let formdata = new FormData(formResponsable);
   formdata.append('addResposable','addResposable');
   if(formdata.get('fname') == '' || formdata.get('lname') == '' || formdata.get('cinRes') == '' 
      || formdata.get('emailRes') == '') {
         Swal.fire({
            icon: 'error',
            title: "Assurez-vous que votre nom, prénom et email sont entrés",
         })
   }else {
      xhr.send(formdata);
   }
}

