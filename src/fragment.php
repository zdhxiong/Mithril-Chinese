<?php
$vars['title'] = 'fragment(attrs, children)';
$vars['filename'] = 'fragment';
$vars['prev'] = array(
    'filename' => 'trust',
    'title' => 'trust(html)'
);
$vars['next'] = array(
    'filename' => 'redraw',
    'title' => 'redraw()'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>fragment(attrs, children)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>可以在 <a href="./vnodes.html">vnode</a> 片段上添加生命周期方法</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var groupVisible = true
var log = function() {
    console.log("group is now visible")
}

m("ul", [
    m("li", "child 1"),
    m("li", "child 2"),
    groupVisible ? m.fragment({oninit: log}, [
        // a fragment containing two elements
        m("li", "child 3"),
        m("li", "child 4"),
    ]) : null
])'); ?></code></pre>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <p>生成一个 <a href="./vnodes.html">vnode</a> 片段</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('vnode = m.fragment(attrs, children)'); ?></code></pre>
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
                <tbody>
                <tr>
                    <td><code>attrs</code></td>
                    <td><code>Object</code></td>
                    <td>是</td>
                    <td>属性映射</td>
                </tr>
                <tr>
                    <td><code>children</code></td>
                    <td><code>Array<Vnode>|String|Number|Boolean</code></td>
                    <td>是</td>
                    <td>vnode 数组</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Vnode</code></th>
                    <th></th>
                    <th><a href="./vnodes.html">vnode</a> 片段</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p><code>m.fragment()</code> 创建一个带属性的 <a href="./vnodes.html">vnode</a> 片段。用于涉及 <a href="./keys.html">key</a> 或 <a href="./lifecycle-methods.html">生命周期方法</a>的高级用法的场合。</p>
        <p>vnode 片段表示 DOM 元素列表。如果你想要只代表一个 DOM 元素的常规 vnode，应该使用 <a href="./hyperscript.html">m()</a>。</p>
        <p>通常，可以使用简单的数组表示节点列表：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var groupVisible = true

m("ul", [
    m("li", "child 1"),
    m("li", "child 2"),
    groupVisible ? [
        // 这个片段包含两个元素
        m("li", "child 3"),
        m("li", "child 4"),
    ] : null
])'); ?></code></pre>
        <p>但是，JavaScript 数组不能添加 key 或生命周期方法。有个方式是创建一个在数组外包裹一个元素来添加 key 和生命周期方法，但有时添加一个额外的元素是不可取的（例如在复杂的表格结构中），这种情况下，可以使用 vnode 片段。</p>
        <p>使用 <code>m.fragment</code> 来代替手写 vnode 对象结构有几个好处：<code>m.fragment</code> 会创建<a href="./vnodes.html#monomorphic-class">单态对象</a>，这会比动态创建对象有更好的性能。</p>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>