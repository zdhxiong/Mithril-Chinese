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

        <h2 id="signature"><a href="#signature">签名</a></h2>

        <h2 id="how-it-works"><a href="#how-it-works">工作原理</a></h2>

        <h2 id="security-considerations"><a href="#security-considerations">security-considerations</a></h2>

        <h2 id="scripts-that-do-not-run"><a href="#scripts-that-do-not-run">scripts-that-do-not-run</a></h2>

        <h2 id="avoid-trusting-html"><a href="#avoid-trusting-html">avoid-trusting-html</a></h2>
    </div>
</div>

<?php include SRC_PATH . '/public/footer.php'; ?>