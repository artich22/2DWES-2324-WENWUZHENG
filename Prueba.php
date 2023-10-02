<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<body>
<table border="1" style="width:300px; border-collapse: collapse; text-align:center;">

    <?php
	$partidos=array();
	$partidos[0]="Eibar Madrid";
	$partidos[1]="Eibar Madrid";
	$partidos[2]="Eibar Madrid";
	$partidos[3]="Eibar Madrid";
	$partidos[4]="Eibar Madrid";
	$partidos[5]="Eibar Madrid";
	$partidos[6]="Eibar Madrid";
	$partidos[7]="Eibar Madrid";
	$partidos[8]="Eibar Madrid";
	$partidos[9]="Eibar Madrid";
	$partidos[10]="Eibar Madrid";
	$partidos[11]="Eibar Madrid";
	$partidos[12]="Eibar Madrid";
	$partidos[13]="Eibar Madrid";
    echo "<tr>";
    echo "<th>Columna :0</th>"; 
	$tamaño = 8;

    for($i = 0; $i < $tamaño; $i++) {
        echo "<th>Columna :$i</th>";
    }
    echo "</tr>";
    
    $quiniela = array();
    $x = array(0, 1, 2);
    
    for($j = 0; $j < 14; $j++) {
        echo "<tr>";
        echo "<td>".$partidos[$j]."</td>";
        for($i = 0; $i < 8; $i++) {
            $quiniela[$j][$i] = $x[rand(0, 2)];
            echo "<td>".$quiniela[$j][$i]."</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</HTML>
