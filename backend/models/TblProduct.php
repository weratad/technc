<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_product".
 *
 * @property integer $product_id
 * @property string $product_create
 * @property string $product_update
 *
 * @property TblProCat $tblProCat
 * @property TblProDetail[] $tblProDetails
 * @property TblProductGrouplist[] $tblProductGrouplists
 */
class TblProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_create'], 'required'],
            [['product_create', 'product_update'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_create' => 'Product Create',
            'product_update' => 'Product Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProCat()
    {
        return $this->hasOne(TblProCat::className(), ['procat_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProDetails()
    {
        return $this->hasMany(TblProDetail::className(), ['pro_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProductGrouplists()
    {
        return $this->hasMany(TblProductGrouplist::className(), ['product_id' => 'product_id']);
    }
}
