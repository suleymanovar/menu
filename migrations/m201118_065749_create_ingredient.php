<?php

use yii\db\Migration;

/**
 * Class m201118_065749_create_ingredient
 */
class m201118_065749_create_ingredient extends Migration
{
    
    
    
    public function safeUp()
    {
		 $this->createTable('ingredient', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'date_create' => $this->dateTime()->notNull(),
			'date_update' => $this->dateTime()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('ingredient');
    }
    
}
