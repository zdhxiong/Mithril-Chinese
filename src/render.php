<?php
$vars['title'] = 'render(element, vnodes)';
$vars['filename'] = 'render';
$vars['prev'] = array(
    'filename' => 'hyperscript',
    'title' => 'm(selector, attributes, children)'
);
$vars['next'] = array(
    'filename' => 'mount',
    'title' => 'mount(root, component)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">render(element, vnodes)</h1>
    <div class="doc-chapter">
        <h2 id="description" class="doc-chapter-title mdui-text-color-theme"><a href="#description">描述</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>把模版渲染到 DOM 中：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(document.body, "hello")
// <body>hello</body>'); ?></code></pre>
        </div>

        <h2 id="signature" class="doc-chapter-title mdui-text-color-theme"><a href="#signature">签名</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(element, vnodes)'); ?></code></pre>
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
                        <td>一个 DOM 元素，vnode 会被渲染到该元素内。</td>
                    </tr>
                    <tr>
                        <td><code>vnodes</code></td>
                        <td><code>Array<Vnode>|Vnode</code></td>
                        <td>是</td>
                        <td>需要渲染的 <a href="./vnodes.html">vnode</a></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>返回</th>
                        <th></th>
                        <th>返回 <code>undefined</code></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <p><a href="./signatures.html">如何阅读签名</a></p>
        </div>

        <h2 id="how-it-works" class="doc-chapter-title mdui-text-color-theme"><a href="#how-it-works">工作原理</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>m.render(element, vnodes)</code> 方法使用虚拟 DOM 树（通常通过 <a href="./hyperscript.html">m() 函数</a>生成）来生成 DOM 树，并添加到 <code>element</code> 元素中。如果之前已经通过调用 <code>m.render()</code> 把 DOM 树添加到了 <code>element</code> 元素中，则再次调用 <code>m.render()</code> 时，会把 <code>vnode</code> 和之前的 <code>vnode</code> 进行比较，并更改发生数据变更的地方，没有数据变更的 DOM 节点不会被更改。</p>
            <p><code>m.render</code> 是同步的。</p>
        </div>

        <h2 id="why-virtual-dom" class="doc-chapter-title mdui-text-color-theme"><a href="#why-virtual-dom">为什么使用虚拟 DOM</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="differences-from-other-api-methods" class="doc-chapter-title mdui-text-color-theme"><a href="#differences-from-other-api-methods">和其他 API 方法的区别</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="standalone-usage" class="doc-chapter-title mdui-text-color-theme"><a href="#standalone-usage">独立使用</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>