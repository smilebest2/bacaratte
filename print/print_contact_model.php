<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	/**

	 * キャンセル

	 */

	if (isset($_POST['cancel'])) {
		$_SESSION["uid"]=$_SESSION["eid"];
		$_SESSION["eid"]="";
		header("Location:".url_print);

		exit;

	}


	/**

	 * 編集

	 */
	function sampleCsv($row) {

		try {

			//CSV形式で情報をファイルに出力のための準備
			$csvFileName = '/tmp/' . time() . rand() . '.csv';
			$res = fopen($csvFileName, 'w');
			if ($res === FALSE) {
				throw new Exception('ファイルの書き込みに失敗しました。');
			}

			// 配列要素カラム名取得
			foreach($row as $key=>$val) {
				$data_heder[]=$key;
				$data[] = $val;
			}
			// 文字コード変換。エクセルで開けるようにする
			mb_convert_variables('SJIS', 'UTF-8', $data_heder);
			fputcsv($res, $data_heder);

			mb_convert_variables('SJIS', 'UTF-8', $data);
			fputcsv($res, $data);

			// ハンドル閉じる
			fclose($res);

			// ダウンロード開始
			header('Content-Type: application/octet-stream');
			$file_name = $mId . $row["sejyutu_month"] . $row["kanjyamei"] . ".csv";
			// ここで渡されるファイルがダウンロード時のファイル名になる
			header('Content-Disposition: attachment; filename=' . $file_name);
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($csvFileName));
			readfile($csvFileName);

		} catch(Exception $e) {

			// 例外処理をここに書きます
			echo $e->getMessage();

		}
	}
	if (isset($_POST['edit'])) {
		$mId =$_SESSION["mid"];
		$mysql = new MySQL_cls();
		$mysql->MySQL();
		$sql = "SELECT * FROM RACE_DATA1 ";
		$sql .= "LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
		$sql .= "LEFT JOIN SEJYUTUSYA ON RACE_DATA1.sejyutu_no = SEJYUTUSYA.NO ";
		$sql .= "WHERE ";
		$sql .= "RACE_DATA1.member_id = '".$mId."'";
		$sql .= "AND RACE_DATA1.NO = '".$_SESSION["id"]."'";
		$mysql->actQuery($sql);
		$mysql->actQuery_result($sql);
		$row = $mysql->getResult();
		sampleCsv($row);
	}


}
