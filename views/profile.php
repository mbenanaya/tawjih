<?php include('./controllers/session-student.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="utf-8">
    <title> موقع توجيه</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>  -->
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Profile Student</title>
    <style type="text/css">
        body {
            margin-top: 20px;
            background-color: #f2f6fc;
            color: #69707a;
        }

        .img-account-profile {
            height: 10rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .alert {
            border-radius: 0;
            -webkit-border-radius: 0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.11);
            display: table;
            width: 100%;
        }

        .alert-white {
            background-image: linear-gradient(to bottom, #fff, #f9f9f9);
            border-top-color: #d8d8d8;
            border-bottom-color: #bdbdbd;
            border-left-color: #cacaca;
            border-right-color: #cacaca;
            color: #404040;
            padding-left: 61px;
            position: relative;
        }

        .alert-white.rounded {
            border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        .alert-white.rounded .icon {
            border-radius: 3px 0 0 3px;
            -webkit-border-radius: 3px 0 0 3px;
        }

        .alert-white .icon {
            text-align: center;
            width: 45px;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border: 1px solid #bdbdbd;
            padding-top: 15px;
        }


        .alert-white .icon:after {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            display: block;
            content: '';
            width: 10px;
            height: 10px;
            border: 1px solid #bdbdbd;
            position: absolute;
            border-left: 0;
            border-bottom: 0;
            top: 50%;
            right: -6px;
            margin-top: -3px;
            background: #fff;
        }

        .alert-white .icon i {
            font-size: 20px;
            color: #fff;
            left: 12px;
            margin-top: -10px;
            position: absolute;
            top: 50%;
        }

        /*============ colors ========*/
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-white.alert-success .icon,
        .alert-white.alert-success .icon:after {
            border-color: #54a754;
            background: #60c060;
        }

        .alert-info {
            background-color: #d9edf7;
            border-color: #98cce6;
            color: #3a87ad;
        }

        .alert-white.alert-info .icon,
        .alert-white.alert-info .icon:after {
            border-color: #3a8ace;
            background: #4d90fd;
        }


        .alert-white.alert-warning .icon,
        .alert-white.alert-warning .icon:after {
            border-color: #d68000;
            background: #fc9700;
        }

        .alert-warning {
            background-color: #fcf8e3;
            border-color: #f1daab;
            color: #c09853;
        }

        .alert-danger {
            background-color: #f2dede;
            border-color: #e0b1b8;
            color: #b94a48;
        }

        .alert-white.alert-danger .icon,
        .alert-white.alert-danger .icon:after {
            border-color: #ca452e;
            background: #da4932;
        }

        #text {
            direction: rtl;
            unicode-bidi: bidi-override;
        }
    </style>
</head>

<body>
    <!-- start header  -->
    <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
        <?php include('./views/assets/inlcudes/header-student.php');  ?>
    </header>
    <!-- end header  -->
    <!-- start sidebar  -->
    <aside id="sidebar" class="sidebar">
        <?php include('./views/assets/inlcudes/sidebar-student.php'); ?>
    </aside>
    <!-- end  sidebar  -->
    <!--Show All Notifications Modal -->
   <div class="modal fade" id="allNotifsModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="ModalLabel">كل الاشعارات</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <ul id="all_notifs" class="list-unstyled"></ul>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
            </div>
         </div>
      </div>
   </div>

    <main id="main" class="main">
        <div class="container-xl px-4 mt-4">
            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-2 d-flex align-items-center">
                <!-- <h1>Dashboard</h1> -->
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL . '/dashboard-student' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="alert alert-success alert-white rounded text-end" style="display:none;">
                
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <strong>Success!</strong>
                تم إرسال طلبك بنجاح ،سيتم الرد عليك قريبًا
            </div>
            <div class="alert alert-info alert-white rounded text-end" style="display:none;">
                
                <div class="icon">
                    <i class="fa fa-info-circle"></i>
                </div>
                <strong> هام</strong>!
                تم قبول طلبك, يمكنك الان تغيير معلوماتك وحفظها
            </div>
            <div class="alert alert-warning alert-white rounded text-end" style="display:none;">
                
                <div class="icon">
                    <i class="fa fa-warning"></i>
                </div>
                <strong>هام</strong>!
                تم رفض طلبك ، لن تتمكن من تعديل معلوماتك
            </div>
            <nav class="nav nav-borders" dir='rtl'>
                <!-- <a class="nav-link active ms-0" href="./dashboard-student">العودة</a> -->
                <span>مرحبا <span id='helloName'></span>,</span>
            </nav>
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <form id="form">
                        <input type="hidden" name="update_info" value="update_info" />
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header d-block text-end" id='text'>الصورة الشخصيه</div>
                            <div class="card-body text-center">

                                <img class="img-account-profile rounded-circle mb-2" id='photo' alt="photo profile">

                                <button class="btn btn-primary" type="button" id="button_photo" disabled>تحميل صورة جديدة </button>
                                <input type="file" name="photo_profile" id="photo_profile" hidden>
                            </div>
                        </div>
                        <div class="card mb-4 mt-4 mb-xl-0">
                            <div class="card-header mt-2 d-block text-end" id='text'>الوثائق الشخصيه</div>
                            <label class="fw-bold px-2 mt-2 d-block text-end"><span>أو مستندات ممسوحة ضوئيا</span> pdf يمكن تحميل الوثائق على صيغة </label>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="codeMassar" class="form-label d-block text-end">البطاقة الوطنية</label>
                                    <input type="file" class="form-control mb-2" id="carte_cin" name="carte_cin" dir="ltr" disabled />                                                                      
                                        <div class='file-img-box mt-3 text-center'>                                                                                             
                                            <a class='file-download' target='_blanck' title='Télècharger' id="file_carte_cin">Voir et télécharger <i class='fa fa-download'></i></a> 
                                        </div>                                                                                   
                                </div>

                                <div class="form-group mb-3">
                                    <label for="codeMassar" class="form-label d-block text-end">بيان النقط</label>
                                    <input type="file" class="form-control mb-2" id="relve_notes" name="relve_notes" dir="ltr" disabled />                                    
                                    <div class='file-img-box mt-3 text-center'>                                                                                             
                                        <a class='file-download' target='_blanck' title='Télècharger' id="file_relve_notes">Voir et télécharger <i class='fa fa-download'></i></a> 
                                    </div> 
                                </div>

                                <div class="form-group mb-3">
                                    <label for="codeMassar" class="form-label d-block text-end">الشهادة / الدبلوم</label>
                                    <input type="file" class="form-control mb-2" id="diplom_doc" name="diplom_doc" dir="ltr" disabled />
                                    <div class='file-img-box mt-3 text-center'>                                                                                             
                                        <a class='file-download' target='_blanck' title='Télècharger' id="file_diplom_doc">Voir et télécharger <i class='fa fa-download'></i></a> 
                                    </div> 
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-xl-8">

                    <div class="card mb-4">
                        <div class="card-header d-block text-end">بياناتي الشخصية</div>
                        <div class="card-body">


                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputLastNameArab"> النسب</label>
                                    <input class="form-control" id="inputLastNameArab" name="inputLastNameArab" type="text" readonly='' value="" dir="rtl">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputFirstNameArab">الاسم الشخصي</label>
                                    <input class="form-control" id="inputFirstNameArab" name="inputFirstNameArab" type="text" readonly value="" dir="rtl">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstNameFR">Prénom</label>
                                    <input class="form-control" id="inputFirstNameFR" name="inputFirstNameFR" type="text" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastNameFR">Nom</label>
                                    <input class="form-control" id="inputLastNameFR" name="inputLastNameFR" type="text" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>


                            </div>

                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="date_n">تاريخ الازدياد</label>
                                    <input class="form-control" id="date_n" name="date_n" type="date" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputLocation">مكان الازدياد</label>
                                    <input class="form-control" id="inputLocation" name="inputLocation" type="text" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>
                            </div>

                            <div class="card-header d-block text-end">بياناتي المدرسية</div>

                            <div class="row gx-3 mb-3">



                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputsector">الشعبة</label></label>
                                    <!-- <input class="form-control" id="inputsector" type="text" name="birthday" readonly value="" dir='rtl'> -->
                                    <select class="form-select mb-2" name="inputsector" id="inputsector" dir='rtl' disabled>                                        
                                    </select>
                                    <span class="error text-danger">* champ obligatoire</span>                                    
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputRegion">الجهة</label>
                                    <!-- <input class="form-control" id="inputRegion" type="text" readonly value=""> -->
                                    <select class="form-select mb-2" name="region" id="inputRegion" disabled>                                        
                                    </select>
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputCity">المدينة</label>
                                    <!-- <input class="form-control" id="inputCity" type="text" readonly value=""> -->
                                    <select class="form-select mb-2" name="city" id="inputCity" disabled></select>
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>                                
                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputLycee">المؤسسة</label>
                                    <!-- <input class="form-control" id="inputLycee" type="text" readonly value=""> -->
                                    <select class="form-select mb-2" name="lycee" id="inputLycee" disabled></select>
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputCin">رقم بطاقة التعريف الوطنية</label>
                                    <input class="form-control" id="inputCin" name="number_Cin" type="text" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputCne">رقم مسار/Code Massar</label>
                                    <input class="form-control" id="inputCne" name="inputCne" type="text" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputBacYear">سنة الباكالوريا</label>
                                    <input class="form-control" id="inputBacYear" name="inputBacYear" type="number" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>


                                <div class="card-header d-block text-end">بيانات الاتصال</div>


                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputPhone">رقم الهاتف</label>
                                    <input class="form-control" id="inputPhone" name="inputPhone" type="tel" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputPhoneParent">رقم هاتف الأب / ولي الأمر</label>
                                    <input class="form-control" id="inputPhoneParent" name="inputPhoneParent" type="tel" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputAdress">العنوان</label>
                                    <textarea class="form-control" id="inputAdress" name="inputAdress" readonly value=""></textarea>
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>



                                <div class="col-md-6">
                                    <label class="small mb-1 d-block text-end" for="inputEmail">البريد الالكتروني</label>
                                    <input class="form-control" id="inputEmail" name="inputEmail" type="email" readonly value="">
                                    <span class="error text-danger">* champ obligatoire</span>
                                </div>

                            </div>

                            <div style="display:none;" id="save_button"><input class="btn btn-success" type="submit" value="Sauvegarder"></div>
                            </form>
                            <div class="d-flex justify-content-center mt-4"><button class="btn btn-primary" id="request_button" type="button">طلب تعديل البيانات</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start  CHAT AREAT FOR STUDENT -->
            <?php include('./views/chat.php'); ?>
            <!--end  CHAT AREAT FOR STUDENT -->
        </div>
    </main>
    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
    <!-- end scripts  -->
    <!-- script-dashboard-student  -->
    <?php //include('./views/assets/inlcudes/script-dashboard-student.php'); ?>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- JavaScript sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script type="text/javascript">
        $(document).ready(function($) {            
           
                $.ajax({
                    type: 'POST',
                    url: "./controllers/ajax.php",
                    dataType: 'json',
                    data: {
                        profile: 'profile',
                        email: "<?php echo $_SESSION['email_student']; ?>",
                        password: "<?php echo $_SESSION['password_student']; ?>"
                    },
                    success: function(response) {
                        console.log(response)
                        if(response.result == "success"){
                            $('#inputFirstNameArab').val(response.data['firstNameArabe'])
                            $('#inputLastNameArab').val(response.data['lastNameArabe'])
                            $('#inputFirstNameFR').val(response.data['firstName'])
                            $('#inputLastNameFR').val(response.data['lastName'])
                            $('#date_n').val(response.data['dateBirth'])
                            $('#inputLocation').val(response.data['placeBirth'])
                            $('#inputsector').html(response.bacs)                            
                            $('#inputRegion').html(response.region)                            
                            $('#inputCity').html(response.city)                                                        
                            $('#inputLycee').html(response.lycee)                                                                                    
                            $('#inputBacYear').val(response.data['bacYear'])
                            $('#inputPhone').val(response.data['phone'])
                            $('#inputPhoneParent').val(response.data['parentPhone'])
                            $('#inputAdress').val(response.data['address'])
                            $('#inputEmail').val(response.data['email'])
                            $('#inputCne').val(response.data['codeMassar'])
                            $('#inputCin').val(response.data['cin'])
                            $('#photo').attr('src', response.data['photo'])

                            // attachment :
                            if(!(response.data['attachment_cin'] == '')){
                                $("#file_carte_cin").attr('href', response.data['attachment_cin'])
                            }else{
                                $("#file_carte_cin").hide()
                            } 

                            if(!(response.data['attachment_releve'] == '')){
                                $("#file_relve_notes").attr('href', response.data['attachment_releve'])
                            }else{
                                $("#file_relve_notes").hide()
                            } 

                            if(!(response.data['attachment_diplome'] == '')){
                                $("#file_diplom_doc").attr('href', response.data['attachment_diplome'])
                            }else{
                                $("#file_diplom_doc").hide()
                            }                          
                                                        
                            $('#helloName').html(`${response.data['firstNameArabe']} ${response.data['lastNameArabe']} `)

                            request();
                        }
                        
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.errorThrown);
                    }
                })
            
            
            
            // for select image profile
            $('#button_photo').on('click', function() {
                $('#photo_profile').trigger('click');
            });

            $('#photo_profile').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                //$('#button_photo').text(fileName);
            });
            // When the input file changes
            $('#photo_profile').change(function() {
                var file = this.files[0];
                var fileType = file.type.toLowerCase();

                if (fileType === 'image/jpeg' || fileType === 'image/jpg' || fileType === 'image/png' || fileType === 'image/gif') {
                    // File type is valid
                    console.log('Valid file type');
                    // Additional code to process the file can be added here
                } else {
                    // File type is invalid
                    console.log('Invalid file type');
                    $("#error_file").fadeIn().text("Type de fichier invalide !!").css('color', 'red');
                    // Reset the file input field to clear the selection
                    $(this).val('');
                }

                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Update the source of the image preview
                        $('#photo').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });
            // hide all alert
            $(".alert-success").hide();
            $(".alert-info").hide();
            $(".alert-warning").hide();

            $(".error").hide();

            function request() {
                $.ajax({
                    type: "GET",
                    url: "./controllers/request-controller.php",
                    data: {
                        request_state_student: "request_state_student",
                        id_student_state: $('#inputCne').val()
                    },
                    success: function(res) {
                        console.log(res)
                        if ($.trim(res) == "en-cours") {
                            $(".alert-success").hide();
                            $(".alert-info").hide();
                            $(".alert-warning").hide();

                            $(".alert-success").show();
                        } else if ($.trim(res) == "accept") {
                            $(".alert-success").hide();
                            $(".alert-info").hide();
                            $(".alert-warning").hide();

                            $(".alert-info").show()

                            $('#inputFirstNameArab').removeAttr("readonly");
                            $('#inputLastNameArab').removeAttr("readonly");
                            $('#inputFirstNameFR').removeAttr("readonly");
                            $('#inputLastNameFR').removeAttr("readonly");
                            $('#date_n').removeAttr("readonly");
                            $('#inputLocation').removeAttr("readonly");
                            $('#inputsector').removeAttr("disabled");
                            $('#inputRegion').removeAttr("disabled");
                            $('#inputCity').removeAttr("disabled");
                            $('#inputLycee').removeAttr("disabled");
                            $('#inputBacYear').removeAttr("readonly");
                            $('#inputPhone').removeAttr("readonly");
                            $('#inputPhoneParent').removeAttr("readonly");
                            $('#inputAdress').removeAttr("readonly");
                            //$('#inputEmail').removeAttr("readonly");
                            //$('#inputCne').removeAttr("readonly");
                            $('#inputCin').removeAttr("readonly");

                            $('#button_photo').removeAttr("disabled");
                            $('input[type=file]').removeAttr("disabled");

                            $('#request_button').hide();
                            $('#save_button').show();

                            $("#form").submit(function(e) {
                                e.preventDefault();
                                $(".error").hide();
                                var inputLastNameArab = $('#inputLastNameArab').val();
                                if (inputLastNameArab == '') {
                                    $(".error:first").show()
                                    //:eq(1)
                                    $("#inputLastNameArab").focus();
                                    return false;
                                }
                                var inputFirstNameArab = $('#inputFirstNameArab').val();
                                if (inputFirstNameArab == '') {
                                    $(".error:eq(1)").show()
                                    $("#inputFirstNameArab").focus();
                                    return false;
                                }
                                var inputFirstNameFR = $('#inputFirstNameFR').val();
                                if (inputFirstNameFR == '') {
                                    $(".error:eq(2)").show()
                                    $("#inputFirstNameFR").focus();
                                    return false;
                                }
                                var inputLastNameFR = $('#inputLastNameFR').val();
                                if (inputLastNameFR == '') {
                                    $(".error:eq(3)").show()
                                    $("#inputLastNameFR").focus();
                                    return false;
                                }
                                var date_n = $('#date_n').val();
                                if (date_n == '') {
                                    $(".error:eq(4)").show()
                                    $("#date_n").focus();
                                    return false;
                                }
                                var inputLocation = $('#inputLocation').val();
                                if (inputLocation == '') {
                                    $(".error:eq(5)").show()
                                    $("#inputLocation").focus();
                                    return false;
                                }
                                var inputsector = $('#inputsector').val();
                                if (inputsector == '') {
                                    $(".error:eq(6)").show()
                                    $("#inputsector").focus();
                                    return false;
                                }
                                var inputRegion = $('#inputRegion').val();
                                if (inputRegion == '') {
                                    $(".error:eq(7)").show()
                                    $("#inputRegion").focus();
                                    return false;
                                }
                                var inputCity = $('#inputCity').val();                                
                                if (inputCity == '') {
                                    $(".error:eq(8)").show()
                                    $("#inputCity").focus();
                                    return false;
                                }
                                var inputLycee = $('#inputLycee').val();
                                if (inputLycee == '') {
                                    $(".error:eq(9)").show()
                                    $("#inputLycee").focus();
                                    return false;
                                }
                                var inputCin = $('#inputCin').val();
                                if (inputCin == '') {
                                    $(".error:eq(10)").show()
                                    $("#inputCin").focus();
                                    return false;
                                }
                               /*  var inputCne = $('#inputCne').val();
                                if (inputCne == '') {
                                    $(".error:eq(11)").show()
                                    $("#inputCne").focus();
                                    return false;
                                } */
                                var inputBacYear = $('#inputBacYear').val();
                                if (inputBacYear == '') {
                                    $(".error:eq(12)").show()
                                    $("#inputBacYear").focus();
                                    return false;
                                }
                                var inputPhone = $('#inputPhone').val();
                                if (inputPhone == '') {
                                    $(".error:eq(13)").show()
                                    $("#inputPhone").focus();
                                    return false;
                                }
                                var inputPhoneParent = $('#inputPhoneParent').val();
                                if (inputPhoneParent == '') {
                                    $(".error:eq(14)").show()
                                    $("#inputPhoneParent").focus();
                                    return false;
                                }
                                var inputAdress = $('#inputAdress').val();
                                if (inputAdress == '') {
                                    $(".error:eq(15)").show()
                                    $("#inputAdress").focus();
                                    return false;
                                }
                               /*  var inputEmail = $('#inputEmail').val();
                                if (inputEmail == '') {
                                    $(".error:eq(16)").show()
                                    $("#inputEmail").focus();
                                    return false;
                                } */
                                $.ajax({
                                    type: 'POST',
                                    url: "./controllers/request-controller.php",
                                    data: new FormData(this),
                                    cache: false,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        console.log(response);
                                        if ($.trim(response) == "update") {
                                            Swal.fire({
                                                //position: 'top-end',
                                                icon: 'success',
                                                title: 'Votre formation a été modifié avec success',
                                                showConfirmButton: false,
                                                timer: 2000
                                            })                                            
                                            location.reload();
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Une erreur est survenue',
                                                text: 'Veuillez réessayer',
                                                showConfirmButton: true,
                                            })
                                        }

                                    }
                                })
                            })

                        } else if ($.trim(res) == "refuse") {
                            $(".alert-success").hide();
                            $(".alert-info").hide();
                            $(".alert-warning").hide();

                            $(".alert-warning").show()

                            $('#request_button').show();
                            $('#save_button').hide();
                        } else {
                            $(".alert-success").hide();
                            $(".alert-info").hide();
                            $(".alert-warning").hide();

                            $('#request_button').show();
                            $('#save_button').hide();
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.errorThrown);
                    }
                })

                //  Requests update data
                $("#request_button").click(function() {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/request-controller.php",
                        data: {
                            codeMassar_student: $('#inputCne').val()
                        },
                        success: function(res) {
                            console.log(res)
                            if ($.trim(res) == "submited") {
                                $(".alert-success").show();
                                Swal.fire(
                                    'success!',
                                    ' تم إرسال طلبك بنجاح ،سيتم الرد عليك قريبًا',
                                    'success',
                                )
                            } else if ($.trim(res) == "already sent") {
                                Swal.fire({
                                    title: 'déjà vous avez envoyé une demande',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(xhr.errorThrown);
                        }
                    })
                })
            }
        

        })
    </script>
</body>

</html>