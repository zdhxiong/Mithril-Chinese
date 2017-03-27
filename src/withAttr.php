<?php
$vars['title'] = 'withAttr(attrName, callback)';
$vars['filename'] = 'withAttr';
$vars['prev'] = array(
    'filename' => 'buildQueryString',
    'title' => 'buildQueryString(object)'
);
$vars['next'] = array(
    'filename' => 'trust',
    'title' => 'trust(html)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>withAttr(attrName, callback)</h1>

    <nav class="doc-toc">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
            <li><a href="#predictable-event-target">预测事件目标</a></li>
            <li><a href="#attributes-and-properties">属性（attribute 和 property）</a></li>
        </ul>
    </nav>

    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>返回一个事件处理函数，用指定 DOM 元素的值作为参数。</p>
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

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.withAttr(attrName, callback, thisArg?)'); ?></code></pre>
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
                    <td><code>attrName</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>属性名称，该属性的值会被传入回调函数</td>
                </tr>
                <tr>
                    <td><code>callback</code></td>
                    <td><code>any -> undefined</code></td>
                    <td>是</td>
                    <td>回调</td>
                </tr>
                <tr>
                    <td><code>thisArg</code></td>
                    <td><code>any</code></td>
                    <td>否</td>
                    <td>在回调函数中，绑定到 <code>this</code> 关键字上的对象</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Event -> undefined</code></th>
                    <th></th>
                    <th>事件处理函数</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p><code>m.withAttr</code> 方法创建一个事件处理函数。该事件处理函数会调用一个函数，且以指定 DOM 元素的指定属性值作为参数。</p>
        <p>这个辅助函数可以用于把浏览器的事件模型从应用代码中分离。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 独立使用
document.body.onclick = m.withAttr("title", function(value) {
    console.log(value) // 点击时，输出 <body> 元素的标题
})'); ?></code></pre>
        <p>通常，<code>m.withAttr()</code> 可以用在组件的视图中，避免 DOM 事件模型污染数据层：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var state = {
    email: "",
    setEmail: function(email) {
        state.email = email.toLowerCase()
    }
}

var MyComponent = {
    view: function() {
        return m("input", {
            oninput: m.withAttr("value", state.setEmail),
            value: state.email
        })
    }
}

m.mount(document.body, MyComponent)'); ?></code></pre>

        <h2 id="predictable-event-target"><a href="#predictable-event-target">预测事件目标</a></h2>
        <p><code>m.withAttr()</code> 会读取事件处理函数绑定的元素的值，不需要和触发事件的元素相同。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var state = {
    url: "",
    setURL: function(url) {state.url = url}
}

var MyComponent = {
    view: function() {
        return m("a[href=\'/foo\']", {onclick: m.withAttr("href", state.setURL)}, [
            m("span", state.url)
        ])
    }
}

m.mount(document.body, MyComponent)'); ?></code></pre>
        <p>在上面的代码中，如果用户点击了链接中的文本，<code>e.target</code> 会指向 <code><?php echo htmlentities('<span>'); ?></code>，而不是 <code><?php  echo htmlentities('<a>');?></code></p>
        <p>虽然这个行为是按照规范进行的，但很多时候并不使用。因此，<code>m.withAttr</code> 使用 <code>e.currentTarget</code> 的值，它会指向 <code><?php echo htmlentities('<a>'); ?></code>，通常会更适合。</p>

        <h2 id="attributes-and-properties"><a href="#attributes-and-properties">属性（attribute 和 property）</a></h2>
        <p><code>m.withAttr()</code> 的第一个参数是属性名（attribute 或 property 都可以）。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 从 `select.selectedIndex` 属性中读取值
var state = {
    index: 0,
    setIndex: function(index) {state.index = index}
}
m("select", {onclick: m.withAttr("selectedIndex", state.setIndex)})'); ?></code></pre>
        <p>如果参数名既是 attribute，也是 property，则会使用 property 的值。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// value 是布尔值，因为 `input.checked` 属性是布尔值
var state = {
    selected: false,
    setSelected: function(selected) {state.selected = selected}
}
m("input[type=checkbox]", {onclick: m.withAttr("checked", state.setSelected)})'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>