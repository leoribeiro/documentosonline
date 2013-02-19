<?php

class DProcessoDisciplinarController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','adminProcessos','updateProcessoComissao','updateProcesso','updateProcessoDiretor','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DProcessoDisciplinar;
		$model->ServidorProcesso = Yii::app()->user->CDServidor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DProcessoDisciplinar']))
		{
			$model->attributes=$_POST['DProcessoDisciplinar'];
			

			if($model->DataOcorrencia != ''){
				$Data = $model->DataOcorrencia;
				$ar = explode('/', $Data);
				$model->DataOcorrencia = $ar[2].'-'.$ar[1].'-'.$ar[0];
			}

			if($model->save()){
				$this->EnviaEmail($model,1);
				$this->redirect(array('admin','success'=>true));
			}

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DProcessoDisciplinar']))
		{
			$model->attributes=$_POST['DProcessoDisciplinar'];
			$model->DataCriacao = new CDbExpression('NOW()');

			if($model->DataOcorrencia != ''){
				$Data = $model->DataOcorrencia;
				$ar = explode('/', $Data);
				$model->DataOcorrencia = $ar[2].'-'.$ar[1].'-'.$ar[0];
			}

			if($model->save()){
				$this->EnviaEmail($model,1);
				$this->redirect(array('admin','success'=>true));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateProcesso($id)
	{

		$isDirector = false;
		if(Yii::app()->user->checkAccess('ServidorDiretor')){
			$isDirector = true;
		}
		$isComissao = false;
		if(Yii::app()->user->checkAccess('ServidorComissao')){
			$isComissao = true;
		}

		if($isComissao){
			$this->redirect(array('UpdateProcessoComissao','id'=>$id));
		}
		if($isDirector){
			$this->redirect(array('UpdateProcessoDiretor','id'=>$id));
		}

	}

	public function actionUpdateProcessoDiretor($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DProcessoDisciplinar']))
		{
			$model->attributes=$_POST['DProcessoDisciplinar'];
			
			$model->DataDiretor = new CDbExpression('NOW()');

			$modelConf = DConfProcessoDisciplinar::model()->find();
			$model->ServidorDiretor = $modelConf->Servidor_Diretor;

			if(empty($model->ParecerDiretor) or empty($model->DescricaoParecer)){
				if(empty($model->ParecerDiretor))
					$model->addError('ParecerDiretor','Selecione alguma sansão.');
				if(empty($model->DescricaoParecer))
					$model->addError('DescricaoParecer','O parecer deve ser preenchido.');
			}
			else{
				if($model->save())
					$this->redirect(array('admin','success2'=>true));
			}
					
		}

		$this->render('updateComissaoDiretor',array(
			'model'=>$model,
		));
	}


	public function actionUpdateProcessoComissao($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DProcessoDisciplinar']))
		{
			$model->attributes=$_POST['DProcessoDisciplinar'];
			
			$model->DataComissao = new CDbExpression('NOW()');
			$modelConf = DConfProcessoDisciplinar::model()->find();
			$model->ServidorComissao = $modelConf->Servidor_Comissao;
			
			if(empty($model->SansaoAplicavel) or empty($model->ParecerComissao) or empty($model->reincidencia)){
				if(empty($model->SansaoAplicavel))
					$model->addError('SansaoAplicavel','Selecione alguma sansão.');
				if(empty($model->ParecerComissao))
					$model->addError('ParecerComissao','O parecer deve ser preenchido.');
				if(empty($model->reincidencia)){
					$model->addError('reincidencia','A reincidência deve ser preenchida.');
				}
			}
			else{
				if($model->save()){
					$this->EnviaEmail($model,2);
					$this->redirect(array('admin','success3'=>true));
				}

			}
		}

		$this->render('updateComissaoDiretor',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DProcessoDisciplinar');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(isset($_GET['success'])) {

			Yii::app()->user->setFlash('success', 'Processo disciplinar aberto com sucesso!');

		}
		if(isset($_GET['success2'])) {

			Yii::app()->user->setFlash('success', 'Processo disciplinar atualizado com sucesso!');

		}
		if(isset($_GET['success3'])) {

			Yii::app()->user->setFlash('success', 'Processo disciplinar concluído com sucesso!');

		}
		
		$model=new DProcessoDisciplinar('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DProcessoDisciplinar']))
			$model->attributes=$_GET['DProcessoDisciplinar'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminProcessos()
	{
		if(isset($_GET['success'])) {

			Yii::app()->user->setFlash('success', 'Processo disciplinar aberto com sucesso!');

		}
		if(isset($_GET['success2'])) {

			Yii::app()->user->setFlash('success', 'Processo disciplinar atualizado com sucesso!');

		}
		if(isset($_GET['success3'])) {

			Yii::app()->user->setFlash('success', 'Processo disciplinar concluído com sucesso!');

		}

		
		$model=new DProcessoDisciplinar('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DProcessoDisciplinar']))
			$model->attributes=$_GET['DProcessoDisciplinar'];

		$this->render('adminProcessos',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=DProcessoDisciplinar::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dprocesso-disciplinar-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	private function EnviaEmail(){

		$ipServer =  gethostbyname($_SERVER['SERVER_NAME']);
		if($ipServer != "200.131.39.111"){
			return true;
		}

		$parametros = func_get_args();

		$model = $parametros[0];
		$tipo = $parametros[1];

		$emails = array();

		$modelInfo = D_ConfProcessoDisciplinar::model()->find();
		$idComissao = $modelInfo->Servidor_Comissao;
		$idDiretor =  $modelInfo->Servidor_Diretor;

		$criteria = new CDbCriteria;
		if($tipo == 1){
			$criteria->compare('CDServidor',$idComissao);
		}
		else{
			$criteria->compare('CDServidor',$idDiretor);
		}

		$modelServ = Servidor::model()->find($criteria);
		$email = $modelServ->EmailInstitucional;
		$nome = $modelServ->NMServidor;

		// trata professores para receber email.
		if(func_num_args() == 3){
			$emails[$email] = $nome;
			$emails['leonardofribeiro@gmail.com'] = 'Leonardo Ribeiro';
			$message = new YiiMailMessage();
			$message->setTo($emails);
	        $message->setFrom(array('nti@timoteo.cefetmg.br'));
			$subject = 'Processo Disciplinar número '.$model->CDProcessoDisciplinar .' - CEFET-MG Timóteo';
			// melhorar isso aqui, está horrível
			$hora = date("H"); 
			if($hora >= 0 && $hora < 6) { 
				$comprimento = "boa madrugada"; 
			} 
			else if ($hora >= 6 && $hora < 12){ 
				$comprimento = "bom dia"; 
			} 
			else if ($hora >= 12 && $hora < 18) { 
				$comprimento = "boa tarde"; 
			} 
			else{ 
				$comprimento = "boa noite"; }

	        $message->setSubject($subject);

	        if($tipo == 1){
		        $body = '<p>Prezado membro da Comissão Disciplinar Discente, '.$comprimento.'. <br /><br />';
				$body .= 'Existe um Processo Disciplinar Discente,
				 nº XXXX, para análise e emissão de parecer.
				Favor acessar o Sistema de Documentos para finalizar essa demanda.</p>';
	        }
	        else{
	        	$body = '<p>Prezado Diretor, '.$comprimento.'. <br /><br />';
				$body .= 'Existe um Processo Disciplinar Discente, 
				nº XXXX, para análise e emissão de parecer conclusivo.
				Favor acessar o Sistema de Documentos para 
				finalizar essa demanda.</p>';
	        }
	        $body .= '<p><strong>Dados do processo:</strong></p><br /><br /> ';
	        $body .= '<p><strong>Aluno envolvido:</strong> ';
	        $body .= $model->relAluno->NMAluno.'<br />';
	        $body .= '<strong>Relator:</strong> ';
	        $body .= $model->relServidorProcesso->NMServidor.'<br />';
	        $body .= '<strong>Data da ocorrência:</strong> ';

	        $Data = $model->DataOcorrencia;
			$ar = explode('-', $Data);
			$model->DataOcorrencia = $ar[2].'/'.$ar[1].'/'.$ar[0];

	        $body .= $model->DataOcorrencia.'<br /></p>';
	        $body .= '<p><br /><br /><a href="http://sistemas.timoteo.cefetmg.br/documentosoficiais/">Clique aqui</a> para entrar no sistema.</p>';
	        $body .= '<p>Este é um email automático. Por favor, não responda.</p>';
			$body .='<p><br><br><br><br>NTI - Núcleo de Tecnologia da Informação - CEFET-MG Campus Timóteo</p>';

			$message->setBody($body,'text/html');

	        $numsent = Yii::app()->mail->send($message);

		}

	}
}
