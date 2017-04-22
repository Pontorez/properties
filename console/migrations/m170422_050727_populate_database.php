<?php

use common\models\Object;
use common\models\ObjectProperty;
use common\models\ObjectsProperties;
use common\models\ObjectType;
use yii\db\Migration;

class m170422_050727_populate_database extends Migration
{
    const OBJ_TYPE_CRANE = 1;
    const OBJ_TYPE_CAR = 2;
    const OBJ_TYPE_BUS = 3;

    const DATATYPE_INTEGER = 1;
    const DATATYPE_TEXT = 2;

    const PROPERTY_CRANE_HEIGHT = 1;
    const PROPERTY_CRANE_CAPACITY = 2;
    const PROPERTY_CRANE_MODEL = 3;

    const PROPERTY_CAR_POWER = 4;
    const PROPERTY_CAR_POWER_IS_PASSENGER = 5;

    const PROPERTY_BUS_MODEL = 6;
    const PROPERTY_BUS_CAPACITY = 7;

    public function up()
    {
        ObjectProperty::deleteAll();
        ObjectType::deleteAll();
        ObjectsProperties::deleteAll();
        Object::deleteAll();

        // типы обьъектов:
        (new ObjectType(['id' => self::OBJ_TYPE_CRANE, 'name' => 'кран']))->save();
        (new ObjectType(['id' => self::OBJ_TYPE_CAR, 'name' => 'машина']))->save();
        (new ObjectType(['id' => self::OBJ_TYPE_BUS, 'name' => 'автобус']))->save();

        // свойства крана:
        (new ObjectProperty([
            'id' => self::PROPERTY_CRANE_HEIGHT,
            'object_type_id' => self::OBJ_TYPE_CRANE,
            'name' => 'высота',
            'data_type' => self::DATATYPE_INTEGER
        ]))->save();

        (new ObjectProperty([
            'id' => self::PROPERTY_CRANE_CAPACITY,
            'object_type_id' => self::OBJ_TYPE_CRANE,
            'name' => 'грузоподъемность',
            'data_type' => self::DATATYPE_INTEGER
        ]))->save();

        (new ObjectProperty([
            'id' => self::PROPERTY_CRANE_MODEL,
            'object_type_id' => self::OBJ_TYPE_CRANE,
            'name' => 'модель',
            'data_type' => self::DATATYPE_TEXT
        ]))->save();

        // свойства машины:
        (new ObjectProperty([
            'id' => self::PROPERTY_CAR_POWER,
            'object_type_id' => self::OBJ_TYPE_CAR,
            'name' => 'мощность',
            'data_type' => self::DATATYPE_INTEGER
        ]))->save();

        (new ObjectProperty([
            'id' => self::PROPERTY_CAR_POWER_IS_PASSENGER,
            'object_type_id' => self::OBJ_TYPE_CAR,
            'name' => 'легковой или нет',
            'data_type' => self::DATATYPE_INTEGER
        ]))->save();

        // свойства автобуса:
        (new ObjectProperty([
            'id' => self::PROPERTY_BUS_MODEL,
            'object_type_id' => self::OBJ_TYPE_BUS,
            'name' => 'модель',
            'data_type' => self::DATATYPE_TEXT
        ]))->save();

        (new ObjectProperty([
            'id' => self::PROPERTY_BUS_CAPACITY,
            'object_type_id' => self::OBJ_TYPE_BUS,
            'name' => 'пассажировместимость',
            'data_type' => self::DATATYPE_INTEGER
        ]))->save();

        // машины:
        (new Object(['id' => 1, 'name' => 'Tesla Model X P100D', 'type_id' => self::OBJ_TYPE_CAR]))->save();
        (new ObjectsProperties(['object_id' => 1, 'property_id' => self::PROPERTY_CAR_POWER, 'value_int' => 762]))->save();

        (new Object(['id' => 2, 'name' => 'Mercedes-Benz CLS-klasse II (W218) 350', 'type_id' => self::OBJ_TYPE_CAR]))->save();
        (new ObjectsProperties(['object_id' => 2, 'property_id' => self::PROPERTY_CAR_POWER, 'value_int' => 306]))->save();
        (new ObjectsProperties(['object_id' => 2, 'property_id' => self::PROPERTY_CAR_POWER_IS_PASSENGER, 'value_int' => 1]))->save();

        (new Object(['id' => 3, 'name' => 'Scania R-series', 'type_id' => self::OBJ_TYPE_CAR]))->save();
        (new ObjectsProperties(['object_id' => 3, 'property_id' => self::PROPERTY_CAR_POWER, 'value_int' => 450]))->save();
        (new ObjectsProperties(['object_id' => 3, 'property_id' => self::PROPERTY_CAR_POWER_IS_PASSENGER, 'value_int' => 0]))->save();

        // краны:
        (new Object(['id' => 4, 'name' => 'Komatsu', 'type_id' => self::OBJ_TYPE_CRANE]))->save();
        (new ObjectsProperties(['object_id' => 4, 'property_id' => self::PROPERTY_CRANE_CAPACITY, 'value_int' => 8000]))->save();
        (new ObjectsProperties(['object_id' => 4, 'property_id' => self::PROPERTY_CRANE_MODEL, 'value_text' => 'LW80']))->save();
        (new ObjectsProperties(['object_id' => 4, 'property_id' => self::PROPERTY_CRANE_HEIGHT, 'value_int' => 10]))->save();

        (new Object(['id' => 5, 'name' => 'Hyundai', 'type_id' => self::OBJ_TYPE_CRANE]))->save();
        (new ObjectsProperties(['object_id' => 5, 'property_id' => self::PROPERTY_CRANE_CAPACITY, 'value_int' => 15000]))->save();
        (new ObjectsProperties(['object_id' => 5, 'property_id' => self::PROPERTY_CRANE_MODEL, 'value_text' => 'Gold']))->save();
        (new ObjectsProperties(['object_id' => 5, 'property_id' => self::PROPERTY_CRANE_HEIGHT, 'value_int' => 11]))->save();

        // автобусы:
        (new Object(['id' => 6, 'name' => 'Golden Dragon', 'type_id' => self::OBJ_TYPE_BUS]))->save();
        (new ObjectsProperties(['object_id' => 6, 'property_id' => self::PROPERTY_BUS_CAPACITY, 'value_int' => 30]))->save();
        (new ObjectsProperties(['object_id' => 6, 'property_id' => self::PROPERTY_BUS_MODEL, 'value_text' => 'XML 6126JR']))->save();

        (new Object(['id' => 7, 'name' => 'Golden Dragon', 'type_id' => self::OBJ_TYPE_BUS]))->save();
        (new ObjectsProperties(['object_id' => 7, 'property_id' => self::PROPERTY_BUS_CAPACITY, 'value_int' => 37]))->save();
        (new ObjectsProperties(['object_id' => 7, 'property_id' => self::PROPERTY_BUS_MODEL, 'value_text' => 'XML 6125CR']))->save();
    }

    public function down()
    {
        ObjectsProperties::deleteAll();
        Object::deleteAll();
        ObjectProperty::deleteAll();
        ObjectType::deleteAll();
    }

}
