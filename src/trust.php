<?php
$vars['title'] = 'trust(html)';
$vars['filename'] = 'trust';
$vars['prev'] = array(
    'filename' => 'withAttr',
    'title' => 'withAttr(attrName, callback)'
);
$vars['next'] = array(
    'filename' => 'fragment',
    'title' => 'fragment(attrs, children)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>trust(html)</h1>
    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>把 HTML 字符串转换为未经转义的 HTML。不要对未经过滤的用户输入数据使用 <code>m.trust</code>。</p>
        <p>在考虑使用 <code>m.trust</code> 之前，优先考虑使用<a href="./trust.html#avoid-trusting-html">替代方法</a>。</p>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('vnode = m.trust(html)'); ?></code></pre>
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
                    <td><code>html</code></td>
                    <td><code>String</code></td>
                    <td>是</td>
                    <td>HTML 字符串</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Vnode</code></th>
                    <th></th>
                    <th>一个可信的 HTML 字符串生成的 <a href="./vnodes.html">vnode</a></th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>
        <p>Mithirl 会默认转义所有值，以防止 <a href="https://en.wikipedia.org/wiki/Cross-site_scripting">XSS 注入</a>。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var userContent = "<script>alert(\'evil\')</script>"
var view = m("div", userContent)

m.render(document.body, view)

// 等效 HTML
// <div>&lt;script&gt;alert(\'evil\')&lt;/script&gt;</div>'); ?></code></pre>
        <p>但是，有时候需要渲染富文本和格式化标签。为了实现这一需求，可以使用 <code>m.trust</code> 来创建可信任的 HTML <a href="./vnodes.html">vnode</a>。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var view = m("div", [
    m.trust("<h1>Here\'s some <em>HTML</em></h1>")
])

m.render(document.body, view)

// 等效 HTML
// <div><h1>Here\'s some <em>HTML</em></h1></div>'); ?></code></pre>
        <p>可信任的 HTML vnode 是一个对象，不是字符串；因此它们不能与普通字符串相加。</p>

        <h2 id="security-considerations"><a href="#security-considerations">安全方面的考虑</a></h2>
        <p>你必须对传入到 <code>m.trust</code> 的参数进行过滤，以确保 HTML 代码中没有恶意代码。如果你没有对 HTML 字符串进行过滤，就将其标记为可信任的字符串，HTML 字符串中的任何 JavaScript 代码都会被执行，且拥有页面的视图级别的权限。</p>
        <p>HTML 字符串中有多种方法来包含可执行代码。最常见的注入攻击是在 <code><?php echo htmlentities('<img>'); ?></code> 或 <code><?php echo htmlentities('<iframe>'); ?></code> 标签上添加 <code>onload</code> 或 <code>onerror</code> 属性，并使用不配对的引号（例如 <code>" onerror="alert(1)</code>）来注入可执行代码。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var data = {}

// 易受攻击的 HTML 字符串
var description = "<img alt=\'" + data.title + "\'> <span>" + data.description + "</span>"

// 使用 onload 属性进行攻击
data.description = "<img onload=\'alert(1)\'>"

// 使用不配对的引号进行攻击
data.description = "</span><img onload=\'alert(1)\'><span"

// 使用不配对的引号进行攻击
data.title = "\' onerror=\'alert(1)"

// 使用另一个属性进行攻击
data.title = "\' onmouseover=\'alert(1)"

// 不使用 JavaScript 进行的攻击
data.description = "<a href=\'http://evil.com/login-page-that-steals-passwords.html\'>Click here to read more</a>"'); ?></code></pre>
        <p>有无数种创建恶意代码的方式，因此强烈建议你使用<a href="https://en.wikipedia.org/wiki/Whitelist">白名单</a>来过滤 HTML 标签、属性、以及属性值，并使用<a href="https://en.wikipedia.org/wiki/Blacklisting">黑名单</a>来过滤用户输入。同时强烈建议你使用标准的 HTML 解析器，而不是用正则表达式进行清理，因为正则表达式对边缘情况难以测试。</p>

        <h2 id="scripts-that-do-not-run"><a href="#scripts-that-do-not-run">不运行的脚本</a></h2>
        <p>尽管有很多方法来使 HTML 字符串运行 JavaScript，但 <code><?php echo htmlentities('<script>'); ?></code> 标签出现在 HTML 字符串中时，就不会运行。</p>
        <p>由于历史原因，浏览器会忽略通过 innerHTML 插入到 DOM 中的 <code><?php echo htmlentities('<script>'); ?></code> 标签。这样做是因为，一旦元素渲染完成（具有可访问的 innerHTML 属性），渲染引擎时不能退回到解析阶段的，如果脚本调用类似于 <code>document.write("")</code> 的代码的话，无法重新渲染。</p>
        <p>这种浏览器行为对于 jQuery 开发者可能会感到惊讶，因为 jQuery 实现了专门查找 script 标签，并执行代码。Mithril 遵守浏览器行为。如果需要 jQuery 的行为，你可以把代码从 HTML 字符串移动到 <code>oncreate</code> 生命周期方法中，或者直接使用 jQuery。</p>

        <h2 id="avoid-trusting-html"><a href="#avoid-trusting-html">avoid-trusting-html</a></h2>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>