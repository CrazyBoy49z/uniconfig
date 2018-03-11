{set $id = $_modx->resource.id}
{var $assets = ('assets_url' | config) ~ 'components/uniconfig/'}
<!DOCTYPE html>
<html lang="en">
{include 'file:chunks/_head.tpl'}
<body class="login-page">
<!-- Start login container -->
<div class="container login-container">
    <div class="login-panel panel panel-default plain">
        <!-- Start .panel -->
        <div class="panel-heading">
            <h4 class="panel-title text-center">
                <a href="/"><img id="logo" src="{$assets ~ 'img/logo.png'}" alt="Унисервис logo"></a>
            </h4>
            <h4 class="text-center">{$_modx->resource.pagetitle}</h4>
            {if $id == 8}
                <p class="text-center">
                    <small>Введите email, который вы использовали при регистрации.</small>
                </p>
            {/if}
        </div>
        <div class="panel-body">
            {$_modx->resource.content}
        </div>
        <!-- End .panel -->
    </div>
    <!-- End login container -->
</div>
{include 'file:chunks/_site_js.tpl'}
</body>
</html>