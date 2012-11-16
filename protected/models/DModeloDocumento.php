<?php

/**
 * This is the model class for table "D_Modelo_Documento".
 *
 * The followings are the available columns in table 'D_Modelo_Documento':
 * @property integer $CDModeloDocumento
 * @property string $NMModeloDocumento
 * @property integer $NumeracaoDocumento
 * @property string $NMSiglaDocumento
 *
 * The followings are the available model relations:
 * @property DDocumento[] $dDocumentos
 * @property DResponsavelDocumento[] $dResponsavelDocumentos
 */
class DModeloDocumento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DModeloDocumento the static model class
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
		return 'D_Modelo_Documento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' NMModeloDocumento, NMSiglaDocumento', 'required'),
			array('CDModeloDocumento, NumeracaoDocumento', 'numerical', 'integerOnly'=>true),
			array('NMModeloDocumento', 'length', 'max'=>300),
			array('NMSiglaDocumento', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDModeloDocumento, NMModeloDocumento, NumeracaoDocumento, NMSiglaDocumento', 'safe', 'on'=>'search'),
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
			'dDocumentos' => array(self::HAS_MANY, 'DDocumento', 'ModeloDocumento_CDModeloDocumento'),
			'dResponsavelDocumentos' => array(self::HAS_MANY, 'DResponsavelDocumento', 'ModeloDocumento'),
			'relServidor'=>array(self::MANY_MANY, 'Servidor',
                'D_ResponsavelDocumento(ModeloDocumento,Responsavel)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDModeloDocumento' => 'Código',
			'NMModeloDocumento' => 'Nome do modelo',
			'NumeracaoDocumento' => 'Numeracao Documento',
			'NMSiglaDocumento' => 'Sigla do modelo',
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

		$criteria=new CDbCriteria;

		$criteria->compare('CDModeloDocumento',$this->CDModeloDocumento);
		$criteria->compare('NMModeloDocumento',$this->NMModeloDocumento,true);
		$criteria->compare('NumeracaoDocumento',$this->NumeracaoDocumento);
		$criteria->compare('NMSiglaDocumento',$this->NMSiglaDocumento,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function behaviors()
	{
	    return array(
			
			// Adicionado junto com a extensão CAdvancedArBehavior
			'CAdvancedArBehavior' => array('class' => 'application.extensions.CAdvancedArBehavior')

			
		); 

	}

}