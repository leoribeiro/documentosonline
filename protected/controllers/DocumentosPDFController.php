<?php

class DocumentosPDFController extends Controller
{

	private $PDF;
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('geraPDF'),
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
	
	public function Cabecalho(){

		
		$this->PDF->SetLeftMargin(10);
		$this->PDF->SetRightMargin(10);
		$this->PDF->SetTopMargin(10);
		$this->PDF->SetAutoPageBreak(1,0);

		$this->PDF->Open();                    
		$this->PDF->AddPage();                

		$brasao = YiiBase::getPathOfAlias('webroot')."/images/brasao.jpg";
		

		$this->PDF->Image($brasao,96,7,17.29,18.7);
		
		$this->PDF->Ln(17);
		$this->PDF->SetFont("Verdana", "B", 12 ,"UTF-8");
		$this->PDF->Cell(190, 5,iconv('utf-8','iso-8859-1','SERVIÇO PÚBLICO FEDERAL'),0, 1, 'C');
		$this->PDF->Cell(190, 5,iconv('utf-8','iso-8859-1','MINISTÉRIO DA EDUCAÇÃO'),0, 1, 'C');
		$this->PDF->Cell(190, 5,iconv('utf-8','iso-8859-1','CENTRO FEDERAL DE EDUCAÇÃO TECNOLÓGIA DE MINAS GERAIS'),0, 1, 'C');
		//$PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','Autorização de Funcionamento - Portaria 2.026 de 28/12/2006 DOU de 29/12/2006'),'LR', 1, 'C');
		$this->PDF->Cell(190, 5, iconv('utf-8','iso-8859-1','CAMPUS TIMÓTEO') , 0, 1, 'C');
		

	}

	public function tipoDocumentoView($model){

		$criteria = new CDbCriteria;
	    $criteria->compare('CDModeloDocumento',
	    $model->ModeloDocumento_CDModeloDocumento);
	    $modelModeloDoc = DModeloDocumento::model()->find($criteria);

	    $numeracao = str_pad(($modelModeloDoc->NumeracaoDocumento+1), 3, "0", STR_PAD_LEFT);

		$this->PDF->Ln(9);
		$this->PDF->SetFont("Verdana", "", 12 ,"UTF-8");
		$this->PDF->Cell(190, 5,iconv('utf-8','iso-8859-1',$modelModeloDoc->NMSiglaDocumento."-".$numeracao."/".date("Y")),0, 1, 'L');

		return ($modelModeloDoc->NMSiglaDocumento."-".$numeracao."-".date("Y"));

	}

	public function tipoDocumento($model){

		$criteria = new CDbCriteria;
	    $criteria->compare('CDModeloDocumento',
	    $model->ModeloDocumento_CDModeloDocumento);
	    $modelModeloDoc = DModeloDocumento::model()->find($criteria);

	    $numeracao = str_pad(($model->NumeroDocumento), 3, "0", STR_PAD_LEFT);

		$this->PDF->Ln(9);
		$this->PDF->SetFont("Verdana", "", 12 ,"UTF-8");
		$this->PDF->Cell(190, 5,iconv('utf-8','iso-8859-1',$modelModeloDoc->NMSiglaDocumento."-".$numeracao."/".$model->Ano),0, 1, 'L');

		return ($modelModeloDoc->NMSiglaDocumento."-".$numeracao."-".$model->Ano);

	}

	public function localdataDocumento($model){

		$dataDocM = $model->DataDocumento;

		$dataDoc = explode('/', $dataDocM);

		$tipoData = 0;
		if(sizeof($dataDoc) == 1){
			$dataDoc = explode('-', $dataDocM);			
			$tipoData = 1;
		}

		switch ($dataDoc[1]) {
	        case "01":    $mes = "Janeiro";     break;
	        case "02":    $mes = "Fevereiro";   break;
	        case "03":    $mes = "Março";       break;
	        case "04":    $mes = "Abril";       break;
	        case "05":    $mes = "Maio";        break;
	        case "06":    $mes = "Junho";       break;
	        case "07":    $mes = "Julho";       break;
	        case "08":    $mes = "Agosto";      break;
	        case "09":    $mes = "Setembro";    break;
	        case "10":    $mes = "Outubro";     break;
	        case "11":    $mes = "Novembro";    break;
	        case "12":    $mes = "Dezembro";    break; 
	    }

		$localDoc = $model->Local;

		if($tipoData == 0){
			$dataDoc = $dataDoc[0]." de ".$mes." de ".$dataDoc[2];	
		}
		else{
			$dataDoc = $dataDoc[2]." de ".$mes." de ".$dataDoc[0];
		}
		

		$this->PDF->Ln(7);
		$this->PDF->SetFont("Verdana", "", 12 ,"UTF-8");
		$this->PDF->Cell(190, 5,iconv('utf-8','iso-8859-1//TRANSLIT',$localDoc.", ".$dataDoc."."),0, 1, 'R');

	}


