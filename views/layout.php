<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?
/*
	*************************************************************
	*
	*	Copyright (c) 2012, PG (PG@miko.tw)
	*
	*	PG Tsai @ NCTU SenseLab
	*
	*	All rights reserved.
	*
	*************************************************************
	
	Redistribution and use in source and binary forms, with or without
	modification, are permitted provided that the following conditions are met: 

	1. Redistributions of source code must retain the above copyright notice, this
	   list of conditions and the following disclaimer. 
	2. Redistributions in binary form must reproduce the above copyright notice,
	   this list of conditions and the following disclaimer in the documentation
	   and/or other materials provided with the distribution. 

	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
	ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
	WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
	DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
	ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
	(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
	LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
	ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
	(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
	SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

	The views and conclusions contained in the software and documentation are those
	of the authors and should not be interpreted as representing official policies, 
	either expressed or implied, of the Mikochan Project.
*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script type="text/javascript" src="<?=base_url()?>/jq171.js"></script>
<script type="text/javascript" src="<?=base_url()?>/jqui.js"></script>
<script type="text/javascript" src="<?=base_url()?>/jqblockui.js"></script>
<link type="text/css" href="<?=base_url()?>/jqui.css" rel="Stylesheet" />
<style type="text/css">
#main {
	margin: auto;

	height: auto;
	width: 1430px;
	background-color: #F0F0E0;
}
.post_msg {
	color: #600;
	font-size: 1em;
}
.post {

background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top, #ffffff 0%, #f3f3f3 68%, #ededed 94%, #ffffff 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(68%,#f3f3f3), color-stop(94%,#ededed), color-stop(100%,#ffffff)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #ffffff 0%,#f3f3f3 68%,#ededed 94%,#ffffff 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #ffffff 0%,#f3f3f3 68%,#ededed 94%,#ffffff 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #ffffff 0%,#f3f3f3 68%,#ededed 94%,#ffffff 100%); /* IE10+ */
background: linear-gradient(top, #ffffff 0%,#f3f3f3 68%,#ededed 94%,#ffffff 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
	margin: 10px;
	width: 1410px;
}
.post_name {
	color: #060;
	font-weight: 800;
	font-size: 1.2em;
}
#post_back {
	background-color: #F9F0F9;
	border-top-style: dotted;
	border-right-style: dotted;
	border-bottom-style: dotted;
	border-left-style: dotted;
	text-align: center;
	border-top-color: #FCC;
	border-right-color: #FCC;
	border-bottom-color: #FCC;
	border-left-color: #FCC;
}
#title {
	background-color: #FC9;
	padding: 0px;
	height: 200px;
	width: 100%;
}
#mode_msg {
	font-size: 3em;
	color: #03F;
}
body {
	background-color: #EEE;
}
.post_title {
	font-size: 2em;
	color: #933;
}
.push_name {
	color: #006;
	font-weight: 800;
	font-size: 1em;
}
.push_msg {
	color: #600;
}
#post_view {
}
#form_main {
	display: none;

}
.noTitleStuff .ui-dialog-titlebar {
display:none
}
</style>

<script type="text/javascript" >

/*
example $.cookie(’the_cookie’);

example $.cookie(’the_cookie’, ‘the_value’);
example $.cookie(’the_cookie’, ‘the_value’, {expires: 7, path: ‘/’, domain: ‘jquery.com’, secure: true});
example $.cookie(’the_cookie’, null);
*/
jQuery.cookie = function(name, value, options) { 
    if (typeof value != 'undefined') { // name and value given, set cookie 
        options = options || {}; 
        if (value === null) { 
            value = ''; 
            options.expires = -1; 
        } 
        var expires = ''; 
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) { 
            var date; 
            if (typeof options.expires == 'number') { 
                date = new Date(); 
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000)); 
            } else { 
                //date = options.expires; 
				date = new Date(); 
                date.setTime(date.getTime() + (14 * 24 * 60 * 60 * 1000)); 
				//modify by PG , set the default time to 14 days.
            } 
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE 
        } 
        var path = options.path ? '; path=' + options.path : ''; 
        var domain = options.domain ? '; domain=' + options.domain : ''; 
        var secure = options.secure ? '; secure' : ''; 
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join(''); 
    } else { // only name given, get cookie 
        var cookieValue = null; 
        if (document.cookie && document.cookie != '') { 
            var cookies = document.cookie.split(';'); 
            for (var i = 0; i < cookies.length; i++) { 
                var cookie = jQuery.trim(cookies[i]); 
                // Does this cookie string begin with the name we want? 
                if (cookie.substring(0, name.length + 1) == (name + '=')) { 
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break; 
                } 
            } 
        } 
        return cookieValue; 
    } 
};

