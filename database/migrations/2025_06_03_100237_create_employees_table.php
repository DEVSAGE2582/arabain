<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('passport_no');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('id_no');
            $table->text('mailing_address');
            $table->string('nationality');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('dob'); // Date of Birth
            $table->date('doj'); // Date of Joining
            $table->string('designation');
            $table->string('qualification');
            $table->decimal('salary_bonus', 10, 2)->nullable();
            $table->decimal('food_allowance', 10, 2)->nullable();
            $table->decimal('transport_allowance', 10, 2)->nullable();
            $table->string('id_image')->nullable(); // File path
            $table->string('photo')->nullable();    // File path
            $table->text('job_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
