<!DOCTYPE html>
<html>
<title>登入/註冊-戀上旅遊</title>

<?php
	include '../css.php';
	include '../header.php';
	include '../conn_mysql.php';
?>

<div id="body_top">	
<div class="menu">會員註冊</div>
<div style="width:590px; height:40px; float:left;"></div>
<div class="menu">會員登入</div>
<div style='clear: both'></div>

<div id="body_login1">
<script language="javascript">

function checkForm(){
	if(document.formJoin.m_username.value==""){		
		alert("請填寫帳號!");
		document.formJoin.m_username.focus();
		return false;
	}else{
		uid=document.formJoin.m_username.value;
		if(uid.length<5 || uid.length>12){
			alert( "您的帳號長度只能5至12個字元!" );
			document.formJoin.m_username.focus();
			return false;
		}
		if(!(uid.charAt(0)>='a' && uid.charAt(0)<='z')){
			alert("您的帳號第一字元只能為小寫字母!" );
			document.formJoin.m_username.focus();
			return false;
		}
		for(idx=0;idx<uid.length;idx++){
			if(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z'){
				alert("帳號不可以含有大寫字元!" );
				document.formJoin.m_username.focus();
				return false;
			}
			if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||( uid.charAt(idx)=='_'))){
				alert( "您的帳號只能是數字,英文字母及「_」等符號,其他的符號都不能使用!" );
				document.formJoin.m_username.focus();
				return false;
			}
			if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
				alert( "「_」符號不可相連 !\n" );
				document.formJoin.m_username.focus();
				return false;				
			}
		}
	}
	if(!check_passwd(document.formJoin.m_passwd.value,document.formJoin.m_passwdrecheck.value)){
		document.formJoin.m_passwd.focus();
		return false;
	}	
	if(document.formJoin.m_name.value==""){
		alert("請填寫姓名!");
		document.formJoin.m_name.focus();
		return false;
	}
	if(document.formJoin.m_birthday.value==""){
		alert("請填寫生日!");
		document.formJoin.m_birthday.focus();
		return false;
	}
	if(document.formJoin.m_email.value==""){
		alert("請填寫電子郵件!");
		document.formJoin.m_email.focus();
		return false;
	}
	if(!checkmail(document.formJoin.m_email)){
		document.formJoin.m_email.focus();
		return false;
	}
	return confirm('確定送出嗎？');
}
function check_passwd(pw1,pw2){
	if(pw1==''){
		alert("密碼不可以空白!");
		return false;
	}
	for(var idx=0;idx<pw1.length;idx++){
		if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
			alert("密碼不可以含有空白或雙引號 !\n");
			return false;
		}
		if(pw1.length<5 || pw1.length>10){
			alert( "密碼長度只能5到10個字母 !\n" );
			return false;
		}
		if(pw1!= pw2){
			alert("密碼二次輸入不一樣,請重新輸入 !\n");
			return false;
		}
	}
	return true;
}
function checkmail(myEmail) {
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(filter.test(myEmail.value)){
		return true;
	}
	alert("電子郵件格式不正確");
	return false;
}
</script>

<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('會員新增成功\n請用申請的帳號密碼登入。');
window.location.href='index.php';		  
</script>

<?php }?>
<form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
<?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
<p align="center"><font color="#FF0000">帳號 <?php echo $_GET["username"];?> 已經有人使用！</font></p>
<?php }?>

            <p>請填寫下列資料，註冊新的帳號</p><br/>
            <p><strong>使用帳號</strong>：
                <input name="m_username" type="text" class="normalinput" id="m_username">
                <font color="#FF0000">*</font> 請填入5~12個字元以內的小寫英文字母、數字、以及_ 符號。</p>
            <p><strong>使用密碼</strong>：
                <input name="m_passwd" type="password" class="normalinput" id="m_passwd">
                <font color="#FF0000">*</font> 請填入5~10個字元以內的英文字母、數字、以及各種符號組合。</p>
            <p><strong>確認密碼</strong>：
                <input name="m_passwdrecheck" type="password" class="normalinput" id="m_passwdrecheck">
                <font color="#FF0000">*</font> 再輸入一次密碼</p>
            <p><strong>真實姓名</strong>：
                <input name="m_name" type="text" class="normalinput" id="m_name">
                <font color="#FF0000">*</font> </p>
            <p><strong>性　　別 </strong>：
                <input name="m_sex" type="radio" value="女" checked>
                              女
                <input name="m_sex" type="radio" value="男">
                              男
               <font color="#FF0000">*</font></p>
            <p><strong>生　　日</strong>：
                <input name="m_birthday" type="text" class="normalinput" id="m_birthday">
                <font color="#FF0000">*</font> 為西元格式(YYYY-MM-DD)。</p>
            <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" class="normalinput" id="m_email">
                <font color="#FF0000">*</font>   請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
            <p><strong>個人網頁</strong>：
                <input name="m_url" type="text" class="normalinput" id="m_url">  請以「http://」 為開頭。 </p>
            <p><strong>電　　話</strong>：
                <input name="m_phone" type="text" class="normalinput" id="m_phone"> </p>
            <p><strong>住　　址</strong>：
                <input name="m_address" type="text" class="normalinput" id="m_address" size="40"> </p><br/>
            <p> <font color="#FF0000">*</font> 表示為必填的欄位</p><br/>
          
          <p align="left">
            <input name="action" type="hidden" id="action" value="join">
            <input type="submit" name="Submit2" value="送出申請">
            <input type="reset" name="Submit3" value="重設資料">
            <input type="button" name="Submit" value="回上一頁" onClick="window.history.back();">
          </p>
</form>
</div>

<div id="body_login2">
<?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="2")){?>
<p align="center"><font color="#FF0000">登入帳號或密碼錯誤！</font></p>
<?php }?>
          <p>登入會員系統</p><br/>
          <form name="form1" method="post" action="">
            <p>帳號：
              <input name="username" type="text" class="logintextbox" id="username" value="<?php echo $_COOKIE["remUser"];?>">
            </p>
            <p>密碼：
              <input name="passwd" type="password" class="logintextbox" id="passwd" value="<?php echo $_COOKIE["remPass"];?>">
            </p>
            <p>
              <input name="rememberme" type="checkbox" id="rememberme" value="true" checked>
記住我的帳號密碼。</p><br/>
            <p align="left">
              <input type="submit" name="button" id="button" value="登入系統">
            </p><br/>
            </form>
          <p align="left"><a href="admin_passmail.php">忘記密碼，補寄密碼信。</a></p>


</div>
</div>


<?php
	include '../footer.php';
?>




</html>
