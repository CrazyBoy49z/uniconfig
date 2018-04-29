{set $fullname = $_modx->runSnippet('pdoUsers', ['users'=> $user_id, 'tpl' => '@INLINE {$fullname}'])}
<div class="comment">
  <div class="col-sm-1 hidden-xs">
    <div class="row">
      <div class="comment-avatar">
        <img src="{$_modx->runSnippet('@FILE snippets/avatar.php', ['user_id' => $user_id])}" alt="Аватарка"
             class="img-circle thumb-md">
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-10">
    <div class="row">
      <div class="comment-message white">
        <div class="comment-meta">
          <div class="comment-author">{$fullname}</div>
          <div class="comment-date">{$date  | dateago}</div>
        </div>
        <div class="col-sm-12">
          <div class="row">
            {$message}
          </div>
        </div>
        {if $photo}
          {foreach $photo as $ph}
            <div class="col-sm-4">
              <div class="row">
                <div class="col-sm-3" style="margin-right: 2px;">
                  <div class="row">
                    <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
                      <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="{$ph}" itemprop="contentUrl"
                           data-size="{$_modx->runSnippet('@FILE snippets/getImageSize.php',['img' => $ph])}">
                          <img src="{$_modx->runSnippet('!phpThumbOn',['input' => $ph, 'options' => 'w=80&h=65&zc=C'])}"
                               itemprop="thumbnail" alt=""/>
                        </a>
                      </figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          {/foreach}
        {/if}
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>