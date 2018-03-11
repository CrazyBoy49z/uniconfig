{set $arrfullname = $fullname | split : ' '}
<div class="panel-heading">
  <h3 class="panel-title">Редактирование личных данных</h3>
</div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" id="office-profile-form" enctype="multipart/form-data">
    <div class="form-group avatar">
      <label class="col-sm-2 control-label">{'office_profile_avatar' | lexicon}</label>
      <div class="col-sm-10">
        <img src="{$_modx->runSnippet('!avatar',['no_pic' => 'https://uni.igamov.ru/assets/tpl/img/nopic.png'])}" id="profile-user-photo" width="100"/>
        <a href="#" id="office-user-photo-remove"{if !$photo} style="display:none;"{/if}>
          {'office_profile_avatar_remove' | lexicon}
          <i class="glyphicon glyphicon-remove"></i>
        </a>
        <p class="help-block">{'office_profile_avatar_desc' | lexicon}</p>
        <input type="hidden" name="photo" value="{$photo}"/>
        <input type="file" name="newphoto" id="profile-photo"/>
      </div>
    </div>



    <div class="form-group">
      <label class="col-sm-2 control-label">Фамилия<sup class="red">*</sup></label>
      <div class="col-sm-10">
        <input type="text" name="surname" value="{$arrfullname['0']}" placeholder="Фамилия *" class="form-control"/>
        <p class="help-block message">{$error_fullname}</p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Имя<sup class="red">*</sup></label>
      <div class="col-sm-10">
        <input type="text" name="name" value="{$arrfullname['1']}" placeholder="Имя *" class="form-control"/>
        <p class="help-block message">{$error_fullname}</p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Отчество</label>
      <div class="col-sm-10">
        <input type="text" name="patronymic" value="{$arrfullname['2']}" placeholder="Отчество" class="form-control"/>
        <p class="help-block message">{$error_fullname}</p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">
        Телефон<sup class="red">*</sup>
      </label>
      <div class="col-md-10">
        <input type="text" name="phone" placeholder="Телефон *" value="{$phone}" class="form-control"/>
        <p class="help-block message">{$error_phone}</p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">{'office_profile_password' | lexicon}</label>
      <div class="col-sm-10">
        <input type="password" name="specifiedpassword" value="" placeholder="********" class="form-control"/>
        <p class="help-block message">{$error_specifiedpassword}</p>
        <p class="help-block desc">{'office_profile_specifiedpassword_desc' | lexicon}</p>
        <input type="password" name="confirmpassword" value="" placeholder="********" class="form-control"/>
        <p class="help-block message">{$error_confirmpassword}</p>
        <p class="help-block desc">{'office_profile_confirmpassword_desc' | lexicon}</p>
      </div>
    </div>

    <hr/>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">{'office_profile_save' | lexicon}</button>
      </div>
    </div>
  </form>
</div>