<?php
session_start();
error_reporting(-1);
ini_set("display_errors", "On");
$cols = 5;
$rows = 5;

$aaaa = false;

if (isset($_POST["color"])) {
    //echo $_POST["color"];
    $color = $_POST["color"];
    $aaaa = true;
}
else {
    if(isset($_COOKIE["color"])) {
        $color = $_COOKIE["color"];
        $aaaa = true;
    }
    else {
        $color = 'gray';
        //$aaaa = false;
    }
}
if($aaaa) {
    setcookie("color", $color);
}


?>
<html lang="en">
<head>
    <title>Superglobals</title>

    <style>
        .block {
            display: inline-block;
            width: 30px;
            height: 30px;
            padding: 0;
            margin: 0;
        }

        .block:hover {
            background-color: lightgray;
        }

        .cyan {
            background-color: cyan;
        }

        .magenta {
            background-color: magenta;
        }

        .yellow {
            background-color: yellow;
        }

        .gray {
            background-color: gray;
        }

        .white {
            background-color: white;
        }
    </style>
</head>
<body>

<?php
if(isset($_POST['sx']) || isset($_POST['sz'])){
    if(isset($_POST['sx'])) $_SESSION['cols'] = $_POST['sx'];
    if(isset($_POST['sz'])) $_SESSION['rows'] = $_POST['sz'];
}

/*
if (isset($_POST['color'])) {
    setcookie("color", $_POST["color"]);
    if(!isset($_COOKIE["color"])) {
        $_COOKIE["color"] = $_POST["color"];
    }
    //header("Refresh:0");
    //$col = $_POST["color"];
    //echo $_POST['color'];
}


if(isset($_COOKIE['color'])) $col = $_COOKIE['color'];
else $col = "gray";
*/

if(isset($_SESSION['cols'])) $cols = $_SESSION['cols'];
if(isset($_SESSION['rows'])) $rows = $_SESSION['rows'];

if($rows==0 || $cols==0) {
    echo '<div></div>';
}
else {
    for ($i=0; $i<$rows; $i++) {
        echo '<div>';
        for ($j=0; $j<$cols; $j++) {
            ?>
            <a class="block <?php echo $color ?>" href="?x=<?php echo $j ?>&z=<?php echo $i ?>"></a>
            <?php
        }
        echo '</div>';
    }
}



if(isset($_GET['x']) && isset($_GET['z'])) {
    if(isset($_SESSION['tab'])) {
        if($_SESSION['tab'][count($_SESSION['tab'])-2]!=$_GET['x'] || $_SESSION['tab'][count($_SESSION['tab'])-1]!=$_GET['z']) {
            $_SESSION['tab'][] = $_GET['x'];
            $_SESSION['tab'][] = $_GET['z'];
        }
    }
    else {
        $tab[] = $_GET['x'];
        $tab[] = $_GET['z'];
        $_SESSION['tab'] = $tab;
    }
}



$num = 0;
$line = [];
$help = [];
for($i=0; $i<$rows; $i++) {
    for($j=0; $j<$cols; $j++) {
        $help[$i][] = 0;
    }
}



if(isset($_SESSION['tab'])) {
    foreach ($_SESSION['tab'] as $v) {
        //echo $v . "\n";
        $num += 1;
        $line[] = $v;
        if($num==4) {
            $num = 0;

            $height = $line[2]-$line[0];
            $width= $line[3]-$line[1];
            if($width==0) $a = 0;
            else $a = $height/$width;
            $b = $line[2] - ($a * $line[3]);

            //echo "a: ".$a." b: ".$b."<br>";

            $help[$line[0]][$line[1]] = 1;
            $help[$line[2]][$line[3]] = 1;

            $r = 1;
            $s = 1;
            if ($line[0]>$line[2]) $r = -1;
            if ($line[1]>$line[3]) $s = -1;

            if ($width>=$height) {
                for ($i=$line[0]; $i!=$line[2]; $i=$i+$r) {
                    $w = $a * $i + $b;
                    $help[floor($w)][$i] = 1;
                }
            }
            else {
                for ($i=$line[1]; $i!=$line[3]; $i=$i+$s) {
                    $w = $a * $i + $b;
                    $help[$i][floor($w)] = 1;
                }
            }

            $line = [];
            //wywolanie funkcji wyliczającej pozycję na linię
                //0 -> a, 1 -> round(b), ...
        }
    }
}

/*
echo "<br>";
foreach ($help as $v) {
    for($j=0; $j<$cols; $j++) {
        echo $v[$j] . " ";
    }
    echo "<br>";
}
*/

?>

<br/>

<form method="post">
    <label>
        Columns:
        <input type="text" name="sx">
    </label>
    <label>
        Rows:
        <input type="text" name="sz">
    </label>
    <input type="submit" name="submit1" value="Change">
</form>

<form method="post">
    <label>
        Color:
        <select name="color">
            <option value="gray" selected>Gray</option>
            <option value="magenta">Magenta</option>
            <option value="yellow">Yellow</option>
            <option value="cyan">Cyan</option>
        </select>
    </label>
    <input type="submit" value="Change">
</form>

</body>
</html>
