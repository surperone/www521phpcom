<?php
function smarty_modifier_bian($string,$type=1,$cat=''){
	//���Ϊ1����ȫ����д
	//���Ϊ2,ȫ��Сд
	//
	$string.=$cat;
	switch($type){
		case 1:

			return ucfirst($string);
			break;
		case 2:

			return strtolower($string);
			break;
		case 3:
			return strtoupper($string);
			break;
	}
		
	


}


?>
