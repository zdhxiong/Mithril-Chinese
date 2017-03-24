<?php
$vars['title'] = 'version';
$vars['filename'] = 'version';
$vars['prev'] = array(
    'filename' => 'redraw',
    'title' => 'redraw()'
);
$vars['next'] = array(
    'filename' => 'promise',
    'title' => 'Promise(executor)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">version</h1>

    <nav class="doc-toc mdui-text-color-theme">
        <ul>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
        </ul>
    </nav>

    <div class="doc-chapter">
        <h2 id="signature" class="doc-chapter-title mdui-text-color-theme"><a href="#signature">签名</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js">m.version</code></pre>
            <div class="mdui-table-fluid">
                <table class="mdui-table mdui-table-hoverable">
                    <thead>
                    <tr>
                        <th>参数</th>
                        <th>类型</th>
                        <th>是否必须</th>
                        <th>描述</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>返回</th>
                        <th>String</th>
                        <th></th>
                        <th>返回版本号</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <h2 id="how-it-works" class="doc-chapter-title mdui-text-color-theme"><a href="#how-it-works">工作原理</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>m.version</code> 属性会返回当前 Mithril 的版本号。</p>
            <p>版本号使用 <a href="http://semver.org/" target="_blank">semver</a> 规范，格式为 “0.0.0”，第一个数字是主板本号，第二个数字是次版本好，第三个数字是修订版本号。</p>
            <ul>
                <li>当有向下不兼容的 API 更改时，更新主版本号</li>
                <li>当添加新功能，且向下兼容时，更新次版本号</li>
                <li>当修复 bug，且向下兼容时，更新修订版本号</li>
            </ul>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>