<div class="loginForm">
  <form id="login-form" class="form-horizontal mt0" method="post">
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
								<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</span>
          <input type="email" name="email" id="email" class="form-control" value="" placeholder="E-mail" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-12">
        <div class="input-group input-icon">
								<span class="input-group-addon">
									<i class="fa fa-key"></i>
								</span>
          <input type="password" name="password" id="password" class="form-control" value="" placeholder="Пароль" required>
        </div>
        <span class="help-block text-right">
								<a href="">Забыли пароль ?</a>
							</span>
      </div>
    </div>
    <input class="returnUrl" type="hidden" name="returnUrl" value="[[+request_uri]]" />
    <input class="loginLoginValue" type="hidden" name="service" value="login" />
    <div class="form-group mb0">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
        <div class="checkbox-custom">
          <input type="checkbox" name="remember" id="remember" value="option">
          <label for="remember">Запомнить меня</label>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 mb25">
        <button class="btn btn-primary pull-right" type="submit" ame="Login">Войти</button>
      </div>
    </div>
  </form>
</div>