<?php 

namespace app\models;

use Yii;

class Utm
{
	
	public function getUtmSource()
	{
		$utm_source = Yii::$app->request->get('utm_source');
		return $utm_source;
	}
	public function getUtmCampaign()
	{
		$utm_campaign = Yii::$app->request->get('utm_campaign');
		return $utm_campaign;
	}
	public function getUtmMedium()
	{
		$utm_medium = Yii::$app->request->get('utm_medium');
		return $utm_medium;
	}
	public function getUtmContent()
	{
		$utm_content = Yii::$app->request->get('utm_content');
		return $utm_content;
	}
	public function getUtmTerm()
	{
		$utm_term = Yii::$app->request->get('utm_term');
		return $utm_term;
	}
}
?>