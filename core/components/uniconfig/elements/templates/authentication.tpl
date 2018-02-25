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
        </div>
        <div class="panel-body">
            {$_modx->resource.content}
        </div>
        {if $id == 2}
            <div class="panel-footer gray-lighter-bg bt">
                <h4 class="text-center">
                    <strong>Нет учетной записи?</strong>
                </h4>
                <p class="text-center">
                    <a href="{$_modx->makeUrl(3)}" class="btn btn-default">Создать учетную запись</a>
                </p>
            </div>
        {/if}
        {if $id == 3}
            <div class="panel-footer gray-lighter-bg bt">
                <h4 class="text-center">
                    <strong>Уже есть учетная запись?</strong>
                </h4>
                <p class="text-center">
                    <a href="{$_modx->makeUrl(2)}" class="btn btn-default">Войти</a>
                </p>
            </div>
        {/if}
        <!-- End .panel -->
    </div>
    <!-- End login container -->
</div>
{include 'file:chunks/_site_js.tpl'}
</body>
</html>