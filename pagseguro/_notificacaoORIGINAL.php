<?php

    require_once "PagSeguroLibrary/PagSeguroLibrary.php";
        
    $credenciais = PagSeguroConfig::getAccountCredentials();

    $type = $_POST['notificationType'];
    $code = $_POST['notificationCode'];

    if($type == "transaction"){
        $transaction = PagSeguroNotificationService::checkTransaction( $credenciais, $code);
    }

    $status = $transaction->getStatus();

    $mensagem = "Tipo: ".$type." Código: ".$code." Status: ".$status->getValue();

    mail("pagseguro@jaison.com.br", "Retorno da compra ".$_GET['compra'], $mensagem);