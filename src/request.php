<?php
$vars['title'] = 'request(options)';
$vars['filename'] = 'request';
$vars['prev'] = array(
    'filename' => 'route',
    'title' => 'route(root, defaultRoute, routes)'
);
$vars['next'] = array(
    'filename' => 'jsonp',
    'title' => 'jsonp(options)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>request(options)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature"></a>签名</li>
            <li><a href="#how-it-works">工作原理</a></li>
            <li><a href="#typical-usage">典型用法</a></li>
            <li><a href="#loading-icons-and-error-messages">加载中图标和错误消息</a></li>
            <li><a href="#dynamic-urls">带参数的 URL</a></li>
            <li><a href="#aborting-requests">取消请求</a></li>
            <li><a href="#file-uploads">文件上传</a></li>
            <li><a href="#multiple-file-uploads">多个文件上传</a></li>
            <li><a href="#monitoring-progress">检测进度</a></li>
            <li><a href="#casting-response-to-a-type">对请求结果进行处理</a></li>
            <li><a href="#non-json-responses">非 JSON 格式的响应</a></li>
            <li><a href="#retrieving-response-details">获取响应详情</a></li>
            <li><a href="#avoid-anti-patterns">避免反模式</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>发送 XHR（又名 AJAX）请求，返回 <a href="./promise.html">promise</a>：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "PUT",
    url: "/api/v1/users/:id",
    data: {id: 1, name: "test"}
})
.then(function(result) {
    console.log(result)
})'); ?></code></pre>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('promise = m.request([url,] options)'); ?></code></pre>
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
                    <td><code>url</code></td>
                    <td><code>String</code></td>
                    <td>否</td>
                    <td>如果存在该参数，相当于设置了 <code>{method: "GET", url: url}</code>，该对象会覆盖 options 中对应的值。</td>
                </tr>
                <tr>
                    <td><code>options.method</code></td>
                    <td><code>String</code></td>
                    <td>否</td>
                    <td>使用的 HTTP 方法。值必须是以下之一：<code>GET</code>、<code>POST</code>、<code>PUT</code>、<code>PATCH</code>、<code>DELETE</code>、<code>HEAD</code>、<code>OPTIONS</code>。默认为 <code>GET</code>。</td>
                </tr>
                <tr>
                    <td><code>options.url</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>请求会发送到该 URL。该 URL 可以是绝对路径，也可以是相对路径，且可以包含 <a href="http://mithril.js.org/request.html#dynamic-urls">URL 参数</a>。</td>
                </tr>
                <tr>
                    <td><code>options.data</code></td>
                    <td><code>any</code></td>
                    <td>否</td>
                    <td>添加到请求的数据。对于 GET 请求，会序列化为查询字符串，并添加到 URL 中。对于其他请求，会添加到 body 中。</td>
                </tr>
                <tr>
                    <td><code>options.async</code></td>
                    <td><code>Boolean</code></td>
                    <td>否</td>
                    <td>请求是否异步。默认为 <code>true</code>。</td>
                </tr>
                <tr>
                    <td><code>options.user</code></td>
                    <td><code>String</code></td>
                    <td>否</td>
                    <td>用于 HTTP 验证的 username。默认为 <code>undefined</code>。</td>
                </tr>
                <tr>
                    <td><code>options.password</code></td>
                    <td><code>String</code></td>
                    <td>否</td>
                    <td>用于 HTTP 验证的 password。默认为 <code>undefined</code>。此参数用于兼容 <code>XMLHttpRequest</code>，但你应该避免使用此参数，因为它会明文发送密码。</td>
                </tr>
                <tr>
                    <td><code>options.withCredentials</code></td>
                    <td><code>Boolean</code></td>
                    <td>否</td>
                    <td>是否把 cookie 发送到第三方域名。默认为 <code>false</code>。</td>
                </tr>
                <tr>
                    <td><code>options.config</code></td>
                    <td><code>xhr = Function(xhr)</code></td>
                    <td>否</td>
                    <td>用于配置 XMLHttpRequest 对象。默认为<a href="https://zh.wikipedia.org/wiki/%E6%81%86%E7%AD%89%E5%87%BD%E6%95%B8">恒等函数</a>。</td>
                </tr>
                <tr>
                    <td><code>options.headers</code></td>
                    <td><code>Object</code></td>
                    <td>否</td>
                    <td>用于添加到请求的 Header 中（该参数会在设置 <code>options.config</code> 之前设置）。</td>
                </tr>
                <tr>
                    <td><code>options.type</code></td>
                    <td><code>any = Function(any)</code></td>
                    <td>否</td>
                    <td>响应中的每个对象的构造函数，即得到请求结果后，会先使用该函数进行处理。默认为<a href="https://zh.wikipedia.org/wiki/%E6%81%86%E7%AD%89%E5%87%BD%E6%95%B8">恒等函数</a>。</td>
                </tr>
                <tr>
                    <td><code>options.serialize</code></td>
                    <td><code>string = Function(any)</code></td>
                    <td>否</td>
                    <td>序列化 <code>data</code> 的方法。默认为 <code>JSON.stringify</code>，或者当 <code>options.data</code> 是一个 <a href="https://developer.mozilla.org/en/docs/Web/API/FormData">FormData</a> 实例时，默认为<a href="https://zh.wikipedia.org/wiki/%E6%81%86%E7%AD%89%E5%87%BD%E6%95%B8">恒等函数</a>。</td>
                </tr>
                <tr>
                    <td><code>options.deserialize</code></td>
                    <td><code>any = Function(string)</code></td>
                    <td>否</td>
                    <td>对请求的响应进行反序列化的方式。默认是对 <code>JSON.parse</code> 进行的封装，如果是空响应，会返回 <code>null</code>。</td>
                </tr>
                <tr>
                    <td><code>options.extract</code></td>
                    <td><code>string = Function(xhr, options)</code></td>
                    <td>否</td>
                    <td>一个钩子，指定如何读取 XMLHttpRequest 的响应。可用于读取响应的 header 和 cookie。默认为返回 <code>xhr.responseText</code> 的函数。如果定义了该参数，则其中的 <code>xhr</code> 表示请求的 XMLHttpRequest 的实例，<code>options</code> 则是传入到 <code>m.request</code> 中的对象。如果设置了自定义的 <code>extract</code> 回调，则会忽略 <code>options.deserialize</code>，且 extract 回调返回的字符串不会被解析为 JSON。</td>
                </tr>
                <tr>
                    <td><code>options.useBody</code></td>
                    <td><code>Boolean</code></td>
                    <td>否</td>
                    <td>当设置为 <code>true</code> 时，强制把所有请求的 <code>data</code> 都放在 HTTP 的 body 中；当设置为 <code>false</code> 时，强制把所有请求的 <code>data</code> 都放在请求的查询字符串中。默认 <code>GET</code> 请求为 <code>false</code>，其他请求为 <code>true</code>。</td>
                </tr>
                <tr>
                    <td><code>options.background</code></td>
                    <td><code>Boolean</code></td>
                    <td>否</td>
                    <td>如果为 <code>false</code>，则在请求完成后重绘已挂载的组件；如果为 <code>true</code>，则不会重绘。默认为 <code>false</code>。</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>在 <code>extract</code>、<code>deserialize</code> 和 <code>type</code> 方法完成之后，返回 promise 用于处理响应的数据。</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p><code>m.request</code> 工具是对 <a href="https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest">XMLHttpRequest</a> 的轻量级的封装，用于发送 HTTP 请求到服务器，从而从数据库保存或读取数据。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "GET",
    url: "/api/v1/users",
})
.then(function(users) {
    console.log(users)
})'); ?></code></pre>
        <p>调用 <code>m.request</code> 后会返回 <a href="./promise.html">promise</a>，并在 promise 完成后触发重绘。</p>
        <p>默认情况下，<code>m.request</code> 假设响应的格式为 JSON，并将其解析为 JavaScript 对象（或数组）。</p>

        <h2 id="typical-usage"><a href="#typical-usage">典型用法</a></h2>
        <p>这是一个说明性示例，组件使用 <code>m.request</code> 来从服务器获取一些数据。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Data = {
    todos: {
        list: [],
        fetch: function() {
            m.request({
                method: "GET",
                url: "/api/v1/todos",
            })
            .then(function(items) {
                Data.todos.list = items
            })
        }
    }
}

