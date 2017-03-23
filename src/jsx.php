<?php
$vars['title'] = 'JSX';
$vars['filename'] = 'jsx';
$vars['prev'] = array(
    'filename' => 'simple-application',
    'title' => '简单应用教程'
);
$vars['next'] = array(
    'filename' => 'es6',
    'title' => 'ES6'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">JSX</h1>

    <nav class="doc-toc mdui-text-color-theme">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#setup">安装</a></li>
            <li><a href="#jsx-vs-hyperscript">JSX vs hyperscript</a></li>
            <li><a href="#converting-html">HTML 转换为 hyperscript</a></li>
        </ul>
    </nav>

    <div class="doc-chapter">
        <h2 id="description" class="doc-chapter-title mdui-text-color-theme"><a href="#description">描述</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>JSX 是一个语法扩展，可以让你在 JavaScript 中直接使用 HTML 语法。它不是任何 JavaScript 标准的一部分，也不是构建应用所必需的，你可以根据你的喜好来决定是否使用它。</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var MyComponent = {
    view: function() {
        return m("main", [
            m("h1", "Hello world"),
        ])
    }
}

// 使用 JSX 可以写成：
var MyComponent = {
    view: function() {
        return (
            <main>
                <h1>Hello world</h1>
            </main>
        )
    }
}'); ?></code></pre>
            <p>当使用 JSX 语法时，可以使用大括号在 JSX 中插入 JavaScript 表达式：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var greeting = "Hello"
var url = "http://google.com"
var link = <a href={url}>{greeting + "!"}</a>
// 以上代码将生成 <a href="http://google.com">Hello</a>'); ?></code></pre>
            <p>可以通过首字母大写的组件名来调用组件：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.mount(document.body, <MyComponent />)
// 等效于 m.mount(document.body, m(MyComponent))'); ?></code></pre>
        </div>

        <h2 id="setup" class="doc-chapter-title mdui-text-color-theme"><a href="#setup">安装</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>可以通过 <a href="https://babeljs.io/" target="_blank">Babel</a> 插件来使用 JSX。</p>

            <h3 class="doc-chapter-subtitle">独立安装 Babel</h3>
            <p>如果你没有使用 Webpack，可以把 Babel 作为一个独立的工具进行使用。</p>
            <p>确保你已经安装 <a href="https://nodejs.org/en/" target="_blank">Node.js</a>，在项目文件夹下执行命令来初始化项目：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('npm init -y'); ?></code></pre>
            <p>执行以下命令来安装 Babel：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('npm install babel-cli babel-preset-es2015 babel-plugin-transform-react-jsx --save-dev'); ?></code></pre>
            <p>安装完后会创建 <code>.babelrc</code> 文件：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "presets": ["es2015"],
    "plugins": [
        ["transform-react-jsx", {
            "pragma": "m"
        }]
    ]
}'); ?></code></pre>
            <p>然后在命令行中运行：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('babel src --out-dir bin --source-maps'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">通过 Webpack 使用 Babel</h3>
            <p>如果你的项目已经使用了 Webpack，你可以按以下步骤把 Babel 集成到 Webpack 中。首先执行以下命令安装 Babel：</p>
            <pre class="doc-code"><code><?php echo htmlentities('npm install babel-core babel-loader babel-preset-es2015 babel-plugin-transform-react-jsx --save-dev'); ?></code></pre>
            <p>安装完后会创建 <code>.babelrc</code> 文件：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "presets": ["es2015"],
    "plugins": [
        ["transform-react-jsx", {
            "pragma": "m"
        }]
    ]
}'); ?></code></pre>
            <p>然后，创建一个 <code>webpack.config.js</code> 配置文件：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('module.exports = {
    entry: \'./src/index.js\',
    output: {
        path: \'./bin\',
        filename: \'app.js\',
    },
    module: {
        loaders: [{
            test: /\.js$/,
            exclude: /node_modules/,
            loader: \'babel-loader\'
        }]
    }
}'); ?></code></pre>
            <p>这个配置文件设置了应用的入口文件为 <code>src/index.js</code>，且打包后输出到 <code>bin/app.js</code>。</p>
            <p>要运行 bundler，需要设置一个 npm 脚本。打开 <code>package.json</code> 文件并在 <code>"scripts"</code> 中添加一行命令：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack -d --watch"
    }
}'); ?></code></pre>
            <p>现在，可以在命令行中执行以下命令来运行 bundler：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('npm start'); ?></code></pre>

            <h3 class="doc-chapter-subtitle">生产环境构建</h3>
            <p>要压缩生成的文件，请打开 <code>package.json</code> 文件，并添加一个新的 npm 脚本 <code>build</code>：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack -d --watch",
        "build": "webpack -p",
    }
}'); ?></code></pre>
            <p>在生产环境中,你可以使用钩子来自动运行构建脚本。这是一个使用 <a href="https://www.heroku.com/" target="_blank">Heroku</a> 的例子：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('{
    "name": "my-project",
    "scripts": {
        "start": "webpack -d --watch",
        "build": "webpack -p",
        "heroku-postbuild": "webpack -p"
    }
}'); ?></code></pre>
        </div>

        <h2 id="jsx-vs-hyperscript" class="doc-chapter-title mdui-text-color-theme"><a href="#jsx-vs-hyperscript">JSX vs hyperscript</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>JSX 引入了一个非标准的语法，它必须借助工具才能运行，但它允许开发者直接在 JavaScript 使用 HTML 语法。使用 JSX 代替 HTML 语法的好处是 JSX 的语法更加严格，它会在适当时候提示语法错误；而 HTML 的语法太宽松了，可能产生了语法错误但你很难发现。</p>
            <p>和 HTML 不同的是，JSX 区分大小写。比如 <code><?php echo htmlentities('<div className="test"></div>'); ?></code> 和 <code><?php echo htmlentities('<div classname="test"></div>'); ?></code> 是不同的，前者会编译成 <code><?php echo htmlentities('m("div", {className: "test"})'); ?></code>，而后者会编译成 <code><?php echo htmlentities('m("div", {classname: "test"})'); ?></code>，后者并不是创建类属性的正确方式。幸运的时，Mithril 支持标准的 HTML 属性名，因此，这个例子可以像普通 HTML 一样来写：<code><?php echo htmlentities('<div class="test"></div>'); ?></code>。</p>
            <p>JSX 对于那些以写 HTML 为主，且 JavaScript 经验不足的团队比较有用，但它需要大量的工具来维护，而纯 HTML 大多数情况下都可以直接在浏览器中打开。</p>
            <p>Hyperscript 是指 JSX 编译后生成的语法。Hyperscript 的语法也是可读的，你可以直接使用它的语法来编写，不一定要用 JSX 来生成（文档中大多数地方用的都是 Hyperscript）。Hyperscript 往往比 JSX 更简洁，因为：</p>
            <ul>
                <li>它不需要它不需要关闭标签（例如 <code>m("div")</code> VS <code><?php echo htmlentities('<div></div>'); ?></code>）</li>
                <li>可以使用 CSS 选择器的语法来编写静态属性（如 <code>m("a.button")</code> VS <code><?php echo htmlentities('<div class="button"></div>'); ?></code>）</li>
            </ul>
            <p>此外，因为 hyperscript 是标准的 javaScript 语法，所以它的缩进会比 JSX 更自然：</p>
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('//JSX
var BigComponent = {
    activate: function() {/*...*/},
    deactivate: function() {/*...*/},
    update: function() {/*...*/},
    view: function(vnode) {
        return [
            {vnode.attrs.items.map(function(item) {
                return <div>{item.name}</div>
            })}
            <div
                ondragover={this.activate}
                ondragleave={this.deactivate}
                ondragend={this.deactivate}
                ondrop={this.update}
                onblur={this.deactivate}
            ></div>
        ]
    }
}

// hyperscript
var BigComponent = {
    activate: function() {/*...*/},
    deactivate: function() {/*...*/},
    update: function() {/*...*/},
    view: function(vnode) {
        return [
            vnode.attrs.items.map(function(item) {
                return m("div", item.name)
            }),
            m("div", {
                ondragover: this.activate,
                ondragleave: this.deactivate,
                ondragend: this.deactivate,
                ondrop: this.update,
                onblur: this.deactivate,
            })
        ]
    }
}'); ?></code></pre>
            <p>在较复杂的应用中，组件的控制流和配置的代码可能比标签更多，因此 hyperscript 比 JSX 代码可能有更好的可读性。</p>
            <p>另外，hyperscript 是纯 JavaScript 代码，不像 JSX 那样需要编译才能产生可运行的代码。</p>
        </div>

        <h2 id="converting-html" class="doc-chapter-title mdui-text-color-theme"><a href="#converting-html">HTML 转换为 hyperscript</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>在 Mithril 中，要把一个格式规范的 HTML 文件集成到使用 JSX 的项目中，除了复制粘贴外，只需要做少量的修改。</p>
            <p>使用 hyperscript 时，需要把 HTML 代码转为 hyperscript 语法才能运行。为方便起见，你可以使用<a href="http://arthurclemens.github.io/mithril-template-converter/index.html" target="">HTML-to-Mithril 模版转换器</a>。</p>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>