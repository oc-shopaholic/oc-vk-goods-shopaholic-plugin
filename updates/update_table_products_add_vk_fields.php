<?php namespace Lovata\BaseCode\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class UpdateTableProductsAddVkFields
 * @package Lovata\BaseCode\Updates
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class UpdateTableProductsAddVkFields extends Migration
{
    const TABLE = 'lovata_shopaholic_products';

    /**
     * Apply migration
     */
    public function up()
    {
        if (!Schema::hasTable(self::TABLE) || Schema::hasColumns(self::TABLE, ['external_vk_id', 'active_vk'])) {
            return;
        }

        Schema::table(self::TABLE, function(Blueprint $obTable) {
            $obTable->boolean('active_vk')->default(0);
            $obTable->string('external_vk_id')->nullable();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        if (!Schema::hasTable(self::TABLE) || !Schema::hasColumns(self::TABLE, ['external_vk_id', 'active_vk'])) {
            return;
        }

        Schema::table(self::TABLE, function(Blueprint $obTable) {
            $obTable->dropColumn(['external_vk_id', 'active_vk']);
        });
    }
}
