<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Product]].
 *
 * @see \common\models\Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \common\models\query\ProductQuery
     */
    public function published()
    {
        return $this->andWhere(['status' => 1]);
    }

    public function id($id)
    {
        return $this->andWhere(['id' => $id]);
    }
}
