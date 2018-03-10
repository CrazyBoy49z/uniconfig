<div class="panel-heading">
  <h3 class="panel-title">Редактирование личных данных</h3>
</div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" id="office-profile-form" enctype="multipart/form-data">

    <div class="form-group avatar">
      <label class="col-sm-2 control-label">{'office_profile_avatar' | lexicon}</label>
      <div class="col-sm-10">
        <img src="{if $photo?}{$photo}{else}{$gravatar}?s=100{/if}" id="profile-user-photo"
             data-gravatar="{$gravatar}?s=100" width="100"/>
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
      <label class="col-sm-2 control-label">{'office_profile_fullname' | lexicon}<sup class="red">*</sup></label>
      <div class="col-sm-10">
        <input type="text" name="fullname" value="{$fullname}" placeholder="{'office_profile_fullname' | lexicon}" class="form-control"/>
        <p class="help-block message">{$error_fullname}</p>
        <p class="help-block desc">{'office_profile_fullname_desc' | lexicon}</p>
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