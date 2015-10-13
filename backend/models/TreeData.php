<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tree_data".
 *
 * @property string $id
 * @property string $nm
 * @property string $type
 */
class TreeData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nm'], 'required'],
            [['id'], 'integer'],
            [['nm'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm' => 'Nm',
            'type' => 'Type',
        ];
    }
}
