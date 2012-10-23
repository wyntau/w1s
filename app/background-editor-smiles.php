<?php /*add smiles to background editor*/
        if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')) 
{
    function ihacklog_add_smiley()
    {
        echo <<<EOT
        <script type="text/javascript">
        function grin(tag) 
        {
        var myField;
        tag = ' ' + tag + ' ';
        if (document.getElementById('content') && document.getElementById('content').style.display != 'none' && document.getElementById('content').type == 'textarea') 
        {
            myField = document.getElementById('content');
            if (document.selection) 
            {
            myField.focus();
            sel = document.selection.createRange();
            sel.text = tag;
            myField.focus();
            }
            else 
                if (myField.selectionStart || myField.selectionStart == '0') 
                {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                var cursorPos = endPos;
                myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length);
                cursorPos += tag.length;
                myField.focus();
                myField.selectionStart = cursorPos;
                myField.selectionEnd = cursorPos;
                }
                else 
                {
                myField.value += tag;
                myField.focus();
                }
        } 
        else 
        {
        tinyMCE.execCommand('mceInsertContent', false, tag);
        }
    }
    var smiley='<p><a href="javascript:grin(\':no:\')"><img src="../wp-content/themes/W1s/img/smilies/1.gif"  /></a> <a href="javascript:grin(\':razz:\')"><img src="../wp-content/themes/W1s/img/smilies/17.gif" alt="冷笑" /></a> <a href="javascript:grin(\':sad:\')"><img src="../wp-content/themes/W1s/img/smilies/30.gif" alt="伤心" /></a> <a href="javascript:grin(\':evil:\')"><img src="../wp-content/themes/W1s/img/smilies/2.gif" alt="邪恶" /></a> <a href="javascript:grin(\':eat:\')"><img src="../wp-content/themes/W1s/img/smilies/3.gif" alt="感叹" /></a> <a href="javascript:grin(\':smile:\')"><img src="../wp-content/themes/W1s/img/smilies/33.gif" alt="微笑" /></a> <a href="javascript:grin(\':sex:\')"><img src="../wp-content/themes/W1s/img/smilies/13.gif" alt="微笑" /></a> <a href="javascript:grin(\':oops:\')"><img src="../wp-content/themes/W1s/img/smilies/25.gif" alt="红脸" /></a> <a href="javascript:grin(\':grin:\')"><img src="../wp-content/themes/W1s/img/smilies/4.gif" alt="咧嘴笑" /></a> <a href="javascript:grin(\':eek:\')"><img src="../wp-content/themes/W1s/img/smilies/18.gif" alt="吃惊" /></a> <a href="javascript:grin(\':han:\')"><img src="../wp-content/themes/W1s/img/smilies/6.gif" alt="吃惊" /></a> <a href="javascript:grin(\':zzz:\')"><img src="../wp-content/themes/W1s/img/smilies/29.gif" alt="惊讶" /></a> <a href="javascript:grin(\':shock:\')"><img src="../wp-content/themes/W1s/img/smilies/7.gif" alt="惊讶" /></a> <a href="javascript:grin(\':mask:\')"><img src="../wp-content/themes/W1s/img/smilies/27.gif" alt="惊讶" /></a> <a href="javascript:grin(\':surprise:\')"><img src="../wp-content/themes/W1s/img/smilies/26.gif" alt="惊讶" /></a> <a href="javascript:grin(\':jiong:\')"><img src="../wp-content/themes/W1s/img/smilies/8.gif" alt="惊讶" /></a> <a href="javascript:grin(\':cold:\')"><img src="../wp-content/themes/W1s/img/smilies/14.gif" alt="惊讶" /></a> <a href="javascript:grin(\':han:\')"><img src="../wp-content/themes/W1s/img/smilies/15.gif" alt="惊讶" /></a> <a href="javascript:grin(\':shut:\')"><img src="../wp-content/themes/W1s/img/smilies/23.gif" alt="惊讶" /></a> <a href="javascript:grin(\':???:\')"><img src="../wp-content/themes/W1s/img/smilies/5.gif" alt="困惑" /></a> <a href="javascript:grin(\':cool:\')"><img src="../wp-content/themes/W1s/img/smilies/10.gif" alt="耍酷" /></a> <a href="javascript:grin(\':ool:\')"><img src="../wp-content/themes/W1s/img/smilies/32.gif" alt="惊讶" /></a> <a href="javascript:grin(\':lol:\')"><img src="../wp-content/themes/W1s/img/smilies/24.gif" alt="大笑" /></a> <a href="javascript:grin(\':mad:\')"><img src="../wp-content/themes/W1s/img/smilies/31.gif" alt="抓狂" /></a> <a href="javascript:grin(\':love:\')"><img src="../wp-content/themes/W1s/img/smilies/20.gif" alt="惊讶" /></a> <a href="javascript:grin(\':twisted:\')"><img src="../wp-content/themes/W1s/img/smilies/19.gif" alt="痛苦" /></a> <a href="javascript:grin(\':roll:\')"><img src="../wp-content/themes/W1s/img/smilies/21.gif" alt="转眼珠" /></a> <a href="javascript:grin(\':idea:\')"><img src="../wp-content/themes/W1s/img/smilies/9.gif" alt="好主意" /></a> <a href="javascript:grin(\':arrow:\')"><img src="../wp-content/themes/W1s/img/smilies/16.gif" alt="" /></a> <a href="javascript:grin(\':cry:\')"><img src="../wp-content/themes/W1s/img/smilies/28.gif" alt="哭" /></a> <a href="javascript:grin(\':mrgreen:\')"><img src="../wp-content/themes/W1s/img/smilies/11.gif" alt="绿脸先生" /></a></p>';
            jQuery('#quicktags').before(smiley);

</script>
EOT;
        }    
    add_action('admin_footer','ihacklog_add_smiley');
}//add smiles to background editor ;?>
