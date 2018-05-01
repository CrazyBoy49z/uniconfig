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
                  <td><b>Дата создания заявки</b></td>
                  <td>{$date | date_format : '%d.%m.%Y %H:%M'}</td>
                </tr>
                <tr>
                  <td><b>Заявитель</b></td>
                  <td>{$profile.fullname}</td>
                </tr>
                <tr>
                  <td><b>Email</b></td>
                  <td>{$profile.email}</td>
                </tr>
                <tr>
                  <td><b>Телефон</b></td>
                  <td>{$profile.phone}</td>
                </tr>
                <tr>
                  <td><b>Специализация</b></td>
                  <td>{$specialization.name}</td>
                </tr>
                {if $executor}
                  <tr>
                    <td><b>Исполнитель</b></td>
                    <td>{$executor.fullname}</td>
                  </tr>
                {/if}
                <tr style="word-break: break-all;">
                  <td colspan="2">
                    <p><b>Описание</b></p>
                    <p>{$description}</p>
                  </td>
                </tr>
                <tr>
                  <td><b>Локация</b></td>
                  <td>{$location.name}</td>
                </tr>
                <tr>
                  <td><b>Статус</b></td>
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
            {if $_modx->isMember('Users')}
              {if $status.id == 3}
                <div id="ex_forms">
                  <div style="display: inline-block;">
                    <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#modification">
                      На доработку
                    </button>
                  </div>
                  <div style="display: inline-block;">
                    <form action="" method="post" class="uniform">
                      <input type="hidden" name="status_id" value="4">
                      <input type="hidden" name="id" value="{$id}"/>
                      <input type="hidden" name="action" value="order/update">
                      <button type="submit" class="btn btn-danger">Закрыть</button>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                  <div id="modification" class="collapse" style="padding: 40px 0">
                    <div class="col-sm-4">
                      <div class="row">
                        <h4>Отправить заявку на доработку</h4>
                      </div>
                      <form action="" method="post" class="uniform form-horizontal">
                        <input type="hidden" name="status_id" value="1">
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="hidden" name="action" value="order/update">
                        <div class="form-group">
                          <div class="uploader" data-name="file">
                            <div class="dz-message">Прикрепить изображения (макс - 4 шт.)</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <textarea name="message" class="form-control" rows="5"
                                    placeholder="Сообщение"></textarea>
                        </div>
                        <div id="files"></div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              {/if}
            {/if}
            {if $_modx->isMember('Executors')}
              <hr>
              {switch $status.id}
              {case 1}
                <form action="" method="post" class="uniform">
                  <input type="hidden" name="status_id" value="2">
                  <input type="hidden" name="id" value="{$id}"/>
                  <input type="hidden" name="executor" value="{$_modx->user.id}">
                  <input type="hidden" name="action" value="order/update">
                  <button type="submit" class="btn btn-primary">Принять заявку</button>
                </form>
              {case 2}
                <div id="ex_forms">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#review">
                      Отправить на проверку
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#specialization">
                      Изменить специализацию
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#defer">
                      Отложить
                    </button>
                    <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#agreement">
                      На согласование
                    </button>
                  </div>
                  <div id="review" class="collapse" data-parent="#ex_forms" style="padding: 40px 0">
                    <div class="col-sm-4">
                      <div class="row">
                        <h4>Отправить на проверку</h4>
                      </div>
                      <form action="" method="post" class="uniform form-horizontal">
                        <input type="hidden" name="status_id" value="3">
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="hidden" name="action" value="order/update">
                        <div class="form-group">
                          <div class="uploader" data-name="file">
                            <div class="dz-message">Прикрепить изображения (макс - 4 шт.)</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <textarea name="message" class="form-control" rows="5"
                                    placeholder="Сообщение"></textarea>
                        </div>
                        <div id="files"></div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div id="specialization" class="collapse" data-parent="#ex_forms" style="padding: 40px 0">
                    <div class="col-sm-4">
                      <div class="row">
                        <h4>Изменить специализацию</h4>
                      </div>
                      <form action="" method="post" class="uniform form-horizontal">
                        <input type="hidden" name="status_id" value="1">
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="hidden" name="action" value="order/update">
                        <div class="form-group">
                          <select class="form-control" name="specialization">
                            <option value="" selected disabled hidden>Выберите специализацию</option>
                            {$_modx->runSnippet('!pdoResources',[
                            'class' => 'uniSpecialization',
                            'select' => '{"uniSpecialization":"id,name"}',
                            'tpl' => '@INLINE <option value="{$id}">{$name}</option>',
                            'where' => ["active" => 1,"id:!=" => $specialization.id],
                            'sortby' => 'name',
                            'sortdir' => 'asc',
                            'limit' => '0',
                            ])}
                          </select>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div id="defer" class="collapse" data-parent="#ex_forms" style="padding: 40px 0">
                    <div class="col-sm-4">
                      <div class="row">
                        <h4>Отложить заявку</h4>
                      </div>
                      <form action="" method="post" class="uniform form-horizontal">
                        <input type="hidden" name="status_id" value="5">
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="hidden" name="action" value="order/update">
                        <div class="form-group">
                          <textarea name="message" class="form-control" rows="5"
                                    placeholder="Сообщение"></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div id="agreement" class="collapse" data-parent="#ex_forms" style="padding: 40px 0">
                    <div class="col-sm-4">
                      <div class="row">
                        <h4>Отправить на согласование</h4>
                      </div>
                      <form action="" method="post" class="uniform form-horizontal">
                        <input type="hidden" name="status_id" value="6">
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="hidden" name="action" value="order/update">
                        <div class="form-group">
                          <textarea name="message" class="form-control" rows="5"
                                    placeholder="Сообщение"></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              {/switch}
            {/if}
            {if $_modx->isMember('ManagerExecutor') || $_modx->isMember('ManagerLocation')}
              <hr>
              {if $_modx->isMember('ManagerExecutor')}
                {set $fields = $_modx->runSnippet('@FILE snippets/worker_fields.php', ['user_id' => $_modx->user.id, 'class' => 'uniManagerExecutor'])}
                {set $where = ['uniExecutor.specialization' => $fields['specialization']]}
              {/if}
              {if $_modx->isMember('ManagerLocation')}
                {set $fields = $_modx->runSnippet('@FILE snippets/worker_fields.php', ['user_id' => $_modx->user.id, 'class' => 'uniManagerLocation'])}
                {set $where = ['uniExecutor.location' => $fields['location']]}
              {/if}
              {switch $status.id}
              {case 1}
                <div class="col-sm-4">
                  <div class="row">
                    <h4>Распределить</h4>
                  </div>
                  <form action="" method="post" class="uniform">
                    <input type="hidden" name="status_id" value="2">
                    <input type="hidden" name="id" value="{$id}"/>
                    <input type="hidden" name="action" value="order/update">
                    <div class="form-group">
                      <select class="form-control" name="executor">
                        <option value="" selected disabled hidden>Выберите исполнителя</option>
                        {$_modx->runSnippet('!pdoUsers',[
                        'groups' => 'Executors',
                        'select' => ["modUser" => '*', "uniExecutor" => '*'],
                        'leftJoin' => ["uniExecutor" => ['class'=> 'uniExecutor', 'on' => 'uniExecutor.user = modUser.id']],
                        'tpl' => '@INLINE <option value="{$user}" >{$fullname}</option>',
                        'where' => $where,
                        'sortby' => 'fullname',
                        'sortdir' => 'asc',
                        'limit' => '0',
                        ])}
                      </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                    </div>
                  </form>
                </div>
              {case 5}
                <div class="col-sm-4">
                  <div class="row">
                    <h4>Назначить</h4>
                  </div>
                  <form action="" method="post" class="uniform">
                    <input type="hidden" name="status_id" value="2">
                    <input type="hidden" name="id" value="{$id}"/>
                    <input type="hidden" name="action" value="order/update">
                    <div class="form-group">
                      <select class="form-control" name="executor">
                        <option value="" selected disabled hidden>Выберите исполнителя</option>
                        {$_modx->runSnippet('!pdoUsers',[
                        'groups' => 'Executors',
                        'select' => ["modUser" => '*', "uniExecutor" => '*'],
                        'leftJoin' => ["uniExecutor" => ['class'=> 'uniExecutor', 'on' => 'uniExecutor.user = modUser.id']],
                        'tpl' => '@INLINE <option value="{$user}" >{$fullname}</option>',
                        'where' => $where,
                        'sortby' => 'fullname',
                        'sortdir' => 'asc',
                        'limit' => '0',
                        ])}
                      </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                    </div>
                  </form>
                </div>
              {/switch}
            {/if}
            {if $_modx->isMember('Dispatchers')}
              {if $status.id == 6}
                <hr>
                <div id="ex_forms">
                  <div style="display: inline-block;">
                    <form action="" method="post" class="uniform">
                      <input type="hidden" name="status_id" value="1">
                      <input type="hidden" name="id" value="{$id}"/>
                      <input type="hidden" name="action" value="order/update">
                      <button type="submit" class="btn btn-primary">Отправить на исполнение</button>
                    </form>
                  </div>
                  <div style="display: inline-block;">
                    <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#review">
                      Заявителю на проверку
                    </button>
                  </div>
                  <div class="pull-right">
                    <form action="" method="post" class="uniform">
                      <input type="hidden" name="status_id" value="4">
                      <input type="hidden" name="id" value="{$id}"/>
                      <input type="hidden" name="action" value="order/update">
                      <button type="submit" class="btn btn-danger">Закрыть</button>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                  <div id="review" class="collapse" style="padding: 40px 0">
                    <div class="col-sm-4">
                      <div class="row">
                        <h4>Отправить Заявителю на проверку</h4>
                      </div>
                      <form action="" method="post" class="uniform form-horizontal">
                        <input type="hidden" name="status_id" value="3">
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="hidden" name="action" value="order/update">
                        <div class="form-group">
                          <div class="uploader" data-name="file">
                            <div class="dz-message">Прикрепить изображения (макс - 4 шт.)</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <textarea name="message" class="form-control" rows="5"
                                    placeholder="Сообщение"></textarea>
                        </div>
                        <div id="files"></div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              {/if}
            {/if}
          </div>
        </div>
        <div class="panel panel-default ident">
          <div class="panel-heading">
            <h3 class="panel-title">История заявки</h3>
          </div>
          <div class="panel-body">
            {$_modx->runSnippet('pdoResources',[
            'class' => 'uniOrderHistory',
            'where' => ['order_id' => $id],
            'sortby' => 'date',
            'sortdir' => 'ASC',
            'tpl' => '@FILE chunks/history/_history.tpl'
            ])}
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
                    {$_modx->runSnippet('@FILE snippets/message.php', ['order_id' => $id, 'tpl' => '@FILE chunks/messages/_message.tpl'])}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {if !$_modx->isMember('Users')}
        <div class="tab-pane" id="order-comments">
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
                          <div class="col-xs-12 col-sm-10">
                            <div class="form-group">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Комментарий"
                                  style="resize: none;"></textarea>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-sm-11">
                            <div class="row">
                              <button type="submit" class="btn btn-default pull-right">
                                <i class="fa fa-paper-plane"></i> отправить
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