<div class="loginForm" id="office-auth-form">
  <form id="office-auth-register" class="login-form form-horizontal mt0" method="post">
    <input type="hidden" name="action" value="auth/formRegister"/>
    <input type="hidden" name="return" value=""/>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-user-circle"></i>
          </span>
          <input type="text" name="surname" id="surname" class="form-control" value="" placeholder="Фамилия *">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-user-circle"></i>
          </span>
          <input type="text" name="name" id="name" class="form-control" value="" placeholder="Имя *">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-user-circle"></i>
          </span>
          <input type="text" name="patronymic" id="patronymic" class="form-control" value="" placeholder="Отчество">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-phone"></i>
          </span>
          <input type="text" name="phone" id="phone" class="form-control" value="" placeholder="Телефон *">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-envelope"></i>
          </span>
          <input type="text" name="email" id="email" class="form-control" value="" placeholder="{'office_auth_register_email' | lexicon} *">
        </div>
        <p class="help-block">
          <small>{'office_auth_register_email_desc' | lexicon}</small>
        </p>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-key"></i>
          </span>
          <input type="password" name="password" id="password" class="form-control" value="" placeholder="{'office_auth_register_password' | lexicon} *">
        </div>
        <p class="help-block">
          <small>{'office_auth_register_password_desc' | lexicon}</small>
        </p>
      </div>
    </div>
    <div class="form-group mb0">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary">{'office_auth_register_btn' | lexicon}</button>
      </div>
    </div>
    <div class="form-group b-link">
      <a href="{$_modx->makeUrl('6')}">Уже зарегистрированы? Войти тут</a>
    </div>
    {if $error?}
      <div class="alert alert-block alert-danger alert-error">{$error}</div>
    {/if}
  </form>
</div>