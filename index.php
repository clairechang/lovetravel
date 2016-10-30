<?php 
require_once 'conn_mysql.php';

//由DB column取出,圖片是二進位, 需透過程式改碼,顯示原圖片
function data_uri(&$contents, $mime)
{
	return '<img src="' . ('data:' . $mime . ';base64,' . base64_encode($contents)) . '" style="width: 250px; height: 250px"/>';
}

$limit_photo="SELECT `n_photo` FROM `note` ORDER BY `lastmod` DESC LIMIT 3";
$sql_limit_photo=mysql_query($limit_photo);

// foreach的前身語法:   while(list($key, $value) = each($rowphoto)) 

?>


<!DOCTYPE html>
<html>
<title>首頁-戀上旅遊</title>

<?php
	include 'css.php';
	include 'header.php';
?>
<div id="body_bottom">
	<div id="body_note">
		<div class="menu">最新雜記</div>
		<div style='clear: both'></div>
	
		<?php while ($rowphoto=mysql_fetch_row($sql_limit_photo)):?>
			
			<div class="note_content"><?php echo data_uri($rowphoto[0], 'image/jpg');?></div>
			
		<?php endwhile;?>
		
		<div class="note_content"></div>
		<div class="note_content"></div>
		<div class="note_content"></div>
	</div>

	<div id="body_board">
		<div class="menu">最新討論</div>
		<div style='clear: both'></div>
		<div class="board_content"></div>
		<div class="board_content"></div>
		<div class="board_content"></div>
	</div>
</div>

<?php
	include 'footer.php';
?>

</html>