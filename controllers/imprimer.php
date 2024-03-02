<?php
require_once 'auth.php';
require_once 'NotificationsController.php';

$cuser = new Auth();
$cusertwo = new Auth();
if (isset($_POST['action']) && ($_POST['action'] == 'get_student_info')) {
    $id = $_POST['id'];
    $student = $cuser->info_student($id);  
    $website = $cuser->website(); 
	$prixpack = $cuser->prix_pack($id);



}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Facture</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-QLFrKlPQ5AxnOd2zJ6vEnR//RJGWkzaf8uon/jbKl++Lb0zZwBPS/yc6+GyLQx36wA9wQmtjQSCbD4ZxAPX46g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>
		

        body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 20px;
			background-color: #f0f0f0;
		}

		.container {
			margin: 20px;
		}

		h1 {
			font-size: 24px;
			margin-top: 0;
		}

		h2 {
			font-size: 20px;
			margin-top: 0;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		th, td {
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		th {
			text-align: left;
		}

		.print-button {
			background-color: #4CAF50;
			color: white;
			padding: 12px 24px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			margin-bottom: 20px;
		}

		footer {
			background-color: #f0f0f0;
			padding: 20px;
			text-align: center;
		}

		.footer-text {
			margin: 0;
		}

		.signature {
			margin-top: 20px;
		}

		@media print {
			.print-button {
				display: none;
			}
		}
	</style>
</head>
<body>
<header>
	<div>
	<img src="./views/assets/images/logos/<?php echo $website[0]['logo']; ?>" alt="Logo" width="70px">



	</div>
	<div>
		<p><strong>Adresse :</strong> <?php echo $website[0]['address']; ?></p>
		<p><strong>Téléphone :</strong> <?php echo $website[0]['tele']; ?></p>
		<p><strong>Email :</strong> <?php echo $website[0]['email']; ?></p>
	</div>
</header>

	<div class="container">
		<h1>Facture n° : <?php echo $student['id_student']; ?></h1> 

		<p><strong>Date :</strong> <?php echo date("j F Y"); ?></p>

		<h2>Information Ètudiant</h2>
		<table>
			<tr>
				<th>Code Massar :</th>
				<td><?php echo $student['codeMassar']; ?></td>
			</tr>
			<tr>
				<th>Nom :</th>
				<td><?php echo $student['lastName']; ?></td>
			</tr>
			<tr>
				<th>Prénom :</th>
				<td><?php echo $student['firstName']; ?></td>
			</tr>
            <tr>
				<th>Cin :</th>
				<td><?php echo $student['cin']; ?></td>
			</tr>
            <tr>
				<th>Sex :</th>
				<td><?php echo $student['sex']; ?></td>
			</tr>
            <tr>
				<th>Adress :</th>
				<td><?php echo $student['address']; ?></td>
			</tr>
			<tr>
				<th>Nom de Pack :</</th>
				<td><?php echo $prixpack['domaineP']; ?></td>
			</tr>
			<tr>
				<th>Prix :</th>
				<td><?php echo $prixpack['prixPack'] ; ?> DH</td>
			</tr>
			
		
	
			<!-- Ajouter d'autres informations client si nécessaire -->
		</table>
        <button onclick="window.print()" class="print-button" style="background-color: #4CAF50; color: white; padding: 12px 24px; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 20px;">Imprimer</button>

	</div>
    <footer>
	<div>
		
	</div>
	<p class="footer-text">Copyright © 2023 
	<?php echo $website[0]['siteWeb']; ?>. Tous droits réservés.</p>
</footer>
<div class="signature">
		<p>Signature  :</p>
		<!-- Vous pouvez personnaliser le contenu de la zone de signature ici -->
	</div>

</body>

</html>
