<?php
/*
 * AdminEasyEdit
 *
 * Copyright(c) 2014 clicktx. All Rights Reserved.
 *
 * http://perl.no-tubo.net/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * プラグイン のメインクラス.
 *
 * @package AdminEasyEdit
 * @author clicktx
 */
class AdminEasyEdit extends SC_Plugin_Base {

    /**
     * コンストラクタ
     *
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }

    /**
     * インストール
     * installはプラグインのインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin plugin_infoを元にDBに登録されたプラグイン情報(dtb_plugin)
     * @return void
     */
    function install($arrPlugin) {
        $class_name = get_class();

        // ファイルのコピー
        // memo: plugin用HTML_dirにコピーするのでuninnstall時には削除必要ない？
        if(!file_exists(PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/js"))mkdir(PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code']. "/js");
        if(copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html/js/jquery.extablefocus-0.1.0.js", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/js/jquery.extablefocus-0.1.0.js") === false) {
            SC_Utils_Ex::sfDispSiteError(FREE_ERROR_MSG, '', false, PLUGIN_UPLOAD_REALDIR . PLUGIN_HTML_REALDIR . ' に書き込めません。パーミッションをご確認ください。');
        }
    }

    /**
     * アンインストール
     * uninstallはアンインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function uninstall($arrPlugin) {
        // nop
    }

    /**
     * アップデート
     * updateはアップデート時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function update($arrPlugin) {
        // nop
    }

    /**
     * 稼働
     * enableはプラグインを有効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function enable($arrPlugin) {
    }

    /**
     * 停止
     * disableはプラグインを無効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function disable($arrPlugin) {
    }

    /**
     * SC_系クラス読込コールバック関数
     *
     * @param string &$classname クラス名
     * @param string &$classpath クラスファイルパス
     * @return void
     */
    function loadClassFileChange(&$classname, &$classpath) {
    }

    /**
    * フォームパラメーター追加
    * @return void
    */
    function addParam($class_name, $param) {
    }

    /**
     * プレフィルタコールバック関数
     *
     * @param string     &$source  テンプレートのHTMLソース
     * @param LC_Page_Ex $objPage  ページオブジェクト
     * @param string     $filename テンプレートのファイル名
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        $objTransform = new SC_Helper_Transform($source);
        $template_dir = PLUGIN_UPLOAD_REALDIR ."AdminEasyEdit/templates/";

        switch($objPage->arrPageLayout['device_type_id']) {
            // 端末種別：PC
            case DEVICE_TYPE_PC:
                $template_dir .= "default/";
                break;
            // 端末種別：モバイル
            case DEVICE_TYPE_MOBILE:
                $template_dir .= "mobile/";
                break;
            // 端末種別：スマートフォン
            case DEVICE_TYPE_SMARTPHONE:
                break;
            // 端末種別：管理画面
            case DEVICE_TYPE_ADMIN:
            default:
                $template_dir .= "admin/";
                // JS読み込み
                // jQuery1.4.2でのみ動作するのでオーバーライドする...
                if (strpos($filename, "products/product_class.tpl") !== false) {
                    $objTransform->select("table.list")->insertAfter(file_get_contents($template_dir . "products/product_class.tpl"));
                } elseif (strpos($filename, "basis/delivery_input.tpl") !== false) {
                    $objTransform->select("table", 3)->replaceElement(file_get_contents($template_dir . "basis/delivery_input.tpl"));
                }
                break;
        }
        $source = $objTransform->getHTML();
    }

    /**
     * SC_系処理の介入箇所とコールバック関数を設定
     * registerはプラグインインスタンス生成時に実行されます
     *
     * @param SC_Helper_Plugin $objHelperPlugin
     */
    function register(SC_Helper_Plugin $objHelperPlugin) {
        $objHelperPlugin->addAction("prefilterTransform", array(&$this, "prefilterTransform"), $this->arrSelfInfo['priority']);
    }
}
?>
