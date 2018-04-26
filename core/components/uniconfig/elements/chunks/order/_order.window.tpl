<div class="col-sm-12">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Заявка #{$id}</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table req table-condensed table-hover">
            <tbody>
            <tr>
              <td>Дата создания заявки:</td>
              <td>{$date | date_format : '%d.%m.%Y %H:%M'}</td>
            </tr>
            <tr>
              <td>Заявитель:</td>
              <td>{$profile.fullname}</td>
            </tr>
            <tr>
              <td>Email:</td>
              <td>{$profile.email}</td>
            </tr>
            <tr>
              <td>Телефон:</td>
              <td>{$profile.phone}</td>
            </tr>
            <tr>
              <td>Специализация</td>
              <td>{$specialization.name}</td>
            </tr>
            <tr style="word-break: break-all;">
              <td colspan="2">
                <p>Описание</p>
                <p>{$description}</p>
              </td>
            </tr>
            <tr>
              <td>Локация</td>
              <td>{$location.name}</td>
            </tr>
            <tr>
              <td>Статус</td>
              <td>{$status.name}</td>
            </tr>
            </tbody>
          </table>

          <!--<div class="col-sm-6 col-sm-offset-6">
              <a href="[[-~15]]?order=[[-+id]]" class="btn btn-primary pull-right">Редактировать заявку</a>
          </div>-->
        </div>
        <h4>Фото</h4>
        {set $files = json_decode($photo)}
        {foreach $files as $file}
          <div class="col-sm-4 col-md-4 col-lg-2">
            <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
              <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a href="{$file}" itemprop="contentUrl"
                   data-size="{$_modx->runSnippet('@FILE snippets/getImageSize.php',['img' => $file])}">
                  <img src="{$_modx->runSnippet('!phpThumbOn',['input' => $file, 'options' => 'w=200&h=160&zc=C'])}"
                       itemprop="thumbnail" alt=""/>
                </a>
              </figure>
            </div>
          </div>
        {/foreach}
      </div>
    </div>
  </div>
</div>
{$_modx->regClientHTMLBlock('
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="pswp__bg"></div>
  <div class="pswp__scroll-wrap">
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>
    <div class="pswp__ui pswp__ui--hidden">
      <div class="pswp__top-bar">
        <div class="pswp__counter"></div>
        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
        <button class="pswp__button pswp__button--share" title="Share"></button>
        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>
      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
      </button>
      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
      </button>
      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>
    </div>
  </div>
</div>')}