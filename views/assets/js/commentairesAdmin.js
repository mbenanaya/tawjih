const listGroupCommentaires = document.getElementById('listGroupCommentaires');


function gelAllCommentaires() {
   const xhr = new XMLHttpRequest();
   xhr.open('GET','./controllers/CommentaireController.php?gelAllCommentaires=gelAllCommentaires',true);

   xhr.onload = ()=>{
      if (xhr.readyState == XMLHttpRequest.DONE) {
         if (xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            listGroupCommentaires.innerHTML = data.resultat;
         }
      }
   }

   xhr.send();
}

gelAllCommentaires()


function deleteCommentaire(idCommentaire) {
   Swal.fire({
      title: 'vous êtes sûre?',
      text: "Vous ne pourrez pas revenir en arrière!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Supprimer!',
      cancelButtonText:'Annuler'

    }).then((result) => {
      if (result.isConfirmed) {

         const xhr = new XMLHttpRequest();
         xhr.open('GET','./controllers/CommentaireController.php?deleteCommentaire=deleteCommentaire&id='+idCommentaire,true);

         xhr.onload = ()=>{
            if(xhr.readyState == XMLHttpRequest.DONE){
               if(xhr.status == 200){
                  let data = JSON.parse(xhr.response);
                  if(data.resultat == 'commentaire_deleted'){
                     gelAllCommentaires();
                  }else{
                     // console.log(data.resultat);
                  }
               }
            }
         }
         xhr.send();
      }
    })
}

function changePublier(idCommentaire) {

   const xhr = new XMLHttpRequest();
   xhr.open('POST','./controllers/CommentaireController.php',true);

   xhr.onload = ()=>{
      if(xhr.readyState == XMLHttpRequest.DONE){
         if(xhr.status == 200){
            let data = JSON.parse(xhr.response);
            if(data.resultat == 'publier_updated'){
               if (data.value == 1) {
                  document.getElementById('publier'+idCommentaire).classList.remove('btn-dark');
                  document.getElementById('publier'+idCommentaire).classList.add('btn-success');
               } else {
                  document.getElementById('publier'+idCommentaire).classList.remove('btn-success');
                  document.getElementById('publier'+idCommentaire).classList.add('btn-dark');
               }
            }else{
               // console.log(data.resultat);

            }
               // console.log(data.resultat);

         }
      }
   }

   const formdata = new FormData();
   formdata.append('changePublier','changePublier')
   formdata.append('id',idCommentaire)
   xhr.send(formdata);

}



function updateCommentaire(idCommentaire,commentaire) {
   console.log(commentaire);
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
                    <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i>Modification de commentaire</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                
                                <textarea rows="" cols="" class='form-control' name='commentaire' id='commentaire'
                                placeholder="Écrire un commentaire">${commentaire}</textarea>
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
            const commentaire  =Swal.getPopup().querySelector('#commentaire').value;

            if(commentaire == ''){
               Swal.showValidationMessage(`Veuillez écrire un commentaire`)
            }

            return{
               commentaire:commentaire,
            }
        }
   }).then((result)=>{



      const xhr = new XMLHttpRequest();
      xhr.open('POST','./controllers/CommentaireController.php',true);

      xhr.onload = ()=>{

         if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
               const data =JSON.parse(xhr.response);

               if (data.resultat == 'commentaire_updated') {
                  Swal.fire({
                     icon: "success",
                     text:"Commentaire modifié avec succès"
                 });
                 gelAllCommentaires()
               } else {

               }
               // console.log(data);
            }
         }
      }
      const formData = new FormData();
      formData.append('id',idCommentaire);
      formData.append('commentaire',result.value.commentaire);
      formData.append('modificationCommentaire','modificationCommentaire')
      xhr.send(formData);



   })

}