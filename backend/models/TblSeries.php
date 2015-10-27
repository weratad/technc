<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_series".
 *
 * @property integer $serie_id
 * @property string $serie_name
 * @property integer $webpage_id
 *
 * @property TblWebpage $webpage
 */
class TblSeries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $id;
    public static function tableName()
    {
        return 'tbl_series';
    }
    public function setId(){
         return $this->serie_id;
    }
    public function getId(){
         return $this->serie_id;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serie_name'], 'required'],
            [['product_id'], 'integer'],
            [['serie_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'serie_id' => 'Serie ID',
            'serie_name' => 'ชื่อซีรี่ย์',
            'product_id' => 'หน้าสินค้า',
            'tree_id' => 'หมวดสินค้า',
            'serie_group' => 'กลุ่ม'
        ];
    }

    public function behaviors()
    {
        return [
            'sortable' => [
                'class' => \kotchuprik\sortable\behaviors\Sortable::className(),
                'query' => self::find(),
            ],
        ];
    }

}
