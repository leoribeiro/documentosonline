<?php

class DDocumentoController extends Controller
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
				'actions'=>array('create','update','createSure','createAssin','createSave','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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


	public function actionCreateSure(){

		$model = Yii::app()->session['modelDocumento'];

		$this->redirect(array('//DocumentosPDF/geraPDF'));

		

	}

	public function actionCreateSave(){

		$model = Yii::app()->session['modelDocumento'];
		unset(Yii::app()->session['modelDocumento']);
		

		$tempoArq = Yii::app()->session['tempoArq'];
		unset(Yii::app()->session['tempoArq']);

		$nomeArquivo = "pdfs/".$tempoArq.".pdf";

		// deleta o arquivo.
		unlink($nomeArquivo);

		$criteria = new CDbCriteria();
		$criteria->compare('CDModeloDocumento',$model->ModeloDocumento_CDModeloDocumento);
		$modelMD = DModeloDocumento::model()->find($criteria);

		$model->NumeroDocumento = ($modelMD->NumeracaoDocumento+1);
		$modelMD->NumeracaoDocumento = $modelMD->NumeracaoDocumento+1;
		$modelMD->save();
		$model->Ano = date("Y");

		$model->save();

		$this->redirect(array('admin','success'=>true));

	}

	public function actionCreateAssin()
	{
		$model=new DServidor;

		$servidor = Yii::app()->user->CDServidor;
		$criteria = new CDbCriteria();
		$criteria->compare('Servidor_CDServidor',$servidor);
		$modelU = DServidor::model()->find($criteria);

		if(!is_null($modelU)){
			$model = $modelU;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DServidor']))
		{
			$model->attributes=$_POST['DServidor'];
			$model->Servidor_CDServidor = $servidor;


			if($model->save()){

				$this->render('//dadosUsuario/createAssin',array(
				'model'=>$model,'success'=>'true',
				));
			}
			else{
				$this->render('//dadosUsuario/createAssin',array(
				'model'=>$model,
			));
			}
				
		}else{
			$this->render('//dadosUsuario/createAssin',array(
			'model'=>$model,
			));
		}

		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DDocumento;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$criteria = new CDbCriteria();
		$criteria->compare('Servidor_CDServidor',Yii::app()->user->CDServidor);
		$dserv = DServidor::model()->find($criteria);

		if(is_null($dserv)) {

			Yii::app()->user->setFlash('error', 'Sua assinatura para os documentos ainda não está configurada. <strong>Configure-a!</strong>');

		}

		if(isset($_POST['DDocumento']))
		{
			$model->attributes=$_POST['DDocumento'];

			$model->Servidor_CDServidor = Yii::app()->user->CDServidor;

			if($model->validate()){

				Yii::app()->session['modelDocumento'] = $model;

				//$this->redirect(array('//DocumentosPDF/geraPDF'));
				$this->redirect(array('CreateSure'));
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

		if(isset($_POST['DDocumento']))
		{
			$model->attributes=$_POST['DDocumento'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CDDocumento));
		}

		$this->render('update',array(
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
		$dataProvider=new CActiveDataProvider('DDocumento');
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

			Yii::app()->user->setFlash('success', 'Documento oficial criado com sucesso!');

		}

		// para tamanho da página selecionada no gridview	
		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
		}
		
		$model=new DDocumento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DDocumento']))
			$model->attributes=$_GET['DDocumento'];

		$this->render('admin',array(
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
		$model=DDocumento::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ddocumento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
