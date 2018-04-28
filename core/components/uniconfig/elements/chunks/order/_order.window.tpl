<div class="col-sm-12">
  <div class="row">
    <ul id="tab" class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#order">Содержимое заявки</a></li>
      <li><a data-toggle="tab" href="#order-messages">Сообщения</a></li>
      {if !$_modx->isMember('Users')}
      <li><a data-toggle="tab" href="#order-comments">Комментарии</a></li>
      {/if}
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="order">
        <div class="panel panel-default ident">
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
                {if $executor}
                <tr>
                  <td>Исполнитель</td>
                  <td>{$executor.fullname}</td>
                </tr>
                {/if}
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
            {set $files = json_decode($photo)}
            {if $files}
              <h4>Фото</h4>
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
            {/if}
            <hr>
            {if $_modx->isMember('Executors')}
              {if $status.id == 1}
                <form action="" method="post" class="uniform">
                  <input type="hidden" name="status_id" value="2">
                  <input type="hidden" name="id" value="{$id}"/>
                  <input type="hidden" name="executor" value="{$_modx->user.id}">
                  <input type="hidden" name="action" value="order/update">
                  <button type="submit" class="btn btn-primary">Принять заявку</button>
                </form>
              {/if}
            {/if}
          </div>
        </div>
        <div class="col-sm-12">
          <div class="row">
            <div class="panel panel-default ident">
              <div class="panel-heading">
                <h3 class="panel-title">История заявки</h3>
              </div>
              <div class="panel-body">
                {foreach $histories as $history}
                  {set $fullname = $_modx->runSnippet('pdoUsers', ['users'=> $history.user_id, 'tpl' => '@INLINE {$fullname}'])}
                  <p style="border-bottom: dotted 1px #c0c0c0;">Обновлено {$fullname} {$history.date | dateago}</p>
                  {set $messages = json_decode($history.message)}
                  <ul>
                    {foreach $messages as $message}
                      <li>{$message}</li>
                    {/foreach}
                  </ul>
                {/foreach}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="order-messages">
        <div class="col-sm-12">
          <div class="row">
            <div class="panel panel-default ident">
              <div class="panel-heading">
                <h3 class="panel-title">Сообщения</h3>
              </div>
              <div class="panel-body">
                <div class="col-sm-12">
                  <div class="row">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {if !$_modx->isMember('Users')}
      <div class="tab-pane" id="order-comments" >
        <div class="col-sm-12">
          <div class="row">
            <div class="panel panel-default ident">
              <div class="panel-heading">
                <h3 class="panel-title">Комментарии</h3>
              </div>
              <div class="panel-body">
                <div class="col-sm-12">
                  <div class="row">
                    <div id="comments">
                      {$_modx->runSnippet('@FILE snippets/comment.php', ['order_id' => $id, 'tpl' => '@FILE chunks/comments/_comment.tpl'])}
                    </div>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="row">
                    <form class="uniformcomment form-horizontal" action="" method="post">
                      <input type="hidden" value="comment/create" name="action"/>
                      <input type="hidden" value="{$id}" name="order_id"/>
                      <fieldset>
                        <div class="hidden-xs col-sm-1">
                          <div class="row">
                            <div class="comment-avatar">
                              <img src="{$_modx->runSnippet('@FILE snippets/avatar.php')}" alt="Аватарка"
                                   class="img-circle thumb-md">
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-11">
                          <div class="form-group">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Написать комментарий"
                                  style="resize: none;"></textarea>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                          <div class="row">
                            <button type="submit" class="btn btn-default pull-right">
                              <i class="fa fa-paper-plane"></i> написать
                            </button>
                          </div>
                        </div>
                      </fieldset>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {/if}
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
</div>

')}