var Todos = {
    oninit: Data.todos.fetch,
    view: function(vnode) {
        return Data.todos.list.map(function(item) {
            return m("div", item.title)
        })
    }
}

m.route(document.body, "/", {
    "/": Todos
})'); ?></code></pre>
        <p>我们假设 <code>/api/items</code> 会返回 JSON 格式的数据。</p>
        <p>当调用 <code>m.route</code> 时，<code>Todos</code> 组件被初始化。然后会调用 <code>oninit</code> 方法来调用 <code>m.request</code>。这将从服务器异步获取一组对象。“异步” 意味着在等待服务器响应时，JavaScript 会继续执行其他代码。在这种情况下，意味着 <code>fetch</code> 返回时，组件会用 <code>Data.todos.list</code> 这个空数组来渲染。一旦请求完成，返回的 <code>items</code> 赋值给 <code>Data.todos.list</code>，并重新渲染组件，从而产生一个包含 todo 的 <code><?php echo htmlentities('<div>'); ?></code> 列表。</p>

        <h2 id="loading-icons-and-error-messages"><a href="#loading-icons-and-error-messages">加载中图标和错误消息</a></h2>
        <p>这是对上面示例的扩展，实现了加载指示符和错误消息：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Data = {
    todos: {
        list: null,
        error: "",
        fetch: function() {
            m.request({
                method: "GET",
                url: "/api/v1/todos",
            })
            .then(function(items) {
                Data.todos.list = items
            })
            .catch(function(e) {
                Data.todos.error = e.message
            })
        }
    }
}

