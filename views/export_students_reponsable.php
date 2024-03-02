<?php
require_once '../controllers/auth.php';

$cuser = new Auth();
$output ='';
session_start();
$idResponsable = $_SESSION['RESPONSABLEINFO']['idRes'];
$output ='';
$notes = $cuser->get_students_responsable($idResponsable);
if($notes){
    $output .= '<table class="table table-striped text-center" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid black;">code Massar</th>
            <th style="border: 1px solid black;">cin</th>
            <th style="border: 1px solid black;">email</th>
            <th style="border: 1px solid black;">nom</th> 
            <th style="border: 1px solid black;">prenom</th> 
            <th style="border: 1px solid black;">الاسم</th> 
            <th style="border: 1px solid black;">النسب</th> 
            <th style="border: 1px solid black;">sex</th>
            <th style="border: 1px solid black;">phone</th> 
            <th style="border: 1px solid black;">phone parent</th> 
            <th style="border: 1px solid black;">adress</th> 
            <th style="border: 1px solid black;">lieu de naissance</th> 
            <th style="border: 1px solid black;">date de naissance</th> 

        </tr>                          
    </thead>
    <tbody>';
    foreach($notes as $row){
        $output .= '<tr>
        <td style="border: 1px solid black;">'.$row['codeMassar'].'</td>
        <td style="border: 1px solid black;">'.$row['cin'].'</td>
        <td style="border: 1px solid black;">'.$row['email'].'</td>
        <td style="border: 1px solid black;">'.$row['lastName'].'</td>
        <td style="border: 1px solid black;">'.$row['firstName'].'</td>
        <td style="border: 1px solid black;">'.$row['firstNameArabe'].'</td>
        <td style="border: 1px solid black;">'.$row['lastNameArabe'].'</td>
        <td style="border: 1px solid black;">'.$row['sex'].'</td>
        <td style="border: 1px solid black;">'.$row['phone'].'</td>
        <td style="border: 1px solid black;">'.$row['parentPhone'].'</td>
        <td style="border: 1px solid black;">'.$row['address'].'</td>
        <td style="border: 1px solid black;">'.$row['placeBirth'].'</td>
        <td style="border: 1px solid black;">'.$row['dateBirth'].'</td>
    </tr>';
    }
    $output .= '</tbody></table>';

    // Générer le fichier Excel
 // Générer le fichier Excel
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="students.xls"');
echo "\xEF\xBB\xBF"; // Spécifier l'encodage UTF-8 dans Excel

echo '
<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Feuille 1</x:Name>
                    <x:WorksheetOptions>
                        <x:DisplayGridlines/>
                        <x:Print>
                            <x:PrintGridlines/>
                        </x:Print>
                        <x:DisplayGridlines/>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>
<body>
    ' . $output . '
</body>
</html>';


    }
