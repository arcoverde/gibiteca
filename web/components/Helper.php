<?php

namespace app\components;

class Helper
{
	public static function listMeses()
	{
		return [
			'01' => 'Janeiro', 
			'02' => 'Fevereiro', 
			'03' => 'Março',
			'04' => 'Abril',
			'05' => 'Maio',
			'06' => 'Junho',
			'07' => 'Julho',
			'08' => 'Agosto',
			'09' => 'Setembro',
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
