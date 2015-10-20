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
    public static function tableName()
    {
        return 'tbl_series';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['webpage_id'], 'integer'],
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
            'webpage_id' => 'Webpage ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebpage()
    {
        return $this->hasOne(TblWebpage::className(), ['webpage_id' => 'webpage_id']);
    }
}
