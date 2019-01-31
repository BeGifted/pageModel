<?php

class pageController extends controller
{
	public function actionView($category_tag)
	{
		if($category_tag){		
			$category = array();
			$category = Page::getCategoryItemBytag($category_tag);
			$data = array();
			$data = Data::getDataItemBytag($category_tag);
		}
		require_once(__ROOT__.'/views/Page/index.php');
		return true;
	}

	public function actionIndex()
	{
		
		$settings = array();
		$settings = Page::getSettings();
		require_once(__ROOT__.'/views/Page/index.php');
		return true;
    }
    /**
     *  联系博主
     */
    public function actionForm(){          
        $contactName = $_POST['name'];
        $contactName = htmlspecialchars($contactName);
        $contactEmail = $_POST['email'];
        $contactEmail = htmlspecialchars($contactEmail);
        $contactPhone = $_POST['phone'];
        $contactPhone = htmlspecialchars($contactPhone);
        $contactMessage = $_POST['message'];
        $contactMessage = htmlspecialchars($contactMessage);
        $date = date("Y-m-d H:i:s");
        if (!empty($contactName) && !empty($contactEmail)&& !empty($contactPhone)) {
            $formDate = Contact::checkContact($contactName, $contactEmail, $contactPhone, $contactMessage, $date);
            echo 'Has been sent! I will definitely contact you.';
        }
        return true;
    }
}
