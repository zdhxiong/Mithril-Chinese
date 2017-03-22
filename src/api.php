<?php
$vars['title'] = 'API';
$vars['filename'] = 'api';
$vars['prev'] = array(
    'filename' => 'change-log',
    'title' => '更新记录'
);
$vars['next'] = array(
    'filename' => 'hyperscript',
    'title' => 'Hyperscript'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">API</h1>
    <div class="doc-chapter">
        <div class="doc-chapter-content mdui-typo">
            <p>下面列出了最常用的方法。如果哪个方法在下面没有列出，则说明那个方法用于高级用法。</p>
        </div>

        <h2 id="hyperscript" class="doc-chapter-title mdui-text-color-theme"><a href="#hyperscript">m(selector, attrs, children)</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="mount" class="doc-chapter-title mdui-text-color-theme"><a href="#mount">m.mount(element, component)</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="route" class="doc-chapter-title mdui-text-color-theme"><a href="#route">m.route(root, defaultRoute, routes)</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="route-set" class="doc-chapter-title mdui-text-color-theme"><a href="#route-set">m.route.set(path)</a></h2>

    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>