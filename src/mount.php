<?php
$vars['title'] = 'mount(root, component)';
$vars['filename'] = 'mount';
$vars['prev'] = array(
    'filename' => 'render',
    'title' => 'render(element, vnodes)'
);
$vars['next'] = array(
    'filename' => 'route',
    'title' => 'route(root, defaultRoute, routes)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">mount(root, component)</h1>
    <div class="doc-chapter">
        <h2 id="description" class="doc-chapter-title mdui-text-color-theme"><a href="#description">描述</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>激活组件的自动重绘。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var state = {
    count: 0,
    inc: function() {state.count++}
}

var Counter = {
    view: function() {
        return m("div", {onclick: state.inc}, state.count)
    }
}

m.mount(document.body, Counter)'); ?></code></pre>
        </div>

        <h2 id="signature" class="doc-chapter-title mdui-text-color-theme"><a href="#signature">签名</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.mount(element, component)'); ?></code></pre>
            <div class="mdui-table-fluid">
                <table class="mdui-table mdui-table-hoverable">
                    <thead>
                    <tr>
                        <th>参数</th>
                        <th>类型</th>
                        <th>是否必需</th>
                        <th>描述</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><code>element</code></td>
                        <td><code>Element</code></td>
                        <td>是</td>
                        <td>一个 DOM 元素，组件会被渲染到该元素内</td>
                    </tr>
                    <tr>
                        <td><code>component</code></td>
                        <td><code>Component|null</code></td>
                        <td>是</td>
                        <td>要渲染的<a href="./components.html">组件</a>。若为 <code>null</code>，则会移除 DOM 数，并清空内部状态。</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>返回</th>
                        <th></th>
                        <th>没有返回</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <p><a href="./signatures.html">如何阅读签名</a></p>
        </div>

        <h2 id="how-it-works" class="doc-chapter-title mdui-text-color-theme"><a href="#how-it-works">工作原理</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="performance-considerations" class="doc-chapter-title mdui-text-color-theme"><a href="#performance-considerations">performance-considerations</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="differences-from-mrender" class="doc-chapter-title mdui-text-color-theme"><a href="#differences-from-mrender">differences-from-mrender</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>