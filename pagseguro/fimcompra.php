<html>
    <head>
        <title>Compra finalizada</title>
    </head>
    <body>
        <h1>Compra finalizada!</h1>
        
        <h3>Código da compra conosco: <?=$_GET['cod']?></h3>
        <h3>Transação PagSeguro: <?=$_GET['transaction_id']?></h3>
        
        <h4>
            <a href="status.php?transaction_id=<?=$_GET['transaction_id']?>">Verificar status da compra</a>
        </h4>
    </body>
</html>