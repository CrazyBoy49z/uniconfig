<div class="loginForm" id="office-auth-form">
  <form id="office-auth-login" class="login-form form-horizontal mt0" method="post">
    <input type="hidden" name="action" value="auth/formLogin"/>
    <input type="hidden" name="return" value=""/>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-envelope"></i>
          </span>
          <input type="email" name="username" id="email" class="form-control" value="" placeholder="{'office_auth_login_email' | lexicon}" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
          <span class="input-group-addon">
            <i class="fa fa-key"></i>
           </span>
          <input type="password" name="password" id="password" class="form-control" value="" placeholder="{'office_auth_login_password' | lexicon}" required>
        </div>
        <span class="help-block text-right">
          <a href="">Забыли пароль ?</a>
        </span>
      </div>
    </div>
    <div class="form-group mb0">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
        <div class="checkbox-custom">
          <input type="checkbox" name="remember" id="remember" value="option">
          <label for="remember">Запомнить меня</label>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 mb25">
        <button class="btn btn-primary pull-right" type="submit">{'office_auth_login_btn' | lexicon}</button>
      </div>
    </div>
    {if $error?}
      <div class="alert alert-block alert-danger alert-error">{$error}</div>
    {/if}
  </form>
</div>