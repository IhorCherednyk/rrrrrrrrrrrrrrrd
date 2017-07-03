<?php

namespace app\modules\pages\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\helpers\TextHelper;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $slug
 * @property string $body
 * @property string $title
 * @property string $title_short
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $keywords
 * @property string $description
 * @property integer $status
 * @property integer $is_protected
 */
class Pages extends \yii\db\ActiveRecord
{
    const STATUS_SHOW_ALL = 0;
    const STATUS_SHOW_USER = 1;
    const STATUS_SHOW_ADMIN = 2;
    const PROTECTED_NO = false;
    const PROTECTED_YES = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }
    

    public function behaviors() {
        return [
                TimestampBehavior::className(),
                [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'value' => function ($event) {
                    return str_replace(' ', '-', $this->slug);
                }
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'title', 'title_short', 'created_at', 'updated_at'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at', 'status', 'is_protected'], 'integer'],
            [['slug', 'title', 'keywords', 'description'], 'string', 'max' => 250],
            [['title_short'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'body' => 'Body',
            'title' => 'Title',
            'title_short' => 'Title Short',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'status' => 'Status',
            'is_protected' => 'Is Protected',
        ];
    }
    
    public function beforeSave($insert) {
        if (null === $this->slug) {
            $this->slug = TextHelper::translit($this->title);
        }
    }
    public function bySlug($slug) {
        return $this->andWhere('slug = :slug', [':slug' => trim($slug)]);
    }

}
