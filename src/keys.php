<?php
$vars['title'] = 'Keys';
$vars['filename'] = 'keys';
$vars['prev'] = array(
    'filename' => 'lifecycle-methods',
    'title' => '生命周期方法'
);
$vars['next'] = array(
    'filename' => 'autoredraw',
    'title' => '自动重绘系统'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>Keys</h1>
    <div class="doc-chapter mdui-typo">
        <h2 id="what-are-keys"><a href="#what-are-keys">什么是 Key</a></h2>
        <p>Key 是一种允许对 DOM 元素进行重新排序的机制，把列表中的指定数据项映射到各自对应的 DOM 元素，</p>
        <p>换句话说，key 表示 “这个 DOM 元素属于这个数据对象的这个ID”。</p>
        <p>通常，<code>key</code> 属性应该数组中的唯一标识字段，即该字段的值不应产生重复。</p>
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
        <p>有 key 意味着，如果 <code>users</code> 数组被打乱，且视图被重新渲染，<code>input</code> 元素将按照和以前一致的排序方式进行排序，以便保持正确的焦点和 DOM 状态。</p>

        <h2 id="how-to-use"><a href="#how-to-use">如何使用</a></h2>
        <p>常见的模式是，一个由对象组成的数组，生成一个 vnode 列表。例如下面的代码：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var people = [
    {id: 1, name: "John"},
    {id: 2, name: "Mary"},
]

function userList(users) {
    return users.map(function(u) {
        return m("button", u.name) // <button>John</button>
                                   // <button>Mary</button>
    })
}

m.render(document.body, userList(people))'); ?></code></pre>
        <p>假设 <code>people</code> 变量被改为：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('people = [{id: 2, name: "Mary"}]'); ?></code></pre>
        <p>问题是，从 <code>userList</code> 函数中，没法得知是第一个对象被删除了，还是第二个对象被删除了。如果第一个按钮处于聚焦状态，且渲染引擎将其删除，则焦点会按预期回到 <code><?php echo htmlentities('<body>'); ?></code> 元素。但如果渲染引擎删除的是第二个按钮，并修改第一个按钮的文本内容，则焦点会落到错误的按钮上。</p>
        <p>更糟糕的是，如果按钮上使用了带有状态的 jQuery 插件，则在更新后可能会导致状态不正确。</p>
        <p>因此，从动态的数据数组生成 vnode 时，应该为每一个虚拟节点添加 <code>key</code> 属性，指向数据数组中的唯一标识字段。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function correctUserList(users) {
    return users.map(function(u) {
        return m("button", {key: u.id}, u.name)
    })
}'); ?></code></pre>

        <h2 id="debugging-key-related-issues"><a href="#debugging-key-related-issues">调试 Key 的相关问题</a></h2>
        <p>如果 key 被误用，则可能引起混乱。典型症状是，经过几次用户交互后（通常涉及删除操作），应用的状态被破坏。</p>

        <h3>避免在含 key 的元素外面再包裹元素</h3>
        <p>key 必须放在数组的直接子节点上。意味着在上例中，如果你在 <code>button</code> 的外面包裹了一个 <code>div</code>，则必须将 key 移动到 <code>div</code> 上。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
users.map(function(u) {
    return m("div", [ // key should be in `div`
        m("button", {key: u.id}, u.name)
    ])
})'); ?></code></pre>

        <h3>避免把 key 放在组件内</h3>
        <p>如果把按钮放在了组件中，则需要把 key 移到组件外面：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
var Button = {
    view: function(vnode) {
        return m("button", {key: vnode.attrs.id}, u.name)
    }
}

// 建议这种用法
users.map(function(u) {
    return m("div", [
        m(Button, {key: u.id}, u.name) // key 应该在这里，而不是组件内
    ])
})'); ?></code></pre>

        <h3>避免在数组中使用含 key 的元素</h3>
        <p>数组是 <a href="./vnodes.html">vnode</a>，因此可以使用 key。不要把含 key 的元素包裹在数组中：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
users.map(function(u) {
    return [ // 片段是 vnode，因此可以使用 key
        m("button", {key: u.id}, u.name)
    ]
})

// 建议这种用法
users.map(function(u) {
    return m("button", {key: u.id}, u.name)
})

// 建议这种用法
users.map(function(u) {
    return m.fragment({key: u.id}, m("button", u.name))
})'); ?></code></pre>

        <h3>避免可变类型</h3>
        <p>key 必须是字符串，否则会被转换为字符串。因此 <code>"1"</code>(string) 和 <code>1</code>(number) 是同一个 key。</p>
        <p>在一个数组中，key 应该只是用数字、或者只是用字符串，避免两者混用。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// AVOID
var things = [
    {id: "1", name: "Book"},
    {id: 1, name: "Cup"},
]'); ?></code></pre>

        <h3>避免在同一个数组中混用含 key 和不含 key 的 vnode</h3>
        <p>一个 vnode 数组必须只包含含 key 的 vnode、或只包含不含 key 的 vnode，不能两者混用。如果你想要混用，请使用嵌套数组。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
m("div", [
    m("div", "a"),
    m("div", {key: 1}, "b"),
])

// 建议这种用法
m("div", [
    m("div", {key: 0}, "a"),
    m("div", {key: 1}, "b"),
])

// 建议这种用法
m("div", [
    m("div", "a"),
    [
        m("div", {key: 1}, "b"),
    ]
])'); ?></code></pre>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>