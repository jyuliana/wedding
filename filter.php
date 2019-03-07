<?php
//функция в которой применяется фильтр 'my_filter_name'
function text($text ){
	// обрабатываем переданный текст - удалим html теги
	$text = strip_tags($text );
	
	// теперь возращаем текст через фильтр.
	// Если к фильтру не прикреплена ни одна функция, то текст просто
	// вернется как есть, т.е. строка ниже будет эквивалентна "return $text;"
	return apply_filters('my_filter_name', $text );
}

// Создадим функцию для фильтра
function my_filter_function($text ){
	//обрежем текст до 30 знаков и вернем его
	return mb_substr( &text, 0,30 ) .'...';
}
// Прикрепим функцию к фильтру 'my_filter_name');
add_filter('my_filter_name', 'my_filter_function);

// Теперь, при вызове text(), функция удалит из текста html теги - это сделает она сама  помощью strip_tags().
//А дальше обрежет текст - это сделает фильтр, с помощью функции my_filter_function()
echo text( 'Lorem <b>Ipsum</b> is simply dummy text of the printing and typesetting and typesetting industry');


// the excerpt(); //Выводит краткое описание поста 140

function new_excerpt_length($Length){
	return 20;
}
add_filter('excerpt_lenght', new_excerpt_length');
	
	


