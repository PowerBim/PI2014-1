<?php
$animais = new AnimalDAO();
$pessoas = new PessoaDAO();
if (count($_POST) > 0) {
	$dados = array(
		"id" => $_POST['id'],
		"tipo" => $_POST['tipo'],
		"nome" => $_POST['nome'],
		"pessoa_id" => $_POST['pessoa_id']
	);
	if (Ambiente::getAction() == "edit")
		$animais->atualiza($dados);
	else
		$animais->insere($dados);
}
if (Ambiente::getAction() == "edit") {
	$dados = $animais->lista("id", Ambiente::getId(), false);
	foreach ($dados[0] as $key => $value) {
		$$key = $value;
	}
	
	$donos = $pessoas->lista();
}

if (Ambiente::getAction() == "del") {
	$dados['id'] = Ambiente::getId();
	$animais->exclui($dados);
	$p = explode('Manutencao',Ambiente::getPage());
	echo "<script>location.href = '",Ambiente::$url, $p[0],"'</script>";
	exit();
}

if(count($donos)==0){
	Ambiente::setMsg(array("texto" => "Alerta: Ainda não há clientes cadastrados!", "tipo" => "alerta"));
}

$action = Ambiente::$url . Ambiente::getPage() . "/" . Ambiente::getAction() . "/" . Ambiente::getId();
?>
<div class="listagem">
	<form name="manutencao" id="manutencao" action="<?php echo $action; ?>" method="post">
		<h2>Cadastro de Animais - Editar/Incluir</h2>
		<div class="buttons">
			<?php if(Ambiente::getAction()=="edit"): ?>
			<input type="button" name="excluir" id="excluir" value="Excluir" onclick="location.href = '<?php echo Ambiente::$url, Ambiente::getPage(), '/del/', Ambiente::getId() ?>';"/>
			<?php endif; ?>
			<?php if(count($donos)>0): ?>
			<input type="button" name="enviar" id="enviar" value="Salvar" onclick="submit();"/>
			<?php endif; ?>
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
					<label for="pessoa_id">Dono</label>
					<select name="pessoa_id" id="pessoa_id">
						<?php foreach($donos as $pessoa): ?>
						<option value="<?php echo $pessoa['id']; ?>"<?php if($pessoa['id'] == $pessoa_id) echo ' selected="selected"' ?>><?php echo $pessoa['nome'] ?></option>
						<?php endforeach; ?>
					</select>
					<label for="tipo">Tipo</label><input type="text" name="tipo" id="tipo" value="<?php echo $tipo ?>" />
					<label for="nome">Nome</label><input type="text" name="nome" id="nome" value="<?php echo $nome ?>" />
				</fieldset>
			</div>
		</div>
	</form>
</div>