var Todos = {
    oninit: Data.todos.fetch,
    view: function(vnode) {
        return Data.todos.error ? [
            m(".error", Data.todos.error)
        ] : Data.todos.list ? [
            Data.todos.list.map(function(item) {
                return m("div", item.title)
            })
        ] : m(".loading-icon")
    }
}

m.route(document.body, "/", {
    "/": Todos
})'); ?></code></pre>
        <p>这个例子和之前的例子有一些区别。这个例子中，<code>Data.todos.list</code> 默认为 <code>null</code>。并且添加了 <code>error</code> 字段用于显示错误信息，并且 <code>Todos</code> 组件的视图会在存在错误时显示错误信息，或者在 <code>Data.todos.list</code> 为空时显示加载中图标。</p>

        <h2 id="dynamic-urls"><a href="#dynamic-urls">带参数的 URL</a></h2>
        <p>请求的 URL 可以包含参数：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "GET",
    url: "/api/v1/users/:id",
    data: {id: 123},
}).then(function(user) {
    console.log(user.id) // logs 123
})'); ?></code></pre>
        <p>在上面的代码中，<code>:id</code> 参数会用 <code>{id: 123}</code> 对象中的数据替换，请求变成 <code>GET /api/v1/users/123</code>。</p>
        <p>如果 <code>data</code> 属性中没有匹配的数据，则不会对参数进行替换。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "GET",
    url: "/api/v1/users/foo:bar",
    data: {id: 123},
})'); ?></code></pre>
        <p>在上面的代码中，请求为 <code>GET /api/v1/users/foo:bar</code>。</p>

        <h2 id="aborting-requests"><a href="#aborting-requests">取消请求</a></h2>
        <p>有时，需要在请求还没完成时取消请求。例如，在自动完成组件中，在用户输入时，会连续发送多次请求，你只需要获取最后一次请求返回的数据，但请求返回的顺序并不一定和请求发送顺序一致。如果有一个请求在最后一个触发的请求之后完成，则组件可能显示和用户输入不相关的数据。</p>
        <p><code>m.request</code> 可以通过 <code>options.config</code> 暴露出其底层的 <code>XMLHttpRequest</code> 对象，使你可以在需要时调用它的 <code>abort</code> 方法：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var searchXHR = null
function search() {
    abortPreviousSearch()

    m.request({
        method: "GET",
        url: "/api/v1/users",
        data: {search: query},
        config: function(xhr) {searchXHR = xhr}
    })
}
function abortPreviousSearch() {
    if (searchXHR !== null) searchXHR.abort()
    searchXHR = null
}'); ?></code></pre>

        <h2 id="file-uploads"><a href="#file-uploads">文件上传</a></h2>
        <p>要上传文件，首先要获取 <a href="https://developer.mozilla.org/en/docs/Web/API/File">File</a> 对象的引用。最简单的方法是使用 <code><?php echo htmlentities('<input type="file">'); ?></code>：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(document.body, [
    m("input[type=file]", {onchange: upload})
])

