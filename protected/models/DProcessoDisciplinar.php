<?php

/**
 * This is the model class for table "D_ProcessoDisciplinar".
 *
 * The followings are the available columns in table 'D_ProcessoDisciplinar':
 * @property integer $CDProcessoDisciplinar
 * @property string $DataOcorrencia
 * @property string $DataCriacao
 * @property string $DescricaoOcorrencia
 * @property string $ParecerComissao
 * @property integer $SansaoAplicavel
 * @property integer $ParecerDiretor
 * @property string $DescricaoParecer
 */
class DProcessoDisciplinar extends CActiveRecord
{
	public $alunoNMAluno;
	public $servidorNMServidor;
	public $Situacao;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DProcessoDisciplinar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'D_ProcessoDisciplinar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DataOcorrencia, DescricaoOcorrencia,ServidorProcesso,Aluno', 'required'),
			array('SansaoAplicavel, ParecerDiretor', 'numerical', 'integerOnly'=>true),
			array('ParecerComissao,DescricaoParecer', 'length', 'max'=>500),
			array('reincidencia', 'length', 'max'=>3),
			array('Aluno', 'length', 'max'=>60),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDProcessoDisciplinar, DataOcorrencia, DataCriacao, DescricaoOcorrencia, ParecerComissao, SansaoAplicavel, ParecerDiretor, DescricaoParecer,Situacao,ServidorProcesso,Aluno,servidorNMServidor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'relServidorProcesso' => array(self::BELONGS_TO, 'Servidor', 'ServidorProcesso'),
			'relServidorComissao' => array(self::BELONGS_TO, 'Servidor', 'ServidorComissao'),
			'relServidorDiretor' => array(self::BELONGS_TO, 'Servidor', 'ServidorDiretor'),
			'relSansao' => array(self::BELONGS_TO, 'DSansaoAplicavel', 'SansaoAplicavel'),
			'relSansaoDiretor' => array(self::BELONGS_TO, 'DSansaoAplicavel', 'ParecerDiretor'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDProcessoDisciplinar' => 'Número',
			'DataOcorrencia' => 'Data da ocorrência',
			'DataCriacao' => 'Data Criacao',
			'DescricaoOcorrencia' => 'Descrição da ocorrência',
			'ParecerComissao' => 'Parecer da Comissão Disciplinar Discente',
			'SansaoAplicavel' => 'Sansão disciplinas aplicável',
			'ParecerDiretor' => 'Procede com o deferimento para',
			'DescricaoParecer' => 'Descricao do parecer',
			'ServidorProcesso' => 'Relator',
			'Aluno' => 'Discente envolvido',
			'relSansao.NMSansao' => 'Sansão disciplinas aplicável',
			'relSansaoDiretor.NMSansao'=>'Procede com o deferimento para',
			'reincidencia'=>'O aluno é reincindênte?',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$parametros = func_get_args();

		$criteria=new CDbCriteria;

		$criteria->with = array('relServidorProcesso');
		
		$criteria->together = true;

		$valida = true;
		if(isset($parametros[0]) && $parametros[0] == "todos"){
			if(Yii::app()->user->checkAccess('ServidorDiretor')){
				$valida = false;
			}
			if(Yii::app()->user->checkAccess('ServidorComissao')){
				$valida = false;
			}

		}
		if(Yii::app()->user->checkAccess('ServidorPD') && (Yii::app()->user->name != "admin") && $valida){
			$criteria->compare('ServidorProcesso',Yii::app()->user->CDServidor);
		}

		$processosSituacao = array();
		$modelAll = DProcessoDisciplinar::model()->findAll();
		foreach($modelAll as $m){
			if($this->situacaoProcesso($m->CDProcessoDisciplinar) == $this->Situacao){
				$processosSituacao[] = $m->CDProcessoDisciplinar;
			}
		}
		if(!empty($processosSituacao)){
			$criteria->addInCondition('CDProcessoDisciplinar',$processosSituacao);
		}

		if(!empty($this->DataOcorrencia)){
			$Data = $this->DataOcorrencia;
				$ar = explode('/', $Data);
				$this->DataOcorrencia = $ar[2].'-'.$ar[1].'-'.$ar[0];
				$criteria->compare('DataOcorrencia',$this->DataOcorrencia,true);
				$this->DataOcorrencia = $Data;
		}

		


		$criteria->compare('CDProcessoDisciplinar',$this->CDProcessoDisciplinar);
		$criteria->compare('ServidorProcesso',$this->ServidorProcesso);
		$criteria->compare('relServidorProcesso.NMServidor',$this->servidorNMServidor, true);
		$criteria->compare('Aluno',$this->Aluno,true);
		
		$criteria->compare('DataCriacao',$this->DataCriacao,true);
		$criteria->compare('DescricaoOcorrencia',$this->DescricaoOcorrencia,true);
		$criteria->compare('ParecerComissao',$this->ParecerComissao,true);
		$criteria->compare('SansaoAplicavel',$this->SansaoAplicavel);
		$criteria->compare('ParecerDiretor',$this->ParecerDiretor);
		$criteria->compare('DescricaoParecer',$this->DescricaoParecer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	// public function beforeSave() {

	// 	if($this->DataOcorrencia != ''){
	// 			$Data = $this->DataOcorrencia;
	// 			$ar = explode('/', $Data);
	// 			$this->DataOcorrencia = $ar[2].'-'.$ar[1].'-'.$ar[0];				
	// 	}

	// 	return parent::beforeSave();
	// }	

	public function situacaoProcesso($CDProcesso){
	   $criteria = new CDbCriteria;
	   $criteria->compare('CDProcessoDisciplinar',$CDProcesso);

	   $registro = DProcessoDisciplinar::model()->find($criteria);

	   if(is_null($registro)){
			return "Erro";
	   }
	   else{
	   		if(empty($registro->ParecerDiretor) && empty($registro->ParecerComissao)){
	   			return "Enviado";
	   		}
	   		if(!empty($registro->ParecerComissao) && empty($registro->ParecerDiretor)){
	   			return "Analisado pela comissão disciplinar";
	   		}
	   		return "Concluído";	
	   }
	}

	public function visProcesso($CDProcesso){

	   if(Yii::app()->user->name == "admin")
	   		return true;

	   $criteria = new CDbCriteria;
	   $criteria->compare('ServidorProcesso',Yii::app()->user->CDServidor);

	   $registroS = DProcessoDisciplinar::model()->find($criteria);

	   $servProcesso = false;
	   if(!is_null($registroS)){
	   		$servProcesso = true;
	   }

	   $criteria = new CDbCriteria;
	   $criteria->compare('ServidorComissao',Yii::app()->user->CDServidor);

	   $registroS = DProcessoDisciplinar::model()->find($criteria);

	   $servComissao = false;
	   if(!is_null($registroS)){
	   		$servComissao = true;
	   }

	   $criteria = new CDbCriteria;
	   $criteria->compare('ServidorDiretor',Yii::app()->user->CDServidor);

	   $registroS = DProcessoDisciplinar::model()->find($criteria);

	   $servDiretor = false;
	   if(!is_null($registroS)){
	   		$servDiretor = true;
	   }

	   $criteria = new CDbCriteria;
	   $criteria->compare('CDProcessoDisciplinar',$CDProcesso);

	   $registro = DProcessoDisciplinar::model()->find($criteria);

	   if(is_null($registro)){
			return false;
	   }
	   else{
	   		if(empty($registro->ParecerComissao) && $servProcesso){
	   			return true;
	   		}
	   		// if(empty($registro->ParecerDiretor) && $servComissao){
	   		// 	return true;
	   		// }
	   		// if(!empty($registro->ParecerComissao) && $servDiretor){
	   		// 	return true;
	   		// }
	   		return false;
	   		
	   }
	}


	public function visSituacao($CDProcesso){

	   if(Yii::app()->user->name == "admin")
	   		return false;

	   $criteria = new CDbCriteria;
	   $criteria->compare('ServidorProcesso',Yii::app()->user->CDServidor);

	   $registroS = DProcessoDisciplinar::model()->find($criteria);

	   $servProcesso = false;
	   if(!is_null($registroS)){
	   		$servProcesso = true;
	   }

	   $criteria = new CDbCriteria;
	   $criteria->compare('ServidorComissao',Yii::app()->user->CDServidor);
	   $criteria->compare('CDProcessoDisciplinar',$CDProcesso);
	   $registroS = DProcessoDisciplinar::model()->find($criteria);

	   $servComissao = false;
	   if(!is_null($registroS) || Yii::app()->user->checkAccess('ServidorComissao')){
	   		$servComissao = true;
	   }

	   $criteria = new CDbCriteria;
	   $criteria->compare('ServidorDiretor',Yii::app()->user->CDServidor);
	   $criteria->compare('CDProcessoDisciplinar',$CDProcesso);
	   $registroS = DProcessoDisciplinar::model()->find($criteria);

	   $servDiretor = false;
	   if(!is_null($registroS) || Yii::app()->user->checkAccess('ServidorDiretor')){
	   		$servDiretor = true;
	   }

	   $criteria = new CDbCriteria;
	   $criteria->compare('CDProcessoDisciplinar',$CDProcesso);

	   $registro = DProcessoDisciplinar::model()->find($criteria);

	   if(is_null($registro)){
			return false;
	   }
	   else{
	   		if(empty($registro->ParecerDiretor) && $servComissao){
	   			return true;
	   		}
	   		if(!empty($registro->ParecerComissao) && $servDiretor){
	   			return true;
	   		}
	   		return false;
	   		
	   }
	}

	public function visPDF($CDProcesso){

	   $servDiretor = false;
	   if(Yii::app()->user->checkAccess('ServidorDiretor')){
	   		$servDiretor = true;
	   }

	   $criteria = new CDbCriteria;
	   $criteria->compare('CDProcessoDisciplinar',$CDProcesso);

	   $registro = DProcessoDisciplinar::model()->find($criteria);

	   if(is_null($registro)){
			return false;
	   }
	   else{
	   		if(!empty($registro->ParecerDiretor) && $servDiretor){
	   			return true;
	   		}
	   		else if(!empty($registro->ParecerDiretor) && (Yii::app()->user->name == "admin")){
	   			return true;
	   		}
	   		return false;
	   		
	   }
	}


}