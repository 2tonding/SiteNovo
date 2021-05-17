<?php

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
            'description' => 'Notebook Devmedia 1',
            'quantity' => 1,
            'amount' => 1999.00,
            'weight' => 1000
        ),
        1 => array(
            'id' => '0002',
            'description' => 'Notebook Devmedia 2',
            'quantity' => 1,
            'amount' => 1999.00,
            'weight' => 1000
        ),
        2 => array(
            'id' => '0003',
            'description' => 'Notebook Devmedia 3',
            'quantity' => 1,
            'amount' => 1999.00,
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