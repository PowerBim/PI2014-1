<?php

class ui {

	public function listaTabela($objeto) {
		if (!isset($objeto[0])) {
			$objeto = array(0 => array(" " => "Nenhum ítem para listar!"));
		}

		$indices = array_keys($objeto[0]);
		$tabela = "<table>
					<tr>";

		foreach ($indices as $key => $value) {
			$tabela .= "<th>$value</th>\n";
		}

		$tabela .= "<th width=\"5%\">Ações</th>";
		$tabela .= "</tr>\n";

		foreach ($objeto as $row) {
			$tabela .= "<tr>";

			foreach ($row as $td) {
				$tabela .= "<td>$td</td>\n";
			}
			$tabela .= "<td>";

			if (isset($row['ID'])) {
				$tabela .= "<a href=\"" . Ambiente::getPage() . "Manutencao/edit/{$row['ID']}\">Editar</a>";
			}

			$tabela .= "</td>";
			$tabela .= "</tr>\n";
		}
		$tabela .= "</table>";

		echo $tabela;
	}

	public function montaMenu($array, $i = 0) {
		if (is_array($array)) {
			$menu = "<ul";
			if ($i == 1)
				$menu .= ' class="sub"';
			$menu .= ">";
			foreach ($array as $key => $value) {
				$link = $value['link'] != "javascript:;" ? Ambiente::$url . $value['link'] : "javascript:;";
				$menu .= "<li>";
				$menu .= "<a href=\"$link\">$key</a>";
				if (isset($value['sub']))
					$menu .= $this->montaMenu($value['sub'], $i + 1);
				$menu .= "</li>";
			}
			$menu .= "</ul>";
			return $menu;
		}
	}

	public function getContent() {
		$page = Ambiente::getPage() . ".php";
		include("inc/" . $page);
	}

	public function exibeMsg() {
		Ambiente::verificaMsg();
		$msg = Ambiente::getMsg();
		if (isset($msg[0])) {
			for ($i = 0; $i < count($msg); $i++) {
				echo "<div class='msg_sys " . $msg[$i]['tipo'] . "'>";
				echo "	<span>" . $msg[$i]['texto'] . "</span>";
				echo "</div>";
			}
		}
		unset($_SESSION['msg']);
	}

	public function formataLista($lista, $troca) {
		if (isset($lista) && isset($troca)) {
			foreach ($lista as $keyl => $valuel) {
				foreach ($troca as $keyt => $valuet) {
					$lista[$keyl][$valuet] = $lista[$keyl][$keyt];
					unset($lista[$keyl][$keyt]);
				}
			}
		}
		return $lista;
	}

}

?>