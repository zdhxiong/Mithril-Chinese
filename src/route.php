<?php
$vars['title'] = 'route(root, defaultRoute, routes)';
$vars['filename'] = 'route';
$vars['prev'] = array(
    'filename' => 'mount',
    'title' => 'mount(root, component)'
);
$vars['next'] = array(
    'filename' => 'request',
    'title' => 'request(options)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>route(root, defaultRoute, routes)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li>
                <a href="#signature">签名</a>
                <ul>
                    <li>
                        <a href="#static-members">静态成员</a>
                        <ul>
                            <li><a href="#mrouteset">m.route.set</a></li>
                            <li><a href="#mrouteget">m.route.get</a></li>
                            <li><a href="#mrouteprefix">m.route.prefix</a></li>
                            <li><a href="#mroutelink">m.route.link</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#routeresolver">RouteResolver</a>
                        <ul>
                            <li><a href="#routeresolveronmatch">routeResolver.onmatch</a></li>
                            <li><a href="#routeresolverrender">routeResolver.render</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#how-it-works">工作原理</a></li>
            <li><a href="#routing-strategies">路由策略</a></li>
            <li><a href="#typical-usage">典型用法</a></li>
            <li><a href="#navigating-to-different-routes">路由切换</a></li>
            <li>
                <a href="#routing-parameters">路由参数</a>
                <ul>
                    <li><a href="#key-parameter">key 参数</a></li>
                    <li><a href="#variadic-routes">含复杂参数路由</a></li>
                    <li><a href="#history-state">History state</a></li>
                </ul>
            </li>
            <li><a href="#changing-router-prefix">修改路由前缀</a></li>
            <li>
                <a href="#advanced-component-resolution">高级组件方案</a>
                <ul>
                    <li><a href="#wrapping-a-layout-component">封装布局组件</a></li>
                    <li><a href="#authentication">验证</a></li>
                    <li><a href="#preloading-data">预加载数据</a></li>
                    <li><a href="#code-splitting">代码拆分</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>路由用于在应用的不同页面之间跳转</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Home = {
    view: function() {
        return "Welcome"
    }
}

m.route(document.body, "/home", {
    "/home": Home, // defines `http://localhost/#!/home`
})'); ?></code></pre>
        <p>每个应用只能调用一次 <code>m.route</code>。</p>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route(root, defaultRoute, routes)'); ?></code></pre>
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
                    <td><code>root</code></td>
                    <th><code>Element</code></th>
                    <th>是</th>
                    <th>一个 DOM 元素，其他元素会被放置在该元素内</th>
                </tr>
                <tr>
                    <td><code>defaultRoute</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>如果当前 URL 没有匹配的路由，则会跳转到这个默认路由</td>
                </tr>
                <tr>
                    <td><code>routes</code></td>
                    <td><code>Object</code></td>
                    <td>是</td>
                    <td>一个对象，key 是路由字符串，value 是组件或<a href="./route.html#routeresolver">RouteResolver</a></td>
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

        <h3 id="static-members"><a href="#static-members">静态成员</a></h3>

        <h4 id="mrouteset"><a href="#mrouteset">m.route.set</a></h4>
        <p>跳转到匹配的路由，如果没有匹配的路由，则跳转到默认路由。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route.set(path, data, options)'); ?></code></pre>
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
                    <td><code>path</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>路由路径，不含前缀。该路径可以包含路由参数的动态变量</td>
                </tr>
                <tr>
                    <td><code>data</code></td>
                    <td><code>Object</code></td>
                    <td>否</td>
                    <td>路由参数。如果 <code>path</code> 中含路由参数的动态变量，则会将该对象中的对应属性的值添加到路由路径中</td>
                </tr>
                <tr>
                    <td><code>options.replace</code></td>
                    <td><code>Boolean</code></td>
                    <td>否</td>
                    <td>是否创建新的历史记录，还是替换当前的历史记录，默认为 <code>false</code></td>
                </tr>
                <tr>
                    <td><code>options.state</code></td>
                    <td><code>Object</code></td>
                    <td>否</td>
                    <td>传递给 <code>history.pushState</code>/<code>history.replaceState</code> 调用的 <code>state</code> 参数。该参数可以通过 <code>history.state</code> 属性调用，并且会被合并到<a href="./route.html#routing-parameters">路由参数</a>对象。注意该参数只有在使用 pushState API 时才有效，如果路由降级到使用 hashchange 则无效（如浏览器不支持 pushState API）</td>
                </tr>
                <tr>
                    <td><code>options.title</code></td>
                    <td><code>String</code></td>
                    <td>否</td>
                    <td>传递给 <code>history.pushState</code>/<code>history.replaceState</code> 调用的 <code>title</code> 参数</td>
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

        <h4 id="mrouteget"><a href="#mrouteget">m.route.get</a></h4>
        <p>返回最后一个完全解析的路由路径，不含前缀。当路由正在<a href="./route.html#code-splitting">等待解析</a>时，它可能和浏览器地址栏中显示的路径不同。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('path = m.route.get()'); ?></code></pre>
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
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>String</code></th>
                    <th></th>
                    <th>返回最后一个完全解析的路由路径</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="mrouteprefix"><a href="#mrouteprefix">m.route.prefix</a></h4>
        <p>定义路由前缀。路由前缀是一个 URL 片段，表示路由所使用的<a href="./route.html#routing-strategies">策略</a>。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route.prefix(prefix)'); ?></code></pre>
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
                    <td><code>prefix</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>该前缀指定了 Mithril 使用的<a href="./route.html#routing-strategies">路由策略</a></td>
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

        <h4 id="mroutelink"><a href="#mroutelink">m.route.link</a></h4>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('eventHandler = m.route.link(vnode)'); ?></code></pre>
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
                    <td><code>vnode</code></td>
                    <td><code>Vnode</code></td>
                    <td>是</td>
                    <td>这个方法意味着和 <code><?php echo htmlentities('<a>'); ?></code> <a href="./vnodes.html">vnode</a> 的 <a href="./lifecycle-methods.html">oncreate 钩子</a>一起使用</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th>Function(e)</th>
                    <th></th>
                    <th>返回事件处理函数，用链接的 <code>href</code> 作为 <code>path</code> 调用 <code>m.route.set</code></th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h3 id="routeresolver"><a href="#routeresolver">RouteResolver</a></h3>
        <p>RouteResolver 是一个包含 <code>onmatch</code> 和/或 <code>render</code> 方法的对象。两个方法都是可选的，但至少要有其中一个。RouteResolver 不是组件，因此没有生命周期方法。RouteResolver 应该和 <code>m.route</code> 位于相同的文件中，而组件定义应该在对应的模块中。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('routeResolver = {onmatch, render}'); ?></code></pre>

        <h4 id="routeresolveronmatch"><a href="#routeresolveronmatch">routeResolver.onmatch</a></h4>
        <p>当路由在寻找需要渲染的组件时，会调用 <code>onmatch</code> 钩子。每次路由路径改变时会调用一次，但随后在同一个路径中的重绘不会调用。它可以用于在组件初始化之前执行一些逻辑（例如验证登录、数据预加载等）。</p>
        <p>该方法还允许你异步定义要渲染的组件，使其适用于代码分割和异步加载模块。如果要异步渲染组件，则返回解析组件的 Promise。</p>
        <p>更多有关 <code>onmatch</code> 的信息，详见<a href="./route.html#advanced-component-resolution">高级组件方案</a>部分。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('routeResolver.onmatch(args, requestedPath)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>args</code></td>
                    <td><code>Object</code></td>
                    <td><a href="./route.html#routing-parameters">路由参数</a></td>
                </tr>
                <tr>
                    <td><code>requestedPath</code></td>
                    <td><code>String</code></td>
                    <td>最后的路由操作请求的路由路径，包括动态变量的值，但不含前缀。当 <code>onmatch</code> 被调用时，路由路径的解析还是未完成的，且 <code>m.route.get()</code> 得到的依然时前一个路径。</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Component|Promise</code></th>
                    <th>返回组件、或者解析到组件的 Promise</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <p>如果 <code>onmatch</code> 返回组件、或者解析到组件的 Promise，则该组件将被用作 RouteResolver 的 <code>render</code> 方法中第一个参数的 <code>vnode.tag</code>。否则，<code>vnode.tag</code> 会被设置为 <code>"div"</code>。如果省略 <code>onmatch</code> 方法，<code>vnode.tag</code> 同样会被设置为 <code>"div"</code>。</p>
        <p>如果 <code>onmatch</code> 返回被拒绝的 Promise，则路由会跳转到 <code>defaultRoute</code>。你可以在 Promise 返回前调用 <code>.catch</code> 来覆盖它的行为。</p>

        <h4 id="routeresolverrender"><a href="#routeresolverrender">routeResolver.render</a></h4>
        <p>在匹配的路由进行重绘时会调用 <code>render</code> 方法。它类似组件中的 <code>view</code> 方法，它可以简化<a href="./route.html#wrapping-a-layout-component">组件的组成</a>。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('vnode = routeResolve.render(vnode)'); ?></code></pre>
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>vnode</code></td>
                    <td><code>Object</code></td>
                    <td>一个 <a href="./vnodes.html">vnode</a>，且它的属性对象包含了路由参数。如果 <code>onmatch</code> 没有返回组件或解析到组件的 Promise，则 vnode 的 <code>tag</code> 默认为 <code>"div"</code>。</td>
                </tr>
                <tr>
                    <td><code>vnode.attrs</code></td>
                    <td><code>Object</code></td>
                    <td>URL 参数值的映射</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Vnode</code></th>
                    <th>返回 vnode</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p>路由是一个允许创建单页面应用（SPA）的系统。例如应用可以从一个页面跳转到另一个页面，但不会导致整个页面刷新。</p>
        <p>无刷新的路由切换功能由 <a href="https://developer.mozilla.org/en-US/docs/Web/API/History_API#The_pushState()">history.pushState</a> API 实现。使用该 API，开发者可以在页面载入后手动修改 URL，并载入该 URL 对应的内容，而无需刷新整个页面。</p>

        <h2 id="routing-strategies"><a href="#routing-strategies">路由策略</a></h2>
        <p>路由策略决定了一个库如何实现路由。有三个常用的策略来实现 SPA 路由系统，每个策略都有各自的注意事项：</p>
        <ul>
            <li>使用 hash。使用这种策略的 URL 看起来是：<code>http://localhost/#!/page1</code></li>
            <li>使用 querystring。使用这种策略的 URL 看起来是：<code>http://localhost/?/page1</code></li>
            <li>使用 pathname。使用这种策略的 URL 看起来是：<code>http://localhost/page1</code></li>
        </ul>
        <p>使用 hash 策略可以在不支持 <code>history.pushState</code> 的浏览器上运行（IE9 及以下），因为它可以降级到使用 <code>onhashchange</code>。如果你的应用需要支持 IE9，请使用该策略。</p>
        <p>使用 querystring 策略也可以支持 IE9，但它会降级使用重新加载整个页面。如果你需要支持锚链接，且服务端不支持 pathname 策略时，可以使用该策略。</p>
        <p>使用 pathname 策略可以产生看起来很干净的 URL，但不支持 IE9，且需要在服务器为每个路由进行设置。如果你想要干净的 URL，且不需要支持 IE9，可以使用该策略。</p>
        <p>使用 hash 策略的单页面应用通常会在 <code>#</code> 后面添加一个叹号，以指示使用 hash 作为路由机制，而不是链接到锚点。<code>#!</code> 字符串被称为 hashbang。</p>
        <p>默认策略使用 hashbang。</p>

        <h2 id="typical-usage"><a href="#typical-usage">典型用法</a></h2>
        <p>通常，你需要先创建几个<a href="./components.html">组件</a>：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Home = {
    view: function() {
        return [
            m(Menu),
            m("h1", "Home")
        ]
    }
}

var Page1 = {
    view: function() {
        return [
            m(Menu),
            m("h1", "Page 1")
        ]
    }
}'); ?></code></pre>
        <p>在上面的代码中，有两个组件：<code>Home</code> 和 <code>Page1</code>。每个组件都包含一个菜单和一些文本，菜单本身也被定义成了一个组件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Menu = {
    view: function() {
        return m("nav", [
            m("a[href=/]", {oncreate: m.route.link}, "Home"),
            m("a[href=/page1]", {oncreate: m.route.link}, "Page 1"),
        ])
    }
}'); ?></code></pre>
        <p>现在我们可以定义路由，并把组件映射到路由：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route(document.body, "/", {
    "/": Home,
    "/page1": Page1,
})'); ?></code></pre>
        <p>这里我们指定了两个路由：<code>/</code> 和 <code>/page1</code>，当用户切换到指定 URL 时，将渲染对应的组件。默认状态下，路由前缀为 <code>#!</code>。</p>

        <h2 id="navigating-to-different-routes"><a href="#navigating-to-different-routes">路由切换</a></h2>
        <p>在上面的例子中，<code>Menu</code> 组件有两个链接。你可以添加钩子 <code>{oncreate: m.route.link}</code>，来指定 <code>href</code> 属性是一个路由链接（而不是跳转到其他页面的常规链接）。</p>
        <p>你也可以调用 <code>m.route.set(route)</code> 来手动切换路由。例如 <code>m.route.set("/page1")</code>。</p>
        <p>切换路由时，不需要指定路由前缀。也就是说，当使用 <code>m.route.link</code> 或 <code>m.route.set(route)</code> 时，不要在路由路径前加上 <code>#!</code>。</p>

        <h2 id="routing-parameters"><a href="#routing-parameters">路由参数</a></h2>
        <p>有时我们需要在路由中添加一个变量，Mithril 支持参数化路由：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Edit = {
    view: function(vnode) {
        return [
            m(Menu),
            m("h1", "Editing " + vnode.attrs.id)
        ]
    }
}
m.route(document.body, "/edit/1", {
    "/edit/:id": Edit,
})'); ?></code></pre>
        <p>在上面的例子中，我们定义了一个路由 <code>/edit/:id</code>。它是一个动态路由，可以匹配以 <code>/edit/</code> 开头，且后面跟着一些数据的 URL（例如 <code>/edit/1</code>、<code>/edit/234</code>）。<code>id</code> 的值会作为组件的 <a href="./vnodes.html">vnode</a> 的属性（<code>vnode.attrs.id</code>）。</p>
        <p>一个路由可以有多个参数，例如 <code>/edit/:projectID/:userID</code> 路由会给组件的 vnode 的属性对象添加 <code>projectID</code> 和 <code>userID</code> 两个属性。</p>
        <p>除了路由参数之外，<code>attrs</code> 对象还包含一个表示当前路由路径的 <code>path</code> 属性，和表示当前路由的 <code>route</code> 属性。</p>

        <h3 id="key-parameter"><a href="#key-parameter">key 参数</a></h3>
        <p>当用户跳转到含不同参数的同一路由时（例如 <code>/page/:id</code> 路由，从 <code>/page/1</code> 跳转到 <code>/page/2</code> 时），不会重新创建组件，因为两条路由解析的是同一个组件，但是会产生虚拟 DOM diff。这会触发 <code>onupdate</code> 钩子，但不会触发 <code>oninit</code>/<code>oncreate</code>。</p>
        <p>但是，也有的开发者希望在路由改变时重建组件。为了实现这一点，可以把路由参数和 <a href="./keys.html">key</a> 功能结合使用：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route(document.body, "/edit/1", {
    "/edit/:key": Edit,
})'); ?></code></pre>
        <p>路由参数中使用了 <code>key</code>。因为路由参数会称为 <code>vnode</code> 的属性，所以页面切换时，导致 <code>key</code> 改变，从而使组件重新创建（<code>key</code> 的改变告诉虚拟 DOM 引擎旧的组件和新的组件是不同的实体）。</p>
        <p>你可以利用该特性，在重新加载路由时，重新创建组件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route.set(m.route.get(), {key: Date.now()})'); ?></code></pre>
        <p>或者使用 <a href="./route.html#history-state">history state</a> 功能实现可重新加载的组件，且不会污染 URL：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route.set(m.route.get(), null, {state: {key: Date.now()}})'); ?></code></pre>

        <h3 id="variadic-routes"><a href="#variadic-routes">含复杂参数路由</a></h3>
        <p>路由中可以包含复杂的参数。例如，用含斜线的 URL 路径作为路由参数：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route(document.body, "/files/pictures/image.jpg", {
    "/files/:file...": Edit,
})'); ?></code></pre>

        <h3 id="history-state"><a href="#history-state">History state</a></h3>
        <p>可以充分利用底层的 <code>history.pushState</code> API 来改善用户体验。例如，当用户离开一个页面时，应用可以记住表单状态，在用户通过点击浏览器的返回按钮回到这个页面时，表单中保留这上次填写的内容。</p>
        <p>例如，你可以创建一个如下表单：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var state = {
    term: "",
    search: function() {
        // 保存此路由的状态
        // 等效于 `history.replaceState({term: state.term}, null, location.href)`
        m.route.set(m.route.get(), null, {replace: true, state: {term: state.term}})

        // 离开页面
        location.href = "https://google.com/?q=" + state.term
    }
}

var Form = {
    oninit: function(vnode) {
        state.term = vnode.attrs.term || "" // 如果用户点击了返回按钮，则从 `history.state` 属性填充数据
    },
    view: function() {
        return m("form", [
            m("input[placeholder=\'Search\']", {oninput: m.withAttr("value", function(v) {state.term = v}), value: state.term}),
            m("button", {onclick: state.search}, "Search")
        ])
    }
}

m.route(document.body, "/", {
    "/": Form,
})'); ?></code></pre>
        <p>这样，如果用户搜索时离开了页面，然后通过返回按钮又回到这个页面，则搜索框仍然会填充着搜索词。这种技术可以改善大型应用的表单、以及其他需要持久化状态的应用的用户体验。</p>

        <h2 id="changing-router-prefix"><a href="#changing-router-prefix">修改路由前缀</a></h2>
        <p>路由前缀是一个 URL 片段，表示路由使用的基本<a href="./route.html#routing-strategies">策略</a>。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 设置为路径名
m.route.prefix("")

// 设置为 querystring
m.route.prefix("?")

// 设置为 hash
m.route.prefix("#")

// 设置为路径名，并用一段路径当前缀
// 例如，应用位于 `http://localhost/my-app`，而其他东西位于 `http://localhost`
m.route.prefix("/my-app")'); ?></code></pre>

        <h2 id="advanced-component-resolution"><a href="#advanced-component-resolution">高级组件方案</a></h2>
        <p>你可以指定一个 RouteResolver 对象，而不是把组件映射到路由。RouteResolver 对象包含 <code>onmatch()</code> 和/或 <code>render()</code> 方法。两个方法都是可选的，但至少要又一个方法。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route(document.body, "/", {
    "/": {
        onmatch: function(args, requestedPath) {
            return Home
        },
        render: function(vnode) {
            return vnode // 等效于 m(Home)
        },
    }
})'); ?></code></pre>
        <p>RouteResolvers 对于实现复杂的路由很有用。</p>

        <h3 id="wrapping-a-layout-component"><a href="#wrapping-a-layout-component">封装布局组件</a></h3>
        <p>通常需要将组件包裹在可重用的布局中。为了做到这一点，你首先需要创建一个包含可重用部分的组件，用于包裹各种不同的组件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Layout = {
    view: function(vnode) {
        return m(".layout", vnode.children)
    }
}'); ?></code></pre>
        <p>在上面的例子中，布局只包含 <code><?php echo htmlentities('<div class="layout">'); ?></code> 和它的子元素，但真正在开发项目时，会复杂的多。</p>
        <p>包裹布局的一种方法是在路由中定义一个匿名组件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 示例 1
m.route(document.body, "/", {
    "/": {
        view: function() {
            return m(Layout, m(Home))
        },
    },
    "/form": {
        view: function() {
            return m(Layout, m(Form))
        },
    }
})'); ?></code></pre>
        <p>但是，请注意，因为顶级组件是匿名组件，从 <code>/</code> 路由跳转到 <code>/form</code> 路由（反之依然）将会移除匿名组件，并重新创建 DOM。如果布局组件定义了<a href="./lifecycle-methods.html">生命周期方法</a>，每次路由改变时，会触发 <code>oninit</code> 和 <code>oncreate</code> 钩子。</p>
        <p>如果你希望布局组件能进行 diff，而不是从头创建，则应该使用 RouteResolver 作为根对象：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 示例 2
m.route(document.body, "/", {
    "/": {
        render: function() {
            return m(Layout, m(Home))
        },
    },
    "/form": {
        render: function() {
            return m(Layout, m(Form))
        },
    }
})'); ?></code></pre>
        <p>在这种情况下，布局组件的 <code>oninit</code> 和 <code>oncreate</code> 生命周期方法只有在第一次路由改变时才会触发（假设所有路由使用相同的布局）。</p>
        <p>为了理清两个示例之间的区别，示例 1 相当于：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 功能和示例 1 相同
var Anon1 = {
    view: function() {
        return m(Layout, m(Home))
    },
}
var Anon2 = {
    view: function() {
        return m(Layout, m(Form))
    },
}

m.route(document.body, "/", {
    "/": {
        render: function() {
            return m(Anon1)
        }
    },
    "/form": {
        render: function() {
            return m(Anon2)
        }
    },
})'); ?></code></pre>
        <p>因为 <code>Anon1</code> 和 <code>Anon2</code> 是不同的组件，它们的子树（包括 <code>Layout</code>）是从头开始创建的。这也是直接使用组件，而不使用 RouteResolver 时会发生的情况。</p>
        <p>在示例 2 中，因为 <code>Layout</code> 是所有路由的顶级组件，<code>Layout</code> 组件会进行 diff，并且只有从 <code>Home</code> 切换到 <code>Form</code> 才会触发子元素的重建。</p>

        <h3 id="authentication"><a href="#authentication">验证</a></h3>
        <p>RouterResolver 的 <code>onmatch</code> 钩子可以在路由的顶级组件初始化之前执行一些逻辑。下面的示例显示了如何实现登录验证，除非用户登录，否则阻止用户看到 <code>/secret</code> 页面。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var isLoggedIn = false

var Login = {
    view: function() {
        return m("form", [
            m("button[type=button]", {
                onclick: function() {
                    isLoggedIn = true
                    m.route.set("/secret")
                }
            }, "Login")
        ])
    }
}

m.route(document.body, "/secret", {
    "/secret": {
        onmatch: function() {
            if (!isLoggedIn) m.route.set("/login")
            else return Home
        }
    },
    "/login": Login
})'); ?></code></pre>
        <p>当应用加载时，<code>onmatch</code> 方法会被调用，以为 <code>isLoggedIn</code> 是 false，所以会跳转到 <code>/login</code>。用户点击登录按钮后，<code>isLoggedIn</code> 被设置为 true，且应用跳转到 <code>/secret</code>，<code>onmatch</code> 钩子会再次被调用，因为这次 <code>isLoggedIn</code> 已经是 true 了，所以应用会渲染 <code>Home</code> 组件。</p>
        <p>为了简单起见，在上例中，用户的登录状态保存在全局变量中，并且用户点击登录按钮时，仅仅只是改变该变量的值。在真正的项目中，用户需要输入正确的用户名密码，点击登录按钮后向服务器发送请求来验证用户：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Auth = {
    username: "",
    password: "",

    setUsername: function(value) {
        Auth.username = value
    },
    setPassword: function(value) {
        Auth.password = value
    },
    login: function() {
        m.request({
            url: "/api/v1/auth",
            data: {username: Auth.username, password: Auth.password}
        }).then(function(data) {
            localStorage.setItem("auth-token": data.token)
            m.route.set("/secret")
        })
    }
}

var Login = {
    view: function() {
        return m("form", [
            m("input[type=text]", {oninput: m.withAttr("value", Auth.setUsername), value: Auth.username}),
            m("input[type=password]", {oninput: m.withAttr("value", Auth.setPassword), value: Auth.password}),
            m("button[type=button]", {onclick: Auth.login, "Login")
        ])
    }
}

m.route(document.body, "/secret", {
    "/secret": {
        onmatch: function() {
            if (!localStorage.getItem("auth-token")) m.route.set("/login")
            else return Home
        }
    },
    "/login": Login
})'); ?></code></pre>

        <h3 id="preloading-data"><a href="#preloading-data">预加载数据</a></h3>
        <p>通常，组件可以在初始化时加载数据。以这种方法加载数据会渲染组件两次（路由一次，请求完成一次）。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var state = {
    users: [],
    loadUsers: function() {
        return m.request("/api/v1/users").then(function(users) {
            state.users = users
        })
    }
}

m.route(document.body, "/user/list", {
    "/user/list": {
        oninit: state.loadUsers,
        view: function() {
            return state.users.length > 0 ? state.users.map(function(user) {
                return m("div", user.id)
            }) : "loading"
        }
    },
})'); ?></code></pre>
        <p>在上面的例子中，第一次渲染后，会显示 <code>“loading”</code>，因为在请求完成前，<code>state.users</code> 是一个空数组。一旦数据加载完成，组件会进行重绘，并显示用户 id 列表。</p>
        <p>RouteResolvers 可以作为渲染组件之前预加载数据的机制，以避免 UI 闪烁：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var state = {
    users: [],
    loadUsers: function() {
        return m.request("/api/v1/users").then(function(users) {
            state.users = users
        })
    }
}

m.route(document.body, "/user/list", {
    "/user/list": {
        onmatch: state.loadUsers,
        render: function() {
            return state.users.map(function(user) {
                return m("div", user.id)
            })
        }
    },
})'); ?></code></pre>
        <p>上面的示例中，只有请求完成后才会执行 <code>render</code>，因此不再需要三元操作符。</p>

        <h3 id="code-splitting"><a href="#code-splitting">代码拆分</a></h3>
        <p>在大型项目中，可能需要按需下载每个路由对应的代码，而不是预先加载所有代码。这种方式称为代码分割或延迟加载。在 Mithril 中，可以通过从 <code>onmatch</code> 钩子返回 Promise 来实现。</p>
        <p>下面是最简单的形式：</p>
        <pre class="doc-code" data-filename="Home.js"><code class="lang-js"><?php echo htmlentities('module.export = {
    view: function() {
        return [
            m(Menu),
            m("h1", "Home")
        ]
    }
}'); ?></code></pre>
        <pre class="doc-code" data-filename="index.js"><code class="lang-js"><?php echo htmlentities('function load(file) {
    return m.request({
        method: "GET",
        url: file,
        extract: function(xhr) {
            return new Function("var module = {};" + xhr.responseText + ";return module.exports;")
        }
    })
}

m.route(document.body, "/", {
    "/": {
        onmatch: function() {
            return load("Home.js")
        },
    },
})'); ?></code></pre>
        <p>但是，为了在生产级规模上使用，需要把 <code>Home.js</code> 模块的所有依赖打包到一个单独的文件中。</p>
        <p>又许多工具可以实现模块打包进行延迟加载。以下是使用 <a href="https://webpack.github.io/docs/code-splitting.html">Webpack 的代码分割系统</a>的示例：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.route(document.body, "/", {
    "/": {
        onmatch: function() {
            // using Webpack async code splitting
            return new Promise(function(resolve) {
                require([\'./Home.js\'], resolve)
            })
        },
    },
})'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>