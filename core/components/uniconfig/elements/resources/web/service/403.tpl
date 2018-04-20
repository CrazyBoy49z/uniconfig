{set $id = $_modx->resource.id}
{var $assets = ('assets_url' | config) ~ 'components/uniconfig/'}
<!DOCTYPE html>
<html lang="en">
{include 'file:chunks/_head.tpl'}
<body class="login-page">
<div class="container container-fluid text-center" style="color: #ffffff;">
  <h1>{$_modx->resource.pagetitle}</h1>
  <p>Вы запросили страницу, доступ к которой ограничен специальными правами.</p>
  <p><a href="javascript:history.back()" onMouseOver="window.status='Back';return true">Вернуться на предыдущую страницу</a></p>
  <p><a href="{$_modx->makeUrl('1')}">Перейти на главную страницу</a></p>
</div>
</body>
</html>