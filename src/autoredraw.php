<?php
$vars['title'] = '自动重绘系统';
$vars['filename'] = 'autoredraw';
$vars['prev'] = array(
    'filename' => 'keys',
    'title' => 'Key'
);
$vars['next'] = array(
    'filename' => 'framework-comparison',
    'title' => '框架比较'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>自动重绘系统</h1>

    <nav class="doc-toc">
        <ul>
            <li>
                <a href="#introduction">介绍</a>
                <ul>
                    <li><a href="#after-event-handlers">事件处理函数之后</a></li>
                    <li><a href="#after-request">m.request 之后</a></li>
                    <li><a href="#after-route-changes">路由改变之后</a></li>
                </ul>
            </li>
            <li><a href="#when-mithril-does-not-redraw">何时不进行重绘</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="introduction"><a href="#introduction">介绍</a></h2>
        <p>为了实现快速渲染，Mithril 实现了一个虚拟 DOM diff 系统，此外，还提供了各种机制来实现对渲染粒度的控制。</p>
        <p>Mithril 的自动重绘系统，会在数据层的数据改变后，同步更改 DOM。当你调用 <code>m.mount</code> 后将开启自动重绘系统。当你使用 <code>m.route</code> 时，在调用了 <code>m.render</code> 后也将开启自动重绘系统。</p>
        <p>自动重绘功能其实只是在完成某些功能后执行的重新渲染。</p>

        <h3 id="after-event-handlers">事件处理函数之后</h3>
        <p>Mithril 会在视图中的 DOM 事件处理函数执行完后，进行自动重绘：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var MyComponent = {
    view: function() {
        return m("div", {onclick: doSomething})
    }
}

function doSomething() {
    // 函数执行完后，同步进行重绘
}

m.mount(document.body, MyComponent)'); ?></code></pre>
        <p>你可以通过在事件处理函数中设置 <code>e.redraw</code> 为 <code>false</code> 来禁用该事件的自动重绘：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var MyComponent = {
    view: function() {
        return m("div", {onclick: doSomething})
    }
}

function doSomething(e) {
    e.redraw = false
    // 触发该事件处理函数后，不再执行自动重绘
}

m.mount(document.body, MyComponent)'); ?></code></pre>

        <h3 id="after-request">m.request 之后</h3>
        <p>Mithril 会在 <a href="./request.html">m.request</a> 完成后执行自动重绘：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request("/api/v1/users").then(function() {
    // 函数执行完后会进行自动重绘
})'); ?></code></pre>
        <p>你可以把 <code>background</code> 设置为 <code>true</code>，来禁用指定请求的自动重绘功能：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request("/api/v1/users", {background: true}).then(function() {
    // 不再触发自动重绘
})'); ?></code></pre>

        <h3 id="after-route-changes">路由改变之后</h3>
        <p>Mithril 会在调用 <a href="./route.html#mrouteset">m.route.set()</a> 后，或者点击使用了 <a href="./route.html#mroutelink">m.route.link</a> 的链接后，执行自动重绘：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var RoutedComponent = {
    view: function() {
        return [
            // a redraw happens asynchronously after the route changes
            m("a", {href: "/", oncreate: m.route.link}),
            m("div", {
                onclick: function() {
                    m.route.set("/")
                }
            }),
        ]
    }
}

m.route(document.body, "/", {
    "/": RoutedComponent,
})'); ?></code></pre>

        <h2 id="when-mithril-does-not-redraw"><a href="#when-mithril-does-not-redraw">何时不进行重绘</a></h2>
        <p>Mithril 在 <code>setTimeout</code>、<code>setInterval</code>、<code>requestAnimationFrame</code>、<code>Promise</code> 以及第三方库的事件处理函数（例如 Socket.io 回调）的回调中不会执行自动重绘。在这种情况下，你必须手动调用 <a href="./redraw.html">m.redraw()</a>。</p>
        <p>在生命周期方法执行完后，Mithril 也不会自动重绘。在 <code>oninit</code> 之后部分 UI 可能会重绘，但另一部分 UI 可能在触发 <code>oninit</code> 时已经重绘完成。<code>oncreate</code> 和 <code>onupdate</code> 触发时 UI 已经重绘完成。</p>
        <p>如果你希望在生命周期方法中触发重绘，可以调用 <code>m.redraw()</code>，这将触发异步重绘：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var StableComponent = {
    oncreate: function(vnode) {
        vnode.state.height = vnode.dom.offsetHeight
        m.redraw()
    },
    view: function() {
        return m("div", "This component is " + vnode.state.height + "px tall")
    }
}'); ?></code></pre>
        <p>Mithirl 不会对通过 <code>m.render</code> 渲染的 vnode 进行自动重绘。这意味着，通过 <code>m.render</code> 渲染的组件在触发事件和调用 <code>m.request</code> 后不会触发重绘。因此，如果你希望手动控制重绘发生的时机，则应该使用 <code>m.render</code> 而不是 <code>m.mount</code>。</p>
        <p>注意，<code>m.render</code> 传入的参数是一个 vnode，而 <code>m.mount</code> 传入的参数是一个组件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 使用 m.render 时需要把组件包裹在 m() 函数中
m.render(document.body, m(MyComponent))

// 使用 m.mount 时，直接传入组件即可
m.mount(document.body, MyComponent)'); ?></code></pre>
            <p>如果重绘的频率高于动画帧（通常为16ms），则 Mithril 会适当的避免自动重绘。这意味着，当使用 <code>onresize</code> 或 <code>onscroll</code> 这类事件时，Mithril 会自动调节重绘频率。</p>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>