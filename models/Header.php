<?php 

namespace app\models;

use Yii;

class Header
{
	public $utm_term;
	
    public function __construct($utm_term)
	{
		$this->utm_term = $utm_term;
	}

	public function createHeader()
	{
		$header = 'ПРОЕКТ РЕКУЛЬТИВАЦИИ НАРУШЕННЫХ ЗЕМЕЛЬ';
		
		$word_1 = 'ПРОЕКТ РЕКУЛЬТИВАЦИИ ';
		$word_2 = 'РАЗРАБОТКА ПРОЕКТА РЕКУЛЬТИВАЦИИ ';

		$word_3 = 'НАРУШЕННЫХ ЗЕМЕЛЬ';
		$word_4 = 'СЕЛЬСКОХОЗЯЙСТВЕННЫХ ЗЕМЕЛЬ';
		$word_5 = 'КАРЬЕРА';
		$word_6 = 'ЗЕМЕЛЬНОГО УЧАСТКА';

	    if(preg_match("/разработ/i", $this->utm_term)) $header = $word_2;
	    else $header = $word_1;
	    if(preg_match("/сельх/i", $this->utm_term) || preg_match("/сельскохоз/i", $this->utm_term)) $header .= $word_4;
	    elseif(preg_match("/карьер/i", $this->utm_term)) $header .= $word_5;
	    elseif(preg_match("/земельного участ/i", $this->utm_term) || preg_match("/земельных участ/i", $this->utm_term)) $header .= $word_6;
	    else $header .= $word_3;
	    return $header; 
	}
}

?>