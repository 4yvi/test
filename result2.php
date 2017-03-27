<?php
/**
 * Написать функцию которая из этого массива
 */
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];

/**
 *  Функция разбора массива
 *
 *  @param array
 *  
 *  @return array
 */
function parse(array $array)
{
	$arResult = array();

	foreach ($array as $key => $value) {

		//	Разбираем и переварачиваем массив
		$explode = array_reverse(explode('.', $key));

		$arBuffer = array();

		foreach ($explode as $keyEx => $valueEx){
			if ($keyEx == 0) {
				$arBuffer[$valueEx] = $value;
			} else {
				$arBufferRe = $arBuffer;
				$arBuffer = array();
				$arBuffer[$valueEx] = $arBufferRe;
			}
		}

		//	Рекурсивно соедженяем массивы
		$arResult = array_merge_recursive($arResult, $arBuffer);

		/*
		 * 	TODO: Решение в лоб, но оно нам не подходит
		 * */
		//$res[$explode[0]][$explode[1]][$explode[2]] = $value;
	}

	return $arResult;
}

/**
 *  Функция собирает разобранный массив обратно
 *
 *	@param $array array
 * 	@param $key array
 *
 * 	@return array
 * */
function reparse(array $array, $keys = array())
{
	$arResult = array();
	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$keys[] = $key;
			$arResult = array_merge($arResult, reparse($value, $keys));
			array_pop($keys);
			continue;
		}
		$str = implode('.', $keys);
		$arResult[$str . '.' .$key] = $value;
	}
	return $arResult;
}

echo '<pre>';
print_r($data1);
print_r(parse($data1));
print_r(reparse(parse($data1)));
echo '</pre>';
?>