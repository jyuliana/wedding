<?php
// создадим функцию для события
function my_action_function( $text){
	echo 'событие "my_action" сработало сейчас.';
}
// Прикрепляем функцию к событию 'my_action'. Это можно сделать в другом файле
// главное до того как событие сработает.
add_action('my_action, m_action_funtion');

add_action('my_action, m_action_funtion');
add_action('my_action, m_action_funtion');
add_action('my_action, m_action_funtion');

// Вызов амого события. Вставляем эту строку в то место темы где нужно,
// чтобы сработала прикрепленная к нему функция
do_action('my_action');

remove_action();
remove_filter();