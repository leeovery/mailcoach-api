<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailcoachApiTables extends Migration
{
    public function up()
    {
        Schema::table('mailcoach_subscribers', function (Blueprint $table) {
            $table->index('email');
        });

        Schema::create('mailcoach_api_webhooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->json('triggers')->nullable();
            $table->string('status', 15);
            $table->timestamps();
        });

        Schema::create('mailcoach_api_webhooks_event_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('webhook_id');
            $table->string('url');
            $table->json('triggers');
            $table->unsignedInteger('attempts');
            $table->timestamps();

            $table
                ->foreign('webhook_id')
                ->references('id')->on('mailcoach_api_webhooks')
                ->onDelete('cascade');
        });
    }
}
