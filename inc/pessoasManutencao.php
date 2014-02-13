<?php
$pessoas = new PessoaDAO();
if (count($_POST) > 0) {
	$dados = array(
		"id" => $_POST['id'],
		"tipo" => $_POST['tipo'],
		"cpf_cnpj" => $_POST['cpf_cnpj'],
		"rg_ie" => $_POST['rg_ie'],
		"nome" => $_POST['nome'],
		"endereco" => $_POST['endereco'],
		"telefone" => $_POST['telefone'],
		"contato" => $_POST['contato']
	);
	if (Ambiente::getAction() == "edit")
		$pessoas->atualiza($dados);
	else
		$pessoas->insere($dados);
}
if (Ambiente::getAction() == "edit") {
	$dados = $pessoas->lista("id", Ambiente::getId(), false);
	foreach ($dados[0] as $key => $value) {
		$$key = $value;
	}
}

if (Ambiente::getAction() == "del") {
	$dados['id'] = Ambiente::getId();
	$pessoas->exclui($dados);
	$p = explode('Manutencao',Ambiente::getPage());
	echo "<script>location.href = '",Ambiente::$url, $p[0],"'</script>";
	exit();
}

$action = Ambiente::$url . Ambiente::getPage() . "/" . Ambiente::getAction() . "/" . Ambiente::getId();
?>
<div class="listagem">
	<form name="manutencao" id="manutencao" action="<?php echo $action; ?>" method="post">
		<h2>Cadastro de Pessoas - Editar/Incluir</h2>
		<div class="buttons">
			<?php if(Ambiente::getAction()=="edit"): ?>
			<input type="button" name="excluir" id="excluir" value="Excluir" onclick="location.href = '<?php echo Ambiente::$url, Ambiente::getPage(), '/del/', Ambiente::getId() ?>';"/>
			<?php endif; ?>
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
					<label for="tipo">Tipo</label>
					<span>Física</span>
					<input type="radio" name="tipo" id="tipo" value="0"<?php if ($tipo == "0") echo ' checked="checked"' ?> />
					<span class="front">Jurídica</span>
					<input type="radio" name="tipo" id="tipo" value="1"<?php if ($tipo == "1") echo ' checked="checked"' ?> />
					<label for="cpf_cnpj">CPF/CNPJ</label><input type="text" name="cpf_cnpj" id="cpf_cnpj" value="<?php echo $cpf_cnpj ?>" />
					<label for="rg_ie">RG/IE</label><input type="text" name="rg_ie" id="rg_ie" value="<?php echo $rg_ie ?>" />
					<label for="nome">Nome</label><input type="text" name="nome" id="nome" value="<?php echo $nome ?>" />
					<label for="endereco">Endereço</label><input type="text" name="endereco" id="endereco" value="<?php echo $endereco ?>" />
					<label for="telefone">Telefone</label><input type="text" name="telefone" id="telefone" value="<?php echo $telefone ?>" />
					<label for="contato">Contato</label><input type="text" name="contato" id="contato" value="<?php echo $contato ?>" />
				</fieldset>
			</div>
		</div>
	</form>
</div>
<?php
#print_r($dados[0]) ?>