<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tovar".
 *
 * @property int $id
 * @property string $title
 * @property int $price
 * @property string $photo
 * @property string $country
 * @property string $model
 * @property int $year
 * @property int $count
 * @property int $id_category
 *
 * @property Category $category
 * @property Sostav[] $sostavs
 */
class Tovar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tovar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price', 'photo', 'country', 'model', 'year', 'count', 'id_category'], 'required'],
            [['price', 'year', 'count', 'id_category'], 'integer'],
            [['title', 'photo', 'country', 'model'], 'string', 'max' => 255],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'price' => 'Цена',
            'photo' => 'Photo',
            'country' => 'Страна',
            'model' => 'Модель',
            'year' => 'Год выпуска',
            'count' => 'Количество',
            'id_category' => 'Id Category',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * Gets query for [[Sostavs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSostavs()
    {
        return $this->hasMany(Sostav::className(), ['id_tovar' => 'id']);
    }

    public static function getImages()
    {
        $rows = (new \yii\db\Query())
        -> select(['title','photo'])
        -> from('tovar')
        ->orderBy('id DESC')
        ->LIMIT(5)
        ->all();
        return $rows;
        
    }
}
