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
    <h1 class="doc-title mdui-text-color-theme">Keys</h1>
    <div class="doc-chapter">
        <h2 id="what-are-keys" class="doc-chapter-title mdui-text-color-theme"><a href="#what-are-keys"></a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="how-to-use" class="doc-chapter-title mdui-text-color-theme"><a href="#how-to-use">如何使用</a></h2>
        <div class="doc-chapter-content mdui-typo">

        </div>

        <h2 id="debugging-key-related-issues" class="doc-chapter-title mdui-text-color-theme"><a href="#debugging-key-related-issues"></a></h2>
        <div class="doc-chapter-content mdui-typo">
            <h3 class="doc-chapter-subtitle">Avoid wrapper elements around keyed elements</h3>

            <h3 class="doc-chapter-subtitle">Avoid hiding keys in component root elements</h3>

            <h3 class="doc-chapter-subtitle">Avoid wrapping keyed elements in arrays</h3>

            <h3 class="doc-chapter-subtitle">Avoid variable types</h3>

            <h3 class="doc-chapter-subtitle">Avoid mixing keyed and non-keyed vnodes in the same array</h3>
        </div>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>