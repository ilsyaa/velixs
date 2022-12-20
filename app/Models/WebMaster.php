<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebMaster extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function whatsapp_link($product)
    {
        $text1 = [
            '{%product%}',
            '{%price_idr%}',
            '{%price_usd%}',
            '{%url%}'
        ];

        $text2 = [
            $product->name,
            number_format($product->price_idr, 0, ',', '.'),
            $product->price_usd,
            route('front.product.detail', $product->slug),
        ];
        $message = str_replace($text1, $text2, $this->payment_whatsapp_message);
        return 'https://api.whatsapp.com/send?phone=' . $this->payment_whatsapp . '&text=' . urlencode($message);
    }

    public function whatsapp_integration($token)
    {
        return 'https://api.whatsapp.com/send?phone=' . $this->whatsapp_bot . '&text=' . urlencode("/verify $token");
    }
    public function whatsapp_unverify()
    {
        return 'https://api.whatsapp.com/send?phone=' . $this->whatsapp_bot . '&text=' . urlencode("/unverify yourpassword");
    }
}
