<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblProDetail;
/**
 * This is the model class for table "tbl_pro_detail".
 *
 * @property integer $pro_de_id
 * @property string $pro_de_detail
 * @property integer $pro_id
 * @property integer $lang_id
 *
 * @property TblLanguage $lang
 * @property TblProduct $pro
 */
class TblProDetailSearch extends TblProDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_de_name','pro_de_detail'], 'string'],
            [['pro_id'], 'required'],
            [['pro_id', 'lang_id'], 'integer'],
            [['lang_id', 'pro_de_name'], 'safe'],
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
        $query = TblProDetail::find();

        $this->load($params);

        if (array_key_exists('TblProDetailSearch', $params)) {
            if(array_key_exists('pro_cat', $params['TblProDetailSearch'])&& !empty($params['TblProDetailSearch']['pro_cat'])){
                $cat=$params['TblProDetailSearch']['pro_cat'];
                $arrCat  = explode(",", $cat );
                $query->joinWith('pro.procat');
                $query->where(['IN','prodata_id',  $arrCat]);

                  //$query->where(['pro'=> ]);
             }
        }
        $query->andFilterWhere([
            'lang_id' => $this->lang_id,
        ]);
        $query->andFilterWhere(['like', 'pro_de_name', $this->pro_de_name]);
        if(empty($this->lang_id)){
            $query->orderBy(['lang_id'=>SORT_DESC]);
            $query->groupBy(['pro_id']);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['pro_de_id'=>SORT_DESC]]
        ]);
        return $dataProvider;
    }
}
