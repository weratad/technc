<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_product_group".
 *
 * @property integer $pro_gro_id
 * @property string $pro_gro_name
 * @property integer $pro_gro_sort
 * @property integer $id
 *
 * @property TblProductGrouplist[] $tblProductGrouplists
 */
class TblProductGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_gro_name', 'id'], 'required'],
            [['pro_gro_sort', 'id'], 'integer'],
            [['pro_gro_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_gro_id' => 'Pro Gro ID',
            'pro_gro_name' => 'Pro Gro Name',
            'pro_gro_sort' => 'Pro Gro Sort',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProductGrouplists()
    {
        return $this->hasMany(TblProductGrouplist::className(), ['pro_gro_id' => 'pro_gro_id']);
    }
}
