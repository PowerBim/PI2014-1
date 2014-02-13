<?php
$produtos = new ProdutoDAO();
if (count($_POST) > 0) {
	$dados = array(
		"id" => $_POST['id'],
		"nome" => $_POST['nome'],
		"descricao" => $_POST['descricao'],
		"preco" => str_replace(',', '.', $_POST['preco']),
		"unidade" => $_POST['unidade'],
		"estoque" => str_replace(',', '.', $_POST['estoque'])
	);
	if (Ambiente::getAction() == "edit")
		$produtos->atualiza($dados);
	else
		$produtos->insere($dados);
}
if (Ambiente::getAction() == "edit") {
	$dados = $produtos->lista("id", Ambiente::getId(), false);
	foreach ($dados[0] as $key => $value) {
		$$key = $value;
	}
}

if (Ambiente::getAction() == "del") {
	$dados['id'] = Ambiente::getId();
	$produtos->exclui($dados);
	$p = explode('Manutencao',Ambiente::getPage());
	header("location: " . Ambiente::$url . $p[0]);
	//echo "<script>window.location.href = '",Ambiente::$url, $p[0],"'</script>";
}

$action = Ambiente::$url . Ambiente::getPage() . "/" . Ambiente::getAction() . "/" . Ambiente::getId();
?>
<div class="listagem">
	<form name="manutencao" id="manutencao" action="<?php echo $action; ?>" method="post">
		<h2>Cadastro de Produtos - Editar/Incluir</h2>
		<div class="buttons">
			<input type="button" name="excluir" id="excluir" value="Excluir" onclick="window.location.href = '<?php echo Ambiente::$url, Ambiente::getPage(), '/del/', Ambiente::getId() ?>';"/>
			<input type="button" name="enviar" id="enviar" value="Salvar" onclick="submit();"/>
		</div>
		<div class="clear"></div>
		<div class="manutencao">
			<div class="sidebar">
				<ul>
					<li><a href="javascript:;">Geral</a></li>
				</ul>
			</div>
			<div class="content">
				<h3>Geral</h3>
				<fieldset>
					<label for="id">ID</label><input type="text" name="id" id="id" value="<?php echo $id ?>" readonly="readonly" />
					<label for="nome">Nome</label><input type="text" name="nome" id="nome" value="<?php echo $nome ?>" />
					<label for="descricao">Descrição</label><input type="text" name="descricao" id="descricao" value="<?php echo $descricao ?>" />
					<label for="preco">Preço</label><input type="text" name="preco" id="preco" value="<?php echo str_replace('.', ',', $preco) ?>" />
					<label for="unidade">Unidade</label><input type="text" name="unidade" id="unidade" value="<?php echo $unidade ?>" />
					<label for="estoque">Estoque</label><input type="text" name="estoque" id="estoque" value="<?php echo str_replace('.', ',', $estoque) ?>" />
				</fieldset>
			</div>
		</div>
	</form>
</div>