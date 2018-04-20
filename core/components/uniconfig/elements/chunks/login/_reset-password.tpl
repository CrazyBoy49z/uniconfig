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
      <div class="col-sm-12">
        <button class="btn btn-primary" type="submit">Восстановить</button>
      </div>
    </div>
    <div class="form-group b-link">
      <div class="col-sm-6"><a href="{$_modx->makeUrl('6')}">Войти</a></div>
      <div class="col-sm-6"><a href="{$_modx->makeUrl('7')}">Зарегистрироваться</a></div>
    </div>
    {if $error?}
      <div class="alert alert-block alert-danger alert-error">{$error}</div>
    {/if}
  </form>
</div>