function upload(e) {
    var file = e.target.files[0]
}'); ?></code></pre>
        <p>以上代码会渲染一个文件选择器。如果用户选择了一个文件，<code>onchange</code> 事件会触发，调用 <code>upload</code> 函数。<code>e.target.files</code> 则是 <code>File</code> 对象的数组。</p>
        <p>然后，你需要创建一个 <a href="https://developer.mozilla.org/en/docs/Web/API/FormData">FormData</a> 对象来创建 <a href="https://www.w3.org/Protocols/rfc1341/7_2_Multipart.html">Multipart 请求</a>，这是一个指定格式 HTTP 请求，可以在请求的 body 中发送文件数据：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function upload(e) {
    var file = e.target.files[0]

    var data = new FormData()
    data.append("myfile", file)
}'); ?></code></pre>
        <p>然后，你需要调用 <code>m.request</code>，并把 <code>options.method</code> 设置为请求方式（如 <code>POST</code>、<code>PUT</code>、<code>PATCH</code>），以及把 <code>options.data</code> 设置为 <code>FormData</code>。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function upload(e) {
    var file = e.target.files[0]

    var data = new FormData()
    data.append("myfile", file)

    m.request({
        method: "POST",
        url: "/api/v1/upload",
        data: data,
    })
}'); ?></code></pre>
        <p>假设服务器设置为可接受 multipart 请求，则文件信息会和 <code>myfile</code> 相关联。</p>

        <h2 id="multiple-file-uploads"><a href="#multiple-file-uploads">多个文件上传</a></h2>
        <p>可以在一个请求中上传多个文件。但这样会使批量上传具有原子性，例如在上传过程中出现错误，则不会处理任何文件，因此不能只上传部分文件。如果你想在网络不稳定的情况下保存已处理的文件，则应该把每个文件放在单独的请求中上传。</p>
        <p>要上传多个文件，只需将其全部添加到 <code>FormData</code> 对象。当使用文件输入框时，可以通过在输入框上添加 <code>multiple</code> 来选择多个文件：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(document.body, [
    m("input[type=file][multiple]", {onchange: upload})
])

function upload(e) {
    var files = e.target.files

    var data = new FormData()
    for (var i = 0; i < files.length; i++) {
        data.append("file" + i, file)
    }

    m.request({
        method: "POST",
        url: "/api/v1/upload",
        data: data,
    })
}'); ?></code></pre>

        <h2 id="monitoring-progress"><a href="#monitoring-progress">检测进度</a></h2>
        <p>有时，如果一个请求本身就很慢（例如上传大文件），则需要向用户显示一个进度指示符，以表明应用仍在处理请求。</p>
        <p><code>m.request</code> 通过 <code>options.config</code> 向外暴露底层的 <code>XMLHttpRequest</code> 对象，你可以为 <code>XMLHttpRequest</code> 对象添加事件监听：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var progress = 0

m.mount(document.body, {
    view: function() {
        return [
            m("input[type=file]", {onchange: upload}),
            progress + "% completed"
        ]
    }
})

function upload(e) {
    var file = e.target.files[0]

    var data = new FormData()
    data.append("myfile", file)

    m.request({
        method: "POST",
        url: "/api/v1/upload",
        data: data,
        config: function(xhr) {
            xhr.addEventListener("progress", function(e) {
                progress = e.loaded / e.total

                m.redraw() // tell Mithril that data changed and a re-render is needed
            })
        }
    })
}'); ?></code></pre>
        <p>在上面的例子中，渲染了一个文件输入框。如果用户选择了一个文件，则会启动上传，并在 <code>config</code> 回调中，注册了一个 <code>progress</code> 事件处理函数。只要 <code>XMLHttpRequest</code> 中有进度更新，就会触发此事件处理函数。因为 <code>XMLHttpRequest</code> 的进度事件不是由 Mithril 的虚拟 DOM 引擎直接处理的，所以必须调用 <code>m.redraw()</code>，以通知 Mithril 数据已更改，需要进行重绘。</p>

        <h2 id="casting-response-to-a-type"><a href="#casting-response-to-a-type">对请求结果进行处理</a></h2>
        <p>你可能需要将请求返回的数据进行类型转换（例如，统一对日期字段进行格式化）。</p>
        <p>你可以传入构造函数作为 <code>options.type</code> 的参数，Mithril 将为 HTTP 响应中的每个对象进行实例化。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function User(data) {
    this.name = data.firstName + " " + data.lastName
}

