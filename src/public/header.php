<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <title><?php if ($vars['title']) {echo $vars['title'].' - ';} ?>Mithril 中文文档，中文教程</title>
  <link rel="stylesheet" href="./static/mdui/css/mdui.min.css"/>
  <link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/9.10.0/styles/github-gist.min.css"/>
  <link rel="stylesheet" href="./static/css/app.css"/>
</head>
<body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-indigo mdui-theme-accent-pink">
<header class="mdui-appbar mdui-appbar-fixed">
  <div class="mdui-toolbar mdui-color-theme">
    <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer'}"><i class="mdui-icon material-icons">&#xe5d2;</i></span>
    <a href="./" class="mdui-typo-headline mdui-hidden-xs">Mithril</a>
    <a href="" class="mdui-typo-title"><?php echo $vars['title']; ?></a>
    <div class="mdui-toolbar-spacer"></div>
    <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-menu="{target: '#header-menu', fixed: true}"><i class="mdui-icon material-icons">&#xe5d4;</i></span>
    <ul class="mdui-menu" id="header-menu">
      <li class="mdui-menu-item">
        <a href="https://github.com/zdhxiong/Mithril-Chinese" target="_blank" class="mdui-ripple">中文文档 Github</a>
      </li>
      <li class="mdui-menu-item">
        <a href="http://mithril.js.org" class="mdui-ripple">英文官方文档</a>
      </li>
      <li class="mdui-menu-item">
        <a href="https://github.com/lhorie/mithril.js" target="_blank" class="mdui-ripple">官方 Github</a>
      </li>
    </ul>
  </div>
</header>
<div class="mdui-drawer" id="main-drawer">
  <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
    <div class="mdui-collapse-item <?php if ($vars['section'] == 'guide') {echo 'mdui-collapse-item-open';} ?>">
      <a href="./introduction.html" class="mdui-collapse-item-header mdui-list-item mdui-ripple">
        <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">&#xe569;</i>
        <div class="mdui-list-item-content">教程</div>
        <i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i>
      </a>
      <div class="mdui-collapse-item-body mdui-list">
        <a href="./introduction.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'introduction') {echo 'mdui-list-item-active';}; ?>">介绍</a>
        <a href="./installation.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'installation') {echo 'mdui-list-item-active';}; ?>">安装</a>
        <a href="./simple-application.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'simple-application') {echo 'mdui-list-item-active';}; ?>">简单应用教程</a>

        <div class="mdui-subheader-inset">资源</div>
        <a href="./jsx.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'jsx') {echo 'mdui-list-item-active';}; ?>">JSX</a>
        <a href="./es6.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'es6') {echo 'mdui-list-item-active';}; ?>">ES6</a>
        <a href="./css.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'css') {echo 'mdui-list-item-active';}; ?>">CSS</a>
        <a href="./animation.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'animation') {echo 'mdui-list-item-active';}; ?>">动画</a>
        <a href="./testing.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'testing') {echo 'mdui-list-item-active';}; ?>">测试</a>
        <a href="./examples.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'examples') {echo 'mdui-list-item-active';}; ?>">示例</a>

        <div class="mdui-subheader-inset">关键概念</div>
        <a href="./vnodes.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'vnodes') {echo 'mdui-list-item-active';}; ?>">Vnodes</a>
        <a href="./components.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'components') {echo 'mdui-list-item-active';}; ?>">组件</a>
        <a href="./lifecycle-methods.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'lifecycle-methods') {echo 'mdui-list-item-active';}; ?>">Lifecycle methods</a>
        <a href="./keys.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'keys') {echo 'mdui-list-item-active';}; ?>">Keys</a>
        <a href="./autoredraw.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'autoredraw') {echo 'mdui-list-item-active';}; ?>">Autoredraw system</a>

        <div class="mdui-subheader-inset">杂项</div>
        <a href="./framework-comparison.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'framework-comparison') {echo 'mdui-list-item-active';}; ?>">Framework comparison</a>
        <a href="./change-log.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'change-log') {echo 'mdui-list-item-active';}; ?>">Change log/Migration</a>
      </div>
    </div>

    <div class="mdui-collapse-item <?php if ($vars['section'] == 'api') {echo 'mdui-collapse-item-open';} ?>">
      <a href="./api.html" class="mdui-collapse-item-header mdui-list-item mdui-ripple">
        <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">&#xe569;</i>
        <div class="mdui-list-item-content">API</div>
        <i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i>
      </a>
      <div class="mdui-collapse-item-body mdui-list">
        <a href="./hyperscript.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'hyperscript') {echo 'mdui-list-item-active';}; ?>">m</a>
        <a href="./render.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'render') {echo 'mdui-list-item-active';}; ?>">m.render</a>
        <a href="./mount.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'mount') {echo 'mdui-list-item-active';}; ?>">m.mount</a>
        <a href="./route.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'route') {echo 'mdui-list-item-active';}; ?>">m.route</a>
        <a href="./request.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'request') {echo 'mdui-list-item-active';}; ?>">m.request</a>
        <a href="./jsonp.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'jsonp') {echo 'mdui-list-item-active';}; ?>">m.jsonp</a>
        <a href="./parseQueryString.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'parseQueryString') {echo 'mdui-list-item-active';}; ?>">m.parseQueryString</a>
        <a href="./buildQueryString.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'buildQueryString') {echo 'mdui-list-item-active';}; ?>">m.buildQueryString</a>
        <a href="./withAttr.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'withAttr') {echo 'mdui-list-item-active';}; ?>">m.withAttr</a>
        <a href="./trust.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'trust') {echo 'mdui-list-item-active';}; ?>">m.trust</a>
        <a href="./fragment.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'fragment') {echo 'mdui-list-item-active';}; ?>">m.fragment</a>
        <a href="./redraw.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'redraw') {echo 'mdui-list-item-active';}; ?>">m.redraw</a>
        <a href="./version.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'version') {echo 'mdui-list-item-active';}; ?>">m.version</a>
        <a href="./promise.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'promise') {echo 'mdui-list-item-active';}; ?>">Promise</a>
        <a href="./stream.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'stream') {echo 'mdui-list-item-active';}; ?>">Stream</a>
      </div>
    </div>
  </div>
</div>