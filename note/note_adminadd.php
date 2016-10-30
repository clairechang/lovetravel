<?php 
require_once '../conn_mysql.php';

if(isset($_POST["action"]) && $_POST["action"]=="add" && isset($_FILES['photo'])) {
	
	for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
		// 產生檔名
		$file_name = md5($_FILES['photo']['name'][$i]) . '.jpg';
	
		// 從 tmp 搬檔案到目的位置
		$status = move_uploaded_file($_FILES['photo']['tmp_name'][$i], 'images/' . $file_name);

		// 產生 SQL statement
		$query_insert=<<<EOD
		INSERT INTO note 
		(n_title, n_photo)
		VALUES 
		('%s', '%s')
EOD;

		// 處理資安問題 SQL Injection
		$query_insert = sprintf($query_insert,
			       	 	mysql_real_escape_string($_POST['title'][$i]),
				    	mysql_real_escape_string($file_name)
				    	);
		
		// 寫入資料庫
		$result=mysql_query($query_insert);
		$photo_id=mysql_insert_id();
		
	
		if (!$result) {
				die('Invalid query: ' . mysql_error());
		}
		
	} // end of for
	
} // end of if post

?>

<!DOCTYPE html>
<html>
<title>管理介面-新增旅遊雜記-戀上旅遊</title>
<head>
<?php
	include '../css.php';
	include '../header_admin.php';
?>
</head>
<body>

<div id="body_bottom">
    <div class="menu_admin">新增旅遊雜記  管理介面</div>
    <div style="width:1250px;height:40px;border-bottom: 1px #A9A9A9 solid;float:left"> </div>
    <div style='clear: both'></div>
    
 	<form action="" name="form_add" method="post" enctype="multipart/form-data">
 	<input type='hidden' name='action' value='add'>
    
	<div class='input'>
		<label>旅遊雜記主題1:</label>
		<input type='text' name='title[]' size='50' required>
	</div>
	
	<div class='input'>
		<label>上傳檔案1:</label>
		<input type='file' name='photo[]' size='100' accept='image/*'>  
	</div>
	
	<div class='input'>
		<label>旅遊雜記主題2:</label>
		<input type='text' name='title[]' size='50' required>
	</div>
	
	<div class='input'>
		<label>上傳檔案2:</label>
		<input type='file' name='photo[]' size='100' accept='image/*'>
			</div>
	
	<div class='input'>
	<input type='submit' name='button_add' value='確定新增'>
	</div>
	
	<div class='input'>
	<input type='reset' name='button_reset' value='重設資料'><br/>
	</div>
	
	<div class='input'>
	<input type='button' name='button_back' value='回管理界面' onClick='window.history.back();'>
	</div>
	
	</form>
</div>

<?php
	include '../footer.php';
?>

</body>
</html>