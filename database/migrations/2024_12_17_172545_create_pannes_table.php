<?php

use App\Models\User;
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
        Schema::create('pannes', function (Blueprint $table) {
            $table->id();

            $table->enum('voie', ['S1', 'S2', 'S3', 'E4', 'E5', 'E6']);
            $table->enum('type', ['LECTURE', 'PANNE_ELECTRICITE', 'BARRIERE', 'CLASSE']);            
            $table->enum('status',['En cours','Terminée', 'Annulée']);
            $table->string('comment')->nullable();


            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('pannes');
    }
};
