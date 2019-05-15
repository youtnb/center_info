/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 送信フォームsubmit
 * class='search_form'配下のselectタグにonchangeイベントリスナ追加
 * @returns {undefined}
 */
$(document).on('change', '.search_form select', function(){
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
