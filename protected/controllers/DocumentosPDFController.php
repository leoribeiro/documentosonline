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
		$this->PDF->SetFont("Arial", "B", 12 ,"UTF-8");
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
		$this->PDF->SetFont("Arial", "", 12 ,"UTF-8");
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
		$this->PDF->SetFont("Arial", "", 12 ,"UTF-8");
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
		$this->PDF->SetFont("Arial", "", 12 ,"UTF-8");
		$this->PDF->Cell(190, 5,iconv('utf-8','iso-8859-1//TRANSLIT',$localDoc.", ".$dataDoc."."),0, 1, 'R');

	}


	public function assuntoDoc($model){

		$assunto = $model->Assunto;

		$this->PDF->Ln(10);
		$this->PDF->SetFont("Arial", "B", 12 ,"UTF-8");
		$this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1//TRANSLIT',"Assunto: ".$assunto) , 0, 'J', false);

	}

	public function corpoDoc($model){

		$corpo = $model->Corpo;

		$this->PDF->Ln(15);
		$this->PDF->SetFont("Arial", "", 12 ,"UTF-8");
		$this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1//TRANSLIT',$corpo) , 0, 'J', false);

	}

	public function assinaturaDoc($model){

		$idServidor = $model->Servidor_CDServidor;

		$criteria = new CDbCriteria;
		$criteria->compare('Servidor_CDServidor',$idServidor);
	    $modelServ = DServidor::model()->find($criteria);

	    $this->PDF->Ln(15);
		$this->PDF->SetFont("Arial", "", 12 ,"UTF-8");

	    if(!is_null($modelServ)){
	    	$assinatura = $modelServ->Assinatura;
	    }  
	    else{
			$criteria->compare('Servidor_CDServidor',$idServidor);
	    	$modelServ = Servidor::model()->find($criteria);
	    	$assinatura = $modelServ->NMServidor;
	    }
	    //$assinatura = "<div align=\"center\">".$modelServ->Assinatura."</div>";
	    $this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1//TRANSLIT',$assinatura) , 0, 'C', false);

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
		
		$this->Cabecalho();

		if(isset($_GET['idReq'])){
			$nomeDoc = $this->tipoDocumento($model);
		}
		else{
			$nomeDoc = $this->tipoDocumentoView($model);
		}


		$this->localdataDocumento($model);

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
	

	
	
	private function GeraNadaConsta($modelAluno,$modelReqEsp,$modelReq){
		
	    $this->PDF->AddPage();                
	    $this->PDF->SetFont("Arial", "B", 10 ,"UTF-8");
		$cefet = YiiBase::getPathOfAlias('webroot')."/images/cefetlogo.jpg";
		$nti = YiiBase::getPathOfAlias('webroot')."/images/ntilogo.jpg";
		$this->PDF->Cell(0, 2, $this->PDF->Image($cefet,6,13,21.10,14.84));
		$this->PDF->Cell(0, 2, $this->PDF->Image($nti,186,13,18.10,14.84));
		$this->PDF->Ln(1);
		$this->PDF->SetFont("Arial", "B", 9 ,"UTF-8");
		$this->PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','SERVIÇO PÚBLICO FEDERAL'),'LRT', 1, 'C');
		$this->PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','MINISTÉRIO DA EDUCAÇÃO'),'LR', 1, 'C');
		$this->PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','CENTRO FEDERAL DE EDUCAÇÃO TECNOLÓGIA DE MINAS GERAIS'),'LR', 1, 'C');
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','Avenida Amazonas, 1193, Bairro Vale Verde - CEP 35183-006') , 'LR', 1, 'C');
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','Timóteo - MG - CAMPUS VII - Fone: (31) 3845-4600 ') , 'LRB', 1, 'C');
		$this->PDF->Ln(5);
		$this->PDF->SetFont("Arial", "B", 12 ,"UTF-8");
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','DECLARAÇÃO DE "NADA CONSTA DISCENTE"') , 0, 1, 'C');
		$this->PDF->Ln(5);
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Protocolo:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(80, 5, iconv('utf-8','iso-8859-1',$modelReqEsp->getNumRequerimento()) , 0, 1, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Nome:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(101, 5, iconv('utf-8','iso-8859-1',$modelAluno->NMAluno) , 0, 0, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(18, 5, iconv('utf-8','iso-8859-1','Matrícula:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(60, 5, iconv('utf-8','iso-8859-1',$modelAluno->NumMatricula) , 0, 1, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		/////////////////////////////
		$this->PDF->Cell(200, 2, iconv('utf-8','iso-8859-1','') , 'B', 1, 'L');
		///////////////////////////
		$this->PDF->Ln(3);
		$this->PDF->SetFont("Arial", "B", 13 ,"UTF-8");
		$this->PDF->Cell(200, 8, iconv('utf-8','iso-8859-1','Tipo de solicitação:') , 'TLR', 1, 'L');
		$this->PDF->SetFont("Arial", "", 13 ,"UTF-8");
		$cont = 1;
		foreach($modelReq->relOpcao as $opcao){
			$this->PDF->Cell(200, 5, 
			iconv('utf-8','iso-8859-1',$cont." - ".$opcao->NMOpcao) , 'LRB', 1, 'L');
			$cont++;
		}
		$this->PDF->Ln(2);



		$this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(200, 10, iconv('utf-8','iso-8859-1','Declaramos para os devidos fins, conforme solicitação supracitada, que o aluno '.$modelAluno->NMAluno.' compareceu nos setores discriminados abaixo para solicitar a declaração de "nada consta discente", atendendo às Normas Acadêmicas da Educação Profissional Técnica de Nível Médio (EPTNM).') , 'TLRB', 1, 'J');


		$this->PDF->Ln(2);
		$this->PDF->SetFont("Arial", "B", 13 ,"UTF-8");
		$this->PDF->Cell(200, 10, iconv('utf-8','iso-8859-1','RESERVADO PARA PREENCHIMENTO DO CEFET-MG') , 'TLRB', 1, 'C');
		$this->PDF->SetFont("Arial", "", 13 ,"UTF-8");
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 0, 'C');
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 1, 'C');
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Timóteo, ___/___/_______') , 'BLR', 0, 'C');
		$this->PDF->SetFont("Arial", "B", 13 ,"UTF-8");
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Biblioteca') , 'BLR', 1, 'C');
		$this->PDF->SetFont("Arial", "", 13 ,"UTF-8");
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 0, 'C');
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 1, 'C');
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Timóteo, ___/___/_______') , 'BLR', 0, 'C');
		$this->PDF->SetFont("Arial", "B", 13 ,"UTF-8");
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Coordenação Pedagógica') , 'BLR', 1, 'C');
		$this->PDF->SetFont("Arial", "", 13 ,"UTF-8");
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 0, 'C');
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 1, 'C');
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Timóteo, ___/___/_______') , 'BLR', 0, 'C');
		$this->PDF->SetFont("Arial", "B", 13 ,"UTF-8");
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Seção de Assistência ao Estudante') , 'BLR', 1, 'C');

		$this->PDF->Ln(2);
		$this->PDF->SetFont("Arial", "B", 13 ,"UTF-8");
		$this->PDF->Cell(200, 10, iconv('utf-8','iso-8859-1','DESPACHO FINAL') , 'TLRB', 1, 'C');
		$this->PDF->SetFont("Arial", "", 13 ,"UTF-8");
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 0, 'C');
		$this->PDF->Cell(100, 15, iconv('utf-8','iso-8859-1','') , 'LR', 1, 'C');
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Timóteo, ___/___/_______') , 'BLR', 0, 'C');
		$this->PDF->SetFont("Arial", "B", 13 ,"UTF-8");
		$this->PDF->Cell(100, 10, iconv('utf-8','iso-8859-1','Registro Escolar') , 'BLR', 1, 'C');
		$this->PDF->SetFont("Arial", "", 13 ,"UTF-8");

		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->setX(25);

		switch (date("m")) {
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

	 	$this->PDF->Ln(6);
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','Timóteo, '.date('d').' de '.$mes.' de '.date('Y')).'.' , 0, 1, 'C');

		$this->PDF->setY(285);
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1', 'Documento gerado em '.date('H:i:s d/m/Y').'. Núcleo de Tecnologia da Informação - nti@timoteo.cefetmg.br'), 'TBLR', 1, 'C');
		
		
	}

}
