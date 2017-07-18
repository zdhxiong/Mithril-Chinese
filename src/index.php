<?php
$vars['title'] = '介绍';
$vars['filename'] = 'index'; // 原 introduction
$vars['prev'] = array();
$vars['next'] = array(
    'filename' => 'installation',
    'title' => '安装'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>介绍</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#what-is-mithril">Mithril 是什么？</a></li>
            <li><a href="#getting-started">起步</a></li>
            <li><a href="#hello-world">Hello World</a></li>
            <li><a href="#dom-elements">DOM 元素</a></li>
            <li><a href="#components">组件</a></li>
            <li><a href="#routing">路由</a></li>
            <li><a href="#xhr">XHR</a></li>
            <li><a href="#summary">总结</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="what-is-mithril"><a href="#what-is-mithril">Mithril 是什么？</a></h2>
        <p>Mithril 是一个现代化的 JavaScript 框架，用于构建单页面应用。它非常小巧（< 8kb gzip），且内置了路由和 XHR 工具。</p>
        <div class="mdui-row mdui-m-t-4">
            <div class="mdui-col-xs-12 mdui-col-sm-5 mdui-m-b-4">
                <div class="mdui-typo-title-opacity mdui-m-b-1">文件大小</div>
                <span>Mithril (8kb)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 5.9%;"></div>
                </div>
                <span>Vue + Vue-Router + Vuex + fetch (40kb)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 29.6%;"></div>
                </div>
                <span>React + React-Router + Redux + fetch (64kb)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 47.4%;"></div>
                </div>
                <span>Angular (135kb)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 100%;"></div>
                </div>
            </div>
            <div class="mdui-col-xs-12 mdui-col-sm-2"></div>
            <div class="mdui-col-xs-12 mdui-col-sm-5">
                <div class="mdui-typo-title-opacity mdui-m-b-1">性能</div>
                <span>Mithril (6.4ms)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 42.67%;"></div>
                </div>
                <span>Vue (9.8ms)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 65.33%;"></div>
                </div>
                <span>React (12.1ms)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 80.67%;"></div>
                </div>
                <span>Angular (11.5ms)</span>
                <div class="mdui-progress mdui-m-b-2">
                    <div class="mdui-progress-determinate" style="width: 76.67%;"></div>
                </div>
            </div>
        </div>
        <p>很多知名公司，包括 Vimeo 和 Nike，以及开源平台 Lichess 等都在使用 Mithril。</p>
        <p>如果你是有经验的前端开发者，想知道 Mithril 与其它库/框架的区别，请查看<a href="./framework-comparison.html">框架对比</a>。</p>
        <p>Mithril 支持 IE9 及以上的所有浏览器。</p>

        <h2 id="getting-started"><a href="#getting-started">起步</a></h2>
        <p>使用 Mithril 最简单的方式是直接从 CDN 引入 Mithril 文件，并按照本教程学习。本教程包含了大部分的 API，但只需花费你大概 10 分钟时间。</p>
        <p>首先我们创建一个 HTML 文件：</p>
        <pre class="doc-code"><code class="lang-html"><?php echo htmlentities('<body>
    <script src="//unpkg.com/mithril/mithril.js"></script>
    <script>
    var root = document.body

    // your code goes here!
    </script>
</body>') ?></code></pre>

        <h2 id="hello-world"><a href="#hello-world">Hello World</a></h2>
        <p>我们从最简单的开始，在页面中输出一段文本。添加下列代码到文件中：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var root = document.body

m.render(root, "Hello world")'); ?></code></pre>
        <p>下面来修改这段文本：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(root, "My first app")'); ?></code></pre>
        <p>如你所见，创建和修改 HTML 用的是相同的代码。Mithril 会自动计算出最高效的方式来更新 HTML，并不会每次都重新创建 HTML。</p>

        <h2 id="dom-elements"><a href="#dom-elements">DOM 元素</a></h2>
        <p>我们把文本包裹在 <code><?php echo htmlentities('<h1>'); ?></code> 标签中：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(root, m("h1", "My first app"))'); ?></code></pre>
        <p><code>m()</code> 函数可以描述任何 HTML 结构。例如在 <code><?php echo htmlentities('<h1>'); ?></code> 标签上添加一个类：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("h1", {class: "title"}, "My first app")'); ?></code></pre>
        <p>例如创建多个元素：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('[
    m("h1", {class: "title"}, "My first app"),
    m("button", "A button"),
]'); ?></code></pre>
        <p>以及创建嵌套的元素：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("main", [
    m("h1", {class: "title"}, "My first app"),
    m("button", "A button"),
])'); ?></code></pre>
        <p>也可以通过一个 <a href="./jsx.html">Babel 插件</a>来直接使用 HTML 语法创建元素：</p>
        <pre class="doc-code"><code class="lang-html"><?php echo htmlentities('// HTML syntax via Babel\'s JSX plugin
<main>
    <h1 class="title">My first app</h1>
    <button>A button</button>
</main>'); ?></code></pre>

        <h2 id="components"><a href="#components">组件</a></h2>
        <p>组件是一个带 <code>view</code> 方法的对象：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Hello = {
    view: function() {
        return m("main", [
            m("h1", {class: "title"}, "My first app"),
            m("button", "A button"),
        ])
    }
}'); ?></code></pre>
        <p>然后使用 <code>m.mount</code> 来激活组件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.mount(root, Hello)'); ?></code></pre>
        <p>激活组件后就生成了这样的元素：</p>
        <pre class="doc-code"><code class="lang-html"><?php echo htmlentities('<main>
    <h1 class="title">My first app</h1>
    <button>A button</button>
</main>'); ?></code></pre>
        <p><code>m.mount</code> 的功能和 <code>m.render</code> 类似。但 <code>m.render</code> 只会渲染一次 HTML，而 <code>m.mount</code> 会激活 Mithril 的自动重绘系统。我们通过添加一个事件，来帮助理解这一概念：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var count = 0 // added a variable

var Hello = {
    view: function() {
        return m("main", [
            m("h1", {class: "title"}, "My first app"),
            // changed the next line
            m("button", {onclick: function() {count++}}, count + " clicks"),
        ])
    }
}

m.mount(root, Hello)'); ?></code></pre>
        <p>我们在按钮上定义了 <code>onclick</code> 事件，点击按钮时会增加 <code>count</code> 变量的值。同时把 <code>count</code> 的值渲染到了按钮文本中。</p>
        <p>现在点击按钮，按钮的文本会自动更新。因为我们用了 <code>m.mount</code>，所以无需每次都调用 <code>m.render</code> 来修改按钮文本。</p>
        <p>无需担心使用 <code>m.mount</code> 会带来性能问题。事实证明 Mithril 的渲染更新是非常快的，因为它只会涉及到 DOM 中需要更新的部分。例如上例中，点击按钮时，唯一需要更新的就是文本。</p>

        <h2 id="routing"><a href="#routing">路由</a></h2>
        <p>路由功能用于在多个页面之间相互跳转。</p>
        <p>我们来创建一个组件，这个组件包含一个链接：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('var Splash = {
    view: function() {
        return m("a", {href: "#!/hello"}, "Enter!")
    }
}'); ?></code></pre>
        <p>该链接的 <code>#!</code>部分称为 hashbang，<code>/hello</code> 部分则是路由路径。</p>
        <p>要有多个页面，我们使用 <code>m.route</code>：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('m.route(root, "/splash", {
    "/splash": Splash,
    "/hello": Hello,
})');?></code></pre>
        <p><code>m.route</code> 具有和 <code>m.mount</code> 相同的自动重绘功能。但 <code>m.route</code> 还具有 URL 感知功能，它能自动感知到带 <code>!#</code> 的 URL。</p>
        <p><code>m.route</code> 函数的第二个参数是默认路由，如果 URL 中的 hashbang 指向的路由未定义，那么将自动重定向到默认路由。</p>

        <h2 id="xhr"><a href="#xhr">XHR</a></h2>
        <p>XHR 是与服务器通信的方式。</p>
        <p>我们修改上面的点击计数器的例子，使它能把数据保存到服务器。我们需要调用 <code>m.request</code> 函数：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('var count = 0
var increment = function() {
    m.request({
        method: "PUT",
        url: "//rem-rest-api.herokuapp.com/api/tutorial/1",
        data: {count: count + 1},
        withCredentials: true,
    })
    .then(function(data) {
        count = parseInt(data.count)
    })
}');?></code></pre>
        <p>现在调用 <code>increment</code> 方法会把 <code>count</code> 的值发送到 <code>/api/tutorial/1</code> 接口，接口会返回更新后的 <code>count</code> 值。注意，<code>count</code> 变量只有在请求完成后才会更新。</p>
        <p>我们把之前的组件中的事件处理替换成调用 <code>increment</code> 函数：</p>
        <pre class="doc-code"><code class="lang-js"><?php  echo htmlentities('var Hello = {
    view: function() {
        return m("main", [
            m("h1", {class: "title"}, "My first app"),
            m("button", {onclick: increment}, count + " clicks"),
        ])
    }
}');?></code></pre>
        <p>现在单击按钮就能把 <code>count</code> 值保存到服务器了。</p>

        <h2 id="summary"><a href="#summary">总结</a></h2>
        <p>我们已经介绍了如何创建和更新 HTML，如何为单页面应用创建组件和路由，以及如何通过 XHR 与服务器交互。</p>
        <p>现在你已经熟悉了 Mithril API 的基础指示，继续阅读这个<a href="./simple-application.html">简单应用的教程</a>，该教程会指导你构建一个真正的应用。</p>
    </div>


</div>

<?php include SRC_PATH . '/public/footer.php'; ?>
