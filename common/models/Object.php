<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_id
 * @property string $created_at
 *
 * @property ObjectType $type
 * @property ObjectsProperties[] $objectsProperties
 */
class Object extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'required'],
            [['type_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => 'Type ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ObjectType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsProperties()
    {
        return $this->hasMany(ObjectsProperties::className(), ['object_id' => 'id']);
    }
}
