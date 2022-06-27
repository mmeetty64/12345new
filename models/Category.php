<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 *
 * @property Tovar[] $tovars
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Tovars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTovars()
    {
        return $this->hasMany(Tovar::className(), ['id_category' => 'id']);
    }
    
    public static function getCategory()
    {
        return (new \yii\db\Query())
        ->select(['title'])
        ->from ('category')
        ->indexBy('id')
        ->column()
        ;
    }
}
