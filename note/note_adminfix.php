<?php 

require_once '../conn_mysql.php';

if (isset($_POST['action']) && ($_POST['action']=='update'))
{
	
	for($i = 0; $i < count($_POST['n_id']); $i++)
	{
		if(!empty($_FILES['photo']['name'][$i])) // 有選檔案才要處理
		{
			// 產生檔名
			$file_name=md5($_FILES['photo']['name'][$i] . date('U')) . '.jpg';
		
			// 從 tmp 搬檔案到目的位置
			$status = move_uploaded_file ($_FILES['photo']['tmp_name'][$i],'images/'. $file_name);
			
			// 產生 SQL statement-UPDATE
			$query_update=<<<EOD
UPDATE note
SET n_title = '%s', n_photo = '%s'
WHERE n_id = '%s'
EOD;
    		// 處理資安問題 SQL Injection
			$query_update = sprintf($query_update,
					mysql_real_escape_string($_POST['title'][$i]),
					mysql_real_escape_string($file_name),
					mysql_real_escape_string($_POST['n_id'][$i])
			);
		} else {
			// 產生 SQL statement-UPDATE
			$query_update=<<<EOD
UPDATE note
SET n_title = '%s'
WHERE n_id = '%s'
EOD;
			// 處理資安問題 SQL Injection
			$query_update = sprintf($query_update,
					mysql_real_escape_string($_POST['title'][$i]),
					mysql_real_escape_string($_POST['n_id'][$i])
			);
			
		} // end if
		
		
		// 寫入資料庫
		$result=mysql_query($query_update);
				
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		} else {
			echo 'success';
		}
		
	}// end of for
	
} // end of if post
?>
<!DOCTYPE html>
<html>
<title>管理介面-修改旅遊雜記-戀上旅遊</title>
<head>
<?php
	include '../css.php';
	include '../header_admin.php';
?>
</head>
<body>

<div id="body_bottom">
    <div class="menu_admin">修改旅遊雜記  管理介面</div>
    <div style="width:1250px;height:40px;border-bottom: 1px #A9A9A9 solid;float:left"> </div>
    <div style='clear: both'></div>
    
 	<form action="note_adminfix.php" name="form_update" method="post" enctype="multipart/form-data">
 	<input type='hidden' name='action' value='update'>
    <?php
    
	    //顯示相簿資訊SQL敘述句
	    $query_photo = "SELECT * FROM `note` ORDER BY `lastmod` DESC";
	    $result=mysql_query($query_photo);
	    
	    while ($row_result=mysql_fetch_assoc($result)) {
    	
    ?>
    <input type='hidden' name='n_id[]' value='<?php echo $row_result['n_id']?>'>
	<div class='input'>
		<label>旅遊雜記主題:</label>
		<input type='text' name='title[]' size='50' value="<?php echo $row_result['n_title'];?>"/>
	</div>
	
	<div class='input'>
		<label>上傳檔案:</label>
		<input type='file' name='photo[]' size='100' accept='image/*'> 
		<img src='images/<?php echo $row_result['n_photo']?>'>
	</div>
	
	<?php } // end of while ?>
	
	<div class='input'>
		<input type='submit' name='button_fix' value='確定修改'>
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