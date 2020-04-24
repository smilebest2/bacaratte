<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/mail.php';
require_once '../common/function.php';
require_once '../common/const.php';

if(isset($_GET["no"])){
	$sId= $_GET["no"];
}
if($_SESSION["schid"]){
	$user_name = $_SESSION["una"];
	$_SESSION["user_id"] = $_SESSION["schid"];
	$_SESSION["schid"]="";

	$mId =$_SESSION["mid"];
	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$sejyutu_opt="";
	$kanjya_opt="";
	$sql = "select NO,nick_name from SEJYUTUSYA where NO = '$sId'";
	$ka_no=array();
	$mysql->actQuery($sql);
	$row = $mysql->getResult();
	$se_name=$row["nick_name"];

	$sql = "select NO,nick_name from RIYOUSHA where member_id = '$mId' and syutanto = '$sId'";
	$mysql->actQuery($sql);
	while (($row_ka = $mysql->getResult())){
		$kanjya_opt .= "<option value=" . $row_ka["NO"] .">" . $row_ka["nick_name"] . "</option>";
		$ka_no[]=$row_ka["NO"];
	}
	//var_dump($_SESSION[row]);
	//var_dump($_SESSION["sejyutu_month"]);
	//echo $_SESSION[sejyutu_day];
	//echo $_SESSION[new_from_chiryoin_kyori];


}else{
	header("Location: https://smilebest.info/sample_login/sample_login.php");
	exit;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="Content-Style-Type" content="text/css" />

<meta http-equiv="Content-Script-Type" content="text/javascript" />

<title>スケジュール</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
<script src='lib/jquery.min.js'></script>
<script src='lib/moment.min.js'></script>
<script src='lib/fullcalendar.js'></script>

<script>
$(document).ready(function() {
var id=<?php echo $sId ?>;

	$('#calendar').fullCalendar({
		editable: true,
		events: "https://smilebest.info/sample_login/schedule/events.php?no=" + id,

			header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
			},

		editable: true,
		eventLimit: true, // allow "more" link when too many events
		eventLimitText:'その他',
		lang:'ja',
			//ヘッダーの書式
			columnFormat: {
			month: 'ddd',    // 月
			week: 'D[(]ddd[)]', // 7(月)
			day: 'D[(]ddd[)]' // 7(月)
			},
			// タイトルの書式
			titleFormat: {
			month: 'YYYY年 M月',                             // 2014年9月
			week: 'YYYY年 M月 D日',
			day: 'YYYY年 M月 D日[(]ddd[)]',                  // 2014年9月7日(火)
			},

		//more表示の書式
		dayPopoverFormat:'YYYY年 M月 D日[(]ddd[)]',
		// 月名称
		monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
		// 月略称
		monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
		// 曜日名称
		dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
		// 曜日略称
		dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
		// スロットの時間の書式
		axisFormat: 'H:mm',
		// 時間の書式
		timeFormat: 'H:mm',

			// ボタン文字列
			buttonText: {
			prev: '前',
			next: '次',
			prevYear: '前年',
			nextYear: '翌年',
			today: '今日',
			month: '月',
			week: '週',
			day: '日'
			},
		//月曜日開始
		firstDay:1,
		//土日表示
		weekends:true,
		//終日スロットル表示
		allDaySlot:false,
		//終日スロットルタイトル
		allDayText:'登録データ',
		//agendaWeek、agendaDayの1時間4セル（15分間隔）で表示
		slotDuration:'00:10:00',
		//開始（終了）時間がない場合の設定
		defaultTimedEventDuration:'09:00:00',
		//スクロール開始時間
		scrollTime:'09:00:00',
		//スクロール時間の最大、最小の設定
		minTime:'07:00:00',
		maxTime:'24:00:00',



			//日付クリック
			dayClick: function(date, jsEvent, view) {

				$(this).css('background-color', 'red');
			},
			//イベントクリック
			eventClick: function(calEvent, jsEvent, view) {

				location.href = "https://smilebest.info/sample_login/schedule/calendar_edit.php?no=" + id + "&start=" + escape(calEvent.start.format('YYYY-MM-DD HH:mm:ss')) + "&end=" + escape(calEvent.end.format('YYYY-MM-DD HH:mm:ss'));
				$(this).css('border-color', 'red');
			},


		//ドラッグ可能
		selectable:true,
		selectHelper:true,
		//ドラッグ後処理
		select: function(start, end ) {
		riyo = $('[name=required_riyousya]').val();

			time = start.hours();

			if (riyo) {
				var data = "";
				if(time == 0){

				start = start.hours(9);
				end = end.hours(10);
				start = start.format('YYYY-MM-DD HH:mm');
				end = end.add('days',-1).format('YYYY-MM-DD HH:mm');

				}
				else{
				start = start.format('YYYY-MM-DD HH:mm');
				end = end.format('YYYY-MM-DD HH:mm');
				}

				riyo = $('[name=required_riyousya]').val();
				data='no=' + id +'&riyo=' + riyo + '&start=' + escape(start) + '&end=' + escape(end);
				location.href="https://smilebest.info/sample_login/schedule/calendar_edit_new.php?" + data;




					 $('#calendar').fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
						},
					true // make the event "stick"
					);
		    }
			$('#calendar').fullCalendar('unselect');
		},
		eventDrop: function(event, delta) {
		    start = event.start.format('YYYY-MM-DD HH:mm');
		    end = event.end.format('YYYY-MM-DD HH:mm');
		    riyo = $('[name=required_riyousya]').val();
			    $.ajax({
			    url: "update_events.php",
			    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id +'&riyo='+ riyo ,
			    type: "POST",
				    success: function(json) {
				    }
			    });
	   },
		eventResize: function(event) {
		   start = event.start.format('YYYY-MM-DD HH:mm');
		   end = event.end.format('YYYY-MM-DD HH:mm');
		    $.ajax({
		    url: "update_events.php",
		    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
		    type: "POST",
			    success: function(json) {
			    }
		    });
		}
	});
	$('#calendar').addTouch();
});
</script>
<style type='text/css'>
#calendar {
	width: 900px;
	margin: 0 auto;
}
</style>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			</br> </br> </br>
			<p class="headerTitle">スケジュール</p>
		</div>
		<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?>
		</label> <br> <INPUT type="submit" value=" 戻る " name="back_bt"
			style="position: relative; left: 800px; top: 0px;"
			onclick="location.href='http://smilebest.info/menu.php'"><br>
					<div id="riyousya">
						&nbsp;&nbsp;&nbsp;&nbsp; 施術者&nbsp:&nbsp;&nbsp;
						<?php echo $se_name ?>
						&nbsp;&nbsp;&nbsp;&nbsp; 患 者&nbsp:&nbsp;&nbsp;&nbsp;<select
							name="required_riyousya">
							<?php
							if($kanjya_opt!=""){
		echo	$kanjya_opt;
	}else{
		echo	"<option value=\"a\">患者を登録してください</option>";
	}
	?>
						</select>
					</div>
					<div id='calendar' style="margin-top: 40px;"></div>
					<div id="footer">
						<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All
							Rights Reserved.</p>
					</div>

	</div>
</body>
</html>
