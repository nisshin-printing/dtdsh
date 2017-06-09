/**
 * minneの商品をCSV形式で出力するスクリプト
 * 
 * 2017-06-09時点でのDOM構造に対応。
 * Google Chromeでテスト済み
 */

{
    /**
     * 商品一覧をCSVフォーマットにして返す
     */
    const items = $(document.getElementById('container')).find('.gallery_imgarea');

    function formatEntry(entry) {
        const array = [entry.id, entry.name, entry.price, entry.category, entry.image];
        return array.join('\t') + '\n';
    }

    /**
     * CSVをポップアップ
     */
    function popup(content) {
        const generator = window.open('', 'name', 'height=100%,width=100%');
        generator.document.write(`<html><head><title>minneの商品一覧をCSVで出力</title></head><body><pre>${content}</pre></body></html>`);
        generator.document.close();
        return generator;
    }

    /**
     * HTMLを取得
     */
    function getHTML(url) {
        const jqXHR = $.ajax({
            url: url,
            dataType: html
        });
        return jqXHR;
    }
    const getHTML = getHTML();
    getHTML.done(response => $('#hoge').html(response));
    getHTML.fail(() => alert('エラー'));
    getHTML.always(() => alert('コンプリート！'));


    /**
     * jQueryの読み込み
     */
    if (typeof jQuery !== 'function') {
        const d = document;
        const s = d.createElement('script');
        s.src = '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js';
        s.onload = init;
        d.body.appendChild(s);
    } else {
        init();
    }
}