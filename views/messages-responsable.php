<?php
include('./controllers/SessionResponsable.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link href="./views/assets/css/bootstrap.min.css" rel="stylesheet"> -->

   <link href="./views/assets/css/messages.css" rel="stylesheet">
   <link rel="shortcut icon" href="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png"
    type="image/x-icon">

   <title>Messages | Responsable</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
      integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
   </script>
</head>

<body style="background-color: #A7B5FE;">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <div class="container app">
      <div class="row app-one">
         <div class="col-sm-4 side">
            <div class="side-one">
               <div class="row heading">
                  <div class="col-sm-3 col-xs-3 heading-avatar">
                     <div class="heading-avatar-icon">
                        <img src="./views/assets/images/images-admin/<?php echo $_SESSION['RESPONSABLEINFO']['photo']?>">
                     </div>
                  </div>
                  <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                     <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                  </div>
                  <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
                     <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
                  </div>
               </div>

               <div class="row searchBox">
                  <div class="col-sm-12 searchBox-inner">
                     <div class="form-group has-feedback">
                        <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                     </div>
                  </div>
               </div>

               <div class="row sideBar" id="sideBarMessagesStudent">
<!-- 
                  <div class="row sideBar-body">
                     <a href="">
                     <div class="col-sm-3 col-xs-3 sideBar-avatar">
                        <div class="avatar-icon">
                           <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                        </div>
                     </div>
                     <div class="col-sm-9 col-xs-9 sideBar-main">
                        <div class="row">
                           <div class="col-sm-8 col-xs-8 sideBar-name">
                              <span class="name-meta">khalid</span>
                           </div>
                           <div class="col-sm-4 col-xs-4 pull-right sideBar-time" style="display: flex;justify-content: end;flex-direction:column;">
                              <div style="height:30px;width: 30px;right: 0px;">
                                 <span class="time-meta pull-right">18:18</span>
                              </div>
                              <div 
                              style="width: 20px; height:20px;border-radius:30%
                              ;background-color: red;color: white;font-size: 10px;margin-top: -10px;display: flex;justify-content: center;align-items: center;">
                              2
                              </div>
                           </div>
                        </div>
                     </div>
                     </a>
                  </div> -->




               </div>
            </div>

            <div class="side-two">
               <div class="row newMessage-heading">
                  <div class="row newMessage-main">
                     <div class="col-sm-2 col-xs-2 newMessage-back">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     </div>
                     <div class="col-sm-10 col-xs-10 newMessage-title">
                        Messages Admins
                     </div>
                  </div>
               </div>

               <div class="row composeBox">
                  <div class="col-sm-12 composeBox-inner">
                     <div class="form-group has-feedback">
                        <input id="composeText" type="text" class="form-control" name="searchText"
                           placeholder="Search People">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                     </div>
                  </div>
               </div>

               <div class="row compose-sideBar" id="sideBarTwoListAmins">

                  <div class="row sideBar-body">
                     <div class="col-sm-3 col-xs-3 sideBar-avatar">
                        <div class="avatar-icon">
                           <img src="https://bootdey.com/img/Content/avatar/avatar3.png">
                        </div>
                     </div>
                     <div class="col-sm-9 col-xs-9 sideBar-main">
                        <div class="row">
                           <div class="col-sm-8 col-xs-8 sideBar-name">
                              <span class="name-meta">khalid
                              </span>
                           </div>
                           <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                              <span class="time-meta pull-right">18:18
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row sideBar-body">
                     <div class="col-sm-3 col-xs-3 sideBar-avatar">
                        <div class="avatar-icon">
                           <img src="https://bootdey.com/img/Content/avatar/avatar4.png">
                        </div>
                     </div>
                     <div class="col-sm-9 col-xs-9 sideBar-main">
                        <div class="row">
                           <div class="col-sm-8 col-xs-8 sideBar-name">
                              <span class="name-meta">khalid
                              </span>
                           </div>
                           <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                              <span class="time-meta pull-right">18:18
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row sideBar-body">
                     <div class="col-sm-3 col-xs-3 sideBar-avatar">
                        <div class="avatar-icon">
                           <img src="https://bootdey.com/img/Content/avatar/avatar5.png">
                        </div>
                     </div>
                     <div class="col-sm-9 col-xs-9 sideBar-main">
                        <div class="row">
                           <div class="col-sm-8 col-xs-8 sideBar-name">
                              <span class="name-meta">khalid
                              </span>
                           </div>
                           <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                              <span class="time-meta pull-right">18:18
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      
         </div>


         <div class='col-sm-8'>

         </div>

   </div>

   <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
   <script src="./views/assets/js/chat/messages-responsable.js"></script>
   <script>
      $(function() {
         $(".heading-compose").click(function() {
            $(".side-two").css({
               "left": "0"
            });
         });
         $(".newMessage-back").click(function() {
            $(".side-two").css({
               "left": "-100%"
            });
         });
      })
   </script>

   </div>

</body>

</html>