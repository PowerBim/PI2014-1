<?php
Ambiente::login();
?>

<h1>Olá, bem-vindo ao sistema. Para continuar faça login!</h1>

<div class="login">
	<form action="<?php echo Ambiente::$url ?>login" method="post" id="frmLogin" name="frmLogin">
		<label for="login">Login</label>
		<input type="text" name="login" id="login" />
		<label for="senha">Senha</label>
		<input type="password" name="senha" id="senha" />
		<input type="submit" name="enviar" id="enviar" value="Entrar" />
	</form>
</div>