/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 行クリック
 * trタグにdata-hrefを指定
 * @param {type} $
 * @returns {undefined}
 */
jQuery(function($)
{
    $('tr[data-href]').addClass('clickable').click(function(e) {
        if(!$(e.target).is('a')){
            window.location = $(e.target).closest('tr').data('href');
        };
    });
});

/**
 * 送信フォームsubmit
 * class='search_form'配下のselectタグにonchangeイベントリスナ追加
 * class='search_form'配下のinput type=checkboxタグにonchangeイベントリスナ追加
 * @returns {undefined}
 */
$(document).on('change', '.search_form select', function(){
    $('.search_form :submit').click();
});
$(document).on('change', '.search_form :checkbox', function(){
    $('.search_form :submit').click();
});

/**
 * 送信フォームreset
 * class='search_form'のinputをすべてクリアしてsubmitボタンclick
 * @returns {undefined}
 */
function reset_form()
{
    $('.search_form :input').val('');
    $('.search_form :submit').click();
}
