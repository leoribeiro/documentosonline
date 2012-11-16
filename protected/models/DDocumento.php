<?php

/**
 * This is the model class for table "D_Documento".
 *
 * The followings are the available columns in table 'D_Documento':
 * @property integer $CDDocumento
 * @property string $Assunto
 * @property string $Corpo
 * @property string $DataCriacao
 * @property string $DataDocumento
 * @property integer $ModeloDocumento_CDModeloDocumento
 *
 * The followings are the available model relations:
 * @property DModeloDocumento $modeloDocumentoCDModeloDocumento
 */
class DDocumento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DDocumento the static model class
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
		return 'D_Documento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Assunto,Local,Corpo,DataDocumento, ModeloDocumento_CDModeloDocumento, Para, Servidor_CDServidor', 'required'),
			array('CDDocumento, ModeloDocumento_CDModeloDocumento', 'numerical', 'integerOnly'=>true),
			array('DataDocumento', 'date','format'=>'dd/MM/yyyy'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDDocumento, Assunto, Corpo, DataCriacao, DataDocumento, ModeloDocumento_CDModeloDocumento', 'safe', 'on'=>'search'),
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
			'relModeloDocumento' => array(self::BELONGS_TO, 'DModeloDocumento', 'ModeloDocumento_CDModeloDocumento'),
			'relServidor' => array(self::BELONGS_TO, 'Servidor', 'Servidor_CDServidor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDDocumento' => 'Código',
			'Assunto' => 'Assunto',
			'Local' => 'Local',
			'Para' => 'Para',
			'Corpo' => 'Corpo',
			'DataCriacao' => 'Data da Criação',
			'DataDocumento' => 'Data do documento',
			'ModeloDocumento_CDModeloDocumento' => 'Modelo do documento',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		
		$parametros = func_get_args();

		

		$criteria=new CDbCriteria;

		$criteria->compare('CDDocumento',$this->CDDocumento);
		$criteria->compare('Assunto',$this->Assunto,true);
		$criteria->compare('Corpo',$this->Corpo,true);

		if(!empty($parametros) && $parametros[0] == 'resp'){
			$servidor = Yii::app()->user->CDServidor;
			$criteria->compare('Servidor_CDServidor',$servidor);
		}

		if($this->DataCriacao != ''){
			$Data= $this->DataCriacao;
			$ar = explode('/', $Data);
			if(count($ar) == 3)
				$this->DataCriacao = $ar[2].'-'.$ar[1].'-'.$ar[0];
	    }

		$criteria->compare('DataCriacao',$this->DataCriacao,true);

		if($this->DataCriacao != ''){
			$Data = $this->DataCriacao;
			$ar = explode('-', $Data);
			if(count($ar) == 3)
				$this->DataCriacao = $ar[2].'/'.$ar[1].'/'.$ar[0];
	    }

		if($this->DataDocumento != ''){
			$Data= $this->DataDocumento;
			$ar = explode('/', $Data);
			if(count($ar) == 3)
				$this->DataDocumento = $ar[2].'-'.$ar[1].'-'.$ar[0];
	    }
		$criteria->compare('DataDocumento',$this->DataDocumento,true);

		if($this->DataDocumento != ''){
			$Data = $this->DataDocumento;
			$ar = explode('-', $Data);
			if(count($ar) == 3)
				$this->DataDocumento = $ar[2].'/'.$ar[1].'/'.$ar[0];
	    }	


		$criteria->compare('ModeloDocumento_CDModeloDocumento',$this->ModeloDocumento_CDModeloDocumento);

		$criteria->order = 'CDDocumento DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {

		if($this->DataDocumento != ''){
				$Data = $this->DataDocumento;
				$ar = explode('/', $Data);
				$this->DataDocumento = $ar[2].'-'.$ar[1].'-'.$ar[0];				
		}

		return parent::beforeSave();
	}	


	public function numeroDocumento($CDDocumento){
	   $criteria = new CDbCriteria;
	   $criteria->with = array('relModeloDocumento');
	   $criteria->together = true;
	   $criteria->compare('CDDocumento',$CDDocumento);

	   $registro = DDocumento::model()->find($criteria);

	   if(is_null($registro)){
			return "Erro";
	   }
	   else{
	   		$Doc = $registro->relModeloDocumento->NMSiglaDocumento."-".$registro->NumeroDocumento."/".$registro->Ano;
	   		return $Doc;
	   }
	}


}