</script>
</head>
<?
	$this->load->helper('html');
	require_once('recaptchalib.php');
	$reCAPTCHA_error = null;
?>
<body>
<div id="post_show_img"></div>
<div id="main">
	<div id="title">
	mikochan v0.5.x 私人貼圖區的完美解決方案(暫定ㄎㄎ)<br />
	排版針對貼圖區的特性強化，並大量運用JavaScript以達到更好的使用者體驗<br />
	[注意] 沒有VIP code的人無法使用實驗中的網址上傳功能，抱歉!<br />
	
	頁面產生時間 : <?php echo $this->benchmark->elapsed_time();?><br />
	<div style="float:right;"><input type="button" id="form_new" value="發表新文章" /></div>
	<?php echo form_open_multipart('mikochan/do_upload', array('id' => 'form_main'));?>
	Mode : <span id="mode_msg">New</span>
	<input type="hidden" id="form_gid" name="gid" size="50" />
	VIP_code : <input type="password"  id="form_VIP_code" name="VIP_code" size="20" /><br />
	Title : <input type="text"  id="form_title" name="title" size="50" /><br />
	Name : <input type="text"  id="form_name" name="name" size="20" /><br />
	Msg : <input type="text"  id="form_msg" name="msg" size="70" /><br />
	File : <input type="file"  id="form_file" name="userfile" size="30" /><br />
	URL :(輸入網址後程式會自動抓取該網址的圖片，同時選擇檔案與輸入網址時，以網址優先) <br />
	<input type="text"  id="form_url" name="url" size="70" /><br />
    <div style="float:right;"><input type="submit" value="送出" /></div><br />
	<input type="hidden" name="mode" />
	<div id="form_rec">
	<?=recaptcha_get_html(null, $reCAPTCHA_error)?>
	</div>
	</form>
	</div>
<? foreach ($query as $k): ?>


<div class="post" >

  <? if(isset($k[0])): ?>
  <table width="100%" border="0" id="post_no_<?=$k[0]->gid?>">
    <tr>
      <td style="width:1000px" class="post_title_td">
        <span class="post_title"><?=$query2[$k[0]->gid]->name?></span>
        <div class="post_push">
			<? foreach ($query3[$k[0]->gid] as $i):?>
				<span class="push_name">
					<?=$i->name?></span>：<span class="push_msg"><?=$i->msg?><br />
				</span>
			<? endforeach; ?>
		</div>
      </td>
      <td align="right">
        <?
           $tmp = $post_count[$k[0]->gid];
           if ($tmp > 7);
           
        ?>
        <a href="#<?=$k[0]->gid?>" class="EventExtend">展開</a>
        <a href="#<?=$k[0]->gid?>" class="EventReply" >續貼</a>
        <a href="#<?=$k[0]->gid?>"  class="EventPush">推文</a>
      </td>
    </tr>
  </table>
  <? endif; ?>
  <div class="post_content">
    <? $data['k'] = $k; $this->load->view('show_pic_unit',$data);?>
  </div>
</div>

<?php endforeach; ?>
  <p>&nbsp;</p>


<div id="post_view">
  <h1>this is post view</h1>
  <div id="post_back"><h1><a href="#">[Back]</a></h1></div>
  <div id="post_content"></div>
</div>


  <div id="bot"> This is bot</div>
  <p>&nbsp;</p>
</div>

