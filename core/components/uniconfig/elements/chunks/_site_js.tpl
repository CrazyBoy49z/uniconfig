{var $assets = ('assets_url' | config) ~ 'components/uniconfig/'}
<script src="{$assets ~ 'js/web/libs.js'}"></script>
<script>
  NProgress.start();
  NProgress.set(0.4);
  //Increment
  var interval = setInterval(function() { NProgress.inc(); }, 1000);
  $(document).ready(function(){
    NProgress.done();
    clearInterval(interval);
  });
</script>
<script src="{$assets ~ 'js/web/scripts.js'}"></script>
