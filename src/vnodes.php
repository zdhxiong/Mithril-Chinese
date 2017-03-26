<?php
$vars['title'] = '虚拟 DOM 节点';
$vars['filename'] = 'vnodes';
$vars['prev'] = array(
    'filename' => 'examples',
    'title' => '示例'
);
$vars['next'] = array(
    'filename' => 'components',
    'title' => '组件'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>虚拟 DOM 节点</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#basics">基础</a></li>
            <li><a href="#structure">结构</a></li>
            <li><a href="#vnode-types">vnode 类型</a></li>
            <li><a href="#monomorphic-class">单态类</a></li>
            <li><a href="#avoid-anti-patterns">避免反面模式（anti-patterns）</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="basics"><a href="#basics">基础</a></h2>
        <p>虚拟 DOM 节点（vnode）是用于表示 DOM 元素（或 DOM 的一部分）的 JavaScript 对象。Mithril 的虚拟 DOM 引擎使用 vnode 树来生成 DOM 树。</p>
        <p>vnode 通过 <a href="./hyperscript.html">m()</a> hyperscript 工具来创建：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("div", {id: "test"}, "hello")'); ?></code></pre>
        <p>Hyperscript 也可以直接使用<a href="./components.html">组件</a>：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 定义一个组件
var ExampleComponent = {
    view: function(vnode) {
        return m("div", vnode.attrs, ["Hello ", vnode.children])
    }
}

// 使用该组件
m(ExampleComponent, {style: "color:red;"}, "world")

// 最终生成的 HTML 为：
// <div style="color:red;">Hello world</div>'); ?></code></pre>

        <h2 id="structure"><a href="#structure">结构</a></h2>
        <p>虚拟 DOM 节点（vnode）是一个 JavaScript 对象，具有以下属性：</p>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>属性</th>
                    <th>类型</th>
                    <th>说明</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>tag</code></td>
                    <td><code>String|Object</code></td>
                    <td>DOM 元素的 <code>nodeName</code>。也可以是 <code>[</code> 用来表示一个片段，<code>#</code> 用来表示文本节点，<code><</code> 用来表示 HTML 字符串。另外，也可以是组件。</td>
                </tr>
                <tr>
                    <td><code>key</code></td>
                    <td><code>String?</code></td>
                    <td>用于把 DOM 元素映射到数据数组中对应项的值。</td>
                </tr>
                <tr>
                    <td><code>attrs</code></td>
                    <td><code>Object?</code></td>
                    <td><a href="hyperscript.html#dom-attributes">DOM 属性</a>，<a href="hyperscript.html#events">事件</a>，<a href="hyperscript.html#properties">属性</a>和<a href="hyperscript.html#lifecycle-methods">生命周期方法</a>的 hashmap。</td>
                </tr>
                <tr>
                    <td><code>children</code></td>
                    <td><code>(Array|String|Number|Boolean)?</code></td>
                    <td>在大多数 vnode 类型中，<code>children</code> 属性是一个 vnode 数组。对于文本和 HTML 字符串节点，<code>children</code> 属性是字符串、数字和布尔值。</td>
                </tr>
                <tr>
                    <td><code>text</code></td>
                    <td><code>(String|Number|Boolean)?</code></td>
                    <td>如果 vnode 只包含文本，则可以用该属性代替 <code>children</code>。使用这个属性是出于性能的考虑。组件 vnode 始终不会使用 <code>text</code> 属性，即使组件只包含文本。</td>
                </tr>
                <tr>
                    <td><code>dom</code></td>
                    <td><code>Element?</code></td>
                    <td>指向与 vnode 对应的元素。此属性在 <code>oninit</code> 生命周期方法中为 <code>undefined</code>。在节点片段和 HTML 节点中，<code>dom</code> 指向所有节点中的第一个元素。</td>
                </tr>
                <tr>
                    <td><code>domSize</code></td>
                    <td><code>Number?</code></td>
                    <td>只在节点片段和 HTML 节点中存在，在其他类型的 vnode 中为 <code>undefined</code>。它表示 vnode 表示的 DOM 元素的数量（从 DOM 元素引用的元素开始）。</td>
                </tr>
                <tr>
                    <td><code>state</code></td>
                    <td><code>Object</code></td>
                    <td>在重绘时保持不变的对象。在组件 vnode 中，<code>state</code> 是组件对象的浅克隆。</td>
                </tr>
                <tr>
                    <td><code>events</code></td>
                    <td><code>Object?</code></td>
                    <td>一个保存事件处理操作的对象，在重绘时保持不变，可通过 DOM API 移除事件。如果没有已定义的事件，则 <code>events</code> 属性为 <code>undefined</code>。这个属性只在 Mithril 内部使用，开发者不要使用它。</td>
                </tr>
                </tbody>
            </table>
        </div>

        <h2 id="vnode-types"><a href="#vnode-types">vnode 类型</a></h2>
        <p>vnode 的 <code>tag</code> 属性决定了它的类型。有 5 种 vnode 类型：</p>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th style="width: 114px;">vnode 类型</th>
                    <th style="width: 284px;">示例</th>
                    <th>说明</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>元素</td>
                    <td><code>{tag: "div"}</code></td>
                    <td>表示 DOM 元素。</td>
                </tr>
                <tr>
                    <td>片段</td>
                    <td><code>{tag: "[", children: []}</code></td>
                    <td>表示 DOM 元素的列表，其父 DOM 元素可能还包含不在片段中的其他元素。当使用 <a href="./hyperscript.html">m()</a> 函数时，只能通过把数组传入 <code>m()</code> 函数的 <code>children</code> 参数中来创建 vnode 片段。<code>m("[")</code> 无法创建有效的 vnode。</td>
                </tr>
                <tr>
                    <td>文本</td>
                    <td><code>{tag: "#", children: ""}</code></td>
                    <td>表示 DOM 文本节点。</td>
                </tr>
                <tr>
                    <td>HTML 字符串</td>
                    <td><code><?php echo htmlentities('{tag: "<", children: "<br>"}'); ?></code></td>
                    <td>表示来自 HTML 字符串的 DOM 元素列表。</td>
                </tr>
                <tr>
                    <td>组件</td>
                    <td><code>{tag: ExampleComponent}</code></td>
                    <td>如果 <code>tag</code> 是包含 <code>view</code> 方法的 JavaScript 对象，vnode 则表示通过渲染该组件生成的 DOM。</td>
                </tr>
                </tbody>
            </table>
        </div>

        <h2 id="monomorphic-class"><a href="#monomorphic-class">单态类</a></h2>
        <p>Mithril 中所有的 vnode 都是通过 <code>mithril/render/vnode</code> 模块生成的。这确保了现代 JavaScript 引擎可以通过始终将 vnode 编译到同一隐藏类来优化虚拟 DOM diff 的性能。</p>
        <p>当你在其他的库中需要使用 vnode 时，应该调用此模块，而不是直接写 JavaScript 对象，以确保较高的渲染性能。</p>

        <h2 id="avoid-anti-patterns"><a href="#avoid-anti-patterns">避免反面模式（anti-patterns）</a></h2>
        <h3>避免存储可变 vnode</h3>
        <p>vnode 应该表示 DOM 在某个时间点的状态。Mithril 的渲染引擎会假定 vnode 是不变的，所以修改一个已经渲染了的 vnode 时，会导致意想不到的后果。</p>
        <p>尽可能重用 vnode 来避免 diff，最好使用 <code>onbeforeupdate</code> 钩子来使其他开发者能明白你的意图。</p>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>