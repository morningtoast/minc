<?
    include_once("class_minc.php");
	$minc = new minc();
	
	if (!$minc->fetch()) {
		$minc->save();
		$minc->delete();
		$minc->dir();
	}
?>