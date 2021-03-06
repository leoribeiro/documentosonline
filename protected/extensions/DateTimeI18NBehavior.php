<?php
 
/**
 * DateTimeI18NBehavior
 * Automatically converts date and datetime fields to I18N format
 *
 * @author Ricardo Grana <rickgrana@yahoo.com.br>, <ricardo.grana@pmm.am.gov.br>
 * @version 1.1
 */
class DateTimeI18NBehavior extends CActiveRecordBehavior
{
    public $dateOutcomeFormat = 'Y-m-d';
    public $dateTimeOutcomeFormat = 'Y-m-d H:i:s';
 
    public $dateIncomeFormat = 'yyyy-MM-dd';
    public $dateTimeIncomeFormat = 'yyyy-MM-dd hh:mm:ss';
 
    /**
     * List of columns by model classes. Contains only date and datetime columns
     * cache = array(
     *  typeName => array(
     *    'date' => array() // Columns with 'date' type
     *    'datetime' => array() // Columns with 'datetime' type
     *  )
     * )
     *
     * @var array
     * @see DateTimeI18NBehavior::checkCache
     */
    private static $cache = array();
 
    public function beforeSave($event)
    {
        $this->convertToPhpFormat($event->sender);
        return true;
    }
 
    /**
     * We must reconvert columns after they saved (little hack for CForm)
     */
    public function afterSave($event)
    {
        $this->convertToLocaleFormat($event->sender);
        return true;
    }
 
    public function afterFind($event)
    {
        $this->convertToLocaleFormat($event->sender);
        return true;
    }
 
    private function convertToLocaleFormat(CActiveRecord $model)
    {
        $this->checkCache($model);
        $type = get_class($model);
        $columns = &self::$cache[$type];
 
        // Convert all columns with 'date' type
        foreach ($columns['date'] as $columnName)
        {
            if (strlen($model->$columnName) > 0)
                $model->$columnName = Yii::app()->dateFormatter->formatDateTime(
                    CDateTimeParser::parse($model->$columnName, $this->dateIncomeFormat),
                    'medium',
                    null
                );
        }
 
        // Convert all columns with 'datetime' type
        foreach ($columns['datetime'] as $columnName)
        {
            if (strlen($model->$columnName) > 0)
                $model->$columnName = Yii::app()->dateFormatter->formatDateTime(
                    CDateTimeParser::parse($model->$columnName, $this->dateTimeIncomeFormat),
                    'medium',
                    'medium'
                );
        }
    }
 
    private function convertToPhpFormat(CActiveRecord $model)
    {
        $this->checkCache($model);
        $type = get_class($model);
        $columns = &self::$cache[$type];
 
        // Convert all columns with 'date' type
        foreach ($columns['date'] as $columnName)
        {
            if (strlen($model->$columnName) > 0)
                $model->$columnName = date(
                    $this->dateOutcomeFormat,
                    CDateTimeParser::parse($model->$columnName, Yii::app()->locale->dateFormat)
                );
        }
 
        // Convert all columns with 'datetime' type
        foreach ($columns['datetime'] as $columnName)
        {
            if (strlen($model->$columnName) > 0)
                $model->$columnName = date(
                    $this->dateTimeOutcomeFormat,
                    CDateTimeParser::parse(
                        $model->$columnName,
                        strtr(
                            Yii::app()->locale->dateTimeFormat,
                            array(
                                "{0}" => Yii::app()->locale->timeFormat,
                                "{1}" => Yii::app()->locale->dateFormat
                            )
                        )
                    )
                );
        }
    }
 
    /**
     * Check cache for type of $model, and make if need
     *
     * @param CActiveRecord $model
     */
    private function checkCache(CActiveRecord $model)
    {
        $type = get_class($model);
        if (!isset(self::$cache[$type]))
        {
            self::$cache[$type] = array(
                'date' => array(),
                'datetime' => array()
            );
 
            $columns = &self::$cache[$type];
            foreach ($model->tableSchema->columns as $columnName => $column)
            {
                if ($column->dbType == 'date' || $column->dbType == 'datetime')
                    $columns[$column->dbType][] = $columnName;
            }
        }
    }
}