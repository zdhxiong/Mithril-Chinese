<?php
$vars['title'] = '测试';
$vars['filename'] = 'testing';
$vars['prev'] = array(
    'filename' => 'animation',
    'title' => '动画'
);
$vars['next'] = array(
    'filename' => 'examples',
    'title' => '示例'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>测试</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#ospec">ospec 测试框架</a></li>
            <li><a href="#good-testing-practices">良好的测试实践</a></li>
            <li><a href="#unit-testing">单元测试</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="ospec"><a href="#ospec">ospec 测试框架</a></h2>
        <p>Mithril 提供了一个名为 <a href="https://github.com/lhorie/mithril.js/tree/rewrite/ospec">ospec</a> 的测试框架。与大多数测试框架不同的是，它没有任何可配置项。</p>
        <p>我们来为测试框架添加一个 NPM 脚本。打开项目的 <code>package.json</code> 文件，修改 <code>"script"</code> 中的 <code>test</code> 行：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
"name": "my-project",
"scripts": {
    "test": "ospec"
}
}'); ?></code></pre>
        <p>在项目文件夹下创建一个文件夹 <code>tests</code>，在该文件夹内编写测试：</p>
        <pre class="doc-code" data-filename="tests/math-test.js"><code class="lang-js"><?php echo htmlentities('var o = require("mithril/ospec/ospec")

o.spec("math", function() {
o("addition works", function() {
    o(1 + 2).equals(3)
})
})'); ?></code></pre>
        <p>然后在命令行中执行 <code>npm test</code> 来运行测试。Ospec 会把项目中所有 <code>tests</code> 文件夹内的文件都当成测试文件。</p>

        <h2 id="good-testing-practices"><a href="#good-testing-practices">良好的测试实践</a></h2>
        <p>一般来说，有两种方法来编写测试：预先编写测试和事后编写测试。</p>
        <p>预先编写测试可以预先定义 API 需要遵守的规范。但是如果你还不知道你的项目会是什么样子，或者 API 可能会发生变动，那么预先编写测试可能不合适。</p>
        <p>事后编写测试可以测试已有 API 是否符合规范，以及是否存在 bug，确保之前修复的 bug 不会被后面的修改重新引入。</p>

        <h2 id="unit-testing"><a href="#unit-testing">单元测试</a></h2>
        <p>单元测试是指对应用中最小可测试单元进行测试，给定一些输入，并测试它的输出。</p>
        <p>测试 Mithril 的组件很简单。假设有一个这样的组件：</p>
        <pre class="doc-code" data-filename="Mycomponent.js"><code class="lang-js"><?php echo htmlentities('var m = require("mithril")

module.exports = {
view: function() {
    return m("div", "Hello world")
}
}'); ?></code></pre>
        <p>然后为此组件编写测试，首先创建一个测试文件 <code>tests/MyComponent.js</code>：</p>
        <pre class="doc-code" data-filename="tests/MyComponent.js"><code class="lang-js"><?php echo htmlentities('var MyComponent = require("MyComponent")

o.spec("MyComponent", function() {
o("returns a div", function() {
    var vnode = MyComponent.view()

    o(vnode.tag).equals("div")
    o(vnode.children.length).equals(1)
    o(vnode.children[0].tag).equals("#")
    o(vnode.children[0].children).equals("Hello world")
})
})'); ?></code></pre>
        <p>通常，你不会如此细致的测试 vnode 树的结构，而只会测试视图的重要的动态部分。可以使用 <a href="https://github.com/StephanHoyer/mithril-query" target="_blank">Mithril Query</a> 工具来帮助测试 vnode 树。</p>
        <p>有时需要模拟模块的依赖关系，可以使用 <a href="https://github.com/mfncooper/mockery" target="_blank">Mockery</a>。</p>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>