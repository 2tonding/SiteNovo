<?php

/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */

$PagSeguroConfig = array();

//$PagSeguroConfig['environment'] = array();
$PagSeguroConfig['environment'] = "sandbox"; // production, sandbox

$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = "marcio@honnest.com.br";
$PagSeguroConfig['credentials']['token']['production'] = "f993df29-5d00-4624-bbb9-8d5d2f1cbef320a7c6db4090adb757f251e21caaa44b3c19-63c0-4ffd-bb88-452ebf151226";
$PagSeguroConfig['credentials']['token']['sandbox'] = "3650FE0A17284977A967D4247E43E3E2";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = false;
$PagSeguroConfig['log']['fileLocation'] = "";
