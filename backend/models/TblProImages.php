<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pro_images".
 *
 * @property integer $pro_image_id
 * @property string $pro_image_name
 * @property integer $product_id
 *
 * @property TblProduct $product
 */
class TblProImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    /*public static function tableName()
    {
        return 'tbl_pro_images';
    }

    /**
     * @inheritdoc
     */
    public $image;
    public function rules()
    {
        return [
//[['pro_image_name', 'product_id'], 'required'],
            //[['product_id'], 'integer'],
            //[['pro_image_name'], 'string', 'max' => 255],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    /*public function attributeLabels()
    {
        return [
            'pro_image_id' => 'Pro Image ID',
            'pro_image_name' => 'Pro Image Name',
            'product_id' => 'Product ID',
        ];
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getProduct()
    {
        return $this->hasOne(TblProduct::className(), ['product_id' => 'product_id']);
    }*/
}
