<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'virtualschool' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+3tPt&j`}rNDgVbOEr1E=$fgvytcZ:]=Lz>O`k:Y62S/rHwMx,1Bmw]bvQd81o2<' );
define( 'SECURE_AUTH_KEY',  '8?28/pACI^iI-:#Bk(bkX*]zXvZA_1yO=:=4CmFB+q!YG]b3d&ta=hv+x^|/|&bS' );
define( 'LOGGED_IN_KEY',    'cbgS`2QBrtjp_LPKpwL)4,SL[2N~0i M5uFe[PqT;{YUR(^@Eg*8sqpQx%tIU%%#' );
define( 'NONCE_KEY',        'Dzy@P:^w>9e|[3?oZ5D{kFSnoXsjQxbVdPR,`i-jHtBA4y3n>-h{YnxPD-@<1>w3' );
define( 'AUTH_SALT',        '3x@79{l,s1d(s;w>mh%v]n.va]w;s%AF=I2q/t)/t}P|mT6jSzUra?V4?tO3@j7w' );
define( 'SECURE_AUTH_SALT', '[#_vgY>#wBA|#D+Jp|k@iry0[IMzm6{dsdT+@3rA|CE3FBgA+l}*G61-?pY&X5H3' );
define( 'LOGGED_IN_SALT',   ')jp9zJI1OF/g}bOP9xJo).d7/,k{|HGz+vs&GuB9>v,TD[hTNM,BV#8/:fh ?(=#' );
define( 'NONCE_SALT',       'm[#Jz2s.04$-{S6;Sd+ ]A;=0%<9RxZOCxlCBGFTK?P5W([rHsUSaOjiM<Es1x,n' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
