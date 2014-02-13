<div class="listagem">
	<h2>Vendas Efetuadas</h2>
	<div class="buttons">
		<input type="button" name="novo" id="novo" value="Novo" onclick="location.href = '<?php echo Ambiente::$url, Ambiente::getPage(), '/insert/' ?>';"/>
	</div>
	<?php
	$vendas = new VendaDAO();
	$ui = new ui();

	Venda::setColunasPadrao();
	$ui->listaTabela($ui->formataLista($vendas->lista(), Venda::getColunas()));
	?>
</div>