<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/Notification.php';

class NotificationsController
{
	private $notification;

    public function __construct()
    {
        $this->notification = new Notification();
    }

    public function createNewArticleNotif($notif_subject, $notif_text, $bacs, $titre, $created_at)
    {
    	$result = $this->notification->createNewArticleNotif($notif_subject, $notif_text, $titre, $bacs, $created_at);
    	return true;
    }

    public function createUpdateArticleNotif($notif_subject, $notif_text, $id, $created_at)
    {
    	$result = $this->notification->createUpdateArticleNotif($notif_subject, $notif_text, $id, $created_at);
    	return true;
    }

    public function sendNewArticleEmail($emailSubject, $bacs, $titre)
    {
    	$this->notification->sendNewArticleEmail($emailSubject, $bacs, $titre);
    	return true;
    }

    public function sendUpdateArticleEmail($emailSubject, $id)
    {
    	$this->notification->sendUpdateArticleEmail($emailSubject, $id);
    	return true;
    }

    public function getStudsIdsByBac($bacs)
    {
    	$data = $this->notification->getStudsIdsByBac($bacs);
    	return $data;
    }

    public function showAllNotifs($student_id)
    {
    	
    	$output = '';
    	$count = $this->notification->countNewNotifications($student_id);

    	if ($count == 0) {
    		$output .= "
				<li class='dropdown-header text-right'> ليس لديك أي اشعار جديد</li>
	            <li> <hr class='dropdown-divider'> </li>
	    	";
    	} else if ($count == 1) {
    		$output .= "
				<li class='dropdown-header text-right bg-primary text-white fw-bold'>لديك اشعار جديد واحد</li>
	            <li> <hr class='dropdown-divider'> </li>
	    	";
    	} else if ($count == 2) {
    		$output .= "
				<li class='dropdown-header text-right bg-primary text-white fw-bold'>لديك اشعاران جديدان</li>
	            <li> <hr class='dropdown-divider'> </li>
	    	";
    	} else {
    		$output .= "
				<li class='dropdown-header text-right bg-primary text-white fw-bold' dir='rtl'>
					لديك $count من الاشعارات الجديدة
					<a href='#''><span class='view_all badge rounded-pill bg-success p-2 ms-2' type='button' data-bs-toggle='modal' data-bs-target='#allNotifsModal' >عرض الكل</span></a>
	            </li>
	            <li>
	               <hr class='dropdown-divider'>
	            </li>
	    	";
    	}
    	
        $notifs = $this->notification->getAllNotifications($student_id);
        
        if (empty($notifs)) {
            $output .= '<li class="notification-item text-right justify-content-center"><div><h4> ليس لديك أي اشعار </h4> </div> </li>';
        } else {
            foreach ($notifs as $notif) {
            	$id_notif = $notif['id_notif'];
	            $notif_subject = $notif['notif_subject'];
	            $notif_text = $notif['notif_text'];
	            $read_status = $notif['read_status'];
	            $students_ids = $notif['id_student'];
	            $id = $notif['id'];
	            $creation_date = new DateTime($notif['created_at']);
	            $now = new DateTime();
	            $diff = $now->diff($creation_date);
	            $time_ago = '';

	            $arabic = array(
				    'year' => 'عام',
				    'years' => 'أعوام',
				    'month' => 'شهر',
				    'months' => 'أشهر',
				    'day' => 'يوم',
				    'days' => 'أيام',
				    'hour' => 'ساعة',
				    'hours' => 'ساعات',
				    'minute' => 'دقيقة',
				    'minutes' => 'دقائق',
				    'just now' => 'الآن'
				);

	            if ($diff->y > 0) {
				    $time_ago = $diff->y . ' ' . ($diff->y > 1 ? $arabic['years'] : $arabic['year']);
				} else if ($diff->m > 0) {
				    $time_ago = $diff->m . ' ' . ($diff->m > 1 ? $arabic['months'] : $arabic['month']);
				    if ($diff->m > 10) {
				    	$time_ago = $diff->i . ' ' . 'شهرا';
				    }
				} else if ($diff->d > 0) {
				    $time_ago = $diff->d . ' ' . ($diff->d > 1 ? $arabic['days'] : $arabic['day']);
				    if ($diff->h > 10) {
				    	$time_ago = $diff->i . ' ' . $arabic['day'];
				    }
				} else if ($diff->h > 0) {
				    $time_ago = $diff->h . ' ' . ($diff->h > 1 ? $arabic['hours'] : $arabic['hour']);
				    if ($diff->h > 10) {
				    	$time_ago = $diff->i . ' ' . $arabic['hour'];
				    }
				} else if ($diff->i > 0) {
				    $time_ago = $diff->i . ' ' . ($diff->i > 1 ? $arabic['minutes'] : $arabic['minute']);
				    if ($diff->i > 10) {
				    	$time_ago = $diff->i . ' ' . $arabic['minute'];
				    }
				} else {
				    $time_ago = $arabic['just now'];
				}

				$bg_color = "#fff";

	            if (strpos($read_status, $student_id) !== false) {
	            	$bg_color = "#fff";
	            } else {
	            	$bg_color = "#90e0ef";
	            }

	            if($id !== null) {
	            	$output .= '
		                <li data-id = "'.$id_notif.'" class="notif_concours notification-item text-right p-0" dir="rtl" style="background-color: '.$bg_color.'">

	                    	<a class="text-decoration-none" href="article-concours?id='.$id.'" style="width: 100%;padding: 1.2rem 1.3rem;">
		                        <h4>' . $notif_subject . '</h4>
		                        <p class="text-black fw-semibold">' . $notif_text . '</p>
		                        <span> منذ ' . $time_ago . '</span>
	                        </a>
		                    
		                </li>
		                <li>
		                    <hr class="dropdown-divider">
		                </li>
		            ';
	            } else {
	            	if (strpos($students_ids, $student_id) !== false) {
					    $output .= '
			                <li data-id = "'.$id_notif.'" class="notif_concours notification-item text-right p-0" dir="rtl" style="background-color: '.$bg_color.'">

		                        <a class="text-decoration-none" href="#" style="width: 100%;padding: 1.2rem 1.3rem;">
			                        <h4>' . $notif_subject . '</h4>
			                        <p class="text-black fw-semibold">' . $notif_text . '</p>
			                        <span> منذ ' . $time_ago . '</span>
		                        </a>

			                </li>
			                <li>
			                    <hr class="dropdown-divider">
			                </li>
			            ';
					}
	            	
	            } 
	            
	        }
		}

		$data = array( 'notifications' => $output, 'count' => $count );
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function updateReadStatus($id_notif, $student_id) {
	    $updSt = $this->notification->updateReadStatus($id_notif, $student_id);
	    if ($updSt === true) {
	    	echo 'updated';
	    } else {
	    	echo 'dosn\'t';
	    }
	}

}

$notifContr = new NotificationsController;

if (isset($_POST['student_id']) && isset($_POST['action']) && $_POST['action'] == 'showNotifs') {
    $student_id = $_POST['student_id'];
    $notifContr->showAllNotifs($student_id);
}

if (isset($_POST['action']) && $_POST['action'] === 'updNotStatus') {
    $id_notif = $_POST['id_notif'];
    $student_id = $_POST['student_id'];

    $notifContr->updateReadStatus($id_notif, $student_id);
}