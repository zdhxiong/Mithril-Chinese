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
            <p>可以使用 <a href="https://babeljs.io/" target="_blank">Babel</a> 插件来使用 JSX。</p>

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
            <p>JSX 引入了一个非标准的语法，它必须借助工具才能运行，但它允许开发者直接在 JavaScript 使用 HTML 语法。使用 JSX 代替 HTML 语法的好处是 JSX 的语法更加严格，它会在适当时候产生语法错误；而 HTML 的语法太宽松了，可能产生了语法错误但难以发现。</p>
            <p>和 HTML 不同的是，JSX 区分大小写。比如 <code><?php echo htmlentities('<div className="test"></div>'); ?></code> 和 <code><?php echo htmlentities('<div classname="test"></div>'); ?></code> 是不同的，前者会编译成 <code><?php echo htmlentities('m("div", {className: "test"})'); ?></code>，而后者会编译成 <code><?php echo htmlentities('m("div", {classname: "test"})'); ?></code>，后者并不是创建类属性的正确方式。幸运的时，Mithril 支持标准的 HTML 属性名，因此，这个例子可以像普通 HTML 一样来写：<code><?php echo htmlentities('<div class="test"></div>'); ?></code>。</p>
            <p></p>
        </div>

        <h2 id="converting-html" class="doc-chapter-title mdui-text-color-theme"><a href="#converting-html">转换 HTML</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>