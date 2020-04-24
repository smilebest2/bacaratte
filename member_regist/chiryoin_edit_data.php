<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';


/**

 * テキストボックス表示処理

 */

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if (isset($_POST['entry2'])) {

	if(isset($_GET["no"]))

	{

		$_SESSION["id"] = $_GET["no"];

	}

	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$mysql->actQuery(SELECT009 . " WHERE ID = '" . '1' . "'");

	if ($row = $mysql->getResult())

	{

		echo '<table id="table_contact">';

		echo '      <tr>';
		echo ' <th>' . denwabango . '</td>';
		echo '                           <td><input type="text" name="required_denwabango" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_denwabango"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . siharaikubun . '</td>';
		echo '                           <td><input type="text" name="required_siharaikubun" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_siharaikubun"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . ginkomei . '</td>';
		echo '                           <td><input type="text" name="required_ginkomei" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_ginkomei"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . sitenmei . '</td>';
		echo '                           <td><input type="text" name="required_sitenmei" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_sitenmei"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . kouza . '</td>';
		echo '                           <td><input type="text" name="required_kouza" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_kouza"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . kouzameigi . '</td>';
		echo '                           <td><input type="text" name="required_kouzameigi" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_kouzameigi"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . kouzabango . '</td>';
		echo '                           <td><input type="text" name="required_kouzabango" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_kouzabango"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . dairinin . '</td>';
		echo '                           <td><input type="text" name="required_dairinin" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_dairinin"] . '" /></td>';
		echo '      </tr>';
		echo '      <tr>';
		echo ' <th>' . dairinin_add . '</td>';
		echo '                           <td><input type="text" name="required_dairinin_add" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_dairinin_add"] . '" /></td>';
		echo '      </tr>';

		echo '</table>';

	}



	}
}
else{
/**

 * 初期画面表示

 */
	if(isset($_GET["no"]))

	{

		$_SESSION["id"] = $_GET["no"];

	}

	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$mysql->actQuery(SELECT009 . " WHERE ID = '" . '1' . "'");

	if ($row = $mysql->getResult())

	{

		echo '<table id="table_contact">';

		echo '	<tr>';

		echo '		<th width="150">' . ID . '</td>';

		echo '		<td width="400">' . $row["id"] . '</td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . REG_D . '</td>';

		echo '		<td><input type="text" name="required_reg_d" maxlength="10" size="10" value="' . $row["reg_d"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . MNT . '</td>';


		echo '		<td><select name="optionmenu" />
					<OPTION value="有">有</OPTION>
					<OPTION value="無">無</OPTION>
					<OPTION selected="selected">' . $row["mnt"] . '</OPTION>

		                </td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '	<tr>';

		echo '		<th>' . OBJ . '</td>';

		echo '		<td><input type="text" name="required_obj" style="ime-mode: active" maxlength="50" size="50" value="' . $row["obj"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . OBJ_KANA . '</td>';

		echo '		<td><input type="text" name="required_obj_kana" style="ime-mode: disabled" maxlength="50" size="50" value="' . $row["obj_kana"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . MGR . '</td>';

		echo '		<td><input type="text" name="required_mgr" style="ime-mode: active" maxlength="30" size="30" value="' . $row["mgr"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . ZIP . '</td>';

		echo '		<td><input type="text" name="required_zip" style="ime-mode: disabled" maxlength="8" size="8" value="' . $row["zip"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . PREF . '</td>';

		echo '		<td><input type="text" name="required_pref" style="ime-mode: active" maxlength="10" size="10" value="' . $row["pref"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . ADR . '</td>';

		echo '		<td><input type="text" name="required_adr" style="ime-mode: active" maxlength="50" size="50" value="' . $row["adr"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . TEL . '</td>';

		echo '		<td><input type="text" name="required_tel" style="ime-mode: disabled" maxlength="20" size="20" value="' . $row["tel"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FAX . '</td>';

		echo '		<td><input type="text" name="required_fax" style="ime-mode: disabled" maxlength="20" size="20" value="' . $row["fax"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . MGR_OF_H . '</td>';

		echo '		<td><input type="text" name="required_mgr_of_h" style="ime-mode: disabled" maxlength="50" size="50" value="' . $row["mgr_of_h"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . ATC_D . '</td>';

		echo '		<td><input type="date" name="required_atc_d" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["atc_d"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . GRT_PRD . '</td>';

		echo '		<td><input type="date" name="required_grt_prd" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["grt_prd"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FMNT_DT . '</td>';

		echo '		<td><input type="date" name="required_fmnt_dt" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["fmnt_dt"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . TYPE . '</td>';

		echo '		<td><input type="text" name="required_type" style="ime-mode: disabled" maxlength="50" size="50" value="' . $row["type"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FIN . '</td>';

		echo '		<td><input type="text" name="required_fin" style="ime-mode: active" maxlength="20" size="20" value="' . $row["fin"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . SET_N . '</td>';

		echo '		<td><input type="text" name="required_set_n" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["set_n"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . RE_TYPE . '</td>';

		echo '		<td><input type="text" name="required_re_type" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["re_type"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . RE_SET_N . '</td>';

		echo '		<td><input type="text" name="required_re_set_n" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["re_set_n"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . RE_NUM . '</td>';

		echo '		<td><input type="text" name="required_re_num" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["re_num"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . RE_PRC . '</td>';

		echo '		<td><input type="text" name="required_re_prc" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["re_prc"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . SAL_PER . '</td>';

		echo '		<td><input type="text" name="required_sal_per" style="ime-mode: active" maxlength="30" size="30" value="' . $row["sal_per"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . CNT_NAME . '</td>';

		echo '		<td><input type="text" name="required_cnt_name" style="ime-mode: active" maxlength="50" size="50" value="' . $row["cnt_name"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . CNT_ZIP . '</td>';

		echo '		<td><input type="text" name="required_cnt_zip" style="ime-mode: disabled" maxlength="8" size="8" value="' . $row["cnt_name"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . CNT_PREF . '</td>';

		echo '		<td><input type="text" name="required_cnt_pref" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["cnt_pref"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . CNT_ADR . '</td>';

		echo '		<td><input type="text" name="required_cnt_adr" style="ime-mode: active" maxlength="50" size="50" value="' . $row["cnt_adr"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . CNT_TEL . '</td>';

		echo '		<td><input type="text" name="required_cnt_tel" style="ime-mode: disabled" maxlength="20" size="20" value="' . $row["cnt_tel"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . CNT_PER . '</td>';

		echo '		<td><input type="text" name="required_cnt_per" style="ime-mode: active" maxlength="30" size="30" value="' . $row["cnt_per"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . CNS_C . '</td>';

		echo '		<td><input type="text" name="required_cns_c" style="ime-mode: active" maxlength="50" size="50" value="' . $row["cns_c"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . M_C . '</td>';

		echo '		<td><input type="text" name="required_m_c" style="ime-mode: active" maxlength="50" size="50" value="' . $row["m_c"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . M_C_ZIP . '</td>';

		echo '		<td><input type="text" name="required_m_c_zip" style="ime-mode: disabled" maxlength="8" size="8" value="' . $row["m_c_zip"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . M_C_PREF . '</td>';

		echo '		<td><input type="text" name="required_m_c_pref" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["m_c_pref"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . M_C_ADR . '</td>';

		echo '		<td><input type="text" name="required_m_c_adr" style="ime-mode: active" maxlength="50" size="50" value="' . $row["m_c_adr"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . M_C_TEL . '</td>';

		echo '		<td><input type="text" name="required_m_c_tel" style="ime-mode: disabled" maxlength="20" size="20" value="' . $row["m_c_tel"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . M_C_PER . '</td>';

		echo '		<td><input type="text" name="required_m_c_per" style="ime-mode: active" maxlength="30" size="30" value="' . $row["m_c_per"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . MT_STR_D . '</td>';

		echo '		<td><input type="date" name="required_mt_str_d" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["mt_str_d"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . MT_ENF_M . '</td>';

		echo '		<td><input type="text" name="required_mt_enf_m" style="ime-mode: active" maxlength="2" size="2" value="' . $row["mt_enf_m"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . MT_PRC . '</td>';

		echo '		<td><input type="text" name="required_mt_prc" style="ime-mode: disabled" maxlength="10" size="10" value="' . $row["mt_prc"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . PAY_CON . '</td>';

		echo '		<td><input type="text" name="required_pay_con" style="ime-mode: disabled" maxlength="20" size="20" value="' . $row["pay_con"] . '" /></td>';

		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . NOTE . '</td>';

		echo '		<td><TEXTAREA cols="50" rows="4" wrap="physical" name="required_note" style="ime-mode: disabled">' . $row["note"] . '</TEXTAREA></td>';

		echo '	</tr>';


		echo '	<tr>';

		echo '		<th>' . FILE_1 . '</td>';
if ($row["file_1"] == ""){
		echo '		<td><input type="file" name="required_file_1" : active" maxlength="30" size="30" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_1"] . '">' . $row["file_1"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_2 . '</td>';
if ($row["file_2"] == ""){
		echo '		<td><input type="file" name="required_file_2" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_2"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_2"] . '">' . $row["file_2"] . '</a></td>';
}		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_3 . '</td>';
if ($row["file_3"] == ""){
		echo '		<td><input type="file" name="required_file_3" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_3"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_3"] . '">' . $row["file_3"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_4 . '</td>';
if ($row["file_4"] == ""){
		echo '		<td><input type="file" name="required_file_4" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_4"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_4"] . '">' . $row["file_4"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_5 . '</td>';
if ($row["file_5"] == ""){
		echo '		<td><input type="file" name="required_file_1" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_5"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_5"] . '">' . $row["file_5"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_6 . '</td>';
if ($row["file_6"] == ""){
		echo '		<td><input type="file" name="required_file_6" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_6"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_6"] . '">' . $row["file_6"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_7 . '</td>';
if ($row["file_7"] == ""){
		echo '		<td><input type="file" name="required_file_7" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_7"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_7"] . '">' . $row["file_7"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_8 . '</td>';
if ($row["file_8"] == ""){
		echo '		<td><input type="file" name="required_file_8" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_8"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_8"] . '">' . $row["file_8"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_9 . '</td>';
if ($row["file_9"] == ""){
		echo '		<td><input type="file" name="required_file_9" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_9"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_9"] . '">' . $row["file_9"] . '</a></td>';
}
		echo '	</tr>';

		echo '	<tr>';

		echo '		<th>' . FILE_10 . '</td>';
if ($row["file_10"] == ""){
		echo '		<td><input type="file" name="required_file_10" style="ime-mode: active" maxlength="30" size="30" value="' . $row["file_10"] . '" /></td>';
}else{
	    echo '		<td><a href="https://msg.apprhythm.net/worldpark/files/' . $row["file_10"] . '">' . $row["file_10"] . '</a></td>';
}
		echo '	</tr>';

		echo '</table>';

	}
}