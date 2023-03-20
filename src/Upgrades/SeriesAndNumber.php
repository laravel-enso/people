<?php

namespace LaravelEnso\People\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class SeriesAndNumber implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('people', 'id_series');
    }

    public function migrateTable(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('id_number')->nullable()->after('nin');
            $table->string('id_series')->nullable()->after('nin');
        });
    }
}
