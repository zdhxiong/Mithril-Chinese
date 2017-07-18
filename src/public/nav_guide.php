<div class="mdui-collapse-item <?php if ($vars['section'] == 'guide') {echo 'mdui-collapse-item-open';} ?>">
    <a href="./index.html" class="mdui-collapse-item-header mdui-list-item mdui-ripple">
        <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink-accent">&#xe865;</i>
        <div class="mdui-list-item-content">教程</div>
        <i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i>
    </a>
    <div class="mdui-collapse-item-body mdui-list">
        <a href="./index.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'introduction') {echo 'mdui-list-item-active';}; ?>">介绍</a>
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
        <a href="./vnodes.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'vnodes') {echo 'mdui-list-item-active';}; ?>">虚拟 DOM</a>
        <a href="./components.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'components') {echo 'mdui-list-item-active';}; ?>">组件</a>
        <a href="./lifecycle-methods.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'lifecycle-methods') {echo 'mdui-list-item-active';}; ?>">生命周期方法</a>
        <a href="./keys.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'keys') {echo 'mdui-list-item-active';}; ?>">Key</a>
        <a href="./autoredraw.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'autoredraw') {echo 'mdui-list-item-active';}; ?>">自动重绘系统</a>

        <div class="mdui-subheader-inset">杂项</div>
        <a href="./framework-comparison.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'framework-comparison') {echo 'mdui-list-item-active';}; ?>">Framework comparison</a>
        <a href="./change-log.html" class="mdui-list-item mdui-ripple <?php if ($vars['filename'] == 'change-log') {echo 'mdui-list-item-active';}; ?>">Change log/Migration</a>
    </div>
</div>