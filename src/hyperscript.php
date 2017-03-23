<?php
$vars['title'] = 'm(selector, attributes, children)';
$vars['filename'] = 'hyperscript';
$vars['prev'] = array(
    'filename' => 'api',
    'title' => 'API'
);
$vars['next'] = array(
    'filename' => 'render',
    'title' => 'render(element, vnodes)'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">m(selector, attributes, children)</h1>
    <div class="doc-chapter">
        <h2 id="description" class="doc-chapter-title mdui-text-color-theme"><a href="#description">说明</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>在 Mithril 视图中表示一个 HTML 元素：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("div", {class: "foo"}, "hello")
// 表示 <div class="foo">hello</div>'); ?></code></pre>
            <p>你也可以通过 Babel 插件<a href="https://babeljs.io/repl/#?code=%2F**%20%40jsx%20m%20*%2F%0A%3Ch1%3EMy%20first%20app%3C%2Fh1%3E">使用 HTML 语法</a>。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('/** jsx m */
<div class="foo">hello</div>'); ?></code></pre>
        </div>

        <h2 id="signature" class="doc-chapter-title mdui-text-color-theme"><a href="#signature">签名</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('vnode = m(selector, attributes, children)'); ?></code></pre>
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
                        <td><code>selector</code></td>
                        <td><code>String|Object</code></td>
                        <td>是</td>
                        <td>CSS 选择器或<a href="./components.html">组件</a></td>
                    </tr>
                    <tr>
                        <td><code>attributes</code></td>
                        <td><code>Object</code></td>
                        <td>否</td>
                        <td>HTML 属性或元素属性</td>
                    </tr>
                    <tr>
                        <td><code>children</code></td>
                        <td><code>Array<Vnode>|String|Number|Boolean</code></td>
                        <td>否</td>
                        <td>子 <a href="./vnodes.html">vnodes</a>。也可以写成<a href="./signatures.html#splats">解构参数</a>。</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>返回</th>
                        <th><code>Vnode</code></th>
                        <th></th>
                        <th><a href="./vnodes.html">vnode</a></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <p><a href="./signatures.html">如何阅读签名</a></p>
        </div>

        <h2 id="how-it-works" class="doc-chapter-title mdui-text-color-theme"><a href="#how-it-works">工作原理</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>Mithril 提供了一个 hyperscript 函数 <code>m()</code>，它可以用 JavaScript 语法表达任何 HTML 结构。它接受一个 <code>selector</code> 字符串（必须），一个 <code>attributes</code> 对象（可选）和一个 <code>children</code> 数组（可选）。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("div", {id: "box"}, "hello")

// 等效 HTML:
// <div id="box">hello</div>'); ?></code></pre>
            <p><code>m()</code> 函数返回的不是 DOM 元素，而是<a href="./vnodes.html">虚拟 DOM 节点</a>或这 vnode，它是一个用 JavaScript 对象表示的 DOM 元素。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// a vnode
var vnode = {tag: "div", attrs: {id: "box"}, children: [ /*...*/ ]}'); ?></code></pre>
            <p>可以使用 <a href="./render.html">m.render()</a> 函数把 vnode 转换为真实的 DOM 元素。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.render(document.body, m("br")) // 在 <body> 中输出了 <br>'); ?></code></pre>
            <p>多次调用 <code>m.render()</code> 时，只会对 DOM 中发生变更的部分进行更改，并不会每次都重新创建 DOM 树，因为重新创建 DOM 是非常耗费资源的，且会导致失去输入框的焦点等问题。</p>
        </div>

        <h2 id="flexibility" class="doc-chapter-title mdui-text-color-theme"><a href="#flexibility">灵活性</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>m()</code> 函数的参数非常灵活：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 简单的标签
m("div") // <div></div>

// 属性和子元素是可选的
m("a", {id: "b"}) // <a id="b"></a>
m("span", "hello") // <span>hello</span>

// 包含子节点
m("ul", [             // <ul>
    m("li", "hello"), //   <li>hello</li>
    m("li", "world"), //   <li>world</li>
])                    // </ul>

// 是否使用数组也是可选的
m("ul",               // <ul>
    m("li", "hello"), //   <li>hello</li>
    m("li", "world")  //   <li>world</li>
)                     // </ul>'); ?></code></pre>
        </div>

        <h2 id="css-selectors" class="doc-chapter-title mdui-text-color-theme"><a href="#css-selectors">CSS 选择器</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><code>m()</code> 函数的第一个参数可以是 CSS 选择器。它支持任何有效的 CSS 语法，包括：<code>#</code>（id），<code>.</code>（class）和 <code>[]</code>（属性）等。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("div#hello")
// <div id="hello"></div>

m("section.container")
// <section class="container"></section>

m("input[type=text][placeholder=Name]")
// <input type="text" placeholder="Name" />

m("a#exit.external[href=\'http://example.com\']", "Leave")
// <a id="exit" class="external" href="http://example.com">Leave</a>'); ?></code></pre>
            <p>如果省略了标签名，Mithril 会默认使用 <code>div</code> 标签。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m(".box.box-bordered") // <div class="box box-bordered"></div>'); ?></code></pre>
            <p>通常，建议你把 CSS 选择器用于静态属性（值不会改变的属性），并传入一个属性对象用于动态属性值。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var currentURL = "/"

m("a.link[href=/]", {
    class: currentURL === "/" ? "selected" : ""
}, "Home")

// 等效 HTML:
// <a href="/" class="link selected">Home</a>'); ?></code></pre>
            <p>如果在 <code>m()</code> 函数的第一个参数和第二个参数中都存在 CSS 类名，则它们会合并到一起。</p>
        </div>

        <h2 id="dom-attributes" class="doc-chapter-title mdui-text-color-theme"><a href="#dom-attributes">DOM 属性</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>Mithril 同时使用 JavaScript API 和 DOM API（<code>setAttribute</code>）来解析属性。这意味着你可以使用这两种语言来引用属性。</p>
            <p>例如，在 JavaScript API 中，<code>readonly</code> 属性称为 <code>element.readOnly</code>（注意大小写）。在 Mithril 中，下面所有的用法都是支持的：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("input", {readonly: true}) // 小写
m("input", {readOnly: true}) // 大写
m("input[readonly]")
m("input[readOnly]")'); ?></code></pre>
        </div>

        <h2 id="style-attribute" class="doc-chapter-title mdui-text-color-theme"><a href="#style-attribute">样式属性</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>Mithril 支持使用字符串或对象作为 <code>style</code> 的值。下面所有的用法都是支持的：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("div", {style: "background:red;"})
m("div", {style: {background: "red"}})
m("div[style=background:red]")'); ?></code></pre>
            <p>使用字符串作为 <code>style</code> 的值时，在重绘时会覆盖元素中的所有内敛样式。</p>
            <p>Mithril 不会为数字值添加单位。</p>
        </div>

        <h2 id="events" class="doc-chapter-title mdui-text-color-theme"><a href="#events">事件</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>Mithril 支持为所有的事件绑定事件处理程序，包括不是以 <code>on${event}</code> 这种规范定义的属性，例如 <code>touchstart</code>：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function doSomething(e) {
    console.log(e)
}

m("div", {onclick: doSomething})'); ?></code></pre>
        </div>

        <h2 id="properties" class="doc-chapter-title mdui-text-color-theme"><a href="#properties">属性</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>Mithril 支持可以通过属性访问的 DOM 功能，例如 <code><?php echo htmlentities('<select>'); ?></code> 的 <code>selectedIndex</code> 和 <code>value</code> 属性。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("select", {selectedIndex: 0}, [
    m("option", "Option A"),
    m("option", "Option B"),
])'); ?></code></pre>
        </div>

        <h2 id="components" class="doc-chapter-title mdui-text-color-theme"><a href="#components">组件</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p><a href="./components.html">组件</a>可以把逻辑封装在一个单元内，并把它当元素使用。它是开发大型可扩展应用的基础。</p>
            <p>组件是包含 <code>view</code> 方法的 JavaScript 对象。把组件作为 <code>m()</code> 函数的第一个参数传入，即可使用该组件。可以通过定义属性和子元素把参数传递给组件，如下面的示例所示：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 定义一个组件
var Greeter = {
    view: function(vnode) {
        return m("div", vnode.attrs, ["Hello ", vnode.children])
    }
}

// 使用该组件
m(Greeter, {style: "color:red;"}, "world")

// 等效 HTML:
// <div style="color:red;">Hello world</div>'); ?></code></pre>
            <p>要了解更多有关组件的信息，请参阅<a href="./components.html">组件</a>页面。</p>
        </div>

        <h2 id="lifecycle-methods" class="doc-chapter-title mdui-text-color-theme"><a href="#lifecycle-methods">生命周期方法</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>vnode 和组件拥有生命周期方法（又叫钩子），它们会在 DOM 元素的生命周期的不同时期被调用。Mithril 支持的生命周期方法包括：<code>oninit</code>、<code>oncreate</code>、<code>onupdate</code>、<code>onbeforeremove</code>、<code>onremove</code>、<code>onbeforeupdate</code>。</p>
            <p>生命周期方法的定义和 DOM 事件处理函数的定义相同，但是传入了 vnode 作为参数：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function initialize(vnode) {
    console.log(vnode)
}

m("div", {oninit: initialize})'); ?></code></pre>
            <div class="mdui-table-fluid">
                <table class="mdui-table mdui-table-hoverable">
                    <thead>
                    <tr>
                        <th>钩子</th>
                        <th>描述</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><code>oninit(vnode)</code></td>
                        <td>vnode 被渲染成 DOM 元素之前运行</td>
                    </tr>
                    <tr>
                        <td><code>oncreate(vnode)</code></td>
                        <td>vnode 添加到 DOM 以后运行</td>
                    </tr>
                    <tr>
                        <td><code>onupdate(vnode)</code></td>
                        <td>重绘完成后运行</td>
                    </tr>
                    <tr>
                        <td><code>onbeforeremove(vnode)</code></td>
                        <td>DOM 元素被移除之前运行。如果返回 Promise，Mithril 会在 Promise 完成后再移除 DOM 元素。只有在移除元素本身时才会触发该方法，移除子元素时不会触发该方法。</td>
                    </tr>
                    <tr>
                        <td><code>onremove(vnode)</code></td>
                        <td>DOM 元素被移除之前运行。如果定义了 <code>onbeforeremove</code> 钩子，则 <code>onremove</code> 方法会在调用 <code>done</code> 之后被调用。在移除元素本身、或移除元素的父元素时，都会触发该方法。</td>
                    </tr>
                    <tr>
                        <td><code>onbeforeupdate(vnode, old)</code></td>
                        <td><code>onupdate</code> 之前运行。如果它返回 <code>false</code>，则会阻止该元素及其子元素进行 diff。</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p>要了解更多有关生命周期方法的信息，请参阅<a href="./lifecycle-methods.html">生命周期犯法</a>页面。</p>
        </div>

        <h2 id="keys" class="doc-chapter-title mdui-text-color-theme"><a href="#keys">key</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>列表中的 vnode 可以拥有一个称为 <code>key</code> 的特殊属性，用于对 DOM 元素进行标记。在生成 vnode 的模型数据改变时，可以通过 <code>key</code> 来找到指定的 DOM 元素。</p>
            <p>通常，<code>key</code> 应该是数组中的唯一标志字段，即 <code>key</code> 字段的值应该是不重复的。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var users = [
    {id: 1, name: "John"},
    {id: 2, name: "Mary"},
]

function userInputs(users) {
    return users.map(function(u) {
        return m("input", {key: u.id}, u.name)
    })
}

m.render(document.body, userInputs(users))'); ?></code></pre>
            <p>当列表中的 vnode 拥有 <code>key</code> 时，如果 <code>users</code> 数组被重新排序、视图被重新渲染，<code>input</code> 元素将按照和以前一致的排序方式进行排列，以便保持正确的焦点和 DOM 状态。</p>
            <p>了解更多有关 key 的信息，参见 <a href="./keys.html">key</a> 页面。</p>
        </div>

        <h2 id="svg-and-mathml" class="doc-chapter-title mdui-text-color-theme"><a href="#svg-and-mathml">SVG 和 MathML</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>Mithril 完全支持 SVG。Xlink 也是支持的，但与之前 v1.0 版本的 Mithril 不同的是，必须明确定义命名空间：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m("svg", [
    m("image[xlink:href=\'image.gif\']")
])'); ?></code></pre>
            <p>MathML 也是完全支持的。</p>
        </div>

        <h2 id="making-templates-dynamic" class="doc-chapter-title mdui-text-color-theme"><a href="#making-templates-dynamic">使模版动态化</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>因为嵌套的 vnode 是标准的 JavaScript 表达式，所以你可以使用 JavaScript 来操作它们。</p>

            <h3 class="doc-chapter-subtitle">动态文本</h3>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var user = {name: "John"}

m(".name", user.name) // <div class="name">John</div>'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">循环</h3>
            <p>使用 <code>Array</code> 方法如 <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/map" target="_blank">map</a> 来循环数据列表。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var users = [
    {name: "John"},
    {name: "Mary"},
]

m("ul", users.map(function(u) { // <ul>
    return m("li", u.name)      //   <li>John</li>
                                //   <li>Mary</li>
}))                             // </ul>

// ES6:
// m("ul", users.map(u =>
//   m("li", u.name)
// ))'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">条件语句</h3>
            <p>使用三元运算符根据条件来设置视图中的内容。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var isError = false

m("div", isError ? "An error occurred" : "Saved") // <div>Saved</div>'); ?></code></pre>
            <p>在 JavaScript 表达式中，不能使用如 <code>if</code> 和 <code>for</code> 这样的 JavaScript 语句。</p>
        </div>

        <h2 id="converting-html" class="doc-chapter-title mdui-text-color-theme"><a href="#converting-html">converting-html</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="avoid-anti-patterns" class="doc-chapter-title mdui-text-color-theme"><a href="#avoid-anti-patterns">avoid-anti-patterns</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>