	public function paraDoc($model){

		$para = $model->Para;

		$this->PDF->Ln(10);
		$this->PDF->SetFont("Verdana", "", 12 ,"UTF-8");
		$this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1//TRANSLIT',$para) , 0, 'J', false);

	}

	public function assuntoDoc($model){

		$assunto = $model->Assunto;

		$this->PDF->Ln(10);
		$this->PDF->SetFont("Verdana", "B", 12 ,"UTF-8");
		$this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1//TRANSLIT',"Assunto: ".$assunto) , 0, 'J', false);

	}

	public function corpoDoc($model){

		$corpo = $model->Corpo;

		$this->PDF->Ln(15);
		$this->PDF->SetFont("Verdana", "", 12 ,"UTF-8");
		$this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1//TRANSLIT',$corpo) , 0, 'J', false);

	}

	public function assinaturaDoc($model){

		$idServidor = $model->Servidor_CDServidor;

		$criteria = new CDbCriteria;
		$criteria->compare('Servidor_CDServidor',$idServidor);
	    $modelServ = DServidor::model()->find($criteria);

	    $this->PDF->Ln(15);
		$this->PDF->SetFont("Verdana", "", 12 ,"UTF-8");

	    if(!is_null($modelServ)){
	    	$assinatura = $modelServ->Assinatura;
	    }  
	    else{
	    	$criteria = new CDbCriteria;
			$criteria->compare('CDServidor',$idServidor);
	    	$modelServ = Servidor::model()->find($criteria);
	    	$assinatura = $modelServ->NMServidor;
	    }
	    //$assinatura = "<div align=\"center\">".$modelServ->Assinatura."</div>";
	    $this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1//TRANSLIT',$assinatura) , 0, 'R', false);

	}
	
	
	public function actionGeraPDF(){

		if(isset($_GET['idReq'])){

			$idReq = $_GET['idReq'];
			$criteria = new CDbCriteria;
			$criteria->compare('CDDocumento',$idReq);
	    	$model = DDocumento::model()->find($criteria);

		}else{
			$model = Yii::app()->session['modelDocumento'];
		}
		

		

		Yii::import('application.extensions.fpdf.*');
		require('fpdf.php');
		
		$this->PDF = new FPDF("P","mm","A4");

		$this->PDF->AddFont('Verdana','','verdana.php');
		$this->PDF->AddFont('Verdana','B','verdanab.php');
		
		$this->Cabecalho();

		if(isset($_GET['idReq'])){
			$nomeDoc = $this->tipoDocumento($model);
		}
		else{
			$nomeDoc = $this->tipoDocumentoView($model);
		}


		$this->localdataDocumento($model);

		$this->paraDoc($model);

		$this->assuntoDoc($model);

		$this->corpoDoc($model);

		$this->assinaturaDoc($model);
		
		
		$tipo = "F";
		if(!empty($_GET['idReq'])){
			$tipo = "D";
			$this->PDF->Output($nomeDoc.".pdf",$tipo);
		}
		else{

			$tempoArq = microtime();
			Yii::app()->session['tempoArq'] = $tempoArq;
			$this->PDF->Output("pdfs/".$tempoArq.".pdf",$tipo);
			//$urlServer = "http://sistemas.timoteo.cefetmg.br";
			//return $urlServer.Yii::app()->baseUrl."/pdfs/".$tempoArq.".pdf";

			$this->render('//dDocumento/createSure',array($model
			
			));
			
		}
			
	}
	

}
