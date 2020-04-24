<?php

/**
 * �L�����Z��
 */

	if (isset($_POST['back'])) {
		header("Location:https://smilebest.info/");
		exit();
	}

$field_name = $_POST['name'];
$field_email = $_POST['mailadd'];
$field_message = $_POST['coment'];
$mail_to = 'info@smilebest.org';
mb_language("japanese");
mb_internal_encoding("UTF-8");
$subject = '�₢���킹'.$field_name;
$body_message = 'From: '.$field_name."\n";
$body_message .= 'E-mail: '.$field_email."\n";
$body_message .= 'Message: '.$field_message;
$headers = 'From: '.$field_email."\r\n";
$headers .= 'Reply-To: '.$field_email."\r\n";

$encoding = mb_detect_encoding($body_message, "SJIS,EUC-JP,JIS,UTF-8");
		if ($encoding != "JIS") {
		 $subject = mb_convert_encoding($subject, "JIS", $encoding);
		 $body = mb_convert_encoding($body_message, "JIS", $encoding);
		 $headers = mb_convert_encoding($headers, "JIS", $encoding);
		}

		$body = mb_convert_kana($body, "KVa");
if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $user_mail)){
$mail_status = false;
}else{
		$mail_status = mb_send_mail($mail_to, $subject, $body,"From:".$headers);
}
if ($mail_status) { ?>
    <script language="javascript" type="text/javascript" charset="UTF-8">
        alert('���M���܂����B');
        window.location = 'https://smilebest.info/';
    </script>
<?php
}
else { ?>
    <script language="javascript" type="text/javascript" charset="UTF-8">
        alert('���b�Z�[�W���M�Ɏ��s���܂����B������̃��[���A�h���X�ւ��₢���킹���������Binfo@smilebest.org');
        window.location = 'https://smilebest.info/';
    </script>
<?php
}
?>