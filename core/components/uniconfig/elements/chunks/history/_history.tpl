{set $fullname = $_modx->runSnippet('pdoUsers', ['users'=> $user_id, 'tpl' => '@INLINE {$fullname}'])}
<p style="border-bottom: dotted 1px #c0c0c0;">Обновлено {$fullname} {$date | dateago}</p>
<ul>
  {foreach $message as $mes}
    <li>{$mes}</li>
  {/foreach}
</ul>