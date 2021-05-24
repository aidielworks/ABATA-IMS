<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->timestamps();
        });

        $topics = array(
            "Bunyi Ā",
            "Bunyi BĀ",
            "Bunyi TĀ",
            "Bunyi TSÃ",
            "Bunyi JĀ",
            "Bunyi HĀ (Keadaan Pedas)",
            "Bunyi KHŌ",
            "Bunyi DĀ",
            "Bunyi DZĀ",
            "Bunyi RŌ",
            "Bunyi ZĀ",
            "Bunyi SĀ",
            "Bunyi SYĀ",
            "Bunyi SŌ",
            "Bunyi DHŌ",
            "Bunyi THŌ",
            "Bunyi DZŌ",
            "Bunyi Ā",
            "Bunyi GHŌ",
            "Bunyi FÃ",
            "Bunyi QŌ",
            "Bunyi KĀ",
            "Bunyi LĀ",
            "Bunyi MĀ",
            "Bunyi NĀ",
            "Bunyi WĀ",
            "Bunyi HÃ",
            "Bunyi Ā",
            "Bunyi YĀ",
            "Huruf Bersambung",
            "Mengenal Nama Huruf Arab",
            "Pelajaran Baris di Bawah (Kasrah)",
            "Pelajaran Baris di Hadapan (Dhummah)",
            "Pelajaran Baris Dua Di Atas (Fathah Tanwin)",
            "Pelajaran Baris Dua Di Bawah (Kasrah Tanwin)",
            "Pelajaran Baris Dua Di Hadapan (Dhummah Tanwin)",
            "Mad Thobi'i Baris Atas",
            "Penulisan Alif Kecil Mad Thobi'i",
            "Mad Thobi'i Baris Bawah",
            "Mad Thobi'i Baris Hadapan",
            "Mad Silah Qosiroh",
            "Mad Silah Towilah",
            "Bacaan Tanda Sukun Lam",
            "Izhar Qomariah",
            "Bacaan Tanda Sukun Sin",
            "Hamzah Wasal",
            "Mad Jaiz Munfasil",
            "Mad Wajib Muttasil",
            "Bacaan Sukun Wau dan Ya'",
            "Bacaan Sukun Ro'",
            "Bacaan Sukun 'Ain dan Hamzah",
            "Bacaan Sukun Fa' dan Pedas Ha'",
            "Bacaan Sukun Kaf dan Hamzah",
            "Mad' Arid Lis Sukun",
            "Mad' Iwad",
            "Ikhfa' Hakiki",
            "Wajibul Ghunnah",
            "Bacaan Tanda Sabdu Lam",
            "Idgham Shamsiah",
            "Idgham Bi Ghunnah",
            "Izhar Shafawi",
            "Idgham Mistli",
            "Idgham Bila Ghunnah",
            "Lafaz Allah Tafkhim dan Tarqiq",
            "Qolqolah Sughra, Kubra dan Akbar",
            "Kaedah Bacaan Ketika Wakaf",
            "Iqlab",
            "Ikhfa' Shafawi",
            "Izhar Halqi"
        );


        foreach ($topics as $topic) {
            DB::table('topics')->insert(
                array(
                    'topic' => $topic
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
