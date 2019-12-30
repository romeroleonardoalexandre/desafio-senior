<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StartUserCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $password = \Hash::make('123123');

        \App\User::insert([
            'name' => 'Alexandre Romero',
            'email' => 'contato@alexandreromero.com.br',
            'email_verified_at' => new \DateTime(),
            'password' => $password,
            'api_token' => Hash::make('contato@alexandreromero.com.br')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
