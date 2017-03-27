<?php
$vars['title'] = 'buildQueryString(object)';
$vars['filename'] = 'buildQueryString';
$vars['prev'] = array(
    'filename' => 'parseQueryString',
    'title' => 'parseQueryString(string)'
);
$vars['next'] = array(
    'filename' => 'withAttr',
    'title' => 'withAttr(attrName, callback)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>buildQueryString(object)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>把对象转换为查询字符串</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var querystring = m.buildQueryString({a: "1", b: "2"})
// "a=1&b=2"'); ?></code></pre>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('querystring = m.buildQueryString(object)'); ?></code></pre>
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
                    <td><code>object</code></td>
                    <td><code>Object</code></td>
                    <td>是</td>
                    <td>一个键值对形式的对象</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>String</code></th>
                    <th></th>
                    <th>一个查询字符串</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p><code>m.buildQueryString</code> 从对象创建查询字符串。它对于操作 URL 很有用</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var querystring = m.buildQueryString({a: 1, b: 2})

// querystring is "a=1&b=2"'); ?></code></pre>

        <h3 id="deep-data-structures">数组</h3>
        <p>数组会以主流的服务端语言（例如 PHP、Rails 和 ExpressJS）所理解的方式进行序列化</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var querystring = m.buildQueryString({a: ["hello", "world"]})

// querystring is "a[0]=hello&a[1]=world"'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>