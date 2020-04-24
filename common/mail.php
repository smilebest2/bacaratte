<?php

/**

 * メール送信クラス

 */

class MailSend_cls

{

	//クラス変数

	private $subject;		//件名

	private $message;		//本文

	private $to_address;	//送信先アドレス

	private $header;		//メールヘッダ



	/**

	 * コンストラクタ

	 * @param 件名

	 * @param 本文

	 * @param FROMのアドレス

	 * @param TOのアドレス

	 * @param BCCのアドレス

	 */

	function MailSend()

	{

		//マルチバイト設定。

		mb_language("uni");

		mb_internal_encoding("utf-8");

		mb_http_input("auto");

		mb_http_output("utf-8");

	}



	/**

	 * メール送信実行

	 */

	function sendMail(){

		//@はサーバエラーを表示しないようにする。

		if(!@mb_send_mail($this->to_address, $this->subject, $this->message, $this->header))

		{

			return false;

		}

		return true;

	}



	/**

	 * 宛先メールアドレスを設定

	 * @param 宛先メールアドレス

	 */

	function setToAddress($toAddress)

	{

		$this->to_address = $toAddress;

	}



	/**

	 * メールの件名を設定

	 * @param メールの件名

	 */

	function setSubject($subject)

	{

		$this->subject = $subject;

	}



	/**

	 * メールの本文を設定

	 * @param メールの本文

	 */

	function setMessage($message)

	{

		$this->message = $message;

	}



	/**

	 * メールヘッダーのFrom表示部を設定

	 * @param Fromに表示される日本語名

	 * @param Fromに表示される送信元アドレス

	 */

	function setHeaderFrom($fromName, $fromAddress)

	{

		$this->header .= "From:" . mb_encode_mimeheader($fromName) . "<{$fromAddress}>" . "\r\n";

	}



	/**

	 * メールヘッダーのBCCを設定

	 * 複数設定する場合は、複数回呼び出す。

	 * @param BCCメールアドレス

	 */

	function setHeaderBcc($bcc)

	{

		$this->header .= "Bcc: " . $bcc . "\r\n";

	}

}

?>