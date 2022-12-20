<div>
    <div class="mb-3">
        <h6 class="text-muted">{{ $product->name }}</h6>
        <small class="text-muted">Choose a payment method available below. If you want to make a manual payment, you can choose WhatsApp.</small>
    </div>
    <hr class="text-muted">
    @if ($webmaster->payment_whatsapp)
        <a href="{{ $webmaster->whatsapp_link($product) }}" class="btn-payment btn btn-success w-100 mb-3" style="font-family: 'Noto Sans', sans-serif; font-width: 500px"><i class="bi bi-whatsapp"></i> Whatsapp</a>
    @endif
    @if ($webmaster->paypal_status == 'active')
        <form action="{{ route('front.payment.paypal.process') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $product->id }}" name="product_id">
            <button type="submit" class="btn-payment btn btn-warning w-100 mb-3" style="font-family: 'Noto Sans', sans-serif; font-width: 600px"><img style="height: 20px" src="{!! asset('frontend/landing/svg/paypal.svg') !!}" alt=""></button>
        </form>
    @endif
    <button disabled class="btn-payment btn btn-light w-100 mb-3" style="font-family: 'Noto Sans', sans-serif; font-width: 600px"><img style="height: 20px" src="{!! asset('frontend/landing/svg/dana.svg') !!}" alt=""></button>
</div>
