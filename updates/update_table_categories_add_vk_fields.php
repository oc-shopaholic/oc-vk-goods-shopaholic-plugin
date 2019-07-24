<?php namespace Lovata\BaseCode\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class UpdateTableCategoriesAddVkFields
 * @package Lovata\BaseCode\Updates
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class UpdateTableCategoriesAddVkFields extends Migration
{
    const TABLE = 'lovata_shopaholic_categories';

    /**
     * Apply migration
     */
    public function up()
    {
        if (!Schema::hasTable(self::TABLE) || Schema::hasColumns(self::TABLE, ['category_vk_id'])) {
            return;
        }

        Schema::table(self::TABLE, function(Blueprint $obTable) {
            $obTable->integer('category_vk_id')->nullable();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        if (!Schema::hasTable(self::TABLE) || !Schema::hasColumns(self::TABLE, ['category_vk_id'])) {
            return;
        }

        Schema::table(self::TABLE, function(Blueprint $obTable) {
            $obTable->dropColumn(['category_vk_id']);
        });
    }
}
