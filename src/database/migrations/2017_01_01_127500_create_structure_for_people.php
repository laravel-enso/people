<?php

use LaravelEnso\Migrator\App\Database\Migration;
use LaravelEnso\Permissions\App\Enums\Types;

class CreateStructureForPeople extends Migration
{
    protected $permissions = [
        ['name' => 'administration.people.initTable', 'description' => 'Init table for people', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'administration.people.tableData', 'description' => 'Get table data for people', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'administration.people.exportExcel', 'description' => 'Export excel for people', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'administration.people.options', 'description' => 'Get options for select', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'administration.people.create', 'description' => 'Create person', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.people.edit', 'description' => 'Edit existing person', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.people.index', 'description' => 'Show people index', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'administration.people.store', 'description' => 'Store newly created person', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.people.update', 'description' => 'Update edited person', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.people.destroy', 'description' => 'Delete person', 'type' => Types::Write, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'People', 'icon' => 'user-tie', 'route' => 'administration.people.index', 'order_index' => 200, 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
