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
			array('DataOcorrencia, DataCriacao, DescricaoOcorrencia, ParecerComissao, SansaoAplicavel, ParecerDiretor, DescricaoParecer', 'required'),
			array('SansaoAplicavel, ParecerDiretor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDProcessoDisciplinar, DataOcorrencia, DataCriacao, DescricaoOcorrencia, ParecerComissao, SansaoAplicavel, ParecerDiretor, DescricaoParecer', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDProcessoDisciplinar' => 'Cdprocesso Disciplinar',
			'DataOcorrencia' => 'Data Ocorrencia',
			'DataCriacao' => 'Data Criacao',
			'DescricaoOcorrencia' => 'Descricao Ocorrencia',
			'ParecerComissao' => 'Parecer Comissao',
			'SansaoAplicavel' => 'Sansao Aplicavel',
			'ParecerDiretor' => 'Parecer Diretor',
			'DescricaoParecer' => 'Descricao Parecer',
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

		$criteria->compare('CDProcessoDisciplinar',$this->CDProcessoDisciplinar);
		$criteria->compare('DataOcorrencia',$this->DataOcorrencia,true);
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
}