<script type="text/javascript">
function open_form_main()
{
	$("#form_title").attr("disabled", false);
	$("#form_main").dialog
	({
		width: 800,
		modal: true
	});
}
var PG_return_aim;
<? if (isset($jump_to)): ?>
$("html,body").scrollTop( $("#post_no_<?=$jump_to?>").offset().top );
<? endif; ?>
$("#post_view").hide();
$("input:submit, a, button, #form_new").button();
$("#form_name").val($.cookie("name"));
if ($.cookie("VIP_code") != null && $.cookie("VIP_code") !="")
{
	$("#form_rec").hide();
	$("#form_VIP_code").val($.cookie("VIP_code"));
}
$(document).ready(function(){
	$("#bot").html("Hello jQuery!");
	if (screen.width >=1430 ){}
	else if (screen.width < 1430 && screen > 1200)
	{

		$("#main").css("width","1200px");
		$(".post").css("width","1150px");
		$(".post_img").css("width","120px");
		$(".post_img2").css("width","130px");
		$(".post_title_td").css("width","800px");
	}
	else
	{
		$("#main").css("width","1000px");
		$(".post").css("width","950px");
		$(".post_img").css("width","90px");
		$(".post_img2").css("width","95px");
		$(".post_title_td").css("width","200px");

	}

});
$(".post_img_a").click(function(){
	$.blockUI
	({
		css:
		{ 
			border: 'none', 
			padding: '15px', 
			backgroundColor: '#000', 
			'-webkit-border-radius': '10px', 
			'-moz-border-radius': '10px', 
			opacity: .5, 
			color: '#fff' 
        }
	});
	var t = $(this).attr("href");
	$("#post_show_img").hide();
	$("#post_show_img").html
	(
		"<a href=\""+ t + "\" id=\"post_show_img_a\">" +
		"<img src=\"" + t + "\" id=\"post_show_img_img\"/ >" +
		"</a>"
	);

	 
	$("#post_show_img_img").load(function()
	{
		$.unblockUI();
		$(".ui-dialog-titlebar").hide();
		$("#post_show_img_a").click(function(){
			$(this).dialog("close");
			return false;
		});

		$("#post_show_img_a").dialog
		({
			dialogClass: 'alert, noTitleStuff', //noTitleStuff
			width: 'auto',
			height: 'auto',
			modal: true,
		});
		$("#post_show_img_a").bind
		(
			"dialogclose",
			function()
			{
				//$("#post_show_img_a").removeclass("noTitleStuff");
				//return false;
			}
		);
		
		
		
	});
	return false;
});
$("#form_new").click(function(){
	open_form_main();
	$("#mode_msg").html("New");
	$("#form_main").attr('action', '<?=base_url()?>/index.php/mikochan/do_upload');
	$("#form_title").trigger('focus');
	
});

$(".EventReply").click(function(){
	
	open_form_main();
	$("#form_title").attr("disabled", true);
	$("#form_gid").attr("value", $(this).attr('href').substr(1));
    $("#mode_msg").html("Reply");
	$("#form_main").attr('action', '<?=base_url()?>/index.php/mikochan/do_upload');
	//$("#form_file").trigger('click');
	$("#form_msg").trigger('focus');
	return false;
});
$(".EventPush").click(function(){
	open_form_main();
	$("#form_title").attr("disabled", true);
	$("#form_gid").attr("value", $(this).attr('href').substr(1));
    $("#mode_msg").html("Push");
	$("#form_main").attr('action', '<?=base_url()?>/index.php/mikochan/add_push');
	$("#form_msg").trigger('focus');
	return false;
});
$("#form_name").change(function(){
	$.cookie("name",$("#form_name").val());
});
$("#form_main").submit(function(){

	if ($("#form_name").val() == "")
	{
		alert("請輸入姓名");
		return false;
	}
	var tmp = $("#mode_msg").html();

	if (tmp == "Push")
	{
		if ($("#form_msg").val() == "")
		{
			alert("請輸入推文內容");
			return false;
		}
		else return true;
	}
	else
	{
		if ($("#form_file").val() == "" && $("#form_url").val() == "")
		{
			alert("請選擇檔案 / 輸入網址");
			return false;
		}
		if (tmp == "New" && $("#form_title").val() == "")
		{
			alert("發表新文章必須要有標題");
			return false;
		}
	}
});
$(".EventExtend").click(function(){
	PG_return_aim = $(window).scrollTop();
	var tmp = $(this).attr('href').substr(1);
	$(".post").hide();
	$("#post_content").load
	(
		'<?=base_url()?>/index.php/mikochan/show_all/' + tmp,
		function(){$("#post_view").show();}
	);
	
	return false;
});

$("#post_back").click(function(){
	$("#post_view").hide();
	$(".post").show();
	$("html,body").scrollTop(PG_return_aim);
	return false;
});
$("#form_VIP_code").change(function(){
	var tmp = $("#form_VIP_code").val();
	$.cookie("VIP_code", tmp);
	if (tmp == "")
	{
		$("#form_rec").show();
	}
	else $("#form_rec").hide();
});
</script>
</body>
</html>