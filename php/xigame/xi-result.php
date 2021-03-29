<html>
<head lang="ja">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>勝負の結果は？</title>
</head>
<body bgcolor="#DDDDFF">
<?php

//役の判定
function hand($arg)
{
    if($arg[0]==$arg[1]&&$arg[1]==$arg[2])
    {
        $arghand=16-$arg[0];
    }
    elseif($arg[0]==4&&$arg[1]==5&&$arg[2]==6)
    {
        $arghand=9;
    }
    elseif($arg[0]==1&&$arg[1]==2&&$arg[2]==3)
    {
        $arghand=1;
    }
    elseif($arg[0]==$arg[1])
    {
        $arghand=2+$arg[2];
    }
    elseif($arg[0]==$arg[2])
    {
        $arghand=2+$arg[1];
    }
    elseif($arg[1]==$arg[2])
    {
        $arghand=2+$arg[0];
    }
    else
    {
        $arghand=2;
    }
    return $arghand;
}
//配当の決定
function judge($winhand)
{
    if($winhand==15)
    {
        $i=5;
    }
    elseif($winhand<=14&&$winhand>=10)
    {
        $i=3;
    }
    elseif($winhand==9)
    {
        $i=2;
    }
    elseif($winhand<=8&&$winhand>=3)
    {
        $i=1;
    }
    return $i;
}
//画像の表示
function hyouji($xi)
{
    for($i=0;$i<3;$i++)
    {
        if($xi[$i]==1)
        {
            ?><img src="http://localhost/xigame/xi1.png" width="25" height="25"><?php
        }
        elseif($xi[$i]==2)
        {
            ?><img src="http://localhost/xigame/xi2.png" width="25" height="25"><?php
        }
        elseif($xi[$i]==3)
        {
            ?><img src="http://localhost/xigame/xi3.png" width="25" height="25"><?php
        }
        elseif($xi[$i]==4)
        {
            ?><img src="http://localhost/xigame/xi4.png" width="25" height="25"><?php
        }
        elseif($xi[$i]==5)
        {
            ?><img src="http://localhost/xigame/xi5.png" width="25" height="25"><?php
        }
        else
        {
            ?><img src="http://localhost/xigame/xi6.png" width="25" height="25"><?php
        }
    }
}
//役の表示
function yaku($hand)
{
    if($hand==15)
    {
        echo "ピンゾロ！";
    }
    elseif($hand==14)
    {
        echo "２ゾロ！";
    }
    elseif($hand==13)
    {
        echo "３ゾロ！";
    }
    elseif($hand==12)
    {
        echo "４ゾロ！";
    }
    elseif($hand==11)
    {
        echo "５ゾロ！";
    }
    elseif($hand==10)
    {
        echo "６ゾロ！";
    }
    elseif($hand==9)
    {
        echo "シゴロ！";
    }
    elseif($hand==8)
    {
        echo "６の目！";
    }
    elseif($hand==7)
    {
        echo "５の目！";
    }
    elseif($hand==6)
    {
        echo "４の目！";
    }
    elseif($hand==5)
    {
        echo "３の目！";
    }
    elseif($hand==4)
    {
        echo "２の目！";
    }
    elseif($hand==3)
    {
        echo "１の目！";
    }
    elseif($hand==2)
    {
        echo "役無し！";
    }
    elseif($hand==1)
    {
        echo "ヒフミ！";
    }


}
$commoney  = $_GET['commoney']; 
$money  = $_GET['money']; 
try
{
    $bet  = $_GET['bet']; 
    if($bet=="")
    {
        throw new Exception("賭け金を入力してください");
    }
    elseif(is_numeric($bet)==false)
    {
        throw new Exception("賭け金は数値にしてください");
    }
    elseif($bet>$money)
    {
        throw new Exception("自分の所持金以下の賭け金にしてください");
    }

    else
    {
        $money=$money-$bet;
        $commoney=$commoney-$bet;
        echo "賭け金：$bet";
        echo "円<BR>";
        echo "あなたの持ち金：$money";
        echo "円<BR>";
        echo "CPUの持ち金:$commoney";
        echo "円<BR>";
    }
    
}
catch(Exception $e)
{
    echo $e->getMessage();
    die("");
}
//所持金と賭け金の受け取り



