<html>
<head lang="ja">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>チンチロリンゲーム</title>
</head>
<body bgcolor="#FFDDDD">
<h1>チンチロリンゲーム</h1>
<?php
if(isset($_GET['commoney']))
{  //持ち金
    $commoney = $_GET['commoney'];
} 
else
{
    $commoney = 90000;
}
if(isset($_GET['money']))
{  //持ち金
    $money = $_GET['money'];
} 
else
{
    $money = 4500;
}
echo"CPUの現在の持ち金:$commoney";
echo "円<BR>";
echo "あなたの現在の持ち金：$money";
echo "円";
?>
<form action="xi-result.php" method="GET">
賭け金　<input type="text" name="bet" >円
<input type="submit" value="サイ振り">
<input type="hidden" value=<?php echo $money; ?>  name="money">
<input type="hidden" value=<?php echo $commoney; ?>  name="commoney">
</form>
<hr color=gray>
<h2>チンチロリンとは</h2>
親と子が順番にサイコロを３つ振り、出目の役で勝負するゲームです。<BR>
役によって賭け金の配当が異なったり、その場で負けとなる役もあります。<BR>
<h3>遊び方</h3>
CPUが親、あなたが子です。<BR>
1.子が賭け金を決め、互いに賭け金を場に出します。<BR>
2.親から先にサイコロを振ります。この時、一二三が出れば親の即負けとなります。<BR>
3.次に子がサイコロを振ります。同様に一二三が出れば子の即負けとなります。<BR>
4.役の強弱で勝ち負けを決めます。勝ったプレイヤーは賭け金をもらえます。<BR>
5.CPUかあなた、どちらかの持ち金が０になった時点でゲーム終了です。<BR>
<h3>役一覧</h3>
<img src="http://localhost/xigame/チンチロリン.jpg" alt="役" width="391" height="376"><BR>
このゲームでは「ションベン」はありません。
<?php

?>
</body>
</html>