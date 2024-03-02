const btnAddPack  = document.querySelector('#add_pack');
const messageSuccess = document.getElementById('messageSuccess');

function  CloseSuccess(){
   messageSuccess.style.display = 'none';
}

function getAllBacs() {
   const afficheBacs = document.querySelector('#afficheBacs');

   const xhrBacs = new XMLHttpRequest();
   xhrBacs.open('GET','./controllers/settings/PackController.php?getAllBacs=getAllBacs',true);
   xhrBacs.onload = ()=> {
      if(xhrBacs.readyState == XMLHttpRequest.DONE) {
         if(xhrBacs.status == 200) {
            const data = JSON.parse(xhrBacs.response);
            afficheBacs.innerHTML = data.resultat;
            // console.log(data);
         }
      }
   }
   xhrBacs.send()
}
// affiche all packs
function getAllPacks() {
   const tbodyData = document.querySelector('#tbody_pack');
   const xhrGetAll = new XMLHttpRequest();
   xhrGetAll.open('GET','./controllers/settings/PackController.php?getAllPacks=getAllPacks',true);
   xhrGetAll.onload = ()=> {
      if(xhrGetAll.readyState == XMLHttpRequest.DONE) {
         if(xhrGetAll.status == 200) {
            const data = JSON.parse(xhrGetAll.response);
            tbodyData.innerHTML = data.resultat;
            // console.log(data);
         }
      }
   }
   xhrGetAll.send();
}


function addPack() {
   Swal.fire({
      title: '  ',
      width: '900px',
      html: ` <style>
      body {
      background-color: #F1F5FE;
      }
      .card-header {
      background-color: #57ae74;
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
      }

      </style>
      <div class="container">
            <div class="card">
            <div class="card-header">
               <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Ajouter une PACK</h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                           <label for="" class="form-label">Domaine :</label>
                           <input type="text" class="form-control" id="domaine" placeholder='Domaine'>
                        </div>
                        
                  </div>

                  <div class="col-md-6">
                        <div class="form-group">
                           <label for="student-name" class="form-label">Abréviation   :</label>
                           <input type="text" class="form-control" id="abreviation" placeholder='Abréviation'>
                        </div>                                                                                                                    
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="student-name" class="form-label">Avantage   1 :</label>
                        <textarea  class="form-control" id="avantageOne" placeholder='Entrez le premier avantage'></textarea>
                     </div>                                                                                                            
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="student-name" class="form-label">Avantage   2 :</label>
                        <textarea  class="form-control" id="avantageTwo" placeholder='Entrez le premier avantage'></textarea>
                     </div>                                                                                                                    
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="student-name" class="form-label">Prix   :</label>
                        <input type="text" class="form-control" id="prix" placeholder='Prix'>
                     </div>                                                                                                                    
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="student-name" class="form-label">Color   :</label>
                        <input type="color" class="form-control" id="color">
                     </div>                                                                                                                    
                  </div>
                  <div class="col-md-12">
                     <label for="student-name" class="form-label">Bacs:</label>
                     <hr style="margin:5px 0;display:block">
                  </div>
               </div>
               <div class="row mb-1" id="afficheBacs">

               </div>
            </div>
            </div>
      </div>`,
      showCloseButton: true,
      showConfirmButton: true,
      confirmButtonText: 'Ajouter',
      allowOutsideClick: false,
      confirmButtonColor: '#57ae74',
      preConfirm: () => {
         const domaine = Swal.getPopup().querySelector('#domaine').value
         const abreviation = Swal.getPopup().querySelector('#abreviation').value
         const avantageOne = Swal.getPopup().querySelector('#avantageOne').value
         const avantageTwo = Swal.getPopup().querySelector('#avantageTwo').value
         const prix = Swal.getPopup().querySelector('#prix').value
         const color = Swal.getPopup().querySelector('#color').value
         const bacs = Swal.getPopup().querySelectorAll('.bacs');
         const checkboxes = Array.from(bacs).map((bac) => ({
            idBac:bac.getAttribute('value'),
            status: bac.checked
          }));
         if (domaine == '' || abreviation == '' || avantageOne == '' 
               || avantageTwo == '' || prix == '' || color == '') {
             Swal.showValidationMessage(`Tous les champs sont obligatoires`)
         }
         return {
            domaine: domaine,
            abreviation: abreviation,
            avantageOne: avantageOne,
            avantageTwo: avantageTwo,
            prix: prix,
            color: color,
            checkboxes:checkboxes
         }
     }
   }).then((result)=> {
   
      const xhrPack = new XMLHttpRequest();
      xhrPack.open('POST','./controllers/settings/PackController.php',true);
      xhrPack.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhrPack.onload = ()=> {
         if(xhrPack.readyState == XMLHttpRequest.DONE) {
            if(xhrPack.status == 200) {
               const response = JSON.parse(xhrPack.response);

               if (response.resultat == 'pack_inserted') {
                  Swal.fire({
                      position: 'bottom-end',
                      width: '500px',
                      icon: 'success',
                      text: 'Pack a été Ajouté avec success.',
                      showCloseButton: false,
                      showConfirmButton: false,
                      timer: 2500,
                  });
                  getAllPacks()
              } else {
                  Swal.fire({
                     icon: 'error',
                     title: "une erreur est survenue!",
                  })
              }
               console.log(response);
            }
         }
      }
      const data = {
         domaine:result.value.domaine,
         abreviation: result.value.abreviation,
         avantageOne: result.value.avantageOne,
         avantageTwo: result.value.avantageTwo,
         prix: result.value.prix,
         color: result.value.color,
         checkboxes:result.value.checkboxes,
         action:'addPack'
      }
      xhrPack.send('data=' + encodeURIComponent(JSON.stringify(data)));
   })
}

