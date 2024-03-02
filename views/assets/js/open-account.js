const formOpenAccount = document.querySelector('#form_openaccount');
const nomStd = document.querySelector('#nomStd');
const prenomStd = document.querySelector('#prenomStd');
const emailStd = document.querySelector('#emailStd');
const teleStd = document.querySelector('#phoneStd');
const btnOpenAccount = document.querySelector('#btnOpenAccount');
const methodePayment = document.getElementsByName('methodePayment');
const error = document.querySelector('#error');

formOpenAccount.onsubmit = (e)=>{
   e.preventDefault();
}

btnOpenAccount.onclick = () => {

   if (nomStd.value == '' || prenomStd.value == '' ||  emailStd.value == '' || teleStd.value == '') {
      error.textContent = 'جميع  المعلومات  مطلوبة';
      error.style.display = 'block';

   } else {

      error.style.display = 'none';
      typeMethode = '';
      methodePayment.forEach((elt) => {
         if (elt.checked == true) {
            typeMethode = elt.value;
         }
      })

      if (typeMethode == '') {

         error.textContent = 'يجب عليك اختيار طريقة الد فع ';
         error.style.display = 'block';

      } else {
            if(typeMethode == '1' && check_oayment == false){
               $("#error_payment").text("* Toutes les informations sont obligatoires");
               $("#error_payment").show();
               $("#user-email").focus();
            }else{
               error.style.display = 'none';
               const xhr = new XMLHttpRequest();
               xhr.open('POST','./controllers/DemmandeIncsrController.php',true);
               xhr.onload = () => {
               if (xhr.readyState == XMLHttpRequest.DONE) {
                  if (xhr.status == 200) {
                     const data = JSON.parse(xhr.response);

                     if (data.resultat == 'ok_add_demamdeInscription') {

                        formOpenAccount.reset();
                        Swal.fire({
                           icon: "success",
                           title: "Félicitation",                           
                       });

                     } else if (data.resultat == 'this_email_existe') {

                        Swal.fire({
                              icon: "error",
                              title: "Erreur!!",
                              text:'هذا البريد الالكتروني مستخدم مسبقا'
                        });

                     } else {

                        Swal.fire({
                           icon: "error",
                           title: "Erreur!!",
                           text: 'Une erreur est survenue',
                       });
                       
                     }
                     console.log(data.resultat)
                     
                  }
               }
            }
            const formData = new FormData(formOpenAccount);
            formData.append('demandeInscription','demandeInscription');
            xhr.send(formData);
            }
            
      }

   }
   

   
}