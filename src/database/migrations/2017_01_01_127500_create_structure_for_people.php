<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForPeople extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'administration.people', 'description' => 'People permissions group',
    ];

    protected $permissions = [
        ['name' => 'administration.people.initTable', 'description' => 'Init table for people', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.people.getTableData', 'description' => 'Get table data for people', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.people.exportExcel', 'description' => 'Export excel for people', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.people.options', 'description' => 'Get options for select', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.people.create', 'description' => 'Create person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.people.edit', 'description' => 'Edit existing person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.people.index', 'description' => 'Show people', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.people.store', 'description' => 'Store newly created person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.people.update', 'description' => 'Update edited person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.people.destroy', 'description' => 'Delete person', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'People', 'icon' => 'user-tie', 'link' => 'administration.people.index', 'order_index' => 200, 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
