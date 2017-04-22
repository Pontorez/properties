<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "objects_properties".
 *
 * @property integer $id
 * @property integer $object_id
 * @property integer $property_id
 * @property integer $value_int
 * @property string $value_text
 *
 * @property Object $object
 * @property ObjectProperty $property
 */
class ObjectsProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'property_id'], 'required'],
            [['object_id', 'property_id', 'value_int'], 'integer'],
            [['value_text'], 'string'],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['object_id' => 'id']],
            [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectProperty::className(), 'targetAttribute' => ['property_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => 'Object ID',
            'property_id' => 'Property ID',
            'value_int' => 'Value Int',
            'value_text' => 'Value Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(ObjectProperty::className(), ['id' => 'property_id']);
    }

    public function getValue($propertyName) {
        if ($this->isBoolean($propertyName)) {
            return $this->value_int ? 'да' : 'нет';
        } else {
            return $this->value_text ? $this->value_text : $this->value_int;
        }
    }

    public function isBoolean($propertyName) {
        return in_array($propertyName, [
            'легковой или нет',
        ]);
    }
}
