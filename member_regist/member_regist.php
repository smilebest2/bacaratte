<?php
session_start();

require_once 'member_regist_model.php';
require_once '../common/function.php';
require_once '../common/mysql.php';
require_once '../common/const.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>会員登録</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />



	<script type="text/javascript" src="js/const.js"></script>

</head>



<div id="wrapper">
	<div id="header"></br></br></br>
		<p class="headerTitle">会員登録</p>
	</div>


<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<br/><br/>
  <TBODY style="margin-top:10px;">
    <TR>
      <INPUT type="submit" value=" キャンセル " name="back" style="position: relative; left: 900px; top: 0px;"></TD>
      <br/><br/>
    </TR>
  </TBODY>
<br/><br/>

<?php

	echo '<table id="table_contact" width="500">';

		echo '<tr>';
		echo ' <th width="250">' . member_id . '</td>';
		echo '                           <td width="350"><input type="text" name="required_member_name" style="ime-mode: active" maxlength="50" size="50" value="' . $name . '" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<tr>';
		echo ' <th>' . member_mail . '</td>';
		echo '                           <td><input type="text" name="required_member_mail" style="ime-mode: active" maxlength="50" size="50" value="' . $mail . '" /></td>';
		echo '</tr>';
		echo '<tr>';		
		echo ' <th>' . member_mail_ck . '</td>';
		echo '                           <td><input type="text" name="required_member_mail_ck" style="ime-mode: active" maxlength="50" size="50" value="' . $mail_ck . '" /></td>';
		echo '</tr>';

	echo '	</tr>';
	

	
	

	echo '</table>';
	echo '<center><font size="2" color="red" ><span>※ログインIDは半角英数4文字以上20文字以内で入力してください。</span></br>';
		echo '<span>' . $_POST["err1"] . '</span></center></font>';

?>

<br/>
<br/>
<br/>
  <TBODY>
    <TR>
      <INPUT type="submit" value=" 下記の利用規約に同意して確認画面へ " name="check" style="position: relative; left: 400px; top: 0px;"></TD>
      <br />
    </TR>
  </TBODY>
<br/>
<Div Align="center">
	<textarea name="membAgreement" cols="60" rows="10" readonly="readonly">----------------------------------------------
サービス利用規約
----------------------------------------------

株式会社スマイルベスト（以下、「当社」と記載）の提供する、訪問レセプトサービス（以下、「本サービス」と記載）を利用されるお客様（以下、「お客様」と記載）は、本ご利用規約（以下、「本規約」と記載）に基づいて本サービスをご利用ください。本サービスをご利用になった場合、本規約の内容に同意したものとみなします。

本規約は、当社により予告無く変更されることがあります。お客様は、ご利用の際は、最新の本規約をご確認ください。
本規約の他、本サービスのご利用につき個別サービス毎に別途規約、ガイドライン、ポリシー等が付加される場合があります。各サービスご利用の際にご確認ください。なお、これらの規約、ガイドライン、ポリシー等は、本規約の一部として構成されます。

第１条（ご利用目的）
お客様は、お客様ご自身が閲覧・ご利用する目的のためにのみ本サービスを利用することができます。本サービスの全部または一部を問わず、有償情報の提供その他本サービスを利用した有償サービスを提供する目的で利用（使用、再生、複製、複写などの形態は問いません）することはできません。

第２条（ご利用料金）
本サービスのご利用に関しては、各リンク先サイトで定められた利用規約等に従うものとします。各リンク先サイトにてご確認ください。
※無料ご利用の場合は料金は発生いたしません。
第３条（本サービスの利用）

1. お客様が本サービスの利用を希望される場合は、お客様のメールアドレス、その他お申込みの内容を特定するために当社が指定する事項（以下、併せて「お客様の情報等」といいます）について、Webその他当社が指定する方法で当社に対してご提出いただきます。お客様の情報等は常に最新、正確かつ真実な内容であるものとしてください。お客様情報等の提出により本サービスのお申込とみなし、当社が当該お申込を承諾した時点で契約とみなします。別途当社が定める利用期間中において、本サービスを利用することができます。

