<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResourcePermissionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE  TRIGGER `resource_permissions_BEFORE_INSERT` BEFORE INSERT ON `resource_permissions` FOR EACH ROW
            BEGIN
            IF NEW.`name` IS NULL THEN
                SET NEW.`name` = CONCAT((SELECT name FROM modules WHERE modules.id = (SELECT module_id FROM resources WHERE id = NEW.resource_id)), \'-\', (SELECT name FROM resources WHERE resources.id = NEW.resource_id), \'-\', (SELECT name FROM permissions WHERE permissions.id = NEW.permission_id));
            END IF;
            IF NEW.`label` IS NULL THEN
                SET NEW.`label` = CONCAT((SELECT label FROM permissions WHERE permissions.id = NEW.permission_id), \'-\', (SELECT label FROM resources WHERE resources.id = NEW.resource_id));
            END IF;
            END
        ');

        DB::unprepared('
        CREATE  TRIGGER `resource_permissions_BEFORE_UPDATE` BEFORE UPDATE ON `resource_permissions` FOR EACH ROW
            BEGIN
            IF NEW.`name` IS NULL THEN
                SET NEW.`name` = CONCAT((SELECT name FROM modules WHERE modules.id = (SELECT module_id FROM resources WHERE id = NEW.resource_id)), \'-\', (SELECT name FROM resources WHERE resources.id = NEW.resource_id), \'-\', (SELECT name FROM permissions WHERE permissions.id = NEW.permission_id));
            END IF;
            IF NEW.`label` IS NULL THEN
                SET NEW.`label` = CONCAT((SELECT label FROM permissions WHERE permissions.id = NEW.permission_id), \'-\', (SELECT label FROM resources WHERE resources.id = NEW.resource_id));
            END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::unprepared('DROP  TRIGGER `resource_permission_BEFORE_INSERT`;');
        Schema::unprepared('DROP  TRIGGER `resource_permission_AFTER_UPDATE`;');
    }
}
