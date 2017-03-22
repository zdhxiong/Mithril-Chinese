<?php
$vars['title'] = '组件';
$vars['filename'] = 'components';
$vars['prev'] = array(
    'filename' => 'vnodes',
    'title' => '虚拟 DOM'
);
$vars['next'] = array(
    'filename' => 'lifecycle-methods',
    'title' => '生命周期方法'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">组件</h1>
    <div class="doc-chapter">
        <h2 id="structure" class="doc-chapter-title mdui-text-color-theme"><a href="#structure">结构</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>组件是对视图的一部分进行封装，以方便组织代码和重用。</p>
            <p>任何具有 <code>view</code> 方法的 JavaScript 对象都是 Mithril 组件。组件可以用过 <code>m()</code> 函数调用：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Example = {
    view: function() {
        return m("div", "Hello")
    }
}

m(Example)

// 等效 HTML
// <div>Hello</div>'); ?></code></pre>
        </div>

        <h2 id="passing-data-to-components" class="doc-chapter-title mdui-text-color-theme"><a href="#passing-data-to-components">把数据传递到组件</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>把一个 <code>attrs</code> 对象传入到 <code>m()</code> 函数的第二个参数，即可把参数传入到组件实例中：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m(Example, {name: "Floyd"})'); ?></code></pre>
            <p>在组件的视图和生命周期方法中可以通过 <code>vnode.attrs</code> 来访问数据：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Example = {
    view: function (vnode) {
        return m("div", "Hello, " + vnode.attrs.name)
    }
}'); ?></code></pre>
            <p>注意：生命周期方法也可以通过 <code>attrs</code> 对象提供，所以在你自己的回调中应该避免使用生命周期方法名，因为它们会被 Mithril 调用。只有在你希望创建生命周期钩子的时候，才能在 <code>attrs</code> 对象中使用生命周期方法。</p>
        </div>

        <h2 id="lifecycle-methods" class="doc-chapter-title mdui-text-color-theme"><a href="#lifecycle-methods">生命周期方法</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>组件都拥有相同的生命周期方法作为虚拟 DOM 节点，包括 <code>oninit</code>、<code>oncreate</code>、<code>onupdate</code>、<code>onbeforeremove</code>、<code>onremove</code> 和 <code>onbeforeupdate</code>。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var ComponentWithHooks = {
    oninit: function(vnode) {
        console.log("initialized")
    },
    oncreate: function(vnode) {
        console.log("DOM created")
    },
    onupdate: function(vnode) {
        console.log("DOM updated")
    },
    onbeforeremove: function(vnode) {
        console.log("exit animation can start")
        return new Promise(function(resolve) {
            // 动画完成后调用
            resolve()
        })
    },
    onremove: function(vnode) {
        console.log("removing DOM element")
    },
    onbeforeupdate: function(vnode, old) {
        return true
    },
    view: function(vnode) {
        return "hello"
    }
}') ?></code></pre>
            <p>和其他类型的虚拟 DOM 节点一样，组件作为 vnode 使用时还额外定义了生命周期方法。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('function initialize() {
    console.log("initialized as vnode")
}

m(ComponentWithHooks, {oninit: initialize})'); ?></code></pre>
            <p>vnode 中的生命周期方法不会覆盖组件的方法，反之亦然。组件的生命周期方法总是在 vnode 对应的生命周期方法之后运行。</p>
            <p>注意 vnode 中你自己的回调函数名不要和生命周期方法名重复。</p>
            <p>更多有关生命周期方法的信息，详见<a href="./lifecycle-methods.html">生命周期方法</a>。</p>
        </div>

        <h2 id="state" class="doc-chapter-title mdui-text-color-theme"><a href="#state">状态</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>和所有的虚拟 DOM 节点一样，组件 vnode 也有状态。组件的状态对于支持面向对象的架构是有用的，可以用于封装（encapsulation ）和分离关注点（separation of concerns）。</p>
            <p>组件的状态有 3 种方式可以进行访问：初始化时、通过 <code>vnode.state</code>、通过组件方法中的 <code>this</code> 关键字。</p>

            <h3 class="doc-chapter-subtitle">初始化时</h3>
            <p>任何附加到组件对象上的属性，都会被复制到组件的实例中。利用这个特性可以进行简单的状态初始化。</p>
            <p>在下面的例子中，<code>data</code> 是 <code>ComponentWithInitialState</code> 组件的 state 对象的属性。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var ComponentWithInitialState = {
    data: "Initial content",
    view: function(vnode) {
        return m("div", vnode.state.data)
    }
}

m(ComponentWithInitialState)

// 等效 HTML
// <div>Initial content</div>'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">通过 <code>vnode.state</code></h3>
            <p>状态也可以通过 <code>vnode.state</code> 属性访问，该属性可用于所有生命周期方法以及组件的 <code>view</code> 方法。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var ComponentWithDynamicState = {
    oninit: function(vnode) {
        vnode.state.data = vnode.attrs.text
    },
    view: function(vnode) {
        return m("div", vnode.state.data)
    }
}

m(ComponentWithDynamicState, {text: "Hello"})

// Equivalent HTML
// <div>Hello</div>'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">通过 <code>this</code> 关键字</h3>
            <p>状态也可以通过 <code>this</code> 关键字进行访问，该关键字可用于所有生命周期方法以及组件的 <code>view</code> 方法。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var ComponentUsingThis = {
    oninit: function(vnode) {
        this.data = vnode.attrs.text
    },
    view: function(vnode) {
        return m("div", this.data)
    }
}

m(ComponentUsingThis, {text: "Hello"})

// 等效 HTML
// <div>Hello</div>'); ?></code></pre>
            <p>注意，当使用 ES5 的函数时，嵌套的匿名函数中的 <code>this</code> 的值不是组件的实例。有两个方法来解决这个限制：使用 ES6 的箭头函数，或者 ES6 不可用时，使用 <code>vnode.state</code>。</p>

        </div>

        <h2 id="avoid-anti-patterns" class="doc-chapter-title mdui-text-color-theme"><a href="#avoid-anti-patterns">避免反面模式</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>尽管 Mithril 很灵活，但仍然有一些代码模式不推荐使用：</p>

            <h3 class="doc-chapter-subtitle">避免胖组件</h3>
            <p>通常来说，“胖”组件是指含自定义实例方法的组件。换句话说，你应该避免将函数附加到 <code>vnode.state</code> 或 <code>this</code> 上。一个逻辑只在一个组件实例上可用，但不能被其它组件重用，这种情况是非常罕见的。更常见的情况是一个逻辑可以被多个组件调用。</p>
            <p>如果把逻辑放在数据层，而不是绑定到组件状态，那么重构代码会更加容易。</p>
            <p>来看下这个胖组件：</p>
            <pre class="doc-code" data-filename="views/Login.js"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
var Login = {
    username: "",
    password: "",
    setUsername: function(value) {
        this.username = value
    },
    setPassword: function(value) {
        this.password = value
    },
    canSubmit: function() {
        return this.username !== "" && this.password !== ""
    },
    login: function() {/*...*/},
    view: function() {
        return m(".login", [
            m("input[type=text]", {oninput: m.withAttr("value", this.setUsername.bind(this)), value: this.username}),
            m("input[type=password]", {oninput: m.withAttr("value", this.setPassword.bind(this)), value: this.password}),
            m("button", {disabled: !this.canSubmit(), onclick: this.login}, "Login"),
        ])
    }
}'); ?></code></pre>
            <p>通常，在大型应用中，除了上面的登录组件外，通常还会有注册和忘记密码组件。例如我们希望从登录页面跳转到注册或忘记密码页面时，能自动填写我们在登录页填写过的用户名，这时要把登录页的<code>username</code>共享到注册或忘记密码页面是很困难的。因为胖组件对状态进行了封装，使得从外部无法访问到组件内的状态。</p>
            <p>我们来重构这个组件，把状态代码从组件内移动到数据层。这就像创建一个新模块一样简单：</p>
            <pre class="doc-code" data-filename="models/Auth.js"><code class="lang-js"><?php echo htmlentities('// 建议这种用法
var Auth = {
    username: "",
    password: "",
    setUsername: function(value) {
        Auth.username = value
    },
    setPassword: function(value) {
        Auth.password = value
    },
    canSubmit: function() {
        return Auth.username !== "" && Auth.password !== ""
    },
    login: function() {/*...*/},
}

module.exports = Auth'); ?></code></pre>
            <p>然后，我们清理组件中的代码：</p>
            <pre class="doc-code" data-filename="views/Login.js"><code class="lang-js"><?php echo htmlentities('// 建议这种用法
var Auth = require("../models/Auth")

var Login = {
    view: function() {
        return m(".login", [
            m("input[type=text]", {oninput: m.withAttr("value", Auth.setUsername), value: Auth.username}),
            m("input[type=password]", {oninput: m.withAttr("value", Auth.setPassword), value: Auth.password}),
            m("button", {disabled: !Auth.canSubmit(), onclick: Auth.login}, "Login"),
        ])
    }
}'); ?></code></pre>
            <p>现在，<code>Auth</code> 模块成为了 auth 相关状态的来源，其他组件可以很容易地访问这些数据。</p>
            <p>此外，不需要再使用 <code>.bind</code> 为组件的事件处理程序绑定状态的引用。</p>

            <h3 class="doc-chapter-subtitle">避免对接口造成限制</h3>
            <p>尽量保持组件的接口通用 - 直接使用 <code>attrs</code> 和 <code>children</code> - 除非组件需要指定的逻辑对输入进行操作。</p>
            <p>在下面的例子中，<code><?php echo htmlentities('button'); ?></code> 受到了严重的限制：它不支持 <code>onclick</code> 之外的其他事件、不能自定义样式、只能使用纯文本作为子元素。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
var RestrictiveComponent = {
    view: function(vnode) {
        return m("button", {onclick: vnode.attrs.onclick}, [
            "Click to " + vnode.attrs.text
        ])
    }
}'); ?></code></pre>
            <p>如果需要的属性和普通的 DOM 属性一样，则最好允许将参数传递到组件的根节点。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 推荐这种用法
var FlexibleComponent = {
    view: function(vnode) {
        return m("button", vnode.attrs, [
            "Click to ", vnode.children
        ])
    }
}'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">不要操作 <code>children</code></h3>
            <p>通常组件需要定义多组子元素。例如，某个组件需要一个可以设置的 title 和 body，这时应该使用自定义的属性，而不是直接对 <code>children</code> 进行解析和操作。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
var Header = {
    view: function(vnode) {
        return m(".section", [
            m(".header", vnode.children[0]),
            m(".tagline", vnode.children[1]),
        ])
    }
}

m(Header, [
    m("h1", "My title"),
    m("h2", "Lorem ipsum"),
])

// 糟糕的用法
m(Header, [
    [
        m("h1", "My title"),
        m("small", "A small note"),
    ],
    m("h2", "Lorem ipsum"),
])'); ?></code></pre>
            <p>上面的组件直接对 <code>children</code> 进行操作，在不仔细阅读相关代码的情况下，很难知道 <code>children[0]</code>、<code>children[1]</code> 代表什么，而使用自定义属性来命名参数则更加清晰易懂：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 建议这种用法
var BetterHeader = {
    view: function(vnode) {
        return m(".section", [
            m(".header", vnode.attrs.title),
            m(".tagline", vnode.attrs.tagline),
        ])
    }
}

m(BetterHeader, {
    title: m("h1", "My title"),
    tagline: m("h2", "Lorem ipsum"),
})

// 清晰的用法
m(BetterHeader, {
    title: [
        m("h1", "My title"),
        m("small", "A small note"),
    ],
    tagline: m("h2", "Lorem ipsum"),
})'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">静态地定义组件，动态地调用它们</h3>
            <p><strong>避免在视图中定义组件</strong></p>
            <p>如果把组件的定义放在了函数中，则每次调用函数时都将创建一个新的组件。当 diff 组件的 vnode 时，两个组件时不相等的，即使它们的代码完全一样。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
var ComponentFactory = function(greeting) {
    // 每次调用时都会创建一个新组件
    return {
        view: function() {
            return m("div", greeting)
        }
    }
}
m.render(document.body, m(ComponentFactory("hello")))
// 第二次调用时又重新创建了一个 div
m.render(document.body, m(ComponentFactory("hello")))

// 推荐这种用法
var Component = {
    view: function(vnode) {
        return m("div", vnode.attrs.greeting)
    }
}
m.render(document.body, m(Component, {greeting: "hello"}))
// 第二次调用时不会修改 DOM
m.render(document.body, m(Component, {greeting: "hello"}))'); ?></code></pre>

            <p><strong>避免在视图外创建组件实例</strong></p>
            <p>如果在视图外创建组件实例，则重绘时会跳过对组件实例的差异检查。因此，组件实例应该始终在视图内创建：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 避免这种用法
var Counter = {
    count: 0,
    view: function(vnode) {
        return m("div",
            m("p", "Count: " + vnode.state.count ),

            m("button", {
                onclick: function() {
                    vnode.state.count++
                }
            }, "Increase count")
        )
    }
}

var counter = m(Counter)

m.mount(document.body, {
    view: function(vnode) {
        return [
            m("h1", "My app"),
            counter
        ]
    }
})'); ?></code></pre>
            <p>在上面的示例中，点击组件的 Increase count 按钮会增加 <code>count</code> 的值，但视图不会更新，因为组件的 vnode 引用是同一个，渲染引擎会跳过对它们的差异检查。所以你应该始终在视图中调用组件，确保能创建新的 vnode：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('// 建议这种用法
var Counter = {
    count: 0,
    view: function(vnode) {
        return m("div",
            m("p", "Count: " + vnode.state.count ),

            m("button", {
                onclick: function() {
                    vnode.state.count++
                }
            }, "Increase count")
        )
    }
}

m.mount(document.body, {
    view: function(vnode) {
        return [
            m("h1", "My app"),
            m(Counter)
        ]
    }
})'); ?></code></pre>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>