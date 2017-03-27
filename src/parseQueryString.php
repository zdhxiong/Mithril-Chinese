<?php
$vars['title'] = 'parseQueryString(string)';
$vars['filename'] = 'parseQueryString';
$vars['prev'] = array(
    'filename' => 'jsonp',
    'title' => 'jsonp(options)'
);
$vars['next'] = array(
    'filename' => 'buildQueryString',
    'title' => 'buildQueryString(object)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>parseQueryString(string)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>把表单的查询字符串转为对象</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var object = m.parseQueryString("a=1&b=2")
// {a: "1", b: "2"}'); ?></code></pre>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('object = m.parseQueryString(string)'); ?></code></pre>
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
                    <td><code>string</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>一个查询字符串</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Object</code></th>
                    <th></th>
                    <th>键值对</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p><code>m.parseQueryString</code> 可以从查询字符串创建一个对象。处理 URL 中的数据时比较有用</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var data = m.parseQueryString("a=hello&b=world")

// data is {a: "hello", b: "world"}'); ?></code></pre>

        <h3 id="boolean-type-casting">布尔类型转换</h3>
        <p>此方法会尝试转换布尔值。这样有助于避免产生类型相关的 bug。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var data = m.parseQueryString("a=true&b=false")

// data is {a: true, b: false}'); ?></code></pre>

        <h3 id="leading-question-mark-tolerance">忽略前置的问号</h3>
        <p>为方便起见，<code>m.parseQueryString</code> 会忽略前置的问号。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var data = m.parseQueryString("?a=hello&b=world")

// data is {a: "hello", b: "world"}'); ?></code></pre>

        <h3 id="deep-data-structures">数组</h3>
        <p>Querystring 中带中括号时，会解析成数组</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.parseQueryString("a[0]=hello&a[1]=world")

// data is {a: ["hello", "world"]}'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>