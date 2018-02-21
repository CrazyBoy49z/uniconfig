<!doctype html>
<html lang="en">
  <head>
      {include 'file:chunks/_head.tpl'}
  </head>
  <body>
  {block 'aside'}
    {include 'file:chunks/_aside.tpl'}
  {/block}
    <section id="content" {$.cookie.sidebar_sm == 'true' ? 'class="content-sm"' : ''}>
      {block 'header'}
        {include 'file:chunks/_header.tpl'}
      {/block}
      {block 'content'}
         <div id="wrapper" class="container-fluid pjax-container">
         {$_modx->runSnippet('pdoCrumbs',[
          'tplWrapper' => '	@INLINE <ul class="breadcrumb" style="background: none;">{{+output}}</ul>',
          'hideSingle' => 1])}
            <h1 class="h3">{$pagetitle}</h1>
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
    </section>
  {include 'file:chunks/_site_js.tpl'}
  </body>
</html>