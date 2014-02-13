<div class="listagem">
	<h2>Cadastro de Pessoas</h2>
	<div class="buttons">
		<input type="button" name="registro" id="registro" value="Novo Registro" onclick="location.href='<?php echo Ambiente::$url . Ambiente::getPage() . "Manutencao/insert/0'" ?>"/>
	</div>
	<?php
	$pessoas = new PessoaDAO();
	$ui = new ui();

	Pessoa::setColunasPadrao();
	$ui->listaTabela($ui->formataLista($pessoas->lista(), Pessoa::getColunas()));
	?>
</div>