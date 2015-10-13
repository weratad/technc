<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pro_cat".
 *
 * @property integer $procat_id
 * @property integer $prodata_id
 * @property integer $procat_order
 * @property integer $procat_group
 *
 * @property TblCatgroup $procatGroup
 * @property TblProduct $procat
 */
class TblProCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pro_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['procat_id', 'prodata_id'], 'required'],
            [['procat_id', 'prodata_id', 'procat_order', 'procat_group'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'procat_id' => 'Procat ID',
            'prodata_id' => 'Prodata ID',
            'procat_order' => 'Procat Order',
            'procat_group' => 'Procat Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcatGroup()
    {
        return $this->hasOne(TblCatgroup::className(), ['catgroup_id' => 'procat_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcat()
    {
        return $this->hasOne(TblProduct::className(), ['product_id' => 'procat_id']);
    }
    public function getProdata()
    {
        return $this->hasOne(TreeData::className(), ['id' => 'prodata_id']);
    }
}
