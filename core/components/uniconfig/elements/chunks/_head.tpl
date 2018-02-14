{var $assets = ('assets_url' | config) ~ 'components/uniconfig/'}
<head>
    <title>{$_modx->resource.longtitle}</title>
    <meta charset="UTF-8">
    <base href="{$_modx->config.site_url}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    {('<meta name="csrf-token" content="' ~ $.session['csrf-token'] ~ '">') | htmlToHead}
    {('<meta name="assets-version" content="' ~ $.assets_version ~ '">') | htmlToHead}
    {($assets ~ 'css/web/main.css?v=' ~ $.assets_version) | cssToHead}
</head>