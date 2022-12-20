<?php

namespace Database\Seeders;

use App\Models\WebSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Deving extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create(
            [
                'name' => 'Ilham Cahya',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );


        \App\Models\WebMaster::create([
            'whatsapp_bot' => '6285745876650',
            'payment_whatsapp' => '6285745876650',
            'payment_whatsapp_message' => 'Hello, I want to buy {%product%}.
With a price of Rp.{%price_idr%} or ${%price_usd%}
Link : {%url%}',
            'paypal_status' => 'active',
            'paypal_mode' => 'sandbox',
            'paypal_sandbox_client_id' => 'AetP3fRAyouG5RDGHWJiDMu2G1RSwcPXWOSuTKzZbGn00ELgGFabLMVWWjDAe8AOfhZ08uig4kg4NHim',
            'paypal_sandbox_client_secret' => 'EPBOAjvm2ltbFhRG0_T6duaE8VloVbYsQ9Gt_bbRqZy5A2Bxm__cedlVcDWpLKv7Ki5VNXDnfz6UIG5S'
        ]);
        // create web settings
        WebSetting::create([
            'logo' => 'websetting/JrGrqAskqKvIWj8hEBcbxrH4dCYGUIQOMxoG0yaa.png',
            'app_title' => 'Nitvers',
            'meta_title' => 'Nitvers Indonesia',
            'meta_description' => 'NitVers adalah perusahaan yang bergerak di bidang teknologi informasi dan komunikasi',
            'meta_keywords' => 'NitVers,metaid,tech,it,technology,indonesia',
            'meta_author' => 'Nitvers.id',
            'meta_favicon' => 'websetting/SRATSvdXM7dX5GyTLr6iCcdJPSIIZjXaWLf8efG6.png',
            'meta_thumbnail' => 'websetting/AakMZFAgs6cCaONH3GYoEEZ8Z5KmdMe1mS6QV6i7.jpg',
            'footer' => '© 2022. All Rights Reserved By Metavis',
            'maintenance_message' => '<div class="w-100 text-center"><img class="mb-2" src="storage/websetting/JrGrqAskqKvIWj8hEBcbxrH4dCYGUIQOMxoG0yaa.png" /><h1 class="mb-1">Under Maintenance 🛠</h1><p style="text-align: center;">Website sedang di perbaiki</p></div>',
            'contact_email' => 'cs@metavis.id',
            'contact_phone' => '62857456374344',
            'contact_address' => '123 Business Centre London SW1A 1AA',
        ]);
    }
}
