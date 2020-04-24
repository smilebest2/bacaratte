<div id="header" >

	<h1>株式会社スマイルベスト</h1>

	<?php

	if (strlen($_SESSION["user_id"]) > 0)

	{

		echo '<a href="list.php"><img src="../images/title_list2.png" alt="案件情報サイト　タイトル" width="895" /></a>';

	}

	else

	{

		echo '<a href="login.php"><img src="../images/title_main2.png" alt="案件情報サイト　タイトル" width="895" /></a>';

	}

	?>

</div>