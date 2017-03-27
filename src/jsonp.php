<?php
$vars['title'] = 'jsonp(options)';
$vars['filename'] = 'jsonp';
$vars['prev'] = array(
    'filename' => 'request',
    'title' => 'request(options)'
);
$vars['next'] = array(
    'filename' => 'parseQueryString',
    'title' => 'parseQueryString(string)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>jsonp(options)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
            <li><a href="#typical-usage">典型用法</a></li>

        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>发送 JSON-P 请求。通常，用于与没有开启 CORS，但允许 JSON-P 的服务器进行交互。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.jsonp({
    url: "/api/v1/users/:id",
    data: {id: 1},
    callbackKey: "callback",
})
.then(function(result) {
    console.log(result)
})'); ?></code></pre>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('promise = m.jsonp([url,] options)'); ?></code></pre>
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
                    <td>如果存在该参数，相当于设置了 <code>{url: url}</code>。该对象会覆盖 options 中对应的值。</td>
                </tr>
                <tr>
                    <td><code>options.url</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>请求会发送到该 URL。该 URL 可以是绝对路径，也可以是相对路径，也可以包含<a href="./jsonp.html#dynamic-urls">URL 参数</a>。</td>
                </tr>
                <tr>
                    <td><code>options.data</code></td>
                    <td><code>any</code></td>
                    <td>否</td>
                    <td>该数据会被序列化成 querystring，并添加到 URL 中。</td>
                </tr>
                <tr>
                    <td><code>options.type</code></td>
                    <td><code>any = Function(any)</code></td>
                    <td>否</td>
                    <td>响应中的每个对象的构造函数，即得到请求结果后，会先使用该函数进行处理。默认为<a href="https://zh.wikipedia.org/wiki/%E6%81%86%E7%AD%89%E5%87%BD%E6%95%B8">恒等函数</a>。</td>
                </tr>
                <tr>
                    <td><code>options.callbackName</code></td>
                    <td><code>String</code></td>
                    <td>否</td>
                    <td>回调函数名称。默认为随机字符串（例如，<code>_mithril_6888197422121285_0({a: 1})</code>）</td>
                </tr>
                <tr>
                    <td><code>options.callbackKey</code></td>
                    <td><code>String</code></td>
                    <td>否</td>
                    <td>指定回调名称的查询字符串参数名。默认为 <code>callback</code>（例如，<code>/someapi?callback=_mithril_6888197422121285_0</code>）</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Promise</code></th>
                    <th></th>
                    <th>在通过 <code>options.type</code> 方法处理之后，解析为响应数据的 promise。</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p><code>m.jsonp</code> 工具用于可以返回 <a href="https://en.wikipedia.org/wiki/JSONP">JSON-P</a> 格式数据的第三方 API。</p>
        <p>JSON-P 会创建一个 <code>script</code> 标签，其 <code>src</code> 属性指向第三方服务器中的脚本。通常，你需要定义一个全局函数，并在脚本的 URL 的 querystring 中指定其名称。响应会返回调用全局函数的代码，并将服务器的数据作为第一个参数传入。</p>
        <p>JSON-P 有几个限制：它只能使用 GET 请求，它默认信任第三方服务器不会提供恶意代码，并且它会污染 JavaScript 的全局作用域。尽管如此，在服务器不支持 <a href="https://en.wikipedia.org/wiki/Cross-origin_resource_sharing">CORS</a> 时，它是从服务器获取数据的唯一方法。</p>

        <h2 id="typical-usage"><a href="#typical-usage">典型用法</a></h2>
        <p>一些服务遵守 JSON-P 的响应格式约定，使用 <code>callback</code> 作为查询字符串的 key，此时 <code>m.jsonp</code> 可以自动工作：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.jsonp({url: "https://api.github.com/users/lhorie"}).then(function(response) {
    console.log(response.data.login) // logs "lhorie"
})'); ?></code></pre>
        <p>某些服务不遵守约定，因此必须指定回调名称：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.jsonp({
    url: "https://api.flickr.com/services/feeds/photos_public.gne?tags=kitten&format=json",
    callbackKey: "jsoncallback",
})
.then(function(response) {
    console.log(response.link) // logs "https://www.flickr.com/photos/tags/kitten/"
})'); ?></code></pre>
        <p>有时，你只是想使用 GET 请求的缓存功能：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 该请求每次调用时 querystring 都相同，因此它会被缓存
m.jsonp({
    url: "https://api.github.com/users/lhorie",
    callbackName: "__callback",
})
.then(function(response) {
    console.log(response.data.login) // logs "lhorie"
})'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>