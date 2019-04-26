/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 送信フォームリセット
 * @returns {undefined}
 */
function reset_form()
{
    $('.search_form :input').val('');
    $('.search_form :submit').click();
}
