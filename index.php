<?php
require_once './bootstrap.php';
$ui = new ui();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Ambiente::$url ?>css/styles.css" />
        <title>Pet Shop</title>
    </head>
    <body>
		<div id="wrapper">
			<div class="topo">
				<a href="" class="logo"></a>
			</div>
			<div class="menu">
				<?php echo $ui->montaMenu(Ambiente::getMenu()); ?>
			</div>
			<div class="wrap">
				<?php
				$top = ob_get_contents(); // Armazena até o momento
				ob_end_clean(); // Limpa o buffer e fecha
								
				ob_start(); // Cria um novo objeto
				$ui->getContent(); // Imprime o conteúdo
				$cnt = ob_get_contents(); // Salva o buffer na var
				ob_end_clean(); // Limpa o buffer e fecha
				
				ob_start(); // Cria novo objeto
				echo $top;
				$ui->exibeMsg(); // Imprime msg
				echo $cnt; // Imprime conteúdo do buffer anterior
				?>
			</div>
		</div>
	</body>
</html>
<?php
ob_flush();
ob_end_clean();
?>