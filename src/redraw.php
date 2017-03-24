<?php
$vars['title'] = 'redraw()';
$vars['filename'] = 'redraw';
$vars['prev'] = array(
    'filename' => 'fragment',
    'title' => 'fragment(attrs, children)'
);
$vars['next'] = array(
    'filename' => 'version',
    'title' => 'version'
);
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1 class="doc-title mdui-text-color-theme">redraw()</h1>

    <nav class="doc-toc mdui-text-color-theme">
        <ul>
            <li><a href="#description">描述</a></li>
            <li><a href="#signature">签名</a></li>
            <li><a href="#how-it-works">工作原理</a></li>
        </ul>
    </nav>

    <div class="doc-chapter">
        <h2 id="description" class="doc-chapter-title mdui-text-color-theme"><a href="#description">描述</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>当数据层的数据改变时，更新 DOM。</p>
            <p>在视图中的事件处理函数中、或者是 <code>m.request</code>/<code>m.jsonp</code> 请求完成后不需要调用该方法。</p>
            <p>在 <code>setTimeout</code>、<code>setInterval</code>、<code>requestAnimationFrame</code> 的回调中，或者第三方库的回调中，需要调用该方法。</p>
            <p>通常 <code>m.redraw()</code> 会触发异步重绘，但是如果 Mithril 检测到使用同步重绘可以提高性能的话，则会使用同步重绘（例如，在最后一个动画帧中没有重绘，则会进行一次同步重绘）。你在编写代码时，应该始终把它当成是异步重绘的。</p>
        </div>

        <h2 id="signature" class="doc-chapter-title mdui-text-color-theme"><a href="#signature">签名</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('m.redraw()'); ?></code></pre>
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
                    <tfoot>
                    <tr>
                        <th>返回</th>
                        <th></th>
                        <th></th>
                        <th>没有返回</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <h2 id="how-it-works" class="doc-chapter-title mdui-text-color-theme"><a href="#how-it-works">工作原理</a></h2>
        <div class="doc-chapter-content mdui-typo">
            <p>当 Mithril 外部的回调运行时，你需要通知 Mithril 的渲染引擎需要重绘了。外部回调可以是 <code>setTimeout</code>/<code>setInterval</code>/<code>requestAnimationFrame</code>，web socket 库的回调，jQuery 插件中的事件回调，第三方 XHR 请求的回调等。</p>
            <p>要触发重绘，调用 <code>m.redraw()</code> 即可。注意 <code>m.redraw()</code> 只有在使用 <code>m.mount</code> 或 <code>m.route</code> 时才有效。如果你是通过 <code>m.render</code> 进行渲染的，则需要使用 <code>m.render</code> 进行重绘。</p>
            <p>不要在<a href="./lifecycle-methods.html">生命周期方法</a>中调用 <code>m.redraw()</code>。那样做会导致未知的后果。</p>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>