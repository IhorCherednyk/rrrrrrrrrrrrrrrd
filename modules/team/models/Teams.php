<?php

namespace app\modules\team\models;

use Yii;

/**
 * This is the model class for table "{{%teams}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $second_name
 * @property string $img
 * @property integer $dotabuff_id
 * @property string $dotabuff_link
 * @property integer $total_place
 * @property integer $game_count
 * @property integer $winrate
 */
class Teams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $imgfile;
    
    public static function tableName()
    {
        return '{{%teams}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'img', 'dotabuff_id', 'dotabuff_link', 'total_place', 'game_count', 'winrate'], 'required'],
            [['dotabuff_id', 'total_place', 'game_count', 'winrate'], 'integer'],
            [['name', 'second_name', 'img', 'dotabuff_link'], 'string', 'max' => 255],
            [['imgfile'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'second_name' => 'Second Name',
            'img' => 'Img',
            'dotabuff_id' => 'Dotabuff ID',
            'dotabuff_link' => 'Dotabuff Link',
            'total_place' => 'Total Place',
            'game_count' => 'Game Count',
            'winrate' => 'Winrate',
        ];
    }
}
