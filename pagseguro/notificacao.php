<?php
    require_once "PagSeguroLibrary/PagSeguroLibrary.php";
    $notificationCode = $_POST['notificationCode'];

try{
    $credencials = PagSeguroConfig::getAccountCredentials();
    $response = PagSeguroNotificationService::checkTransaction($credencials, $notificationCode);

    $reference = $response->getReference();
    $status = $response->getStatus();


}catch(PagSeguroServiceException $e){
    die($e->getMessage());

}   
?>