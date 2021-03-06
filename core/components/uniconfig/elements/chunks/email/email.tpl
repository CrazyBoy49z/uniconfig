{var $style = [
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
{var $assets_url = 'assets_url' | option}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{'site_name' | option}</title>
</head>
<body style="margin:0;padding:0;background:#f6f6f6;">
<div style="height:100%;padding-top:20px;background:#f6f6f6;">
  {block 'logo'}
    <a href="{$site_url}">
      <img style="{$style.logo}"
           src="{$site_url}{$assets_url}components/uniconfig/img/logo-dark.png"
           alt="{$site_url}"
           width="180" height="50"/>
    </a>
  {/block}
  <!-- body -->
  <table class="body-wrap" style="padding:0 20px 20px 20px;width: 100%;background:#f6f6f6;margin-top:10px;">
    <tr>
      <td></td>
      <td class="container" style="border:1px solid #f0f0f0;background:#ffffff;width:800px;margin:auto;">
        <div class="content">
          <table style="width:100%;">
            <tr>
              <td>
                <h3 style="{$style.h}{$style.h3}">
                  {block 'title'}
                    Статус заявки был изменен
                  {/block}
                </h3>
                {block 'body'}
                  {$body}
                {/block}
              </td>
            </tr>
          </table>
        </div>
        <!-- /content -->
      </td>
      <td></td>
    </tr>
  </table>
  <!-- /body -->
  <!-- footer -->
  <table style="clear:both !important;width: 100%;">
    <tr>
      <td></td>
      <td class="container">
        <!-- content -->
        <div class="content">
          <table style="width:100%;text-align: center;">
            <tr>
              <td align="center">
                <p style="{$style.p}">
                  {block 'footer'}
                    <a href="{$site_url}" style="color: #999999;">
                      {'site_name' | option}
                    </a>
                  {/block}
                </p>
              </td>
            </tr>
          </table>
        </div>
        <!-- /content -->
      </td>
      <td></td>
    </tr>
  </table>
  <!-- /footer -->
</div>
</body>
</html>