2.当社 が提供するインタフェース以外の手段で、本サービスのいずれにもアクセスしないこと（またはアクセスを試みないこと）に同意するものとします。特に、お客様は、いかなる本サービスについても、いかなる自動化された方法（スクリプトやウェブ クローラーの利用によるものを含みます）によりアクセスせず、アクセスを試みないことに同意します。

3.お客様は、本サービス（または本サービスに接続されているサーバおよびネットワーク）を妨害、中断させるいかなる行為も行わないことに同意するものとします。

4. お客様が本サービスの利用申込をした時点で、システム仕様について合意したものと
みなします。お客様からの仕様変更やプログラム修正のリクエストに関しては、受付しますが、いかなる内容であっても当社はそれに対応する義務がないことに同意します。

5. 当社は、お客様のお申込みが、以下の各号のいずれかに該当する場合は、本サービスのお申込みを拒否、または当該契約を解除し、将来にわたって本サービスその他当社が提供するサービスのご利用をお断りする場合があります。

(1) 不実、不正確な内容にて申込みが行なわれた場合
(2) 該当お申込者が、過去に当社が提供する各サービス等において契約上の義務を怠ったことある場合、または今後も怠るおそれがあると当社が判断した場合
(3) 本サービスの継続的な提供が合理的な理由により困難であると当社が判断した場合
(4) 同業種を営む企業、もしくは関係者の申込であると当社がみなした場合
(5) 明らかに、ひやかしまたはいたずらと当社が判断する場合。
(6) 長期間にわたり、当社からお客様へ連絡がつかない場合。
(7)　60日間以上本サービスにアクセスまたは利用がなかった場合
(8) その他、当社が、業務の遂行上著しい支障があると判断した場合。
(9) 当社は、申し込みを拒否、または解除したことについて一切の責任を負わず、また申し込み拒否または解除の理由を、お客様に説明する義務を負わないものとします。 

5. お客様の情報等について変更が生じた場合については以下のとおりとします。
(1) お客様は、お客様のメールアドレス・その他のお客様情報について変更が生じる場合所定の方法により速やかに当社に連絡することに同意します。

(2) お客様の連絡等の方法により情報等の変更がなされた場合は、それ以後、当社からお客様に対する連絡、通知等は、変更先に対して送付または送信されるものとします。届出なくお客様の情報等が変更された場合、当社が変更前の連絡先に対して通知、連絡したこと、またお客様と連絡がとれなかったことに起因して、当社はお客様および第三者に対して生じたいかなる損害についても一切責任を負いません。

第４条（利用の制限）
１．当社 は、本サービスの一環としソフトウェア（以下「本ソフトウェア」といいます）を提供します。

２．お客様は、本ソフトウェアまたはその一部のコピー、修正、二次的著作物の作成、リバースエンジニアリング、デコンパイル、またはその他の方法によりそのソースコードの抽出を試みてはならず、第三者にもかかる行為を認めてはならないものとします。

３．当社 が書面により明確に許可した場合を除き、お客様は、本ソフトウェアを使用する権利を譲渡したり、サブライセンスを供与したり、本ソフトウェアを使用する権利に担保を設定したり、その他の方法により本ソフトウェアを使用する権利の一部を移転したりしないことに同意するものとします。

第５ 条(データの保管、保持期限)
１．本サービスにてお客様が作成したデータは契約の解除と同時に消去されることに同意します。
２．本サービスを利用中にお客様が作成したデータの保管、保持期間はお客様が本システムを利用している日から過去2年間分を原則とします。 

第６条　コンテンツ
1.お客様は、本サービスの一環として、または本サービスの利用を通じてアクセスできるすべての情報（データファイル、テキスト、ソフトウェア、音楽、音声ファイルまたはその他のサウンド、写真、映像またはその他の画像等）についての責任は、そのコンテンツを制作した者に単独で帰属することを理解するものとします。上記のすべての情報を以下「本コンテンツ」といいます。

