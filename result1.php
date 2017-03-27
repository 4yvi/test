<?php
/**
 * Нужно написать код, который из массива выведет то что приведено ниже в комментарии.
 */
$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

/**
 * 	Разбираем массив
 *
 * 	@param $array array
 *
 * 	@return array
 * */
function parse(array $array)
{
	$arResult = [];

	foreach ($array as $value) {
		$arResult = [$value => $arResult];
	}

	return $arResult;
}

echo '<pre>';
print_r($x);
print_r(parse($x));
echo '</pre>';

?>