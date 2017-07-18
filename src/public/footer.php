<div class="doc-footer-nav mdui-color-indigo">
  <div class="mdui-container">
    <div class="mdui-row">
      <?php if ($vars['prev']){ ?>
      <a href="./<?php echo $vars['prev']['filename']; ?>.html" class="mdui-ripple mdui-color-indigo mdui-col-xs-2 mdui-col-sm-6 doc-footer-nav-left">
        <div class="doc-footer-nav-text">
          <i class="mdui-icon material-icons">&#xe5c4;</i>
          <span class="doc-footer-nav-direction mdui-hidden-xs-down">Previous</span>
          <div class="doc-footer-nav-chapter mdui-hidden-xs-down"><?php echo $vars['prev']['title']; ?></div>
        </div>
      </a>
      <?php } else { ?>
      <div class="mdui-col-xs-2 mdui-col-sm-6 doc-footer-nav-left"></div>
      <?php } ?>

      <?php if ($vars['next']){ ?>
      <a href="./<?php echo $vars['next']['filename']; ?>.html" class="mdui-ripple mdui-color-indigo mdui-col-xs-10 mdui-col-sm-6 doc-footer-nav-right">
        <div class="doc-footer-nav-text">
          <i class="mdui-icon material-icons">&#xe5c8;</i>
          <span class="doc-footer-nav-direction">Next</span>
          <div class="doc-footer-nav-chapter"><?php echo $vars['next']['title']; ?></div>
        </div>
      </a>
      <?php } else { ?>
      <div class="mdui-col-xs-10 mdui-col-sm-6 doc-footer-nav-right"></div>
      <?php } ?>
    </div>
  </div>
</div>
<script src="//cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
<script src="//cdn.bootcss.com/mdui/0.2.1/js/mdui.min.js"></script>
<script>
  var $$ = mdui.JQ;
  hljs.initHighlightingOnLoad();

  setTimeout(function () {
    $$('pre[data-filename]').each(function (i, pre) {
      var $pre = $$(pre);
      var filename = $pre.data('filename');
      if (!filename) {
        return true;
      }
      $pre.prepend('<div class="doc-code-filename">' + filename + '</div>');
    });
  }, 200);

</script>