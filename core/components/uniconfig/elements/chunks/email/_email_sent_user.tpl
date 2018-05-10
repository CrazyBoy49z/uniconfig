{set $style = [
'logo' => 'display:block;margin: auto;',
'a' => 'color:#348eda;',
'p' => 'font-family: Arial;color: #666666;font-size: 16px;',
'h' => 'font-family:Arial;color: #111111;font-weight: 200;line-height: 1.2em;margin: 40px 20px;',
'h1' => 'font-size: 36px;',
'h2' => 'font-size: 28px;',
'h3' => 'font-size: 22px;',
'th' => 'font-family: Arial;text-align: left;color: #111111;',
'td' => 'font-family: Arial;text-align: left;color: #111111;',
]}
{var $site_url = ('site_url' | option) | preg_replace : '#/$#' : ''}
{switch $order.status}
{case 1}
  {* Если статус новая *}
  <p style="{$style.h}{$style.p}">Ваша Заявка #{$order.id} успешно отправлена на работу.</p>
  <h2 style="{$style.h}{$style.h2}">Содержимое заявки</h2>
{$_modx->runSnippet('@FILE snippets/orderWindow.php',[
'order_id' => $order.id,
'tpl' => '@INLINE
{set $th = "font-family: Arial;text-align: left;color: #111111;border-top: 1px solid #ddd;"}
<table style="width:90%;margin:auto;">
  <tbody>
    <tr>
      <td style="{$th}">Дата создания заявки:</td>
      <td style="{$th}">{$date | date_format : "%d.%m.%Y %H:%M"}</td>
    </tr>
    <tr>
      <td style="{$th}">Заявитель:</td>
      <td style="{$th}">{$profile.fullname}</td>
    </tr>
    <tr>
      <td style="{$th}">Email:</td>
      <td style="{$th}">{$profile.email}</td>
    </tr>
    <tr>
      <td style="{$th}">Телефон:</td>
      <td style="{$th}">{$profile.phone}</td>
    </tr>
    <tr>
      <td style="{$th}">Специализация</td>
      <td style="{$th}">{$specialization.name}</td>
    </tr>
      <tr>
      <td style="{$th}" colspan="2">
        <p>Описание</p>
        <p>{$description}</p>
      </td>
    </tr>
    <tr>
      <td style="{$th}">Локация</td>
      <td style="{$th}">{$location.name}</td>
    </tr>
    <tr>
      <td style="{$th}">Статус</td>
      <td style="{$th}">{$status.name}</td>
    </tr>
  </tbody>
</table>
',
])}
{case 2}
  {* Если статус Выполнение *}
{set $executor = $_modx->runSnippet('pdoUsers',[
'users' => $order.executor,
'tpl'=> '@INLINE {$fullname}'
])}
  <p style="{$style.h}{$style.p}">Заявку #{$order.id} выполняет <b>{$executor}</b></p>
{case 3}
  {* Если статус Проверка *}
  <p style="{$style.h}{$style.p}">Заявка #{$order.id} ожидает проверки. Посмотреть заявку можно по <a href="{$site_url}/order-window/{$order.id}">ссылке</a>  </p>
{case 4}
    {* Если статус Закрыто *}
  <p style="{$style.h}{$style.p}">Заявка #{$order.id} закрыта.</p>
{case 5}
    {* Если статус Отложена *}
  <p style="{$style.h}{$style.p}">Заявка #{$order.id} отложена. Посмотреть заявку можно по <a href="{$site_url}/order-window/{$order.id}">ссылке</a>  </p>
{case 6}
  {* Если статус Согласование *}
  <p style="{$style.h}{$style.p}">Заявка #{$order.id} на согласовании.  </p>
{/switch}