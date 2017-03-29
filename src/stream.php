<?php
$vars['title'] = 'API';
$vars['filename'] = 'stream';
$vars['prev'] = array(
    'filename' => 'promise',
    'title' => 'promise'
);
$vars['next'] = array();
?>
<?php include SRC_PATH . '/public/header.php'; ?>

<div class="mdui-container doc-container">
    <h1>stream()</h1>
    <div class="doc-chapter mdui-typo">
        <h2 id="description"><a href="#description">描述</a></h2>
        <p>流是一种可以有关联反应的数据结构，类似于表格应用中的单元格。</p>
        <p>例如，在表格中，如果 <code>A1 = B1 + C1</code>，则修改 <code>B1</code> 或 <code>C1</code> 时，<code>A1</code> 也会被自动修改。</p>
        <p>你可以使一个流依赖于其他流，以便更改一个流时可以自动更改其他的流。当你有一个非常耗资源的计算，且希望只在必要的时候执行，而不是每次重绘时都执行，这时流就会派上用场。</p>
        <p>Stream 模块并没有包含在 Mithril 的核心发行版中。要引入 Stream 模块，请使用：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('var Stream = require("mithril/stream")'); ?></code></pre>
        <p>如果你没有使用模块化工具对文件进行打包，也可以直接直接引用该模块：</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('<script src="https://unpkg.com/mithril-stream"></script>'); ?></code></pre>
        <p>当直接通过 <code><?php echo htmlentities('<script>'); ?></code> 标签引入文件时，stream 库会暴露到 <code>window.m.stream</code>。如果你想把 stream 库和 Mithril 一起使用，则需要在引入 <code>mithril-stream</code> 之前先引入 Mithril，因为 Mithril 会把 <code>window.m</code> 直接覆盖掉。</p>

        <h2 id="signature"><a href="#signature">签名</a></h2>
        <p>创建流</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('stream = Stream(value)'); ?></code></pre>
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
                    <td><code>value</code></td>
                    <td><code>any</code></td>
                    <td>否</td>
                    <td>如果存在该值，则流的值会被设置为该值。</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Stream</code></th>
                    <th></th>
                    <th>返回一个 Stream</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h3 id="static-members"><a href="#static-members">静态成员</a></h3>

        <h4 id="streamcombine"><a href="#streamcombine">Stream.combine</a></h4>
        <p>创建计算流，如果其上面的流发生了更新，则它也会更新。参见<a href="./stream.html#combining-streams">组合流</a></p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('stream = Stream.combine(combiner, streams)'); ?></code></pre>
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
                    <td><code>combiner</code></td>
                    <td><code>(Stream..., Array) -> any</code></td>
                    <td>是</td>
                    <td>详见 <a href="./stream.html#combiner">combiner</a> 参数</td>
                </tr>
                <tr>
                    <td><code>streams</code></td>
                    <td><code><?php echo htmlentities('Array<Stream>'); ?></code></td>
                    <td>是</td>
                    <td>要组合的流的列表</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Stream</code></th>
                    <th></th>
                    <th>返回一个流</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h5 id="combiner"><a href="#combiner">combiner</a></h5>
        <p>指定计算流的值的生成方式。详见<a href="./stream.html#combining-streams">组合流</a>。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('any = combiner(streams..., changed)'); ?></code></pre>
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
                    <td><code>streams...</code></td>
                    <td>多个 <code>Streams</code></td>
                    <td>否</td>
                    <td>0 个或多个流，会传入到 <code>stream.combine</code> 的第二个参数中</td>
                </tr>
                <tr>
                    <td><code>changed</code></td>
                    <td><code><?php echo htmlentities('Array<Stream>');?></code></td>
                    <td>是</td>
                    <td>受更新影响的流列表</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>any</code></th>
                    <th></th>
                    <th>返回一个计算值</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="streammerge"><a href="#streammerge">Stream.merge</a></h4>
        <p>创建一个流，它的值是一组流的值组成的数组。</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('stream = Stream.merge(streams)'); ?></code></pre>
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
                    <td><code>streams</code></td>
                    <td><code><?php echo htmlentities('Array<Stream>');?></code></td>
                    <td>是</td>
                    <td>一个流组成的数组</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Stream</code></th>
                    <th></th>
                    <th>返回一个流，它的值是一组流的值组成的数组。</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="streamscan"><a href="#streamscan">Stream.scan</a></h4>
        <p>创建一个新的流，其值是</p>
        <pre class="doc-code"><code class="lang-js"><?php echo htmlentities('stream = Stream.scan(fn, accumulator, stream)'); ?></code></pre>
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
                    <td><code>fn</code></td>
                    <td><code>(accumulator, value) -> result</code></td>
                    <td>是</td>
                    <td>一个函数，使用累加器和值作为参数，并返回新的累加器的值</td>
                </tr>
                <tr>
                    <td><code>accumulator</code></td>
                    <td><code>any</code></td>
                    <td>是</td>
                    <td>累加器的起始值</td>
                </tr>
                <tr>
                    <td><code>stream</code></td>
                    <td><code>Stream</code></td>
                    <td>是</td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>返回</th>
                    <th><code>Stream</code></th>
                    <th></th>
                    <th>返回包含这些结果的新的流</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <h4 id="streamscanmerge"><a href="#streamscanmerge">Stream.scanMerge</a></h4>

        <h4 id="streamhalt"><a href="#streamhalt">Stream.HALT</a></h4>

        <h4 id="streamfantasy-landof"><a href="#streamfantasy-landof">Stream["fantasy-land/of"]</a></h4>

        <h3 id="static-members"><a href="#static-members">Instance members</a></h3>

        <h4 id="streammap"><a href="#streammap">stream.map</a></h4>

        <h4 id="streamend"><a href="#streamend">stream.end</a></h4>

        <h4 id="streamfantasy-landof"><a href="#streamfantasy-landof">stream["fantasy-land/of"]</a></h4>

        <h4 id="streamfantasy-landmap"><a href="#streamfantasy-landmap">stream["fantasy-land/map"]</a></h4>

        <h4 id="streamfantasy-landap"><a href="#streamfantasy-landap">stream["fantasy-land/ap"]</a></h4>

        <h2 id="basic-usage"><a href="#basic-usage">基本用法</a></h2>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>