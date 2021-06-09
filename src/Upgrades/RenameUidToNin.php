<?php

namespace LaravelEnso\People\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class RenameUidToNin implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('people', 'nin');
    }

    public function migrateTable(): void
    {
        Schema::table('people', fn (Blueprint $table) => $table->renameColumn('uid', 'nin'));
    }
}
