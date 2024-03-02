const formWebsite = document.getElementById('formWebsite');
const btnSaveChange = document.getElementById('btnSaveChange');
const messageSuccess = document.getElementById('messageSuccess');
const messageError = document.getElementById('messageError');
const buttonCloseSuccess = document.querySelector('#messageSuccess button');
const buttonCloseError = document.querySelector('#messageError button');

buttonCloseSuccess.onclick = ()=>{
   messageSuccess.style.display = 'none';
}
buttonCloseError.onclick = ()=>{
   messageError.style.display = 'none';
}


formWebsite.onsubmit = (e) => {
   e.preventDefault();
}
btnSaveChange.onclick = () => {
   const xhr = new XMLHttpRequest();
   xhr.open('POST', './controllers/settings/WebSiteController.php', true);
   xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
         if (xhr.status == 200) {
            let response =JSON.parse(xhr.response);
            if (response.message == 'bien_inserer') {
               //messageSuccess.style.display = 'block';
               Swal.fire({
                  icon: "success",
                  title: "Bien",
                  text: "Les informations ont étés enregistré avec succès",                  
               });
               console.log('bien_inserer');
            }
            if (response.message == 'error_logo') {
               //messageError.querySelector('button').insertAdjacentText('afterend',"Erreur : le logo n'a pas pu être enregistré.")
               //messageError.style.display = 'block';
               console.log('error_logo');
               Swal.fire({
                  icon: 'error',
                  title: "Erreur !!",   
                  text:"le logo n'a pas pu être enregistré."               ,
                  showConfirmButton: true,
               })
            }
            if(response.message == 'bien_update'){
               //messageSuccess.style.display = 'block';
               Swal.fire({
                  icon: "success",
                  title: "Bien",
                  text: "Les informations ont étés mise à jour avec succès",                  
               });
               console.log('bien_update');
            }
            //  console.log(response);
         }
      }
   }
   let formdata = new FormData(formWebsite);
   xhr.send(formdata);
}