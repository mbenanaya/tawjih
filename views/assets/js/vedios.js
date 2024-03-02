


function getAllVediosFotStd(filterParDate = 0,desc_asc = 'DESC') {
   const cards_vedios = document.querySelector('.cards_vedios');
   const xhr = new XMLHttpRequest();
   xhr.open('GET' ,'./controllers/VedioesController.php?getAllVediosFotStd=getAllVediosFotStd&desc_asc='+desc_asc+'&filterParDate='+filterParDate,true);
   xhr.onload = ()=> {
      if(xhr.readyState == XMLHttpRequest.DONE) {
         if(xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            cards_vedios.innerHTML = data.resultat;
            // console.log(data.resultat)
         }
      }
   }

   xhr.send();
}

setTimeout(function(){
   getAllVediosFotStd()
},3000)





$(document).ready(function(){

   $('#btnFilter').click(function(){
         Swal.fire({
            title:' ',
            width:'500px',
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
                          <h4 class="mb-0 text-center">Filtrer</h4>
                      </div>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                  <label for="inputName" class="form-label" style='text-align: right;'>Dernière mise à
                                  jour</label>
                                    <select name="" id="filterParDate" class='form-select'>
                                       <option value="365">tous</option>
                                       <option value="7">7 jours</option>
                                       <option value="14">14 jours</option>
                                       <option value="30">30 jours</option>
                                       <option value="60">2 mois</option>
                                       <option value="90">3 mois</option>
                                       <option value="180">6 mois</option>
                                       <option value="365">1 année</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                       <label for="inputName" class="form-label" style='text-align: right;'>Trier
                                       par</label>
                                    <select name="" id="desc_Asc" class="form-control">
                                       <option value="DESC">descendant</option>
                                       <option value="ASC">ascendant</option>                                       
                                    </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                  </div>
            `,
              showCloseButton: true,
              showConfirmButton: true,
              confirmButtonText: 'Filrer',
              allowOutsideClick: false,
              confirmButtonColor: '#1862ab',
              preConfirm:()=>{
                  const filterParDate  =Swal.getPopup().querySelector('#filterParDate').value;
                  const desc_Asc  =Swal.getPopup().querySelector('#desc_Asc').value;

                  return{
                        filterParDate:filterParDate,
                        desc_Asc:desc_Asc
                  }
              }
         }).then((result)=>{
            const filterParDate = result.value.filterParDate;
            const desc_Asc = result.value.desc_Asc;
            getAllVediosFotStd(filterParDate,desc_Asc)
         })
   })

})