//------------------------------------
//          delete pack
//-----------------------------------
function deletePack(idPack) {
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
         xhr.open('GET','./controllers/settings/PackController.php?deletePack=deletePack&idPack='+idPack,true);
         xhr.onload = ()=>{
            if(xhr.readyState == XMLHttpRequest.DONE){
               if(xhr.status == 200){
                  let data = JSON.parse(xhr.response);
                  if(data.resultat == 'pack_deleted'){
                     getAllPacks()
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
//------------------------------------
//          update pack
//-----------------------------------
function getInfoPack(idPack,callback) {
   const xhr = new XMLHttpRequest();
   xhr.open('GET','./controllers/settings/PackController.php?getInfoPack=getInfoPack&idPack='+idPack,true);
   const infoPack = null;
   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE) {
         if(xhr.status == 200){
            let data = JSON.parse(xhr.response);
            callback(data.resultat);
            // console.log(data.resultat)
         }
      }
   }
   xhr.send();
}

function updatePack(idPack) {
  
   getInfoPack(idPack,(infoPack)=>{
      Swal.fire({
         title: '  ',
         width: '900px',
         html: ` <style>
         body {
         background-color: #F1F5FE;
         }
         .card-header {
         background-color: #57ae74;
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
         }
   
         </style>
         <div class="container">
               <div class="card">
               <div class="card-header">
                  <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Modifier une PACK</h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6">
                           <div class="form-group">
                              <label for="" class="form-label">Domaine :</label>
                              <input type="text" class="form-control" id="domaineU" placeholder='Domaine' value="${infoPack.domaineP}">
                           </div>
                           
                     </div>
   
                     <div class="col-md-6">
                           <div class="form-group">
                              <label for="student-name" class="form-label">Abréviation   :</label>
                              <input type="text" class="form-control" id="abreviationU" placeholder='Abréviation' value="${infoPack.domaineAbreviationP}">
                           </div>                                                                                                                    
                     </div>
   
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="student-name" class="form-label">Avantage   1 :</label>
                           <textarea  class="form-control" id="avantageOneU" placeholder='Entrez le premier avantage'>${infoPack.avantage1P}</textarea>
                        </div>                                                                                                                    
                     </div>
   
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="student-name" class="form-label">Avantage   2 :</label>
                           <textarea  class="form-control" id="avantageTwoU" placeholder='Entrez le premier avantage'>${infoPack.avantage2P}</textarea>
                        </div>                                                                                                                    
                     </div>
   
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="student-name" class="form-label">Prix   :</label>
                           <input type="text" class="form-control" id="prixU" placeholder='Prix' value="${infoPack.prixPack}">
                        </div>                                                                                                                    
                     </div>
   
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="student-name" class="form-label">Color   :</label>
                           <input type="color" class="form-control" id="colorU" value="${infoPack.color}">
                        </div>                                                                                                                    
                     </div>
                     <div class="col-md-12">
                        <label for="student-name" class="form-label">Bacs:</label>
                        <hr style="margin:5px 0;display:block">
                     </div>
                  </div>
                  <div class="row mb-1" id="afficheBacsUpdate">
                  </div>
               </div>
               </div>
         </div>`,
         showCloseButton: true,
         showConfirmButton: true,
         confirmButtonText: 'Modifier',
         allowOutsideClick: false,
         confirmButtonColor: '#57ae74',
         didOpen: () => {
            bacsChecked(idPack);
         },
         preConfirm: () => {
            const domaine = Swal.getPopup().querySelector('#domaineU').value
            const abreviation = Swal.getPopup().querySelector('#abreviationU').value
            const avantageOne = Swal.getPopup().querySelector('#avantageOneU').value
            const avantageTwo = Swal.getPopup().querySelector('#avantageTwoU').value
            const prix = Swal.getPopup().querySelector('#prixU').value
            const color = Swal.getPopup().querySelector('#colorU').value
            const bacs = Swal.getPopup().querySelectorAll('.bacs');
            
            const checkboxes = Array.from(bacs).map((bac) => ({
               idBac:bac.getAttribute('value'),
               status: bac.checked
             }));
            if (domaine == '' || abreviation == '' || avantageOne == '' 
                  || avantageTwo == '' || prix == '' || color == '') {
                Swal.showValidationMessage(`Tous les champs sont obligatoires`)
            }
            return {
               idPack:idPack,
               domaine: domaine,
               abreviation: abreviation,
               avantageOne: avantageOne,
               avantageTwo: avantageTwo,
               prix: prix,
               color: color,
               checkboxes:checkboxes
            }
        }
      }).then((result)=> {
      
         const xhrPack = new XMLHttpRequest();
         xhrPack.open('POST','./controllers/settings/PackController.php',true);
         xhrPack.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         xhrPack.onload = ()=> {
            if(xhrPack.readyState == XMLHttpRequest.DONE) {
               if(xhrPack.status == 200) {
                  const response = JSON.parse(xhrPack.response);
   
                  if (response.resultat == 'pack_updated') {
                     Swal.fire({
                         position: 'bottom-end',
                         width: '500px',
                         icon: 'success',
                         text: 'Pack a été Ajouté avec success.',
                         showCloseButton: false,
                         showConfirmButton: false,
                         timer: 2500,
                     });
                     getAllPacks()
                     console.log(response.resultat)
                 } else {
                     Swal.fire({
                        icon: 'error',
                        title: "une erreur est survenue!",
                     })
                 }
                  console.log(response);
               }
            }
         }
         const data = {
            idPack:result.value.idPack,
            domaine:result.value.domaine,
            abreviation: result.value.abreviation,
            avantageOne: result.value.avantageOne,
            avantageTwo: result.value.avantageTwo,
            prix: result.value.prix,
            color: result.value.color,
            checkboxes:result.value.checkboxes,
            action:'updatePack'
         }
         xhrPack.send('data=' + encodeURIComponent(JSON.stringify(data)));
      })
   });
}
function bacsChecked(idPack) {

   const xhrBacs = new XMLHttpRequest();
   xhrBacs.open('GET','./controllers/settings/PackController.php?bacsChecked=bacsChecked&idPack='+idPack,true);
   xhrBacs.onload = ()=> {
      if(xhrBacs.readyState == XMLHttpRequest.DONE) {
         if(xhrBacs.status == 200) {
            const data = JSON.parse(xhrBacs.response);
            afficheBacsUpdate.innerHTML = data.resultat;
            // console.log(afficheBacsUpdate.nodeName);
         }
      }
   }
   xhrBacs.send()
}
function changeActivePack(idPack){
   const xhr = new XMLHttpRequest();
   xhr.open('GET','./controllers/settings/PackController.php?changeActivePack=changeActivePack&idPack='+idPack,true);
   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE){
         if(xhr.status == 200){
            let data = JSON.parse(xhr.response);
            if(data.resultat == 'change_active'){
               messageSuccess.style.display = 'block';
               // console.log(data.resultat);
            }else{
               console.log(data.resultat);
            }
         }
      }
   }
   xhr.send();
}
// MAIN
btnAddPack.onclick = ()=> {
   addPack();
   getAllBacs();
}
getAllPacks()