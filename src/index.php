<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<div class="container-fluid">
    <h2>Listagem de Clientes</h2>


    <?php

    define('CLASS_DIR', 'curso_poo.dev/');
    set_include_path (get_include_path().PATH_SEPARATOR.CLASS_DIR);
    spl_autoload_register();

    /**
     * Created by PhpStorm.
     * User: felipe
     * Date: 27/03/2017
     * Time: 22:05
     */

    $id = array(1, 50, 62, 93, 68, 37, 102, 392, 205, 10);

    foreach ($id as $key => $x) {
        $id = $x;
        $nome = "Cliente" . $x;
        $email = "cliente_" . $x . "@site.com.br";

        if ($x % 2 === 0) {
            $cpf = str_pad($x, 11, STR_PAD_LEFT);
            $cidade = "Santos";
            $cliente = new POO\Cliente\Type\ClienteFisica;
            $clientes[$x] = $cliente->setId($id)
                ->setNome($nome)
                ->setCPF($cpf)
                ->setEmail($email)
                ->setCidade($cidade)
                ->setGrauImportancia($x % 5)
                ->setEndereco("Rua Code Education, {$x}");
        } else {
            $cnpj = str_pad($x, 14, STR_PAD_LEFT);
            $cidade = "São Vicente";
            $cliente = new POO\Cliente\Type\ClienteJuridico;
            $clientes[$x] = $cliente->setId($id)
                ->setNome($nome)
                ->setCNPJ($cnpj)
                ->setEmail($email)
                ->setCidade($cidade)
                ->setGrauImportancia($x % 5)
                ->setEndereco("Rua Code Education, {$x}");
        }

    }

    if (isset ($_GET['ordem'])) {
        if ($_GET['ordem'] == 1) {
            ksort($clientes);
        } elseif ($_GET['ordem'] == 2) {
            krsort($clientes);
        }
    }

    echo "<a class='btn btn-sm btn-default' href='index.php?ordem=1'>ordem crescente</a>";

    echo "<a class='btn btn-sm btn-default' href='index.php?ordem=2'>ordem decrescente</a>";
    if (isset($_GET['busca'])) {
        echo "<a class='btn btn-sm btn-primary' href='index.php'>exibir todos</a><br>";
    }

    echo "<br><br><table class='table table-hover'>";
    echo "<tr>
            <td>#</td>
            <td>Nome</td>
            <td>CPF/CNPJ</td>
            <td>Email</td>
            <td>Endereço</td>
            <td>Cidade</td>
            <td>Tipo</td>
            <td>Grau de Importancia</td>
            <td>Opções</td>
            </tr>";
    foreach ($clientes as $key => $cliente) {
        $show = false;
        if (isset($_GET['busca'])) {
            if ($_GET['busca'] == $key) {
                $show = true;
            }
        } else {
            $show = true;
        }

        if ($show) {
            echo "<tr ><td>{$cliente -> getId()}</td>";
            echo "<td>{$cliente->getNome()}</td>";
            echo "<td>{$cliente->getNumeroIndetificacao()}</td>";
            echo "<td>{$cliente->getEmail()}</td>";
            echo "<td>{$cliente->getEndereco()}</td>";
            echo "<td>{$cliente->getCidade()}</td>";
            echo "<td>{$cliente->getTipo()}</td>";
            echo "<td>{$cliente->getGrauImportancia()}</td>";
            echo "<td><a class='btn btn-mini btn-primary' href='index.php?busca={$key}'>exibir</a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    ?>
</div>
