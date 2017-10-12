<?php

namespace app\modules\bookmekers\models;

use Yii;

/**
 * This is the model class for table "{{%bookmeker}}".
 *
 * @property integer $id
 * @property string $img_medium
 * @property string $img_small
 * @property string $referal_token
 * @property string $body
 * @property integer $bonus
 * @property string $bonus_link
 * @property string $site_link
 */
class Bookmeker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $filemedium_img;
    public $filesmall_img;
    
    
    
    public static function tableName()
    {
        return '{{%bookmeker}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body','gametournament_alias'], 'string'],
            [['bonus'], 'integer'],
            [['img_medium', 'img_small', 'referal_token', 'bonus_link', 'site_link', 'name'], 'string', 'max' => 250],
            [['filemedium_img','filesmall_img'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'skipOnEmpty' => true], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_medium' => 'Img Medium',
            'img_small' => 'Img Small',
            'referal_token' => 'Referal Token',
            'name' => 'Name',
            'body' => 'Body',
            'bonus' => 'Bonus',
            'bonus_link' => 'Bonus Link',
            'site_link' => 'Site Link',
            'gametournament_alias' => 'gametournament_alias'
        ];
    }
    
    public static function findByAliasName($alias){
        return static::find()->where('LOWER(gametournament_alias) = "' . strtolower($alias) . '"')->one();
    }
    
    public static function findForWidget(){
        return static::find()->where(['not' , ['bonus' => null]])->all();
    }
    
}
