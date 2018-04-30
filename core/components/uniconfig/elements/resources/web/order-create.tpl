<div class="col-sm-12 col-lg-6" style="margin-left: auto; margin-right: auto; float: none;">
  <div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Создать заявку</h3></div>
    <div class="panel-body">
      <form class="uniform form-horizontal" action="" method="post">
        <input type="hidden" value="order/create" name="action"/>
        <fieldset>
          <div class="form-group">
            <div class="col-md-12">
              <select class="form-control" name="specialization" id="specialization">
                <option value="" selected disabled hidden>Выберите специализацию</option>
                {$_modx->runSnippet('!pdoResources',[
                'class' => 'uniSpecialization',
                'select' => '{"uniSpecialization":"id,name"}',
                'tpl' => '@INLINE <option value="{{+id}}" >{{+name}}</option>',
                'where' => '{"active": "1"}',
                'sortby' => 'name',
                'sortdir' => 'asc',
                'limit' => '0',
                ])}
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <textarea name="description" id="description" class="form-control" rows="5" placeholder="Описание"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <select id="location" name="location" class="form-control">
                <option value="" selected disabled hidden>Выберите локацию</option>
                {$_modx->runSnippet('!pdoResources',[
                'class' => 'uniLocation',
                'select' => '{"uniLocation":"id,name"}',
                'tpl' => '@INLINE <option value="{{+id}}" >{{+name}}</option>',
                'where' => '{"active": "1"}',
                'sortby' => 'name',
                'sortdir' => 'asc',
                'limit' => '0',
                ])}
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="uploader" data-name="file"><div class="dz-message">Прикрепить изображения (макс - 4 шт.)</div></div>
            </div>
          </div>
          <div id="files"></div>
          <div class="form-group">
            <div class="col-lg-12">
              <button type="submit" class="btn btn-primary">Создать заявку</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>