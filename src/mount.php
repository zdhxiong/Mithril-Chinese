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
    <h1>mount(root, component)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
            <li><a href="#differences-from-mrender">和 <code>m.render</code> 的区别</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
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

        <h2 id="signature"><a href="#signature">签名</a></h2>
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

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p>和 <a href="./render.html">m.render()</a> 类似，<code>m.mount()</code> 可以把一个组件挂载到指定元素中。如果之前已经通过 <code>m.mount()</code> 方法挂载了组件，则会把该组件和之前的 vnode 进行比较，修改发生数据变更的 DOM，不会涉及到没有数据变更的 DOM 节点。</p>

        <h3>替换一个组件</h3>
        <p>如果先前已经把组件挂载到了 <code>element</code>，再调用 <code>m.mount(element, OtherComponent)</code>，则会用 <code>OtherComponent</code> 组件替换掉先前的组件。</p>

        <h3>卸载组件</h3>
        <p>使用 <code>m.mount(element, null)</code> 可以卸载 <code>element</code> 中的组件，并清空 Mithril 的内部状态。这可以防止手动移除 <code>root</code> 节点时导致内存泄露。</p>

        <h2 id="differences-from-mrender"><a href="#differences-from-mrender">和 <code>m.render</code> 的区别</a></h2>
        <p>通过 <code>m.mount</code> 渲染的组件会根据视图中的事件进行自动重绘，例如调用 <code>m.redraw()</code> 或 <code>m.request()</code>。而通过 <code>m.render()</code> 渲染的则不会。</p>
        <p>把 Mithril 的部件通过 <code>m.mount</code> 整合到使用第三方路由库的代码中，仍然可以使用 Mithril 的自动重绘系统。</p>
        <p><code>m.render</code> 适用于需要手动控制渲染的情况（例如，和第三方路由整合，或使用 Redux 等第三方数据层时）。</p>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>