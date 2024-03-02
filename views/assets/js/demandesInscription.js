
const tboadyDemandes = document.querySelector('#tboadyDemandes');

function getAllDemandes() {
   const xhr = new XMLHttpRequest();

   xhr.open('GET','./controllers/DemmandeIncsrController.php?getAllDemandes=getAllDemandes',true);

   xhr.onload = ()=> {

      if (xhr.readyState == XMLHttpRequest.DONE) {
         if (xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            tboadyDemandes.innerHTML = data.resultat;
            // console.log(data.resultat);
         }
      }

   }
   
   xhr.send();
}

setTimeout(function() {
   getAllDemandes()
},3000)


// chnage Statut En attende || Refuser || Accepter
function changeStatut(elt,idDemande) {
   statutValue = elt.target.value;
   selectResOption = document.getElementById('selectResOption_'+idDemande);
   if (statutValue == 2) { //Accepter

      Swal.fire({
         title: 'vous êtes sûre?',
         text: "Voulez-vous vraiment Accepter cette demande ?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Accepter',
         cancelButtonText:'Annuler'
       }).then((result) => {
         if (result.isConfirmed) {


            
            
             selectResOption.disabled = false;
            changeStatusDemande(idDemande ,statutValue)

            selectResOption.focus();
            selectResOption.classList.remove('border-primary');
            selectResOption.classList.add('border-danger');
            // console.log(selectResOption);
         }
       })

   } else if (statutValue == 1) {

      Swal.fire({
         title: 'vous êtes sûre?',
         text: "Voulez-vous vraiment refuser cette demande ?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Accepter',
         cancelButtonText:'Annuler'
       }).then((result) => {
         if (result.isConfirmed) {

            changeStatusDemande(idDemande ,statutValue)

            selectResOption.options[0].selected = true;
            selectResOption.disabled = true;

            selectResOption.classList.remove('border-danger');
            selectResOption.classList.add('border-primary');


         }

      })
   } else {

      selectResOption.options[0].selected = true;
      selectResOption.disabled = true;
      changeStatusDemande(idDemande ,statutValue)

   }
}

function changeStatusDemande(idDemande ,statutValue) {

   const xhr = new XMLHttpRequest();
   xhr.open('GET','./controllers/DemmandeIncsrController.php?changeStatusDemande=changeStatusDemande&idDemande='+idDemande+'&statutValue='+statutValue,true);

   xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
         console.log(xhr.response)
         if (xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            if (data.resultat == 'etudiante_ajouter') {
               Swal.fire({
                  icon: "success",
                  title: "Ajouter",
                  text:"L'étudiante a été ajouté avec succès, Choisissez le responsable"
              });

            } else if (data.resultat == 'success_refuser') {
            //    Swal.fire({
            //       icon: "error",
            //       title: "Refuser",
            //       text:"L'étudiante a été ajouté avec succès, Choisissez le responsable"
            //   });
            // console.log(data);
            }
            console.log(data);

         }
      }
   }

   xhr.send();
}

function setResponsableToStd(elt,idDemande) {
   const idResponsable =elt.target.value;
   const selectResponsableId = elt.target.id;

   const xhr = new XMLHttpRequest();
   xhr.open('GET','./controllers/DemmandeIncsrController.php?chooseResponsable=chooseResponsable&idResponsable='+idResponsable+'&idDemande='+idDemande,true);

   xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
         if (xhr.status == 200) {
            const data = JSON.parse(xhr.response) ;

            if (data.resultat == 'success_affected_responsable') {

               Swal.fire({
                  icon: "success",
                  // title: "Ajouter",
                  text:"L'opération s'est terminée avec succès"
              });

              document.getElementById(selectResponsableId).classList.remove('border-danger');
              document.getElementById(selectResponsableId).classList.add('border-primary');

            } else {

            }
            console.log(data);
         }
      }
   }

   xhr.send();
}

function deleteDemande(id){
   Swal.fire({
      title: 'êtes-vous sûr?',
      text: "Vous ne pourrez pas revenir en arrière!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Annuler',
      confirmButtonText: 'Oui, supprimez-le!'
  }).then((result) => {
      if (result.isConfirmed) {        
         const xhr = new XMLHttpRequest();
         xhr.open('GET','./controllers/DemmandeIncsrController.php?delteDemande=delteDemande&idDemande='+id,true);
         xhr.onload = () => {
            if (xhr.readyState == XMLHttpRequest.DONE) {
               if (xhr.status == 200) {
                  const data = JSON.parse(xhr.response) ;
                  console.log(data);
                  if(data.resultat == "demande_deleted"){
                     getAllDemandes();
                     Swal.fire({
                        icon: "success",
                        // title: "Ajouter",
                        text:"Demande à eté supprimé avec succès"
                    });
                  }else{
                     Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text:"une erreur est survenue"
                    });
                  }
               }
            }
         }
         xhr.send();
      }
  })
}