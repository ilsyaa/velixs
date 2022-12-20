<link rel="icon" href="{!! $websetting->meta_favicon() !!}">
<link rel="apple-touch-icon" href="{!! $websetting->meta_favicon() !!}">
<link rel="image_src" href="{!! $websetting->meta_favicon() !!}">
<link rel="canonical" href="{!! isset($meta['meta_url']) ? $meta['meta_url'] : url()->full() !!}" />
<meta name="robots" content="{!! isset($meta['meta_robots']) ? $meta['meta_robots'] : 'index, follow' !!}">

<!-- Primary Meta Tags -->
<title>{!! isset($meta['meta_title']) ? str_replace('%title%', $websetting->app_title, $meta['meta_title']) : $websetting->meta_title !!}</title>
<meta name="title" content="{!! isset($meta['meta_title']) ? str_replace('%title%', $websetting->app_title, $meta['meta_title']) : $websetting->meta_title !!}">
<meta name="description" content="{!! isset($meta['meta_description']) ? $meta['meta_description'] : $websetting->meta_description !!}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{!! isset($meta['meta_type']) ? $meta['meta_type'] : 'website' !!}">
<meta property="og:url" content="{!! isset($meta['meta_url']) ? $meta['meta_url'] : url()->full() !!}">
<meta property="og:title" content="{!! isset($meta['meta_title']) ? str_replace('%title%', $websetting->app_title, $meta['meta_title']) : $websetting->meta_title !!}">
<meta property="og:description" content="{!! isset($meta['meta_description']) ? $meta['meta_description'] : $websetting->meta_description !!}">
<meta property="og:image" content="{!! isset($meta['meta_image']) ? $meta['meta_image'] : $websetting->meta_thumbnail() !!}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="627">
@if (isset($meta['meta_type']))
    @if ($meta['meta_type'] == 'product')
        <meta name="product:availability" content="instock">
        <meta name="product:price:currency" content="{!! isset($meta['meta_currency']) ? $meta['meta_currency'] : 'USD' !!}">
        <meta name="product:price:amount" content="{!! isset($meta['meta_amount']) ? $meta['meta_amount'] : '0' !!}">
        <meta name="product:brand" content="{!! isset($meta['meta_brand']) ? $meta['meta_brand'] : 'Unknown' !!}">
    @endif
@endif
<link rel="alternate" hreflang="id" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="en" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="es" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="ru" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="de" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="pl" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="it" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="tr" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="fr" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="pt" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="nl" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="zh" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="cs" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="uk" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="hu" href="{!! url()->full() !!}">
<link rel="alternate" hreflang="sv" href="{!! url()->full() !!}">
<meta property="og:locale:alternate" content="id_ID">
<meta property="og:locale:alternate" content="en_US">
<meta property="og:locale:alternate" content="es_ES">
<meta property="og:locale:alternate" content="ru_RU">
<meta property="og:locale:alternate" content="de_DE">
<meta property="og:locale:alternate" content="pl_PL">
<meta property="og:locale:alternate" content="it_IT">
<meta property="og:locale:alternate" content="tr_TR">
<meta property="og:locale:alternate" content="fr_FR">
<meta property="og:locale:alternate" content="pt_BR">
<meta property="og:locale:alternate" content="nl_NL">
<meta property="og:locale:alternate" content="zh_CN">
<meta property="og:locale:alternate" content="cs_CZ">
<meta property="og:locale:alternate" content="uk_UA">
<meta property="og:locale:alternate" content="hu_HU">
<meta property="og:locale:alternate" content="sv_SE">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{!! isset($meta['meta_url']) ? $meta['meta_url'] : url()->full() !!}">
<meta property="twitter:title" content="{!! isset($meta['meta_title']) ? str_replace('%title%', $websetting->app_title, $meta['meta_title']) : $websetting->meta_title !!}">
<meta property="twitter:description" content="{!! isset($meta['meta_description']) ? $meta['meta_description'] : $websetting->meta_description !!}">
<meta property="twitter:image" content="{!! isset($meta['meta_image']) ? $meta['meta_image'] : $websetting->meta_thumbnail() !!}">