m.request({
    method: "GET",
    url: "/api/v1/users",
    type: User
})
.then(function(users) {
    console.log(users[0].name) // logs a name
})'); ?></code></pre>
        <p>在上面的示例中，假如 <code>/api/v1/users</code> 返回了一个对象数组，<code>User</code> 构造函数会为每个对象进行实例化（如，调用 <code>new User(data)</code>）。如果响应返回了单个对象，该对象会被用作 <code>data</code> 参数。</p>

        <h2 id="non-json-responses"><a href="#non-json-responses">非 JSON 格式的响应</a></h2>
        <p>有时服务端返回的不是 JSON 格式的响应：例如你请求的是 HTML 文件、SVG 文件或 CSV 文件。默认情况下，Mithril 会把它当成 JSON 来解析。你可以使用 <code>options.deserialize</code> 函数来修改解析方式：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "GET",
    url: "/files/icon.svg",
    deserialize: function(value) {return value}
})
.then(function(svg) {
    m.render(document.body, m.trust(svg))
})'); ?></code></pre>
        <p>在上面的示例中，请求了一个 SVG 文件，不进行任何解析（因为 <code>deserialize</code> 函数直接返回了原始值），然后直接将 SVG 字符串显示为 HTML。</p>
        <p>当然，<code>deserialize</code> 的功能可以更加详细：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "GET",
    url: "/files/data.csv",
    deserialize: parseCSV
})
.then(function(data) {
    console.log(data)
})

function parseCSV(data) {
    // 为了保持例子的简单，这里用了最简单的实现方式
    return data.split("\n").map(function(row) {
        return row.split(",")
    })
}'); ?></code></pre>
        <p>上面的例子会输出一个二维数组。</p>
        <p>自定义 header 也是有用的。例如，你请求一个 SVG 文件，你可能需要设置相应的内容类型。要覆盖默认的 JSON 请求类型，把 <code>options.headers</code> 设置成请求头名称和值的键值对对象。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "GET",
    url: "/files/image.svg",
    headers: {
        "Content-Type": "image/svg+xml; charset=utf-8",
        "Accept": "image/svg, text/*"
    },
    deserialize: function(value) {return value}
})'); ?></code></pre>

        <h2 id="retrieving-response-details"><a href="#retrieving-response-details">获取响应详情</a></h2>
        <p>默认情况下，Mithril 会以 JSON 格式解析响应，并返回 <code>xhr.responseText</code>。有时需要获取更详细的响应信息，这时可以传入自定义的 <code>options.extract</code> 函数来实现：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.request({
    method: "GET",
    url: "/api/v1/users",
    extract: function(xhr) {return {status: xhr.status, body: xhr.responseText}}
})
.then(function(response) {
    console.log(response.status, response.body)
})'); ?></code></pre>
        <p>一旦请求完成，在返回 promise 之前，<code>options.extract</code> 的参数就会被填充为 <code>XMLHttpRequest</code> 对象，所以如果 <code>options.extract</code> 中发生异常，promise 仍然可以处于拒绝状态。</p>

        <h2 id="avoid-anti-patterns"><a href="#avoid-anti-patterns">避免反模式</a></h2>

        <h3>Promise 不是响应的数据</h3>
        <p><code>m.request</code> 请求返回 <a href="./promise.html">Promise</a>，而不是响应数据本身。因为一个 HTTP 请求可能需要比较长时间来完成（由于网络延迟），如果 JavaScript 等待请求完成，则它会冻结应用，直到得到响应数据。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 错误用法
var users = m.request("/api/v1/users")
console.log("list of users:", users)
// `users` 不是用户列表哦，而是 promise

// 正确用法
m.request("/api/v1/users").then(function(users) {
    console.log("list of users:", users)
})'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>