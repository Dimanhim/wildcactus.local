<?php

namespace app\components;

use yii\web\UrlRule;
use app\models\Sef;

class SefRule extends UrlRule
{
	public $connectionID = 'db';

	public function init()
	{
		if($this->name === null) $this->name = __CLASS__;
	}
	public function createUrl($manager, $route, $params)
	{
		if($route == 'site/index') return '';
		//if($route == 'site/search') return 'search.html?q='.$params['q'];
		if($route == 'site/payment#delivery') return 'oplata.html#delivery';
		if($route == 'site/payment#guarantees') return 'oplata.html#guarantees';
		$link = $route;
		if(count($params)) {
			$link .= "?";
			foreach($params as $key => $value) $link .= "$key=$value&";
			$link = substr($link, 0, -1);
		}
		$sef = Sef::find()->where(['link' => $link])->one();
		if($sef) return $sef->linksef.'.html';
		return false;
	}
	public function parseRequest($manager, $request)
	{
		$pathInfo = $request->getPathInfo();
		if(preg_match('%^(.*)\.html$%', $pathInfo, $matches)) {
			$linkSef = $matches[1];
			$sef = Sef::find()->where(['linksef' => $linkSef])->one();
			if($sef) {
				$linkData = explode('?', $sef->link);
				$route = $linkData[0];
				$params = array();
				if($linkData[1]) {
					$temp = explode("&", $linkData[1]);
					foreach($temp as $t) {
						$t = explode('=', $t);
						$params[$t[0]] = $t[1];
					}
				}
				return [$route, $params];
			}
		}
		return false;
	}






}





?>