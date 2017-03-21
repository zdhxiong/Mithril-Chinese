<?php
$vars['title'] = '示例';
$vars['filename'] = 'examples';
$vars['prev'] = array(
    'filename' => 'testing',
    'title' => '测试'
);
$vars['next'] = array(
    'filename' => 'vnodes',
    'title' => '虚拟 DOM'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">示例</h1>
    <div class="doc-chapter">
        <div class="doc-chapter-content mdui-typo">
            <p>这是一些 Mithril 的示例：</p>
            <ul>
                <li><a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/animation/mosaic.html">Animation</a></li>
                <li><a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/dbmonster/mithril/index.html">DBMonster</a></li>
                <li><a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/editor/index.html">Markdown Editor</a></li>
                <li>SVG: <a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/svg/clock.html">Clock</a>, <a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/svg/ring.html">Ring</a>, <a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/svg/tiger.html">Tiger</a></li>
                <li><a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/threaditjs/index.html">ThreadItJS</a></li>
                <li><a href="http://cdn.rawgit.com/lhorie/mithril.js/rewrite/examples/todomvc/index.html">TodoMVC</a></li>
            </ul>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>