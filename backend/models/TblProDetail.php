<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pro_detail".
 *
 * @property integer $pro_de_id
 * @property string $pro_de_name
 * @property string $pro_de_detail
 * @property integer $pro_id
 * @property integer $lang_id
 *
 * @property TblLanguage $lang
 * @property TblProduct $pro
 */
class TblProDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pro_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_de_detail'], 'string'],
            [['pro_id', 'lang_id'], 'required'],
            [['pro_id', 'lang_id'], 'integer'],
            [['pro_de_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_de_id' => 'Pro De ID',
            'pro_de_name' => 'ชื่อรายการสินค้า',
            'pro_de_detail' => 'รายละเอียด',
            'pro_id' => 'Pro ID',
            'lang_id' => 'Lang ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(TblLanguage::className(), ['lang_id' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(TblProduct::className(), ['product_id' => 'pro_id']);
    }
}
