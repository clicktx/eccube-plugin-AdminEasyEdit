<script src="<!--{$smarty.const.ROOT_URLPATH}-->js/jquery-1.4.2.min.js"></script>
<script src="<!--{$smarty.const.ROOT_URLPATH}-->plugin/AdminEasyEdit/js/jquery.extablefocus-0.1.0.js"></script>
<script>
    $(function(){
        $("table.list").exTableFocus({
            overrideCrControl : true,
            verticalCrControl : true
        });
    });
    //jQuery2.1.1で動作しないためoverride
    eccube.checkAllBox = function(input, selector) {
        if ($(input).is(':checked')) {
            $(selector).attr('checked', true);
        } else {
            $(selector).attr('checked', false);
        }
    };
</script>
