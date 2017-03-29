<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<div class="container-fluid">
    <h2>Listagem de Clientes</h2>


<?php
/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 27/03/2017
 * Time: 22:05
 */

require_once ('Cliente.php');

$id = array(1,50,62,93,68,37,102,392,205,10);

foreach ($id as $key => $x) {
    $id = $x;
    $nome = "Cliente ".$x;
    $cpf = str_pad($x, 11, STR_PAD_LEFT);
    $email = "cliente_".$x."@site.com.br";
    $cidade = "Santos";
    $clientes[$x] = new Cliente($id, $nome, $cpf, $email, $cidade);
}

if (isset ($_GET['ordem'])) {
    if ($_GET['ordem'] == 1) {
        ksort($clientes);
    } elseif ($_GET['ordem'] == 2) {
        krsort($clientes);
    }
}

echo "<a href='index.php?ordem=1'>ordem crescente</a><br>";

echo "<a href='index.php?ordem=2'>ordem decrescente</a><br>";




foreach ($clientes as $key => $cliente) {
    $show = false;
    if (isset($_GET['busca'])) {
        if ($_GET['busca'] == $key) {
            $show = true;
            echo "<a href='index.php'>exibir todos</a><br>";
        }
    } else {
        $show = true;
    }
    if ($show) {
        echo "<div class='well'>";
        echo "<a href='index.php?busca={$key}'>{$cliente -> getId()}</a>";
        echo "<br>";
        echo $cliente->getNome();
        echo "<br>";
        echo $cliente->getCpf();
        echo "<br>";
        echo $cliente->getEmail();
        echo "<br>";
        echo $cliente->getCidade();
        echo "<br>";
        echo "<br>";
        echo "</div>";
    }
}
?>
</div>
