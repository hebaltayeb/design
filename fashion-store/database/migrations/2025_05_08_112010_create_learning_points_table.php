<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningPointsTable extends Migration
{public function up()
    {
        Schema::create('learning_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('description');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('learning_points');
    }
    
}