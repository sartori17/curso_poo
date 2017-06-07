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
    set_include_path(get_include_path() . PATH_SEPARATOR . CLASS_DIR);
    spl_autoload_register();

    /**
     * Created by PhpStorm.
     * User: felipe
     * Date: 27/03/2017
     * Time: 22:05
     */

    $config = include "POO/db/config.php";

    if (!isset($config['db'])) {
        throw new \InvalidArgumentException("Configuração não existe");
    }

    $host = (isset($config['db']['host'])) ? $config['db']['host'] : null;
    $dbname = (isset($config['db']['dbname'])) ? $config['db']['dbname'] : null;
    $user = (isset($config['db']['user'])) ? $config['db']['user'] : null;
    $password = (isset($config['db']['password'])) ? $config['db']['password'] : null;

    $conn2 = $conn = new \PDO("mysql:host={$host};dbname={$dbname}", $user, $password);

    echo "<a class='btn btn-sm btn-default' href='index.php?ordem=1'>ordem crescente</a>";

    echo "<a class='btn btn-sm btn-default' href='index.php?ordem=2'>ordem decrescente</a>";
    if (isset($_GET['busca'])) {
        echo "<a class='btn btn-sm btn-primary' href='index.php'>exibir todos</a><br>";
    }

    if (isset ($_GET['ordem'])) {
        if ($_GET['ordem'] == 1) {
            $order = " order by idcliente asc";
        } elseif ($_GET['ordem'] == 2) {
            $order = " order by idcliente desc";
        }
    }

    $where = "";
    if (isset($_GET['busca'])) {
        $where = " WHERE idcliente = {$_GET['busca']}";
    }

    $query = "select * from cliente $where $order";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $busca = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    foreach ($busca as $dados) {
        $id = $dados['idcliente'];
        $nome = $dados['nome'];
        $email = $dados['email'];
        $cidade = $dados['cidade'];
        $endereco = $dados['endereco'];
        $registro = $dados['registro'];
        $grauImportancia = $dados['grauimportancia'];
        $tipo = $dados['tipo'];
        if ($tipo === 'F') {
            $cliente = new POO\Cliente\Type\ClienteFisica($conn2);
            $clientes[] = $cliente->setId($id)
                ->setNome($nome)
                ->setCPF($registro)
                ->setEmail($email)
                ->setCidade($cidade)
                ->setGrauImportancia($grauImportancia)
                ->setEndereco($endereco);
        } elseif ($tipo === 'J') {
            $cnpj = $cnpj;
            $cliente = new POO\Cliente\Type\ClienteJuridico($conn2);
            $clientes[] = $cliente->setId($id)
                ->setNome($nome)
                ->setCNPJ($registro)
                ->setEmail($email)
                ->setCidade($cidade)
                ->setGrauImportancia($grauImportancia)
                ->setEndereco($endereco);
        }

        echo "<tr ><td>{$cliente -> getId()}</td>";
        echo "<td>{$cliente->getNome()}</td>";
        echo "<td>{$cliente->getNumeroIndetificacao()}</td>";
        echo "<td>{$cliente->getEmail()}</td>";
        echo "<td>{$cliente->getEndereco()}</td>";
        echo "<td>{$cliente->getCidade()}</td>";
        echo "<td>{$cliente->getTipo()}</td>";
        echo "<td>{$cliente->getGrauImportancia()}</td>";
        echo "<td><a class='btn btn-mini btn-primary' href='index.php?busca={$cliente->getId()}'>exibir</a></td>";
        echo "</tr>";

    }
    echo "</table>";
    ?>
</div>
