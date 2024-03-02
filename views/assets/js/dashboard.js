const formFile = document.querySelector("#file .form");
const formFile_fileInput = document.querySelector('#file .form .file-input');
const formFile_preview = document.querySelector('#file .form .preview');
const img =document.querySelector('#file .form img') ;
formFile.addEventListener('click',function(){
   formFile_fileInput.click();
})

// formFile_fileInput.addEventListener('change', function() {
//    formFile_fileLabel.textContent = formFile_fileInput.files[0].name;
//  });

formFile_fileInput.addEventListener('change',function(){
   const file = formFile_fileInput.files[0];
   const reader = new FileReader();
   reader.onload = function() {
      img.src = reader.result;
      // formFile_preview.appendChild(img);
    }
    reader.readAsDataURL(file);
 });