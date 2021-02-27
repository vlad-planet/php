<?php
public function getModifiers($r){
	if($r instanceof ReflectionMethod || $r instanceof ReflectionProperty){
		$arr = Reflection::getModifierNames($r->getModifiers());
		$description = implode(" ", $arr );
	}else{
		$msg = "������ ���� ReflectionMethod ��� ReflectionProperty";
		throw new ReflectionException( $msg );
	}
	return $description;
}
?>