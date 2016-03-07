<?php
include("./_init.php");


switch($_REQUEST['a']){
	
	case "list":
	default:
		$viewData['result'] = CategoryDao::getList();
		$viewData['page_title'] = "分類";
		renderPage('list');
		break;
		
		
	case "edit":
		try{
			if(IS_POST && $_POST['delete']){
				CategoryDao::removeData($_POST['id']);
				header("Location: ?a=list&msg=成功刪除"); 
			}elseif(IS_POST){
				$_REQUEST['id'] = CategoryDao::setData($_POST);
				header("Location: ?a=edit&id=".$_REQUEST['id']."&msg=成功儲存"); 
			}		
						
			if($_REQUEST['id']){
				$data = CategoryDao::getData($_REQUEST['id']);
				$_REQUEST = array_merge($_REQUEST, $data);
			}
		}
		catch(RuntimeException $e){
		    $_GET['msg'] = $e->getMessage();
		}
		
		$viewData['page_title'] = ($data ? "編輯分類" : "新增分類");
		renderPage('edit');
		break;

}
