{var $assets = ('assets_url' | config) ~ 'components/uniconfig/'}
<aside id="sidebar" {if $.cookie.sidebar_sm}class="sidebar-sm"{/if}>
    {$.cookie|print}
    <a href="{$_modx->makeUrl('9')}" class="navbar-brand">
        <img src="{$assets ~ 'img/logo.png'}" class="logo hidden-xs hidden-sm" alt="">
        <img src="{$assets ~ 'img/logosm.png'}" class="logo-sm hidden-md hidden-lg" alt="">
    </a>
    <div class="sidebar-panel">
        <h5 class="sidebar-panel-title">Профиль пользователя</h5>
    </div>
    <div class="user-info">
        <img src="{$_modx->runSnippet('@FILE snippets/avatar.php')}" alt="Аватарка" class="img-circle thumb-md">
        <span class="username">{$_modx->runSnippet('@FILE snippets/initials.php')}</span>
    </div>
    <div class="sidebar-panel">
        <h5 class="sidebar-panel-title">Меню</h5>
    </div>
    <div class="sidebar-nav">
        {$_modx->runSnippet('!pdoMenu',[
        'checkPermissions' => 'list',
        'parents'          => 0,
        'level'            => 1,
        'outerClass'       => 'nav',
        'tpl'              => '@INLINE <li{$classes}><a href="{$link}" data-original-title="{$pagetitle}" data-toggle="tooltip" data-placement="right" {$attributes}>{$menutitle}</a>{$wrapper}</li>'
        ])}
    </div>
</aside>