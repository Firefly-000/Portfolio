<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>動物で癒されよう</title>
</head>
<body>

<h1 align="center">動物で癒されよう</h1>
<h2>どの動物で癒される？</h2>

<?php
if(isset($_GET['animal']))
{
    $animal = $_GET['animal'];
    if($animal=="dog")
    {
        //URLを生成する
        $req = "https://dog.ceo/api/breeds/image/random";
        //JSONデータをダウンロードする
        $json= file_get_contents($req);
        $json_decode=json_decode($json);
        //JSONデータから目的とするデータを抽出する
        $URL=$json_decode->{"message"};
    }
    else if($animal=="cat")
    {        
        //URLを生成する
        $req = "https://aws.random.cat/meow";
        //JSONデータをダウンロードする
        $json= file_get_contents($req);
        $json_decode=json_decode($json);
        //JSONデータから目的とするデータを抽出する
        $URL=$json_decode->{"file"};
    }
    else if($animal=="fox")
    {        
        //URLを生成する
        $req = "https://randomfox.ca/floof/";
        //JSONデータをダウンロードする
        $json= file_get_contents($req);
        $json_decode=json_decode($json);
        //JSONデータから目的とするデータを抽出する
        $URL=$json_decode->{"image"};
    }
    else if($animal=="shiba")
    {       
        //URLを生成する
        $req = "http://shibe.online/api/shibes?count=1&urls=true&httpsUrls=true";
        //JSONデータをダウンロードする
        $json= file_get_contents($req);
        $json_decode=json_decode($json);
        //JSONデータから目的とするデータを抽出する
        $URL=$json_decode[0];
    }
}
//動物の種類を選ぶボタン
?>
<div style="display:inline-flex">
 <form action="animal.php" method="GET">
 <input type="submit" value="犬">
 <input type="hidden" value="dog" name="animal">
 </form>
 <form action="animal.php" method="GET">
 <input type="submit" value="猫">
 <input type="hidden" value="cat" name="animal">
 </form>
 <form action="animal.php" method="GET">
 <input type="submit" value="狐">
 <input type="hidden" value="fox" name="animal">
 </form>
 <form action="animal.php" method="GET">
 <input type="submit" value="柴犬">
 <input type="hidden" value="shiba" name="animal">
 </form>
</div>

<?php
//画像表示
echo "<br>";
if(isset($URL))
{?>
    <img src=<?php echo $URL; ?> width=50% >
<?php
}
?>
</body>
</html>

