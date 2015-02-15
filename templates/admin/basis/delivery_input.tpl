        <table class="list">
            <!--{section name=cnt loop=$smarty.const.DELIVFEE_MAX}-->
            <!--{assign var=type value="`$smarty.section.cnt.index%2`"}-->
            <!--{assign var=keyno value="`$smarty.section.cnt.iteration`"}-->
            <!--{assign var=key value="fee`$smarty.section.cnt.iteration`"}-->
            <!--{assign var=key_next value="fee`$smarty.section.cnt.iteration+1`"}-->

            <!--{if $type == 0}-->
                <tr>
                <td style="background-color:#f4f5f5;text-align:center;"><!--{$arrPref[$keyno]}--> <span class="attention">*</span></td>
                <!--{if $smarty.section.cnt.last}-->
                <!--{assign var=colspan value="3"}-->
                <!--{else}-->
                <!--{assign var=colspan value="1"}-->
                <!--{/if}-->
                <td width="247" colspan="<!--{$colspan}-->">
                <!--{if $arrErr[$key] != ""}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <!--{/if}-->
                <input type="text" name="<!--{$arrForm[$key].keyname}-->" value="<!--{$arrForm[$key].value|h}-->" maxlength="<!--{$arrForm[$key].length}-->" size="20" class="box20" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" /> 円</td>
            <!--{else}-->
                <td style="background-color:#f4f5f5;text-align:center;"><!--{$arrPref[$keyno]}--> <span class="attention">*</span></td>
                <td width="248">
                <!--{if $arrErr[$key] != ""}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <!--{/if}-->
                <input type="text" name="<!--{$arrForm[$key].keyname}-->" value="<!--{$arrForm[$key].value|h}-->" maxlength="<!--{$arrForm[$key].length}-->" size="20" class="box20" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" /> 円</td>
                </tr>
            <!--{/if}-->
            <!--{/section}-->
            </tr>
        </table>
<script src="<!--{$smarty.const.ROOT_URLPATH}-->js/jquery-1.4.2.min.js"></script>
<script src="<!--{$smarty.const.ROOT_URLPATH}-->plugin/AdminEasyEdit/js/jquery.extablefocus-0.1.0.js"></script>
<script>
    $(function(){
        $("table.list").exTableFocus({
            overrideCrControl : true,
            verticalCrControl : true
        });
    });
</script>
