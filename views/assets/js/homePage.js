
const logoHomePage = document.querySelector('#logoHomePage');
const nameWebSite = document.querySelector('#nameWebSite');
const quiSommesNous = document.querySelector('#quiSommesNous');
const aproposDuSite = document.querySelectorAll('.aproposDuSite');
const address = document.querySelectorAll('.address');
const email = document.querySelectorAll('.email');
const phone = document.querySelectorAll('.phone');
const afficheCommentaires = document.querySelector('#afficheCommentaires');
const socialIcons = document.querySelectorAll('.social-icon');

const photoAdmin = document.querySelector('#photoAdmin');
const nameAdmin = document.querySelector('#nameAdmin');


function getInfoWebSite() {
   const xhr = new XMLHttpRequest();

   xhr.open('GET' ,'./controllers/HomePageController.php?getInfoWebSite=getInfoWebSite',true);

   xhr.onload = ()=> {
      if(xhr.readyState == XMLHttpRequest.DONE) {
         if(xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            logoHomePage.src = `./views/assets/images/logos/${data.webSiteInfo.logo}`;
            nameWebSite.textContent = data.webSiteInfo.siteWeb;
            address.forEach( element => { element.innerHTML =`<i class="bi-geo-alt me-2"></i>${data.webSiteInfo.address}` });
            email.forEach( element => { element.textContent =`${data.webSiteInfo.email}` });
            socialIcons.forEach( element => { element.innerHTML =`
                     <li class="social-icon-item">
                        <a href="${data.webSiteInfo.twitter}" class="social-icon-link bi-twitter"></a>
                     </li>
                     <li class="social-icon-item">
                        <a href="${data.webSiteInfo.facebook}" class="social-icon-link bi-facebook"></a>
                     </li>
                     <li class="social-icon-item">
                        <a href="${data.webSiteInfo.instagrame}" class="social-icon-link bi-instagram"></a>
                     </li>
                     <li class="social-icon-item">
                        <a href="${data.webSiteInfo.youtube}" class="social-icon-link bi-youtube"></a>
                     </li>
                     <li class="social-icon-item">
                        <a href="${data.webSiteInfo.youtube}" class="social-icon-link bi-whatsapp"></a>
                     </li>
                  ` });

            aproposDuSite.forEach( element => { element.textContent = data.webSiteInfo.AproposDuSite });
            quiSommesNous.textContent = data.webSiteInfo.QuiSommesNous;

            phone.forEach( element => { element.textContent =`${data.webSiteInfo.tele}` });
            photoAdmin.src = './views/assets/images/images-admin/'+data.adminInfo.photo;
            nameAdmin.textContent = data.adminInfo.fname + ' ' + data.adminInfo.lname;
            // console.log(address.nodeName);
         }
      }
   }

   xhr.send();
} 
function getInfoPacks() {
   const packsRow = document.getElementById('packsRow');
   const xhr = new XMLHttpRequest();
   xhr.open('GET' ,'./controllers/HomePageController.php?getInfoPacks=getInfoPacks',true);
   xhr.onload = ()=> {
      if(xhr.readyState == XMLHttpRequest.DONE) {
         if(xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            packsRow.innerHTML = data.resultat;
         }
      }
   }

   xhr.send();
}

function getCommentaires() {
   const packsRow = document.getElementById('packsRow');
   const xhr = new XMLHttpRequest();
   xhr.open('GET' ,'./controllers/HomePageController.php?getCommentaires=getCommentaires',true);
   xhr.onload = ()=> {
      if(xhr.readyState == XMLHttpRequest.DONE) {
         if(xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            afficheCommentaires.innerHTML = data.resultat;
            console.log(data.resultat)
         }
      }
   }

   xhr.send();
}

window.onload = function() {
   getInfoWebSite()
   getInfoPacks()
   getCommentaires()
}