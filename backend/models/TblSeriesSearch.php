<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblSeries;
/**
 * This is the model class for table "tbl_series".
 *
 * @property integer $serie_id
 * @property string $serie_name
 * @property integer $webpage_id
 *
 * @property TblWebpage $webpage
 */
class TblSeriesSearch extends TblSeries
{
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public $pro_cat;
    public function search($params)
    {
         $query = TblSeries::find();

         $this->load($params);

         $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}