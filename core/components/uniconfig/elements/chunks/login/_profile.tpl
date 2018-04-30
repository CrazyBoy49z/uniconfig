{set $arrfullname = $fullname | split : ' '}
<div class="panel-heading">
  <h3 class="panel-title">Редактирование личных данных</h3>
</div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" id="office-profile-form" enctype="multipart/form-data">
    <div class="avatar">
      <div class="pull-left" style="margin-right: 20px;">
        <img src="{$_modx->runSnippet('@FILE snippets/avatar.php')}" id="profile-user-photo" class="img-circle"
             width="100"/>
      </div>
      <div class="pull-left">
        <h4>{$fullname}</h4>
        <input type="hidden" name="photo" value="{$photo}"/>
        <input type="file" name="newphoto" id="profile-photo"/>
        <a href="#" id="office-user-photo-remove"{if !$photo} style="display:none;"{/if}>
          {'office_profile_avatar_remove' | lexicon}
          <i class="fa fa-remove"></i>
        </a>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-sm-6">
      <div>
        <label class="control-label">Фамилия<sup class="red">*</sup></label>
        <input type="text" name="surname" value="{$arrfullname['0']}" placeholder="Фамилия *" class="form-control"/>
      </div>

      <div>
        <label class="control-label">Отчество</label>
        <input type="text" name="patronymic" value="{$arrfullname['2']}" placeholder="Отчество" class="form-control"/>
      </div>

      <div>
        <label class="control-label">{'office_profile_password' | lexicon}</label>
        <input type="password" name="specifiedpassword" value="" placeholder="********" class="form-control"/>
        <p class="help-block message">{$error_specifiedpassword}</p>
        <p class="help-block desc">{'office_profile_specifiedpassword_desc' | lexicon}</p>
      </div>
    </div>
    <div class="col-sm-6">
      <div>
        <label class="control-label">Имя<sup class="red">*</sup></label>
        <input type="text" name="name" value="{$arrfullname['1']}" placeholder="Имя *" class="form-control"/>
      </div>

      <div>
        <label class="control-label">Телефон<sup class="red">*</sup></label>
        <input type="text" name="phone" placeholder="Телефон *" value="{$phone}" class="form-control"/>
      </div>

      <div>
        <label class="control-label">Подтвердите пароль</label>
        <input type="password" name="confirmpassword" value="" placeholder="********" class="form-control"/>
        <p class="help-block message">{$error_confirmpassword}</p>
        <p class="help-block desc">{'office_profile_confirmpassword_desc' | lexicon}</p>
      </div>

      <div class="pull-right">
        <button type="submit" class="btn btn-primary">{'office_profile_save' | lexicon}</button>
      </div>
    </div>
  </form>
</div>