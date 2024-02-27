<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('lastName');
            $table->string('firstName');
            $table->string('email')->unique(); // Υποθέτω ό,τι ο κάθε χρήστης έχει ξεχωριστό μοναδικό email.
            $table->string('mobile')->nullable(); 
            $table->foreignId('degree_id')->constrained('degrees'); // foreign key 
            $table->string('resume')->nullable(); // Μονοπάτι στο αρχείο 
            $table->string('jobAppliedFor');
            $table->date('applicationDate')->default(DB::raw('CURRENT_DATE'));
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
        Schema::dropIfExists('candidates');
    }
}
