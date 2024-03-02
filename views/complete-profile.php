
<?php 

require_once './controllers/auth.php';
$cuser = new Auth();

$website = $cuser->website(); 

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> موقع توجيه| اكمال المعلومات الشخصية</title>
   <!-- link bootstrap  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css"
      integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!--START ICON  -->
   <link rel="shortcut icon" href="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png"
        type="image/x-icon">
   <!--END ICON  -->

   <style>
      @import url("https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap");

      section {
         font-family: "Noto Sans Arabic", sans-serif;
      }

      body {
         background-color: #eee;
      }
      label.error{
         color:red;
      }
   </style>
</head>

<body>

   <div class="container">
      <nav class="navbar navbar-expand-lg mt-3">
         <a class="navbar-brand d-flex gap-3 align-items-center " href="<?php echo BASE_URL ?>">
            <div style="width: 100px;height: 100px;display: block;">
            
               <!-- change ./ to ../../v.... -->
               <img src="./views/assets/images/logos/<?php echo $website[0]['logo'] ?>"
                  id="logoHomePage" class="logo" alt="" style="width: 100%;height: 100%;">
            </div>
            <span id='nameWebSite'>
                <?php echo $website[0]['siteWeb']; ?>
            </span>
         </a>
      </nav>
   </div>

   <section class="mt-5">

      <div class="container">

         <div class="row d-flex justify-content-center">
            <div class="col-md-10">

               <form name="complete-reg" id="complete-reg" class=" volunteer-form m-2 px-3 py-4 mb-5 mb-lg-0"
                  enctype="multipart/form-data">
                  <!-- START INFORMATION PERSONNELLES -->
                  <div class="row" dir="rtl">
                     <div class="col-md-12">
                        <div class="card" style="border-radius: 15px;">
                           
                           <div class="card-body">
                              <h3 class="h6 text-end mb-3">المعلومات الشخصية</h3>

                              <div class="row">
                                 <div class="col-sm-6   col-lg-3 mb-3 form-group">
                                    <label for="firstNameArabe" class="form-label text-end d-block">الاسم الشخصي</label>
                                    <input type="text" class="form-control mb-2" id="firstNameArabe"
                                       name="firstNameArabe" dir="rtl" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="lastNameArabe" class="form-label text-end d-block">الاسم العائلي</label>
                                    <input type="text" class="form-control mb-2" id="lastNameArabe" name="lastNameArabe"
                                       dir="rtl" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="firstName" class="form-label text-end d-block">الاسم الشخصي
                                       بالفرنسية</label>
                                    <input type="text" class="form-control mb-2" id="firstName" name="firstName"
                                       dir="rtl" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="lastName" class="form-label text-end d-block">الاسم العائلي
                                       بالفرنسية</label>
                                    <input type="text" class="form-control mb-2" id="lastName" name="lastName"
                                       dir="rtl" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="cin" class="form-label text-end d-block"> رقم البطاقة الوطنية </label>
                                    <input type="text" class="form-control mb-2" id="cin" name="cin" dir="rtl" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="birthDate" class="form-label text-end d-block">تاريخ الازدياد</label>
                                    <input type="date" class="form-control mb-2" id="birthDate" name="birthDate"
                                       dir="rtl" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="birthPlace" class="form-label  text-end d-block">مكان الازدياد</label>
                                    <input type="text" class="form-control mb-2" id="birthPlace" name="birthPlace"
                                       dir="rtl" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">

                                    <label for="birthPlace" class="form-label  text-end d-block">النوع</label>

                                    <div class="row">
                                       <div class="col-sm-4 d-flex gap-2">
                                          <label class="form-check-label text-end d-block" for="male">ذكر</label>
                                          <input class="form-check-input mb-2 " type="radio" name="sex" id="male"
                                             value="Homme" />
                                       </div>
                                       <div class="col-sm-4  d-flex gap-2">
                                          <label class="form-check-label text-end d-block" for="female">أنثى</label>
                                          <input class="form-check-input mb-2 " type="radio" name="sex" id="female"
                                             value="Femme" />
                                       </div>
                                       <div class="col-sm-4">

                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-12  col-lg-3 mb-3 form-group">
                                    <label for="image" class="form-label  text-end d-block">الصورة</label>
                                    <input type="file" class="form-control mb-2" id="image" name="image"
                                       accept="image/*" dir="ltr" />
                                    <div id="imagePreview" class="justify-self-center"></div>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- END INFORMATION PERSONNELLES -->
                  <!-- START INFORMATION SCOLAIRE -->
                  <div class="row mt-3" dir="rtl">
                     <div class="col-md-12">
                        <div class="card" style="border-radius: 15px;">
                           <div class="card-body">
                              <h3 class="h6 text-end mb-3">المعلومات المدرسية</h3>

                              <div class="row">
                                 <div class="col-sm-6   col-lg-3 mb-3 form-group">
                                    <label for="codeMassar" class="form-label">رمز مسار</label>
                                    <input type="text" class="form-control mb-2" id="codeMassar" name="codeMassar" />
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="sector" class="form-label">الشعبة</label>
                                    <select class="form-select mb-2" name="sector" id="sector">
                                        <option selected disabled>اختر الشعبة</option>
                                    </select>
                                 </div>

                                 <!-- <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="bacYear" class="form-label">سنة الباكالوريا</label>
                                       <select class="form-select mb-2" name="bacYear" id="bacYear">
                                          <option selected disabled>اختر سنة الباكالوريا</option>
                                          
                                       </select>
                                 </div> -->
                                 <div class="col-sm-6  col-lg-3 mb-3 form-group" id="bacYearCont"></div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="region" class="form-label">الجهة</label>
                                       <select class="form-select mb-2" name="region" id="region">
                                          <option selected disabled>اختر الجهة</option>
                                       </select>
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="city" class="form-label">المدينة</label>
                                    <select class="form-select mb-2" name="city" id="city">
                                        <option selected disabled>اختر المدينة</option>
                                    </select>
                                 </div>

                                 <div class="col-sm-6  col-lg-3 mb-3 form-group">
                                    <label for="school" class="form-label">المؤسسة</label>
                                       <select class="form-select mb-2" name="school" id="school">                                                                                  
                                       </select>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- END INFORMATION SCOLAIRE -->
                  <!-- START DOCUMENTD -->
                  <!-- <div class="row mt-3" dir="rtl">
                     <div class="col-md-12">
                        <div class="card" style="border-radius: 15px;">
                           <div class="card-body">
                              <h3 class="h6 text-end mb-3">الوثائق الشخصية</h3>

                              <div class="row">
                                 <div class="col-sm-12   col-lg-4 mb-3 form-group">
                                    <label for="codeMassar" class="form-label">البطاقة الوطنية</label>
                                    <input type="file" class="form-control mb-2" id="codeMassar" name="codeMassar" dir="ltr" />
                                 </div>

                                 <div class="col-sm-12  col-lg-4 mb-3 form-group">
                                    <label for="codeMassar" class="form-label">بيان النقط</label>
                                    <input type="file" class="form-control mb-2" id="codeMassar" name="codeMassar" dir="ltr" />
                                 </div>

                                 <div class="col-sm-12  col-lg-4 mb-3 form-group">
                                    <label for="codeMassar" class="form-label">الشهادة / الدبلوم</label>
                                    <input type="file" class="form-control mb-2" id="codeMassar" name="codeMassar" dir="ltr" />
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <!-- END DOCUMENTS -->
                  <!-- START INFORMATION CONTACT -->
                  <div class="row mt-3" dir="rtl">
                     <div class="col-md-12">
                        <div class="card" style="border-radius: 15px;">
                           <div class="card-body">
                              <h3 class="h6 text-end mb-3">معلومات الاتصال</h3>

                              <div class="row">
                                 <div class="col-sm-6   col-lg-4 mb-3 form-group">
                                    <label for="adress" class="form-label">العنوان </label>
                                    <input type="text" class="form-control mb-2" id="adress" name="adress"
                                        placeholder="العنوان" />
                                 </div>

                                 <div class="col-sm-6   col-lg-4 mb-3 form-group">
                                    <label for="zipCode" class="form-label">الرمز البريدي</label>
                                    <input type="text" class="form-control mb-2" id="zipCode" name="zipCode"
                                        placeholder="أدخل الرمز البريدي" />
                                 </div>

                                 <div class="col-sm-6  col-lg-4 mb-3 form-group">
                                    <label for="email" class="form-label">البريد الالكتروني</label>
                                    <input type="email" class="form-control mb-2" id="email" name="email"
                                           value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>"
                                           placeholder="أدخل البريد الالكتروني" readonly />
                                 </div>

                                 <div class="col-sm-6  col-lg-4 mb-3 form-group">
                                    <label for="phoneNumber" class="form-label mb-2">رقم الهاتف</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                        placeholder="0612345678" dir="ltr">
                                 </div>

                                 <div class="col-sm-6  col-lg-4 mb-3 form-group">
                                    <label for="parentPhone" class="form-label mb-2"> رقم هاتف الأب / ولي الأمر</label>
                                    <input type="tel" class="form-control" id="parentPhone" name="parentPhone"
                                        placeholder="0612345678" dir="ltr">
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- END INFORMATION CONTACT -->
                  <!--START  BUTTON SUBMIT -->
                  <div class="row d-flex justify-content-end">
                        <div class='col-sm-4 col-md-3  submitdiv'>
                           <button type="submit" name="register" id="register"
                           class="form-control btn btn-primary py-2 px-4 my-3 fs-4 rounded-pill">التسجيل</button>
                        </div>
                  </div>
                  <!--END BUTTON SUBMIT -->

               </form>

            </div>

         </div>

      </div>
   </section>
       
   <!-- jQuery Scripts -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
   integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <!-- END JQUERY -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js"
   integrity="sha512-p+GPBTyASypE++3Y4cKuBpCA8coQBL6xEDG01kmv4pPkgjKFaJlRglGpCM2OsuI14s4oE7LInjcL5eAUVZmKAQ=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
   integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_ar.min.js"
   integrity="sha512-nb2K94mYysmXkqlnVuBdOagDjQ2brfrCFIbfDIwFPosVjrIisaeYDxPvvr7fsuPuDpqII0fwA51IiEO6GulyHQ=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
   integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
   integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js"
   integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script>
        var base_url = "<?= BASE_URL ?>";        
   </script>

   <script>
        $(document).ready(function () {
            //SI  http://localhost/tawjihwebsite/?page=complete&email=lafhalkhalid@gmail.com&token=lkkgjjgjgjgjgkksle
            //SINON
            // change ./ to ../../c....... 
            $.ajax({
                method: 'GET',
                url: './controllers/ajax.php',
                data: { sector: $('#sector').attr('name') },
                success: function (data) {
                    $('#sector').append(data);
                }
            });

            $.ajax({
                method: 'GET',
                url: './controllers/ajax.php',
                data: { region: $('#region').attr('name') },
                success: function (data) {
                    $('#region').append(data);
                }
            });

            if ($('#region').change(function () {
                $.ajax({
                    method: 'GET',
                    url: './controllers/ajax.php',
                    data: { city: $('#city').attr('name'), idregion: $('#region').val() },
                    success: function (data) {
                        $('#city').empty();
                        $('#city').append("<option selected disabled>اختر المدينة</option>");
                        $('#city').append(data);

                    }
                });
            }));

            /* if($('#city').change(function(){ */
                $.ajax({
                    method:'GET',
                    url:'./controllers/ajax.php',
                    data:{school:$('#school').attr('name'),/* idcity:$('#city').val() */},
                    success:function(data){
                        $('#school').empty();
                        $('#school').append("<option selected disabled>اختر المؤسسة</option>");
                        $('#school').append(data); 
                    }
                });
           /*  })); */
        })
    </script>
    
    <!-- change ./ to ../../v.... -->
    <script src="./views/assets/js/complete-profile.js"></script>

</body>

</html>