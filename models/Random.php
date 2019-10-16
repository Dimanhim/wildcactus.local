<?php 

namespace app\models;

use Yii;

class Random
{
	public function getRandomPage($pages) {
		$session = Yii::$app->session;
		$session->remove('split'); // Отладочная функция
		if (!$session->get('split')) {
			$rand = mt_rand(0, (count($pages) - 1));
	        $session->set('split', $pages[$rand]);
	        return $session->get('split');
		}
		else {
			return $session->get('split');
		}
	}
}
?>