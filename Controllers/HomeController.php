<?php
namespace Controllers;

use \Core\Controller;
use \Models\Board;

class HomeController extends Controller {


	public function index() { 
		$b = new Board();
		$dados = array (
			'CURSOS' => $b->getCurso(),
			'N_AULAS' => $b->getNumAula()
		);
		$this->loadTemplate('home', $dados);
	}

	public function listProfessor() {
		$dados = $_REQUEST['filtro'];
		$retorno = '';
		$array = array();
		$b = new Board();
		$array = $c->getProfessor($dados);
		foreach ($array as $value) {
			$retorno .=  "<option onclick='clienteinput(\"".$value['COD_CLIENTE']."|".$value['LOJA_CLIENTE']."\")'>".$value['COD_CLIENTE']." ".$value['NOME_CLIENTE']." LOJA: ".$value['LOJA_CLIENTE']."</option>";
		}
		print_r ($retorno);
	}

	public function validaProximo(){
		$b = new Board();
		
		if(isset($_REQUEST['id_card'])){
			$id_card = $_REQUEST['id_card'];
			unset($_REQUEST['id_card']);
		}
		if(isset($_REQUEST['id_status'])){
			$id_status = $_REQUEST['id_status'];
			unset($_REQUEST['id_status']);
		}

		$resul =  $b->getProfessor($id_card);
		if(sizeof($resul) > 0){

			if($id_status == 1){
				$b->updateStatus($id_card,2);
				echo "MOVIDO";
				exit;
			}
			if($id_status == 2){
				if(sizeof($resul) > 1){
					$b->updateStatus($id_card,3);
				} else {
					$b->updateStatus($id_card,4);
				}
				echo "MOVIDO";
				exit;
			}
			if($id_status == 3){
				$lastDate = $b->getLastDate($id_card);

				if(( strtotime(date('Y-m-d H:i:s')) - strtotime($lastDate[0]['DT_REGISTRO']) ) > 60 ){
					$b->updateStatus($id_card,4);
					echo "MOVIDO";
				} else {
					echo "ERRO_MINUTO";
					exit;
				}
			}

		} else {
			echo "N";
		}
	}

	public function validaVoltar(){
		$b = new Board();
		
		if(isset($_REQUEST['id_card'])){
			$id_card = $_REQUEST['id_card'];
			unset($_REQUEST['id_card']);
		}

		if(isset($_REQUEST['id_status'])){
			$id_status = $_REQUEST['id_status'];
			unset($_REQUEST['id_status']);
		}

		if($id_status != 1){
			$lastStatus = $b->getLastStatus($id_card,$id_status);
			$b->updateStatus($id_card,$lastStatus[0]['ULTIMO_STATUS']);
			echo "MOVIDO";
			exit;
		}
	}

	function orderBynameAsc($a, $b)
	{
		return strcmp($a["PROFESSORES"][0]['NOME'], $b["PROFESSORES"][0]['NOME']);
	}

	function orderBynameDesc($a, $b)
	{
		return strcmp($b["PROFESSORES"][0]['NOME'], $a["PROFESSORES"][0]['NOME']);
	}
	
	public function boardlist (){
		$b = new Board();

		/* TRATAMENTO DOS REQUESTS QUE CHEGAM DO AJAX */
		if(isset($_REQUEST['filtro_curso'])){
			$filtro_curso = $_REQUEST['filtro_curso'];
			unset($_REQUEST['filtro_curso']);
		}
		else{
			$filtro_curso = '';
		}

		if(isset($_REQUEST['num_aula'])){
			$num_aula = $_REQUEST['num_aula'];
			unset($_REQUEST['num_aula']);
		}
		else{
			$num_aula = '';
		}
		
		if(isset($_REQUEST['filtro_professor'])){
			$filtro_professor = $_REQUEST['filtro_professor'];
			unset($_REQUEST['filtro_professor']);
		}
		else{
			$filtro_professor = '';
		}

		if(isset($_REQUEST['ordenar_por'])){
			$ordenar_por = $_REQUEST['ordenar_por'];
			unset($_REQUEST['ordenar_por']);
		}
		else{
			$ordenar_por = '';
		}

		if(isset($_REQUEST['ordenar_por_modo'])){
			$ordenar_por_modo = $_REQUEST['ordenar_por_modo'];
			unset($_REQUEST['ordenar_por_modo']);
		}
		else{
			$ordenar_por_modo = '';
		}

		/* PARAMETROS DO FILTRO */
		$param = array(
			'filtro_curso'     => $filtro_curso,
			'num_aula'         => $num_aula,
			'filtro_professor' => $filtro_professor,
			'ordenar_por'      => $ordenar_por,
			'ordenar_por_modo' => $ordenar_por_modo
		);
		
		$retorno_cards = $b->getCards($param);
		
		/* FOR PARA MONTAR O ARRAY DE CARDS */
		for($i = 0;$i < sizeof($retorno_cards); $i++){
			$retorno_professores = $b->getProfessor($retorno_cards[$i]['ID_CARD']);
			if(sizeof($retorno_professores) != 0){
				for($j = 0;$j < sizeof($retorno_professores); $j++)
				{
					if(isset($retorno_professores[$j]['NOME'])){
						$explode_ret = explode(" ",$retorno_professores[$j]['NOME']);
						$retorno_professores[$j]['NOME'] = $explode_ret[0]." ".end($explode_ret);
						$retorno_cards[$i]['PROFESSORES'] = $retorno_professores;
					}
				}
			}else{
				$retorno_cards[$i]['PROFESSORES'][0] = array(
					'NOME' => 'SEM PROFESSOR'
				);
			}
			$retorno_materiais = $b->getMaterial($retorno_cards[$i]['ID_CARD']);
			for($k = 0;$k < sizeof($retorno_materiais); $k++)
			{
				$retorno_cards[$i]['MATERIAIS'] = $retorno_materiais;
			}
			
		}

		/* DADOS DO FILTRO E QTD CARDS */
		$dados = array (
			'CURSOS' => $b->getCurso(),
			'N_AULAS' => $b->getNumAula(),
			'QTD_STATUS' => $b->getQtdStatus($param)
		);

		/* ORDENAÇAO POR NOME */
		if($ordenar_por == 'professor'){
			if($ordenar_por_modo == 'asc')
				usort($retorno_cards, array($this,'orderBynameAsc'));
			else
				usort($retorno_cards, array($this,'orderBynameDesc'));
		}
		
		$_SESSION['BOARD'] = $retorno_cards;
		$this->loadViewInTemplate('home', $dados);
	}

}