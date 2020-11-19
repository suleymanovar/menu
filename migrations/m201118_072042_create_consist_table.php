<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%consist}}`.
 */
class m201118_072042_create_consist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%consist}}', [
            'id' => $this->primaryKey(),
			'dish_id' => $this->integer()->notNull(),
            'ingr_id' => $this->integer()->notNull(),
            'date_create' => $this->dateTime()->notNull(),
			'date_update' => $this->dateTime()->notNull()
        ]);
		
		
		 // creates index for column `dish_id`
        $this->createIndex(
            'idx-consist-dish_id',
            'consist',
            'dish_id'
        );

        // add foreign key for table `dish`
        $this->addForeignKey(
            'fk-consist-dish_id',
            'consist',
            'dish_id',
            'dish',
            'id',
            'CASCADE'
        );

         // creates index for column `ingr_id`
        $this->createIndex(
            'idx-consist-ingr_id',
            'consist',
            'ingr_id'
        );

        // add foreign key for table `ingredient`
        $this->addForeignKey(
            'fk-consist-ingr_id',
            'consist',
            'ingr_id',
            'ingredient',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	
		// drops foreign key for table `dish`
        $this->dropForeignKey(
            'fk-consist-dish_id',
            'consist'
        );

        // drops index for column `dish_id`
        $this->dropIndex(
            'idx-consist-dish_id',
            'consist'
        );

		// drops foreign key for table `ingredient`
        $this->dropForeignKey(
            'fk-consist-ingr_id',
            'consist'
        );

        // drops index for column `ingr_id`
        $this->dropIndex(
            'idx-consist-ingr_id',
            'consist'
        );
        $this->dropTable('{{%consist}}');
    }
}
