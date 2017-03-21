<?php
$vars['title'] = '组件';
$vars['filename'] = 'components';
$vars['prev'] = array(
    'filename' => 'vnodes',
    'title' => '虚拟 DOM'
);
$vars['next'] = array(
    'filename' => 'lifecycle-methods',
    'title' => '生命周期方法'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">组件</h1>
    <div class="doc-chapter">
        <h2 id="structure" class="doc-chapter-title mdui-text-color-theme"><a href="#structure">结构</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>组件是对视图的一部分进行封装，以方便组织代码和重用。</p>
            <p>任何具有 <code>view</code> 方法的 JavaScript 对象都是 Mithril 组件。组件可以用过 <code>m()</code> 函数调用：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Example = {
    view: function() {
        return m("div", "Hello")
    }
}

m(Example)

// 等效 HTML
// <div>Hello</div>'); ?></code></pre>
        </div>

        <h2 id="passing-data-to-components" class="doc-chapter-title mdui-text-color-theme"><a href="#passing-data-to-components">把数据传递到组件</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>把一个 <code>attrs</code> 对象传入到 <code>m()</code> 函数的第二个参数，即可把参数传入到组件实例中：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m(Example, {name: "Floyd"})'); ?></code></pre>
            <p>在组件的视图和生命周期方法中可以通过 <code>vnode.attrs</code> 来访问数据：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Example = {
    view: function (vnode) {
        return m("div", "Hello, " + vnode.attrs.name)
    }
}'); ?></code></pre>
            <p>注意：生命周期方法也可以通过 <code>attrs</code> 对象提供，所以在你自己的回调中应该避免使用生命周期方法名，因为它们会被 Mithril 调用。只有在你希望创建生命周期钩子的时候，才能在 <code>attrs</code> 对象中使用生命周期方法。</p>
        </div>

        <h2 id="lifecycle-methods" class="doc-chapter-title mdui-text-color-theme"><a href="#lifecycle-methods">生命周期方法</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="state" class="doc-chapter-title mdui-text-color-theme"><a href="#state">状态</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="avoid-anti-patterns" class="doc-chapter-title mdui-text-color-theme"><a href="#avoid-anti-patterns">避免反面模式</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>