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
    <h1>render(element, vnodes)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#differences-from-other-api-methods">和其他 API 方法的区别</a></li>
            <li><a href="#standalone-usage">独立使用</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>把模版渲染到 DOM 中：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(document.body, "hello")
// <body>hello</body>'); ?></code></pre>

        <h2 id="signature"><a href="#signature">签名</a></h2>
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
                    <th></th>
                    <th>返回 <code>undefined</code></th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p><code>m.render(element, vnodes)</code> 方法使用虚拟 DOM 树（通常通过 <a href="./hyperscript.html">m() 函数</a>生成）来生成 DOM 树，并添加到 <code>element</code> 元素中。如果之前已经通过调用 <code>m.render()</code> 把 DOM 树添加到了 <code>element</code> 元素中，则再次调用 <code>m.render()</code> 时，会把 <code>vnode</code> 和之前的 <code>vnode</code> 进行比较，并更改发生数据变更的地方，没有数据变更的 DOM 节点不会被更改。</p>
        <p><code>m.render</code> 是同步的。</p>

        <h2 id="differences-from-other-api-methods"><a href="#differences-from-other-api-methods">和其他 API 方法的区别</a></h2>
        <p><code>m.render()</code> 在 Mithril 内部会被 <a href="./mount.html">m.mount()</a>、<a href="./route.html">m.route()</a>、<a href="./redraw.html">m.redraw()</a>、<a href="./request.html">m.request()</a> 方法调用。在<a href="./stream.html">流更新</a>后不会被调用。</p>
        <p>和 <code>m.mount()</code> 和 <code>m.route()</code> 不同，通过 <code>m.render()</code> 渲染的 vnode 不会进行自动重绘，它是一种手动控制渲染的方法。</p>
        <p>另一个不同是 <code>m.render</code> 需要一个 <a href="./vnodes.html">vnode</a>（或 vnode 组成的数组）作为第二个参数，而 <code>m.mount()</code> 和 <code>m.route()</code> 第二个参数是组件。</p>

        <h2 id="standalone-usage"><a href="#standalone-usage">独立使用</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var render = require("mithril/render")'); ?></code></pre>
        <p><code>m.render</code> 模块和 Knockout、React 和 Vue 这类视图库类似。它大概有 500 行代码（3kb min+gzip），并实现了搜索空间压缩算法和 DOM 回收机制的虚拟 DOM diff 引擎。无论是初始化页面还是重新渲染，它都拥有顶级的性能。它不依赖 Mithril 的其他模块，可以作为一个独立的库使用。</p>
        <p>尽管该模块非常小，但却是功能齐全的。它支持：SVG、自定义元素、所有标准的属性和事件。当然，它也支持<a href="./components.html">组件</a>和<a href="./lifecycle-methods.html">生命周期方法</a>。</p>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>