//コンピュータの手を決める
$com  = array();
for($n=0;$n<3;$n++)
{
    for($i=0;$i<3;$i++)
    {
        $com[$i]=rand(1,6);
    }
    sort($com);
    $comhand=hand($com);
    if($comhand!=2)
    {
        $n=3;
    }
}
//ユーザの手を決める
$user = array(); 
for($n=0;$n<3;$n++)
{
    for($i=0;$i<3;$i++)
    {
        $user[$i]=rand(1,6);
    }
    sort($user);
    $userhand=hand($user);
    if($userhand!=2)
    {
        $n=3;
    }
}


//コンピュータの役の判定
$comhand=hand($com);
//ユーザの役の判定
$userhand=hand($user);


//引き分け
if($comhand==$userhand)
{
    $result="draw";
}
//コンピュータの即負け
elseif($comhand==1)
{
    $x=2;
    $result="userwin";
}
//ユーザの即負け
elseif($userhand==1)
{
    $x=2;
    $result="comwin";
}
//ユーザーが勝った場合
elseif($userhand>$comhand)
{
    $x=judge($userhand);
    $result="userwin";
}
//コンピュータが勝った場合
elseif($userhand<$comhand)
{
    $x=judge($comhand);
    $result="comwin";
}

echo "CPUの手は";
hyouji($com);
yaku($comhand);
if($comhand==1)
{
    echo "<BR>";
    echo "<BR>CPUの即負け！<BR>";
    $commoney=$commoney-$bet*($x-1);
    $money=$money+$bet+$bet*$x;
}
else
{
    echo "<BR>あなたの手は";
    hyouji($user);
    yaku($userhand);
    if($userhand==1)
    {
        echo "<BR>";
        echo "<BR>あなたの即負け！<BR>";
        $money=$money-$bet*($x-1);
        $commoney=$commoney+$bet+$bet*$x;
    }
    else
    {
        echo "<BR><BR>";
        if($result=="comwin")
        {
            echo "CPUの勝ち！<BR>";
            $money=$money-$bet*($x-1);
            $commoney=$commoney+$bet+$bet*$x;
        }
        elseif($result=="userwin")
        {
            echo "あなたの勝ち！<BR>";
            $commoney=$commoney-$bet*($x-1);
            $money=$money+$bet+$bet*$x;
        }
        elseif($result=="draw")
        {
            echo "引き分け！<BR>";
            $money=$money+$bet;
            $commoney=$commoney+$bet;
        }
    }
}

echo "<BR>あなたの持ち金：$money";
echo "円<BR>";
echo "CPUの持ち金：$commoney";
echo "円<BR>";

?>
<?php
if($commoney<=0)
{?>
    <h2>GAMEOVER！あなたの勝ち！</h2><BR>
    <form action="xi-top.php" method="GET">
    <input type="submit" value="はじめから？">
    <input type="hidden" value=4500 name="money">
    <input type="hidden" value=90000 name="commoney">
    </form>
<?php
}
elseif($money<=0)
{?>
    <h2>GAMEOVER！あなたの負け！</h2><BR>
    <form action="xi-top.php" method="GET">
    <form action="xi-top.php" method="GET">
    <input type="submit" value="はじめから？">
    <input type="hidden" value=4500 name="money">
    <input type="hidden" value=90000 name="commoney">
    </form>
<?php
}
else
{?>
    <form action="xi-top.php" method="GET">
    <input type="submit" value="次のゲームへ">
    <input type="hidden" value=<?php echo $money; ?>  name="money">
    <input type="hidden" value=<?php echo $commoney; ?>  name="commoney">
    </form>
    <form action="xi-top.php" method="GET">
    <input type="submit" value="はじめから？">
    <input type="hidden" value=4500 name="money">
    <input type="hidden" value=90000 name="commoney">
    </form>
<?php
}
?>
</body>
</html>
