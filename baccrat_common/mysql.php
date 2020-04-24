<?php
require_once 'const.php';

/**
 * MySQLクラス
 */
class MySQL_cls
{
	private $m_con = "";
	private $m_rows = 0;
	private $m_hostname = HOST_NAME;
	private $m_database = MYSQL_DB_NAME;
	private $m_username = MYSQL_USER_NAME;
	private $m_password = MYSQL_PASSWORD;


	//コンストラクタ
	function MySQL()
	{
		//MySQLへ接続
		$this->m_con = mysqli_connect('mysql1308.xserver.jp', 'smilebest_user1', 'Windows1', 'smilebest_baccarat');
		$sql_1 = "SELECT now();";

		if(!$this->m_con)
		{
			exit("データベースの接続に失敗しました。");
		}
		//クエリの文字コードを設定
		mysqli_set_charset($this->m_con,'utf8');	//古いバージョン用
		//mysql_set_charset("utf8", $this->m_con);		//PHP5.2以降、MySQL5.0.7以降

		//データベース選択
		if(!mysqli_select_db($this->m_con,$this->m_database))
		{
			exit("aaデータベースの選択に失敗しました。");
		}
	}

	//トランザクション開始
	function TrsBegin()
	{
		//MySQLへ接続
		$Connect = mysqli_connect('mysql1308.xserver.jp', 'smilebest_user1', 'Windows1', 'smilebest_baccarat');
		if( !$Connect ){
	        print "接続できませんでした";
        	exit();
		}

		//データベース選択
//		if(!mysqli_select_db('mysql1308.xserver.jp',$Connect))
//		{
//			exit("データベースの選択に失敗しました。");
//		}

		//トランザクションをはじめる準備

	    $Query = "set autocommit = 0";
	    @mysqli_query($this->m_con,$Query);

	    //トランザクション開始
	    $Query = "begin";
	    @mysqli_query($this->m_con,$Query);

	}

	//トランザクションコミット
	function TrsCmt()
	{
		//MySQLへ接続
		$Connect = mysqli_connect('mysql1308.xserver.jp', 'smilebest_user1', 'Windows1', 'smilebest_baccarat');
		if( !$Connect ){
	        print "接続できませんでした";
        	exit();
		}

		//データベース選択
//		if(!mysqli_select_db('mysql1308.xserver.jp',$Connect))
//		{
//			exit("データベースの選択に失敗しました。");
//		}

	    //トランザクション開始
	    $Query = "commit;";
	    @mysqli_query($this->m_con,$Query);

	}

	//トランザクションコミット
	function TrsRbk()
	{
		//MySQLへ接続
		$Connect = mysqli_connect('mysql1308.xserver.jp', 'smilebest_user1', 'Windows1', 'smilebest_baccarat');
		if( !$Connect ){
	        print "接続できませんでした";
        	exit();
		}

		//データベース選択
//		if(!mysqli_select_db('mysql1308.xserver.jp',$Connect))
//		{
//			exit("データベースの選択に失敗しました。");
//		}

	    //トランザクション開始
	    $Query = "rollback;";
	    @mysqli_query($this->m_con,$Query);

	}
	/**
	 * クエリの実行
	 * @param sql文
	 * @return 実行結果の行数
	 */
	function actQuery($sql)
	{
		$this->m_rows = @mysqli_query($this->m_con,$sql);

		if(!$this->m_rows)
		{
/*
			echo "SQL = " . $sql;
			echo "<br /><br />error = " . mysql_error();
			echo "<br /><br />";
			die("クエリの実行に失敗しました。");
*/
			return false;
		}
		return $this->m_rows;
	}

	/**
	 * クエリの実行
	 * @param sql文
	 */
	function actQuery_result($sql)
	{
		$rtn = @mysqli_query($this->m_con,$sql);

		if(!$rtn)
		{
			return false;
		}
		return $rtn;
	}
	/**
	 * 検索結果取得
	 * 検索結果を1行づつ返す。行が無くなればFalseを返す。
	 * @return フィールド名が添え字になった連想配列。
	 */
	function getResult()
	{
		return mysqli_fetch_array($this->m_rows);
	}

	/**
	 * 変更された行数取得
	 * @return 直近の操作で変更された行数の取得
	 */
	function affectedRows()
	{
		return mysqli_affected_rows($this->m_rows);
	}

	/**
	 * 実行結果の列数を取得
	 * @return 実行結果の列数を取得
	 */
	function getFields()
	{
		return mysqli_num_fields($this->m_rows);
	}

	/**
	 * 実行結果の行数を取得
	 * @return 実行結果の行数を取得
	 */
	function getRows()
	{
		return mysqli_num_rows($this->m_rows);
	}

	/**
	 * MySQLを閉じる
	 * @return unknown_type
	 */
	function closeMysql()
	{
		return mysqli_close($this->m_con);
	}

	/**
	 * MySQLエラー取得
	 * @return MySQLエラー
	 */
	function getErrors()
	{
		return mysqli_errno() . ":" . mysqli_error();
	}

	/**
	 * MySQLエラーナンバー取得
	 * @return MySQLエラーナンバー
	 */
	function getErrorsNo()
	{
		return mysqli_errno();
	}
}
?>