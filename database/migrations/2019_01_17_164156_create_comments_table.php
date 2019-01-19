<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Comment\Comment;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Comment::TABLE, function (Blueprint $table) {
            $table->increments(Comment::PROP_ID);
            $table->string(Comment::PROP_USER_NAME, 255);
            $table->integer(Comment::PROP_PARENT_ID)->nullable()
                ->references(Comment::PROP_ID)
                ->on(Comment::TABLE)
                ->onDelete('CASCADE');
            $table->text(Comment::PROP_TEXT);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Comment::TABLE);
    }
}
