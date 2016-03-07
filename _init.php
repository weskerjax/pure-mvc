<?php
define('ROOT_PATH',	str_replace('\\', '/', dirname(__FILE__))); /*網站主目錄常數*/
define('IS_POST', ($_SERVER['REQUEST_METHOD'] == 'POST'));


/** 設定 mbstring 預設編碼 */
mb_internal_encoding('UTF8');

/**系統時區設置*/
ini_set('date.timezone','Asia/Taipei');   

/**關閉-執行時期的提醒*/
error_reporting(E_ALL^E_NOTICE); 

/**設定以例外方式處理系統錯誤*/
function handle_errors($errno, $errstr, $errfile, $errline ) {
	if(error_reporting() === 0){ return; }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler('handle_errors', E_ALL^E_NOTICE);





/**################################################*/
include(ROOT_PATH.'/app/CategoryDao.php');

CategoryDao::$dbh = new PDO('sqlite:'.ROOT_PATH.'/app/pure.sqlite');


/**################################################*/


$viewData = array();

function renderPage($page) {
	global $viewData;
	
	$ctrl = str_replace('.php', '', basename($_SERVER["SCRIPT_NAME"]));
	include(ROOT_PATH."/view/$ctrl/$page.phtml");
	$contents = ob_get_contents();
	ob_clean();
	
	include(ROOT_PATH."/view/layout.phtml"); 
	echo $contents;
}

/* 跳脫 HTML (Ex: <:&lt; >: &gt; ": &quot; ':&#039; ) */
function _e($string) {
    return htmlspecialchars($string, ENT_QUOTES);
}

/* 陣列空值判斷 */
function _a($array) {
	if(is_array($array)){ return $array; }
	return array();
}

