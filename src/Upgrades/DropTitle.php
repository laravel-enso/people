<?php

namespace LaravelEnso\People\Upgrades;

use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class DropTitle implements MigratesTable
{
    public function isMigrated(): bool
    {
        return ! Table::hasColumn('people', 'title');
    }

    public function migrateTable(): void
    {
        Schema::table('people', fn ($table) => $table->dropColumn('title'));
    }
}
