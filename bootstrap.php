<?php

header('Content-type: text/html; charset=UTF-8');

require_once './class/class.conexao.php';
require_once './class/class.ui.php';
require_once './class/class.pessoa.php';
require_once './class/class.pessoaDAO.php';
require_once './class/class.animal.php';
require_once './class/class.animalDAO.php';
require_once './class/class.produto.php';
require_once './class/class.produtoDAO.php';
require_once './class/class.venda.php';
require_once './class/class.vendaDAO.php';

class Ambiente {

	private static $bd = null;
	private static $conn = null;
	private static $page = null;
	private static $action = null;
	private static $id = null;
	private static $menu = null;
	private static $msg = null;
	public static $url = "http://localhost/pi-php/";

	public static function getBd() {
		return self::$bd;
	}

	private static function setBd($banco) {
		self::$bd = $banco;
	}

	public static function getConn() {
		return self::$conn;
	}

	private static function setConn($banco) {
		self::$conn = $banco;
	}

	public static function getPage() {
		return self::$page;
	}

	public static function setPage($page) {
		self::$page = $page;
	}

	public static function getAction() {
		return self::$action;
	}

	public static function setAction($action) {
		self::$action = $action;
	}

	public static function getId() {
		return self::$id;
	}

	public static function setId($id) {
		self::$id = $id;
	}

	public static function getMenu() {
		if (self::checkLogado())
			return self::$menu;
	}

	public static function setMenu($menu) {
		self::$menu = $menu;
	}

	public static function getMsg() {
		return self::$msg;
	}

	public static function setMsg($msg) {
		self::$msg[] = $msg;
	}

	public static function init() {
		ob_start();
		session_name('pi2sem2013');
		session_start();
		mysqli_report(MYSQLI_REPORT_STRICT);

		self::setPage(isset($_GET['page']) ? $_GET['page'] : "home");
		if (isset($_GET['action']))
			self::setAction($_GET['action']);
		if (isset($_GET['id']))
			self::setId($_GET['id']);

		if (!self::checkLogado() && self::$page != "login") {
			header("Location: " . self::$url . "login");
		} elseif (self::checkLogado() && self::$page == "login") {
			header("Location: " . self::$url . "./");
		}

		self::setMenu(array(
			"Início" => array(
				"link" => "."
			),
			"Cadastros" => array(
				"link" => "javascript:;",
				"sub" => array(
					"Animais" => array(
						"link" => "animais"
					),
					"Pessoas" => array(
						"link" => "pessoas"
					),
					"Produtos" => array(
						"link" => "produtos"
					),
					"Vendas" => array(
						"link" => "vendas"
					)
				)
			),
			"Sair" => array(
				"link" => "sair"
			)
		));

		self::verificaMsg();

		self::setBd(new Conexao());
		$bdi = self::getBd();

		$bdi->setHost('localhost');
		$bdi->setUsuario('root');
		$bdi->setSenha('');
		$bdi->setBanco('projetointegrado');

		self::setConn($bdi->conectaBd());

		$conni = self::getConn();

		if ($conni->connect_error) {
			die('Erro ao conectar no banco de dados!');
		}
	}

	public static function checkLogado() {
		if (isset($_SESSION['logado'])) {
			return true;
		}
	}

	public static function login() {
		if ($_POST) {
			$login = $_POST['login'];
			$senha = $_POST['senha'];
			if ($login == "admin" && md5($senha) == "202cb962ac59075b964b07152d234b70") {
				$_SESSION['logado'] = true;
				header("Location: " . self::$url . "./");
			}else{
				$msg = array("texto" => "Erro: Login ou senha incorretos!", "tipo" => "erro");
				self::setMsg($msg);
			}
		}
	}

	public static function logout() {
		session_destroy();
		header("Location: " . self::$url . "login");
	}

	public static function verificaMsg() {
		if (isset($_SESSION['msg'])) {
			self::setMsg($_SESSION['msg']);
		}
	}

}

Ambiente::init();
?>
