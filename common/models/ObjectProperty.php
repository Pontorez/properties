<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_property".
 *
 * @property integer $id
 * @property integer $object_type_id
 * @property string $name
 * @property integer $data_type
 *
 * @property ObjectType $objectType
 * @property ObjectsProperties[] $objectsProperties
 */
class ObjectProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_type_id', 'name', 'data_type'], 'required'],
            [['object_type_id', 'data_type'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['object_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectType::className(), 'targetAttribute' => ['object_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_type_id' => 'Object Type ID',
            'name' => 'Name',
            'data_type' => 'Data Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        return $this->hasOne(ObjectType::className(), ['id' => 'object_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsProperties()
    {
        return $this->hasMany(ObjectsProperties::className(), ['property_id' => 'id']);
    }
}
