<?php
$vars['title'] = 'API';
$vars['filename'] = 'api';
$vars['prev'] = array(
    'filename' => 'change-log',
    'title' => '更新记录'
);
$vars['next'] = array(
    'filename' => 'hyperscript',
    'title' => 'm(selector, attributes, children)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">API</h1>

    <div class="doc-chapter">
        <div class="doc-chapter-content mdui-typo">
            <p>下面列出了最常用的方法。如果哪个方法在下面没有列出，则说明那个方法用于高级用法。</p>
        </div>
    </div>

    <div class="doc-toc mdui-text-color-theme">
        <ul>
            <li><a href="#hyperscript">m(selector, attrs, children)</a></li>
            <li><a href="#mount">m.mount(element, component)</a></li>
            <li><a href="#route">m.route(root, defaultRoute, routes)</a></li>
            <li><a href="#route-set">m.route.set(path)</a></li>
            <li><a href="#route-get">m.route.get()</a></li>
            <li><a href="#route-prefix">m.route.prefix(prefix)</a></li>
            <li><a href="#route-link">m.route.link()</a></li>
            <li><a href="#request">m.request(options)</a></li>
            <li><a href="#jsonp">m.jsonp(options)</a></li>
            <li><a href="#parseQueryString">m.parseQueryString(querystring)</a></li>
            <li><a href="#buildQueryString">m.buildQueryString(object)</a></li>
            <li><a href="#withAttr">m.withAttr(attrName, callback)</a></li>
            <li><a href="#trust">m.trust(htmlString)</a></li>
            <li><a href="#redraw">m.redraw()</a></li>
        </ul>
    </div>

    <div class="doc-chapter">

        <h2 id="hyperscript" class="doc-chapter-title mdui-text-color-theme"><a href="#hyperscript">m(selector, attrs, children)</a> <small>- <a href="./hyperscript.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("div.class#id", {title: "title"}, ["children"])'); ?></code></pre>
        </div>

        <h2 id="mount" class="doc-chapter-title mdui-text-color-theme"><a href="#mount">m.mount(element, component)</a> <small>- <a href="./mount.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
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

        <h2 id="route" class="doc-chapter-title mdui-text-color-theme"><a href="#route">m.route(root, defaultRoute, routes)</a> <small>- <a href="./route.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Home = {
    view: function() {
        return "Welcome"
    }
}

m.route(document.body, "/home", {
    "/home": Home, // defines `http://localhost/#!/home`
})'); ?></code></pre>
        </div>

        <h2 id="route-set" class="doc-chapter-title mdui-text-color-theme"><a href="#route-set">m.route.set(path)</a> <small>- <a href="./route.html#mrouteset">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route.set("/home")'); ?></code></pre>
        </div>

        <h2 id="route-get" class="doc-chapter-title mdui-text-color-theme"><a href="#route-get">m.route.get()</a> <small>- <a href="./route.html#mrouteget">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var currentRoute = m.route.get()'); ?></code></pre>
        </div>

        <h2 id="route-prefix" class="doc-chapter-title mdui-text-color-theme"><a href="#route-prefix">m.route.prefix(prefix)</a> <small>- <a href="./route.html#mrouteprefix">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>在 <code>m.route()</code> 之前调用。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route.prefix("#!")'); ?></code></pre>
        </div>

        <h2 id="route-link" class="doc-chapter-title mdui-text-color-theme"><a href="#route-link">m.route.link()</a> <small>- <a href="./route.html#mroutelink">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("a[href=\'/Home\']", {oncreate: m.route.link}, "Go to home page")'); ?></code></pre>
        </div>

        <h2 id="request" class="doc-chapter-title mdui-text-color-theme"><a href="#request">m.request(options)</a> <small>- <a href="./request.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "PUT",
    url: "/api/v1/users/:id",
    data: {id: 1, name: "test"}
})
.then(function(result) {
    console.log(result)
})'); ?></code></pre>
        </div>

        <h2 id="jsonp" class="doc-chapter-title mdui-text-color-theme"><a href="#jsonp">m.jsonp(options)</a> <small>- <a href="./jsonp.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.jsonp({
    url: "/api/v1/users/:id",
    data: {id: 1},
    callbackKey: "callback",
})
.then(function(result) {
    console.log(result)
})'); ?></code></pre>
        </div>

        <h2 id="parseQueryString" class="doc-chapter-title mdui-text-color-theme"><a href="#parseQueryString">m.parseQueryString(querystring)</a> <small>- <a href="./parseQueryString.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var object = m.parseQueryString("a=1&b=2")
// {a: "1", b: "2"}'); ?></code></pre>
        </div>

        <h2 id="buildQueryString" class="doc-chapter-title mdui-text-color-theme"><a href="#buildQueryString">m.buildQueryString(object)</a> <small>- <a href="./buildQueryString.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var querystring = m.buildQueryString({a: "1", b: "2"})
// "a=1&b=2"'); ?></code></pre>
        </div>

        <h2 id="withAttr" class="doc-chapter-title mdui-text-color-theme"><a href="#withAttr">m.withAttr(attrName, callback)</a> <small>- <a href="./withAttr.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var state = {
    value: "",
    setValue: function(v) {state.value = v}
}

var Component = {
    view: function() {
        return m("input", {
            oninput: m.withAttr("value", state.setValue),
            value: state.value,
        })
    }
}

m.mount(document.body, Component)'); ?></code></pre>
        </div>

        <h2 id="trust" class="doc-chapter-title mdui-text-color-theme"><a href="#trust">m.trust(htmlString)</a> <small>- <a href="./trust.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(document.body, m.trust("<h1>Hello</h1>"))'); ?></code></pre>
        </div>

        <h2 id="redraw" class="doc-chapter-title mdui-text-color-theme"><a href="#redraw">m.redraw()</a> <small>- <a href="./redraw.html">文档</a></small></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var count = 0
function inc() {
    setInterval(function() {
        count++
        m.redraw()
    }, 1000)
}

var Counter = {
    oninit: inc,
    view: function() {
        return m("div", count)
    }
}

m.mount(document.body, Counter)'); ?></code></pre>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>