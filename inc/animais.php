<div class="listagem">
	<h2>Cadastro de Animais</h2>
	<div class="buttons">
		<input type="button" name="registro" id="registro" value="Novo Registro" onclick="location.href='<?php echo Ambiente::$url . Ambiente::getPage() . "Manutencao/insert/0'" ?>"/>
	</div>
	<?php
	$animais = new AnimalDAO();
	$ui = new ui();

	Animal::setColunasPadrao();
	$ui->listaTabela($ui->formataLista($animais->lista(), Animal::getColunas()));
	?>
</div>