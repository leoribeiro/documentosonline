<?php

/**
 * This is the model class for table "D_ResponsavelDocumento".
 *
 * The followings are the available columns in table 'D_ResponsavelDocumento':
 * @property integer $CDResponsavelDocumento
 * @property integer $Responsavel
 * @property integer $ModeloDocumento
 *
 * The followings are the available model relations:
 * @property DModeloDocumento $modeloDocumento
 * @property Servidor $responsavel
 */
class DResponsavelDocumento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DResponsavelDocumento the static model class
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
		return 'D_ResponsavelDocumento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CDResponsavelDocumento, Responsavel, ModeloDocumento', 'required'),
			array('CDResponsavelDocumento, Responsavel, ModeloDocumento', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDResponsavelDocumento, Responsavel, ModeloDocumento', 'safe', 'on'=>'search'),
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
			'modeloDocumento' => array(self::BELONGS_TO, 'DModeloDocumento', 'ModeloDocumento'),
			'responsavel' => array(self::BELONGS_TO, 'Servidor', 'Responsavel'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDResponsavelDocumento' => 'Cdresponsavel Documento',
			'Responsavel' => 'Responsavel',
			'ModeloDocumento' => 'Modelo Documento',
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

		$criteria->compare('CDResponsavelDocumento',$this->CDResponsavelDocumento);
		$criteria->compare('Responsavel',$this->Responsavel);
		$criteria->compare('ModeloDocumento',$this->ModeloDocumento);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}