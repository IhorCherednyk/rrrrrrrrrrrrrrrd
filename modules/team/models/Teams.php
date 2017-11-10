<?php

namespace app\modules\team\models;

use app\modules\forecasts\models\TeamAlias;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%teams}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property integer $dotabuff_id
 * @property string $dotabuff_link
 * @property integer $total_place
 * @property integer $game_count
 * @property integer $winrate
 */
class Teams extends ActiveRecord
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
            [['name', 'img'], 'required'],
            [['dotabuff_id', 'total_place', 'game_count', 'winrate', 'gametournament_id'], 'integer'],
            [['name', 'img', 'dotabuff_link', 'search_name'], 'string', 'max' => 255],
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
            'img' => 'Img',
            'dotabuff_id' => 'Dotabuff ID',
            'dotabuff_link' => 'Dotabuff Link',
            'total_place' => 'Total Place',
            'game_count' => 'Game Count',
            'winrate' => 'Winrate',
            'search_name' => 'Search Name'
        ];
    }
    
    public static function findByAttributes($id,$name,$alias){
        $query = static::find()->alias('t');
        $query->select('t.*,at.alias');
        
        $query->leftJoin(['at' => TeamAlias::tableName()], 'at.team_id = t.id');
        
        $query->where(['t.gametournament_id' => $id])
                ->orWhere(['t.search_name' => strtolower(preg_replace("/[^a-zA-ZА-Яа-я0-9]/", "", $name))])
                ->orWhere(['t.search_name' => strtolower(preg_replace("/[^a-zA-ZА-Яа-я0-9]/", "", $alias))])
                ->orWhere(['at.alias' => strtolower(preg_replace("/[^a-zA-ZА-Яа-я0-9]/", "", $alias))]);

//        echo  $query->createCommand()->getRawSql();die();
        
        return $query->one();
    }
    
    

}
