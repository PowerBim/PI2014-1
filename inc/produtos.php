<div class="listagem">
	<h2>Cadastro de Produtos</h2>
	<div class="buttons">
		<input type="button" name="novo" id="novo" value="Novo" onclick="location.href = '<?php echo Ambiente::$url, Ambiente::getPage(), 'Manutencao', '/insert/' ?>';"/>
	</div>
	<?php
	$produtos = new ProdutoDAO();
	$ui = new ui();

	Produto::setColunasPadrao();
	$ui->listaTabela($ui->formataLista($produtos->lista(), Produto::getColunas()));
	?>
</div>