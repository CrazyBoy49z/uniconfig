{var $assets = ('assets_url' | config) ~ 'components/uniconfig/'}
<aside id="sidebar" {$.cookie.sidebar_sm == 'true' ? 'class="sidebar-sm"' : ''}>
    <a href="{$_modx->makeUrl('1')}" class="navbar-brand">
        <img src="{$assets ~ 'img/logo.png'}" class="logo hidden-xs hidden-sm" alt="">
        <img src="{$assets ~ 'img/logosm.png'}" class="logo-sm hidden-md hidden-lg" alt="">
    </a>
    <div class="sidebar-panel">
        <h5 class="sidebar-panel-title">Профиль пользователя</h5>
    </div>
    <div class="user-info">
        <img src=""{$assets ~ 'img/nopic.png'}" alt="" class="img-circle thumb-md">
        <span class="username">{$_modx->runSnippet('!initials',['fullname' => $_modx->user.fullname])}
			</span>
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
        'includeTVs'       => 'menu_icon',
        'tpl'              => '@INLINE <li{{+classes}}><a href="{{+link}}" title="{{+menutitle}}" {{+attributes}}><i class="{{+menu_icon}}"></i> <span>{{+menutitle}}</span></a>{{+wrapper}}</li>'
        ])}
    </div>
</aside>