<?php

use yii\db\Migration;

class m170421_190658_properties extends Migration
{
    public function up()
    {
        // Типы объектов (кран, машина, автобус)
        $this->createTable('object_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
        ]);
        $this->createIndex('idx_object_type', 'object_type', 'name', true);


        $this->createTable('object', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200),
            'type_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull() . ' DEFAULT NOW()',
        ]);

        $this->addForeignKey('fk_object_type', 'object', 'type_id', 'object_type', 'id');

        $this->createTable('object_property', [
            'id' => $this->primaryKey(),
            'object_type_id' => $this->integer()->notNull()->comment('Тип объекта'),
            'name' => $this->string(200)->notNull()->comment('Название свойства'),
            'data_type' => $this->integer()->notNull()->comment('Тип данных (1=integer/bool; 2=text)'),
        ]);
        $this->addForeignKey('fk_object_type_id', 'object_property', 'object_type_id', 'object_type', 'id');
        $this->createIndex('idx_object_property', 'object_property', ['object_type_id', 'name'], true);

        $this->createTable('objects_properties', [
            'id' => $this->primaryKey(),
            'object_id' => $this->integer()->notNull(),
            'property_id' => $this->integer()->notNull(),
            'value_int' => $this->integer()->null(),
            'value_text' => $this->text()->null(),
        ]);
        $this->addForeignKey('fk_object', 'objects_properties', 'object_id', 'object', 'id');
        $this->addForeignKey('fk_property', 'objects_properties', 'property_id', 'object_property', 'id');
        $this->createIndex('idx_objects_properties', 'objects_properties', ['object_id', 'property_id'], true);
    }

    public function down()
    {
        $this->dropForeignKey('fk_object_type', 'object');
        $this->dropForeignKey('fk_object_type_id', 'object_property');

        $this->dropForeignKey('fk_object', 'objects_properties');
        $this->dropForeignKey('fk_property', 'objects_properties');
        $this->dropTable('objects_properties');

        $this->dropTable('object');
        $this->dropTable('object_type');

        $this->dropTable('object_property');

    }

}
