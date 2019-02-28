<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Utilizador_m');
		$this->load->model('Exercicio_m');

		if($this->session->userdata('sessao_utilizador')==null){
			$this->session->set_flashdata('erroPT', 'Não tem permissao de aceder a esta página '); //mensagem de erro
			redirect('','refresh');
		}else{
			if(($this->session->userdata('sessao_utilizador')['tipo'])!=5){
				$this->session->set_flashdata('erroPT', 'Não tem permissao de aceder a esta página '); //mensagem de erro
				redirect('','refresh');
			}else if(($this->session->userdata('sessao_utilizador')['estado'])!=1){
				$this->session->set_flashdata('erroPT', 'Sua conta não esta activa'); //mensagem de erro
				redirect('','refresh');
			}
		}

	}

	public function index()
	{
		$data['title'] = 'Home'; 

		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav_cliente');
		$this->load->view('Cliente/index');
		$this->load->view('templates/footer');
	}

	public function trataAjaxCliente(){
		if($this->input->post('cc')){
            if($this->Utilizador_m->verificaCc($this->input->post('cc'))!=null){
                echo "1";
            }else{
                echo "0";
            }
        }else if($this->input->post('nif')){
			if($this->Utilizador_m->verificaNif($this->input->post('nif'))!=null){
                echo "1";
            }else{
                echo "0";
            }
		}
	}


	public function exercicios()
	{

		$data['title'] = "Exercicios";

		// verifica valores da dificuldade para campo pesquisa
		$data['listaDificuldade'] = $this->Exercicio_m->getDificuldade();

		// verifica valores da dificuldade para campo pesquisa
		$data['listaTipo_exercicio'] = $this->Exercicio_m->getTipo_exercicio();

		$search = $this->security->xss_clean($this->input->post('search'));
		$pesquisaTipoExercicio = $this->security->xss_clean($this->input->post('pesquisaTipoExercicio'));
		$pesquisaDificuldade = $this->security->xss_clean($this->input->post('pesquisaDificuldade'));

		// envia dados dos exericios para menu cliente
		$data['listaExercicios'] = $this->Exercicio_m->queryExercicios($search, $pesquisaTipoExercicio, $pesquisaDificuldade);

		// verifica planos de exercicio existentes para modal adicionar exercicio a um plano
		$data['listaPlanoTreino'] = $this->Exercicio_m->getPlanoTreino();

		//verifica cliente que pretende criar um novo plano de treino
		$utilizador = $this->session->userdata('sessao_utilizador');


		if($this->input->post('adicionar_ao_plano')){

			// id do plano de treino escolhido
			$idPlanoTreino = $this->input->post('plano_treino');

			// id do exercicio selecionado para adicionar a um plano
			$idExercicio_selecionado = $this->input->post('exercicio_selecionado');
							
			// apos ter id do plano de treino selecionado, seja novo ou existente vai inserir id do exercicios com o id do plano na BD
			$planoTreino_has_exercicio = array(
				"plano_treino_id" => $idPlanoTreino,
				"exercicio_id" => $idExercicio_selecionado
			);
			$this->Exercicio_m->adicionarExercicio_PlanoTreino($planoTreino_has_exercicio);

		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav_cliente');
		$this->load->view('Cliente/exercicios', $data);
		$this->load->view('templates/footer');
	}


	public function novo_plano($idExercicio = false)
	{

		$data['title'] = "Novo Plano Exercícios";

		$data['exercicio'] = $idExercicio;


		if($this->input->post('criar_plano')){

			//verifica cliente que pretende criar um novo plano de treino
			$utilizador = $this->session->userdata('sessao_utilizador');

			$nomePlanoTreino = $this->input->post('nome_plano');

			// array para inserir novo plano				
			$novoPlanoTreino = array(
				"nome" => $nomePlanoTreino,
				"cliente_admin_id" => $utilizador['id'],
				"pt_estado" => "ativo",
				"pt_data" => date("Y-m-d")
			);

			// insere novo plano na BD e seleciona id
			$idPlanoTreino = $this->Exercicio_m->criarPlanoTreino($novoPlanoTreino);

			if ($idExercicio != false){
				// apos ter id do plano de treino selecionado, vai inserir id do exercicios com o id do plano na BD
				$planoTreino_has_exercicio = array(
					"plano_treino_id" => $idPlanoTreino,
					"exercicio_id" => $idExercicio
				);
				$this->Exercicio_m->adicionarExercicio_PlanoTreino($planoTreino_has_exercicio);
			}

			$this->session->set_flashdata('sucessoTreino', 'Plano de Treino criado com sucesso'); //mensagem de sucesso
			redirect('cliente/novo_plano');
		}



		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav_cliente');
		$this->load->view('Cliente/novo_plano', $data);
		$this->load->view('templates/footer');
	}


	public function treinos($idTreinoApagar = false)
	{
		$data['title'] = "Planos de Treinos";

		// passa para a view o nome dos planos
		$data['listaNomesPlanos'] = $this->Exercicio_m->getPlanoTreino();

		// passa para as views a informação completa dos planos e exercicios contidos
		$data['listaPlanos'] = $this->Exercicio_m->dadosPlanoTreinoCompleto();

		// lista funcionarios para o cliente puder fazer pedido de novo plano
		$data['listaFuncionario'] = $this->Utilizador_m->obterFuncionario();

		// funcionario selecionado para pedir plano
		$idFuncionario = $this->security->xss_clean($this->input->post('selecionaFuncionario'));

		// verifica utilizador com sessao iniciada
		$utilizador = $this->session->userdata('sessao_utilizador'); //iniciar sessao

		
		// verifica se ja existe algum plano pendente com aquele funcionario para bloquear novo pedido
		$verificaEstado = $this->Exercicio_m->verificaPlanoTreino($idFuncionario, $utilizador['id']);

		// verifica se existe já existe algum pedido
		if(count($verificaEstado) > 0){

			// verifica se existe mais que um resultado
			foreach ($verificaEstado as $row){
				
				// se ja existir algum pendente da erro
				if ($row['pt_estado'] == 'pendente'){

					$this->session->set_flashdata('erroPedidoPlano', 'Já efectuou um pedido a este funcionário. Por favor aguarde que o funcionário responda.'); //mensagem de sucesso
					redirect('cliente/treinos');
				}
				
			}
			// caso contrario faz pedido
			// array para inserir novo plano				
			$novoPlanoTreino = array(
				"nome" => "pedido",
				"cliente_admin_id" => $utilizador['id'],
				"funcionario_admin_id" => $idFuncionario,
				"pt_estado" => "pendente",
				"pt_data" => date("Y-m-d")
			);

			// insere novo plano na BD e seleciona id
			$this->Exercicio_m->criarPlanoTreino($novoPlanoTreino);

			$this->session->set_flashdata('sucessoPedidoPlano', 'Pedido efectuado com sucesso. Por favor aguarde que o funcionário responda.'); //mensagem de sucesso
			redirect('cliente/treinos');

		}




		// verifica se foi passado o id de um plano a apagar e se pode ser apagado por este utilizador
		if ($idTreinoApagar == true){

			// verifica os planos criados pelo utilizador e que podem ser apagados pelo mesmo
			$resultado = $this->Exercicio_m->getPlanoTreino($idTreinoApagar, $utilizador['id']);

			if ($resultado != null){

				$this->Exercicio_m->apagarPlanoTreino($idTreinoApagar);

			}else{
				
				$this->session->set_flashdata('erroApagarTreino', 'Erro! Este plano não pode ser apagado por si.'); //mensagem de erro
				
			}

			redirect('cliente/treinos');

		}


		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav_cliente');
		$this->load->view('Cliente/treinos',$data);
		$this->load->view('templates/footer');
	}


	public function plano_treino($idPlanoTreino = false, $id_exercicio_plano_treino = false)
	{
		$data['title'] = "Planos de Treino";

		if($idPlanoTreino == true){

			// passa id do plano de treino recebido pelo url para ser enviado com o id do exercicio que queremos apagar
			$data['idPlanoTreino'] = $idPlanoTreino;

			// passa exercicios que existem no plano escolhido
			$data['exericiosExistentesPlano'] = $this->Exercicio_m->infoPlanoTreino($idPlanoTreino);

		}else{
			redirect('cliente/treinos');
		}

		if($id_exercicio_plano_treino == true){
			
			$this->Exercicio_m->query_apagar_exercicio_plano_treino($idPlanoTreino, $id_exercicio_plano_treino);
			redirect('cliente/plano_treino/'.$idPlanoTreino);
		}


		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav_cliente');
		$this->load->view('Cliente/plano_treino',$data);
		$this->load->view('templates/footer');
	}









}
