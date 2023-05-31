<?php

namespace LaravelEnso\People\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Contracts\Prioritization;

class IdNumber implements MigratesTable, Prioritization
{
    public function priority(): int
    {
        return 110;
    }

    public function isMigrated(): bool
    {
        return Schema::getColumnType('people', 'id_number') === 'string';
    }

    public function migrateTable(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->string('id_number')->change();
        });
    }
}
