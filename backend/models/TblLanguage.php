<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_language".
 *
 * @property integer $lang_id
 * @property string $lang_name
 * @property string $lang_icon
 *
 * @property TblNewsDetail[] $tblNewsDetails
 * @property TblProDetail[] $tblProDetails
 * @property TblWebpageDetail[] $tblWebpageDetails
 */
class TblLanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang_name'], 'required'],
            [['lang_name'], 'string', 'max' => 50],
            [['lang_icon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Lang ID',
            'lang_name' => 'Lang Name',
            'lang_icon' => 'Lang Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblNewsDetails()
    {
        return $this->hasMany(TblNewsDetail::className(), ['lang_id' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProDetails()
    {
        return $this->hasMany(TblProDetail::className(), ['lang_id' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWebpageDetails()
    {
        return $this->hasMany(TblWebpageDetail::className(), ['lang_id' => 'lang_id']);
    }
}
