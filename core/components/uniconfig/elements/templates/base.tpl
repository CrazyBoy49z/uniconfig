<!doctype html>
{set $assets = ('assets_url' | config) ~ 'components/uniconfig/'}
<html lang="en">
    {include 'file:chunks/_head.tpl'}
  <body>
  {block 'aside'}
    {include 'file:chunks/_aside.tpl'}
  {/block}
    <section id="content" {if $.cookie.sidebar_sm}class="content-sm"{/if}>
      {block 'header'}
        {include 'file:chunks/_header.tpl'}
      {/block}
      {block 'content'}
         <div id="wrapper" class="container-fluid pjax-container">
         {$_modx->runSnippet('pdoCrumbs',[
          'tplWrapper' => '	@INLINE <ul class="breadcrumb" style="background: none;">{{+output}}</ul>',
          'hideSingle' => 1])}
            <h1 class="h3">{$_modx->resource.pagetitle}</h1>
            <p>{$_modx->resource.introtext}</p>
            {$_modx->resource.content}
            {if $_modx->hasSessionContext('mgr')}
            {set $info = $_modx->getInfo('', false)}
            Время работы: {$info.totalTime}<br/>
            Время запросов: {$info.totalTime}<br/>
            Количество запросов: {$info.queries}<br/>
            Источник: {$info.source}
            {/if}
         </div>
      {/block}
      <div id="igamov"><a href="http://igamov.ru" target="_blank"><img src="{$assets}img/igamov.svg" alt="igamov.ru"></a></div>
    </section>
  {include 'file:chunks/_site_js.tpl'}
  </body>
</html>