2.お客様は、本サービスの一環として提供される広告やリンクなどを含む本コンテンツが、本コンテンツを 当社 に提供したスポンサーや広告主（または上記の者を代理するその他の者もしくは会社）などの第三者が保有する知的財産権によって保護される場合があることを理解するものとします。お客様は、本コンテンツを修正、賃貸、リース、貸出、販売、配布し、または本コンテンツ（全部もしくは一部のいずれか）に基づく二次的著作物を作成することはできません。ただし、当社 または本コンテンツの所有者から別個の契約において明確な許可を受けた場合は除きます。

広告
1. 本サービスの一部は、広告収入により支えられており、本サービスの一部に広告および宣伝を掲載することがあります。これらの広告は、本サービス上に保存される情報の内容、または本サービスを介して行われたクエリ、またはその他の情報を対象とすることがあります。

2. 本サービス上の 当社 による広告の様式、形態および範囲は、お客様に対し特定の通知を行うことなく変更されることがあります。

3. お客様は、本サービスのアクセス権および利用権をお客様に許諾することの対価として、当社 が、本サービス上で上記のような広告を行えることについて同意するものとします。

その他のコンテンツ
1. 本サービスは、他のウェブサイトまたはコンテンツまたは情報源へのハイパーリンクを含むことがあります。当社 は、当社 以外の企業または個人により提供されるウェブサイトまたは情報源に対し、一切のコントロールを持たないことがあります。

2. 当社 が、上記のような外部のサイトまたは情報源の利用可能性について責任を負わないこと、および、当社 が、上記のようなウェブサイトまたは情報源における、またはここから入手できる広告、製品またはその他品質を保証しないことについて了承し同意ものとします。

3 上記のような外部のサイトまたは情報源の利用可能性に起因し、または、お客様が、上記のようなウェブサイトや情報源における、またはそれらから入手できる広告、サービスや製品、またはその他の品質の完全性、正確性または存在を信頼したことに起因して被るいかなる損失または損害についても、 当社 が責任を負わないことについて了承しかつ同意するものとします。

第７条
お客様のパスワードおよびIDのセキュリティ

1.お客様は、ご自身が本サービスにアクセスするために使用するすべてのIDに関係するパスワードの秘密を保持する責任を負うことを理解し、これに同意します。
ID 及びパスワードを第三者に利用させたり、貸与、譲渡、名義変更、売買などをしてはなりません。

2.お客様は、前項を踏まえて、ご自身のアカウントにおいて生じるすべての活動や行為について、当社 に対して単独で責任を負うことに同意するものとします。

3.物理的セキュリティキーを付与したサービスを利用する場合、その保管に関して
お客様が全責任を負うことを理解し、これに同意します。

4.パスワード、ID、物理的セキュリティキーの不正な使用に気付いた場合は、
速やかに当社に連絡をすることに同意するものとします。

5.パスワード、ID、物理的セキュリティキーを失念および紛失された場合は、
以降当該サービスを継続して利用することができなくなる場合があります。それによ
り本サービスに登録したデータ、内容等が以降利用できなくなることについて、アッ
プシステムは一切責任を負いません。

第８条（お客様の情報等の取り扱い）

1. 当社は、お客様の情報等を次の目的のために利用します。
(1) 本サービスの提供・管理・運営のため
(2) お客様がご利用するにあたり必要な連絡をするため
(3) キャンペーン、アンケート等、その他製品、サービス等に関するお知らせ等を送付するため

2. なお、当社は、以下の場合、お客様の情報等を公表することがあります。
(1) 本サービスにおいて、提携先が提供するサービスが含まれている場合に当該サービスに関し、お客様からのお問合せ等に対して調査、回答等を要するため、お客様の情報等を当該提携先に対して開示する場合
(2) お客様が、当社が提供する本サービスに加えて、提携先が提供するサービスにお申込をされる場合、当該お申込に必要なお客様情報等を当該提携先に対して開示することがあります。
(3) その他、法令に基づく場合

3. その他の事項につきましては、当社のプライバシーポリシーをご参照ください。

第９条（取消・解除）
(1)お客様は、当社が定める所定の方法により、契約を解除できるものとします。契約の取り消し・解除お申込みは、所定の方法によりおこなってください。

