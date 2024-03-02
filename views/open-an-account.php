<?php
include "./models/db.php";
$db = new Db();
if (!isset($_GET['id_pack'])) {
   header('Location: ' . BASE_URL);
} else {
   $id_pack = $_GET['id_pack'];
   $res = $db->selectDb("SELECT prixPack FROM packs where idPack = $id_pack")->fetch(PDO::FETCH_OBJ);
   if ($res) {
      $price = $res->prixPack;
   } else {
      header('Location: ' . BASE_URL);
   }
}
?>

<!doctype html>
<html lang="en">

<?php include('./views/assets/inlcudes/head.php') ?>
<style>
   #connect {
      background-image: url('./views/assets/images/slide/vasily-koloda-8CqDvPuo_kI-unsplash.jpg');
      background-position: center;
      background-size: cover;
   }

   .rounded {
      border-radius: 1rem
   }

   .nav-pills .nav-link {
      color: #555
   }

   .nav-pills .nav-link.active {
      color: white
   }

   input[type="radio"] {
      margin-right: 5px
   }

   .bold {
      font-weight: bold
   }
</style>

<body id="section_1">
   <?php include('./views/assets/inlcudes/head-info-site.php') ?>
   <!-- NAVBAR -->
   <?php include('./views/assets/inlcudes/navbar.php') ?>
   <!-- END NAVBAR -->
   <!-- MAIN -->

   <main>
      <section class="volunteer-section section-padding" id="connect">
         <div class="container">
            <div class="row">

               <div class="col-lg-12 col-12">
                  <!-- <h2 class="mb-4" style="text-align: center;color: #5bc1ac;"> أفتح حساب الأن</h2> -->

                  <form class="custom-form volunteer-form mb-5 mb-lg-0" role="form" id="form_openaccount">
                     <h3 class="mb-4" style="text-align: center;">أفتح حساب الأن</h3>
                     <div class="row">
                        <p id="error" style="display: none;padding-right: 10px;background-color: #FA8865;" dir='rtl'>
                        </p>
                        <div class="col-lg-6 col-12 order-1 order-lg-2" dir="rtl">
                           <input type="text" name="nomStd" id="nomStd" class="form-control" placeholder="النسب">
                           <input type="text" value="<?php echo $_GET['id_pack']; ?>" name="id_pack" hidden>

                        </div>

                        <div class="col-lg-6 col-12 order-1 order-lg-2" dir="rtl">
                           <input type="text" name="prenomStd" id="prenomStd" class="form-control" placeholder="الاسم">
                        </div>

                        <div class="col-lg-6 col-12 order-1 order-lg-2" dir="rtl">
                           <input type="text" name="phoneStd" id="phoneStd" class="form-control" placeholder="الهاتف">
                        </div>

                        <div class="col-lg-6 col-12 order-1 order-lg-2" dir="rtl">
                           <input type="email" name="emailStd" id="emailStd" class="form-control" placeholder="البريد الالكتروني">
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="" class="text-dark d-block" style="font-size: 20px;text-align: right;">طريقة
                                 الدفع</label>

                              <div class="row">
                                 <div class='col-md-12 d-flex gap-4 justify-content-end'>
                                    <div>
                                       <input type="radio" value="1" name="methodePayment" id="methodePaymentOnlin" style="width: 15px;height: 15px;font-size: 18px;">
                                       <label for="" style="font-size: 18px;">بطاقة بنكية</label>
                                    </div>
                                    <div>
                                       <input type="radio" value="0" name="methodePayment" id="methodePaymentCache" style="width: 15px;height: 15px;">
                                       <label for="" style="font-size: 18px;">دفع نقدا</label>
                                    </div>

                                 </div>

                              </div>

                           </div>
                        </div>
                     </div>
                     <!-- payment -->
                     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
                     <div class="container py-5">
                        <div class="mb-5" id="paymentCard">
                           <div class="row mb-4">
                              <div class="col-lg-8 mx-auto text-center">
                                 <h1 class="display-6">الدفع الالكتروني</h1>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-6 mx-auto">
                                 <div class="card ">
                                    <div class="card-header">
                                       <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">

                                          <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                             <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active"> <i class="fas fa-credit-card mr-2"></i> Carte de crédit </a> </li>
                                          </ul>
                                       </div>

                                       <div class="tab-content">
                                          <?php
                                          // get a Secret key stripe from database
                                          $stripe_data = $db->selectDb("SELECT * FROM stripe_account")->fetch(PDO::FETCH_OBJ);
                                          if ($stripe_data) {
                                             $secret_key = $stripe_data->secret_key;
                                             $publishable_key = $stripe_data->publishable_key;
                                          }
                                          require_once "./controllers/stripe-php-master/init.php";
                                          $amount = $price / 10;
                                          $stripe = new \Stripe\StripeClient($secret_key);

                                          try {
                                             // creating setup intent
                                             $payment_intent = $stripe->paymentIntents->create([
                                                'payment_method_types' => ['card'],

                                                // convert double to integer for stripe payment intent, multiply by 100 is required for stripe
                                                'amount' => $amount * 100,
                                                'currency' => 'usd',
                                             ]);
                                          } catch (\Stripe\Exception\ApiConnectionException $e) {
                                             // Handle API connection errors
                                             // Display an error message or perform appropriate actions
                                             echo "Erreur de connexion à l'API Stripe. S'il vous plait, vérifiez votre connexion internet.";
                                             exit;
                                          } catch (\Stripe\Exception\InvalidRequestException $e) {
                                             // Handle invalid requests to the Stripe API
                                             // Display an error message or perform appropriate actions
                                             echo "Erreur de connexion à l'API Stripe. S'il vous plait, vérifiez votre connexion internet.";
                                             echo "<script>console.log('Requête non valide à l\'API Stripe. Veuillez réessayer plus tard.')</script>";
                                             exit;
                                          } catch (\Stripe\Exception\AuthenticationException $e) {
                                             // Handle authentication errors with the Stripe API
                                             // Display an error message or perform appropriate actions
                                             echo "Erreur de connexion à l'API Stripe. S'il vous plait, vérifiez votre connexion internet.";
                                             echo "<script>console.log('L\'authentification a échoué avec l\'API Stripe. Veuillez vérifier vos clés API')</script>";
                                             exit;
                                          }

                                          ?>
                                          <div id="credit-card" class="tab-pane fade show active pt-3">
                                             <form id="form_payment" role="form" onsubmit="event.preventDefault()">
                                                <p id="error_payment" class="text-danger" style="display: none;padding-right: 10px;">
                                                <div class="form-group"> <label for="user-email">Email <span class="text-danger">*</span></label>
                                                   <input type="text" name="user-email" id="user-email" placeholder="Votre Eamil" class="form-control ">
                                                </div>
                                                <div class="form-group"> <label for="user-name">Nom complète <span class="text-danger">*</span></label>
                                                   <input type="text" name="user-name" id="user-name" placeholder="Votre nom complète" class="form-control ">
                                                </div>
                                                <div class="form-group"> <label for="user-mobile-number">Numéro de téléphone <span class="text-danger">*</span></label>
                                                   <input type="text" name="user-mobile-number" id="user-mobile-number" placeholder="Votre Numéro de téléphone" class="form-control ">
                                                </div>
                                                <input type="hidden" id="stripe-public-key" value="<?php echo $publishable_key ?>" />
                                                <input type="hidden" id="stripe-payment-intent" value="<?php echo $payment_intent->client_secret; ?>" />

                                                <div class="row d-flex justify-content-start w-100">
                                                   <div id="stripe-card-element" class="mb-5 mt-3"></div>
                                                </div>
                                                <div class="card-footer text-center"> <button class="subscribe btn btn-primary btn-block shadow-sm w-50" type="submit" onclick="payViaStripe();">
                                                      تأكيد الدفع</button>
                                             </form>
                                          </div>
                                       </div>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="d-flex justify-content-center">
                        <button type="submit" class="form-control w-50 btn" id='btnOpenAccount' value='signup'> تسجيل </button>
                     </div>

                     <div>
                        <a href="<?php echo BASE_URL ?>/se-connecter" class="d-flex flex-row-reverse link-success mt-2">لدي حساب بالفعل</a>
                     </div>

                  </form>
               </div>

            </div>
         </div>
      </section>

   </main>

   <!-- FOOTER -->

   <!-- END FOOTER -->
   <?php include('./views/assets/inlcudes/footer.php') ?>
   <!-- JAVASCRIPT FILES -->
   <!--start  fichier home page js  -->
   <script src="./views/assets/js/homePage.js"></script>
   <!--start  fichier home page js  -->
   <script src="./views/assets/js/jquery.min.js"></script>
   <script src="./views/assets/js/bootstrap.min.js"></script>
   <script src="./views/assets/js/jquery.sticky.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.4.1/jquery.appear.min.js"></script>
   <script src="./views/assets/js/custom.js"></script>
   <script src="./views/assets/js/open-account.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js" integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script>
      $(document).ready(function($) {
         $("#paymentCard").hide();
         $("#methodePaymentOnlin").change(function() {
            $("#paymentCard").show();
         })
         $("#methodePaymentCache").change(function() {
            $("#paymentCard").hide();
         })



      })
   </script>

   <!-- payment------------------------------------------------------------------------------------------------- -->

   <!-- include Stripe library -->
   <script src="https://js.stripe.com/v3/"></script>

   <script>
      var check_oayment = false;
      // global variables
      var stripe = null;
      var cardElement = null;

      const stripePublicKey = document.getElementById("stripe-public-key").value;

      // Check if Stripe is loaded
      if (typeof Stripe !== 'undefined') {
         // initialize stripe when page loads
         window.addEventListener("load", function() {
            stripe = Stripe(stripePublicKey);
            var elements = stripe.elements();
            cardElement = elements.create('card');
            cardElement.mount('#stripe-card-element');
         });
      } else {
         console.error('Stripe library not loaded.');
      }

      function payViaStripe() {
         if ($("#user-email").val() == '') {
            $("#error_payment").text("* Toutes les informations sont obligatoires");
            $("#error_payment").show();
            $("#user-email").focus();
         } else if ($("#user-name").val() == '') {
            $("#error_payment").text("* Toutes les informations sont obligatoires");
            $("#error_payment").show();
            $("#user-name").focus();
         } else if ($("#user-mobile-number").val() == '') {
            $("#error_payment").text("* Toutes les informations sont obligatoires");
            $("#error_payment").show();
            $("#user-mobile-number").focus();
         } else {
            $("#error_payment").hide();
            // get stripe payment intent
            const stripePaymentIntent = document.getElementById("stripe-payment-intent").value;

            // execute the payment
            stripe
               .confirmCardPayment(stripePaymentIntent, {
                  payment_method: {
                     card: cardElement,
                     billing_details: {
                        "email": document.getElementById("user-email").value,
                        "name": document.getElementById("user-name").value,
                        "phone": document.getElementById("user-mobile-number").value
                     },
                  },
               })
               .then(function(result) {

                  // Handle result.error or result.paymentIntent
                  if (result.error) {
                     console.log(result.error);
                     Swal.fire({
                        icon: "error",
                        title: "Erreur!!",
                        text: 'une erreur survenue'
                     });
                  } else {
                     console.log("The card has been verified successfully...", /* result.paymentIntent.id */ );

                     // [call AJAX function here]

                     confirmPayment(result.paymentIntent.id)
                  }
               });



            function confirmPayment(paymentId) {
               var ajax = new XMLHttpRequest();
               ajax.open("POST", "./controllers/stripe.php", true);

               ajax.onreadystatechange = function() {
                  if (this.readyState == 4) {
                     if (this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        const data = JSON.parse(this.responseText);
                        console.log(data.status);
                        if (data.status == "success") {
                           check_oayment = true;
                           Swal.fire({
                              icon: "success",
                              title: "Paiement effectué avec succès",
                           });
                           $("#user-mobile-number").val("")
                           $("#user-name").val("");
                           $("#user-email").val("");
                           $("#paymentCard").empty().html("<h3 class='text-success text-center'>Paiement effectué avec succès</h3>")
                        } else {
                           console.log(this.responseText);
                           Swal.fire({
                              icon: "error",
                              title: "Erreur!!",
                              text: 'une erreur survenue'
                           });
                        }
                     }

                     if (this.status == 500) {
                        console.log(this.responseText);
                        Swal.fire({
                           icon: "error",
                           title: "Erreur!!",
                           text: 'une erreur survenue'
                        });
                     }
                  }
               };

               var formData = new FormData();
               formData.append("payment_id", paymentId);
               ajax.send(formData);
            }
         }
      }
   </script>

</body>

</html>