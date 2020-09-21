<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clients_id')
                ->constrained('clients')
                ->onDelete('restrict');
            $table->foreignId('processors_id')
                ->nullable()
                ->constrained('processors')
                ->onDelete('restrict');
            $table->string('command');
            $table->enum('status', ['open', 'processing', 'done'])
                ->default('open');
            $table->enum('priority', [0, 1, 2, 3, 4]) # high priority 0 - low 4
                ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('jobs', function (Blueprint $table) {
        //     $table->dropForeign('jobs_clients_id_foreign');
        //     $table->dropForeign('jobs_processors_id_foreign');
        // });
        Schema::dropIfExists('jobs');
    }
}
