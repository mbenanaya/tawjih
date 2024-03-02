<?php
   include('./controllers/session-admin.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css"
   	integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA=="
   	crossorigin="anonymous" referrerpolicy="no-referrer" />
   	<style>
   		.required {
				color: red;
				margin-left: 0.3rem;
				font-size: 18px;
				font-weight: 600;
   		}
   		.error {
   			color: red;
   			margin-top: 0.5rem;
   		}
   	</style>
	<title>Envoyer Notification</title>
</head>

<body>

   <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
      <?php include('./views/assets/inlcudes/header-admin.php');  ?>
   </header>

   <aside id="sidebar" class="sidebar">
      <?php include('./views/assets/inlcudes/sidebar-admin.php'); ?>
   </aside>

   <main id="main" class="main d-flex justify-content-center" style="background-color: #f8f9fa">
   	<div class="row row-cols-1 justify-content-center mt-5 w-100 px-3 py-2 rounded-3">
				<form id="notifForm">
					<div>
						<div class="form-group my-4">
							<h4 class="text-center text-black fw-semibold">Informations de notification</h4>
						</div>
						<div class="row row-cols-1 row-md-2 gap-4 bg-white rounded-3 justify-content-center py-4"  style="background: linear-gradient(45deg, #4099ff, #73b4ff);">
							<div class="col-12 col-md-5 form-group mb-4">
								<label for="sujet" class="form-label text-white">Sujet de notification <span class="required">*</span></label>
								<input type="text" class="form-control" name="sujet" id="sujet">
								<div id="sujet_error" class="error"></div>
							</div>

							<div class="col-12 col-md-5 form-group mb-3">
								<label for="notif_text" class="form-label text-white">Text de notification <span class="required">*</span></label>
								<textarea class="form-control" rows="4" name="notif_text" id="notif_text"></textarea>
								<div id="text_error" class="error"></div>
							</div>
						</div>

						<div class="form-group my-4">
							<h4 class="text-center text-black fw-semibold">Selectionner des étudiants</h4>
						</div>

						<div class="row row-cols-1 row-md-3 gap-4 gap-md-0 rounded-3 py-4" style="background: linear-gradient(45deg, #2ed8b6, #59e0c5);color: #fff">
							<div id="packsContainer" class="col-10 col-sm-7 col-md-4 form-group mb-4"></div>

							<div id="filieresContainer" class="col-10 col-sm-7 col-md-4 form-group mb-4"></div>

						</div>
						<div class="form-group my-4">
							<button type="submit" class="btn btn-primary" name="show" id="show">Afficher Liste</button>
						</div>
					</div>
				</form>
				<form id="send_form">
					
				</form>
			</div>
	</main>

   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js"
      integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="./views/assets/js/send_notif.js"></script>

</body>

</html>