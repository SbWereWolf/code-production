<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateObtainTable extends Migration
{
    private $tableName = 'obtain';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->unsignedInteger('obtain_at');
        });

        DB::beginTransaction();

        try {

            $obtain = App\CardPr\Table\Obtain::create(
                array(
                    'obtain_at' => 0,
                )
            );

            $isSuccess = ($obtain->exists);


        } catch (\Exception $e) {
            dd($e);
            $isSuccess = false;
        }

        if (!$isSuccess) {
            DB::rollback();
        }
        if ($isSuccess) {
            DB::commit();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