(2)お客様が作成したデータは、契約取消・契約解除前にPDF保存、画面コピー等の方法によりお客様の責任において保管するものとします。
当社は、お客様の指定する環境にデータを保管、または他のシステムに移行するプログラム、またはその手法等についてお客様に提供しないことに同意するものとします。

第１０条（認証等）
お客様は、お客様が当社の製品または本サービス以外の当社のサービス（以下、「当社製品等」といいます）から本サービスへアクセスしていただいた場合、当社製品等から本サービスへ認証情報を自動的に送信することがあります。認証情報の送信は、アクセス認証を自動的に行うこと、および当社製品等との連携を行うことを目的としています。この場合、本サービスは、当社製品等に登録された認証情報を取得することにより、自動認証することがあります。

第１１条（免責）
当社は、本サービスの運営にあたり免責事項を次のとおり定めます。お客様は、本サービスは、お客様ご自身の責任のもとでの利用するものとし、利用に関わる全ての危険はお客様のみが負うことをここに確認し、同意するものとします。

1.コンテンツの信頼性、正確性、有用性、完全性、安全性の放棄
当社は、本規約に同意されたお客様が本サービスにアクセスしてコンテンツを投稿することを許諾することがありますが、本サービスの内容や確実な提供、アクセス結果、情報のセキュリティ（お客様が本サービスのご利用の際に登録したデータの全部および一部が漏洩・破損）などにつきましては、理由の如何に関わらずそれら一切の保証は行いません。

2. 本サービスのご利用はお客様の責任
当社は、不法行為、契約その他いかなる法的根拠による場合であっても、お客様その他の第三者に対し、本サービスおよび本サービスを通じた他のサービスを利用したこと、または利用しなかったことにより発生した情報漏洩、営業価値の損失、業務の停止、コンピュータの故障による損害、その他あらゆる商業的損害・損失を含め一切の直接的、間接的、特殊的、付随的または結果的損失、損害について責任を負いません。またコンテンツについては、データの保存、複製その他お客様による任意の利用方法に関して必要な法的権利を有しているかどうかを含め、その内容の信頼性、正確性、有用性（有益性）、完全性などにつきまして、当社は一切保証いたしません。よって、本サービスの利用に関して発生したトラブルその他紛争に関しては、当社は一切責任を負いません。本サービスはお客様ご自身の責任でご利用ください。著作権、秘密保持、名誉毀損、品位保持及び輸出に関する法令その他法令上の義務に従うこと等についてもお客様ご自身の責任において確認をおこなってください。なお、当社からの口頭または書面による、いかなる情報または助言もあらたなる保証を行い、またはその他いかなる意味においても本規約の保証範囲を拡大するものではありません。

3.サービスの一時的な中断による責任
当社は以下の事由により、お客様に事前に連絡することなく、一時的にサービスの提供を中断することがあります。このサービスの中断による損害について、当社は一切責任を負わないものとします。
(1)当社によるシステムの保守、点検、修理などを行う場合。
(2)火災・停電によりサービスの提供ができなくなった場合。
(3)天変地異などによりサービスの提供ができなくなった場合。
(4)その他、運用上または技術上、本サービス提供の一時的な中断を必要とした場合。

第１２条（本サービスの変更・終了）
1. 当社は、本サービスの内容を、お客様への事前の通知なくして変更することがありますが、お客様はそれに同意するものとし、それによりコンテンツおよび投稿情報が、削除されることおよび閲覧できなくなること、特定のサービスが利用できなくなること、その他、お客様に不利益または損害が発生したとしても、当社は一切その責を負わないものとします。
2. 当社は本サービスを、お客様に対する事前の予告なくして停止または廃止することができます。当社が本サービスを停止または廃止した場合には、当社はお客様に対して一切の損害賠償等の責を負わないものとします。

第１３条（準拠法および裁判管轄）
本規約は、法の抵触に関する原則の適用を除いて、日本国の法律を準拠法とします。また、本規約に関して紛争が生じた場合は、訴額に応じて東京簡易裁判所および東京地方裁判所を専属第一審管轄裁判所とします。

以上</textarea>
</Div>
<br />
</form>
<div id="footer">
	<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All Rights Reserved.</p>
</div>
</body>

</html>