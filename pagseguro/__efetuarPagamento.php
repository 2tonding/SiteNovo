<?php
session_start();
include_once "../databaseconnect.php";
$login = $_SESSION['login'];
$link = $_GET['link'];
$nomepgto = $_GET['nome'];
$valorpgto = $_GET['valor'];

$senderNome = "Representante Distribuidor";
$senderEmail = "marcio@honnest.com.br";
$senderDdd = "54";
$senderFone = "99776648";
$senderCpf = "11111111111";

$codigoCompra = "CPR001";

$urlNotificacao = "http://marciof4.sg-host.com/pagseguro/notificacao.php?compra=".$codigoCompra;
$urlFim = "http://marciof4.sg-host.com/pagseguro/fimcompra.php?cod=".$codigoCompra;

$itens = Array(
        0 => array(
            'id' => '0001',
            'description' => 'Assinatura '.$nomepgto,
            'quantity' => 1,
            'amount' => $valorpgto,
            'weight' => 1000
        )
        );

$dadosEnvio = Array(
                'postalCode' => '01452002',
                'street' => 'Av. Brig. Faria Lima',
                'number' => '1384',
                'complement' => 'apto 100',
                'district' => 'Jardim Paulistano',
                'city' => 'São Paulo',
                'state' => 'SP',
                'country' => 'BRA'
);

    //require_once "_dados.php";
    
    if(isset($_GET['pgt'])){
        
        require_once "PagSeguroLibrary/PagSeguroLibrary.php";
        
        $requisicaoPagamento = new PagSeguroPaymentRequest();
        
        $credenciais = PagSeguroConfig::getAccountCredentials();
        
        $requisicaoPagamento->setItems($itens);
        
        $requisicaoPagamento->setSender($senderNome, $senderEmail, $senderDdd, $senderFone);
        
        $requisicaoPagamento->setShippingAddress($dadosEnvio);
        
        $requisicaoPagamento->setShippingType(3);
        
        $requisicaoPagamento->setCurrency("BRL");
        
        $requisicaoPagamento->setReference($codigoCompra);
        
        $requisicaoPagamento->setRedirectURL($urlFim);
        
        $requisicaoPagamento->addParameter('notificationURL', $urlNotificacao);
        $requisicaoPagamento->addParameter('senderCPF', $senderCpf);
        
        $url = $requisicaoPagamento->register($credenciais);
        
        header("Location: ".$url);
        
        exit;
    
?>



<?php } else { ?>

<h1>Carrinho de compras</h1>
<table border="1" width="500">
    <tr>
        <td>Item</td>
        <td>Quantidade</td>
        <td>Valor</td>        
    </tr>
    
    <?php foreach($itens as $item){ ?>
    <tr>
        <td><?=$item["description"]?></td>
        <td><?=$item["quantity"]?></td>
        <td><?=$item["amount"]?></td>        
    </tr>
    <?php } ?>
</table>

<h3><a href="efetuarPagamento10.php?pgt=s">Efetuar pagamento</a></h3>

<?php } ?>