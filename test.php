<?php
session_start();

require_once 'baccrat_common/mysql.php';

require_once 'baccrat_common/const.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
 <!--
body
        {
         margin:0px;
         padding:0px;
        }
#wrapper{
     width: 960px;
     margin: 0 auto;
}
#log_space
        {
         width:100%;
         height:200px;
         background-color:#cc6600;
        }
#logo
        {
         width:100%;
         height:50px;
         background-color:#cc6600;
         text-align: center;
         font-size: 100%;
        }
#player_card
        {
         width:50%;
         height:300px;
         float:left;
         background-color:#ff9933;
         text-align: center;
         font-size: 100%;
         margin: 0px auto;
        }
#banker_card
        {
         width:50%;
         height:300px;
         float:left;
         background-color:#ff9933;
         text-align: center;
         font-size: 100%;
        }
#bet_player
        {
         width:40%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#bet_tie
        {
         width:20%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#bet_banker
        {
         width:40%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#pear_player
        {
         width:10%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#pear_banker
        {
         width:10%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
	background-color: #ffffff;
	margin-left: auto;
	margin-right: auto;
}
td, th {
	padding: 3px;
	width: 20px;
	height: 15px;
	font-size: 50%;
}
th {
	background: #f0e6cc;
}
.even {
	background: #fbf8f0;
}
.odd {
	background: #fefcf9;
}
.container {
  width: 960px;
  margin: 0 auto;
  background-color:#ff9933;
  text-align: center;
}

#pcard1 {
	float:left;
    position: relative;
    left: 1000px; 
    margin: 10px;
    display:none;
}
#pcard2 {
	float:left;
    position: relative;
    left: 1000px; 
    margin: 10px;
    display:none;
}
#pcard3 {
	float:left;
    position: relative;
    left: 1000px; 
    margin: 10px;
    display:none;
}
#bcard1 {
	float:left;
    position: relative;
    left: 1000px; 
    margin: 10px;
    display:none;
}
#bcard2 {
	float:left;
    position: relative;
    left: 1000px; 
    margin: 10px;
    display:none;
}
#bcard3 {
	float:left;
    position: relative;
    left: 1000px; 
    margin: 10px;
    display:none;
}
 -->
</style>
<title>Baccarat</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){

   //変数の設定-----------------------------------

   var setSecond = 30; //タイマーの秒数
   
 (function($) {
	  $.fn.timer = function(totalTime) {
	    // reset timer
	    clearTimeout(this.data('id_of_settimeout'));
	    this.empty();
	    
	    // initialize elements
	    this.append('<h4>Betting Time <span></span> seconds.</h4>');
	    this.append('<div class="progress"></div>');
	    this.children('.progress').append('<div class="progress-bar progress-bar-info"></div>');
	    this.find('.progress-bar').css({
	        cssText: '-webkit-transition: none !important; transition: none !important;',
	        width: '100%'
	    });

	    var countdown = (function(timeLeft) {
	      var $progressBar = this.find('div.progress-bar');
	      var $header = this.children('h4');

	      if (timeLeft <= 0) {
	        $header.empty().text('Over the time limit!').addClass('text-danger');
	        window.location.href = "/trump.php?no=" + no;
	        // return;
	      }

	      $header.children('span').text(timeLeft);

	      var width = (timeLeft - 1) * (100/totalTime); // unit in '%'
	      if (width < 20) { // less than 20 %
	        $progressBar.removeClass();
	        $progressBar.addClass('progress-bar progress-bar-danger');
	      } else if (width < 50) { // less than 50 % (and more than 20 %)
	        $progressBar.removeClass();
	        $progressBar.addClass('progress-bar progress-bar-warning');
	      }

	      $progressBar.animate({
	        width:  width + '%'
	      }, 1000, 'linear');

	      var id = setTimeout((function() {
	        countdown(timeLeft - 1);
	      }), 1000);
	      this.data("id_of_settimeout", id);
	    }).bind(this);

	    countdown(totalTime);
	  };
	})(jQuery);

  //カウントダウン実行
  //$('#timer').timer(setSecond);
  
setTimeout(function(){
		$('#pcard1').show();
		$('#pcard1').animate({'left': '10px'})
	},1000);
setTimeout(function(){
		$('#bcard1').show();
		$('#bcard1').animate({'left': '10px'})
	},2000);
setTimeout(function(){
		$('#pcard2').show();
		$('#pcard2').animate({'left': '10px'})
	},3000);

setTimeout(function(){
		$('#bcard2').show();
		$('#bcard2').animate({'left': '10px'})
	},4000);
setTimeout(function(){
		$('#pcard3').show();
		$('#pcard3').animate({'left': '10px'})
	},5000);
setTimeout(function(){
		$('#bcard3').show();
		$('#bcard3').animate({'left': '10px'})
	},6000);

});
</script>

</head>

<div id="wrapper">
<div id="log_space">
<br>
<table>
	<tbody>

	</tbody>
</table>
</div>

<div id="logo">BACCARAT</br></div>
<div class="container">
    <div id="timer"></div>
</div>
<div id="player_card">PLAYER
<br />

<br />
Total:

<br />

<div id="pcard1"><img src="card_pic/ura.gif"></div>
<div id="pcard2"><img src="card_pic/ura.gif"></div>
<div id="pcard3"><img src="card_pic/ura.gif"></div>
<br>

</div>
<div id="banker_card">BANKER
<br />

<br />
Total:

<br />

<div id="bcard1"><img src="card_pic/ura.gif"></div>
<div id="bcard2"><img src="card_pic/ura.gif"></div>
<div id="bcard3"><img src="card_pic/ura.gif"></div>

<br>

</div>


	<div id="bet_player">PLAYER</div>
	<div id="bet_tie">TIE</div>
	<div id="bet_banker">BANKER</div>
	<div id="bet_player"></div>
	<div id="pear_player">PAIR</br>PLAYER</div>
	<div id="pear_banker">PAIR</br>BANKER</div>
	<div id="bet_banker"></div>
	<td><img src= 'card_pic/coin10.gif' ></td>
	<td><img src= 'card_pic/coin50.gif' ></td>
	<td><img src= 'card_pic/coin100.gif' ></td>
	<td><img src= 'card_pic/coin500.gif' ></td>
	<td><img src= 'card_pic/coin1000.gif' ></td>
	<td><img src= 'card_pic/coin5000.gif' ></td>
	<div id= "bet_cancel"></div>
	<div id= "player_money">\</div>
<ul>
  <li><?php echo "<a href='?no=$no'>Next</a>"; ?></li><br>
  <li><?php echo "<a href='table_list.php'>Table List</a>"; ?></li>
</ul>
</div>
</div>

</body>
</html>