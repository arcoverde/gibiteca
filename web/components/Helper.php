<?php

namespace app\components;

class Helper
{
	public static function listMeses()
	{
		return [
			'1' => 'Janeiro', 
			'2' => 'Fevereiro', 
			'3' => 'Março',
			'4' => 'Abril',
			'5' => 'Maio',
			'6' => 'Junho',
			'7' => 'Julho',
			'8' => 'Agosto',
			'9' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro',
		];
	}
	
	public static function listAnos($anoInicial)
	{
		$anos = [];
		for($index=date('Y'); $index >= $anoInicial; $index--) {
			$anos[$index] = $index;
		}
		return $anos;
	}
}
