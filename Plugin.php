<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 为Typecho默认编辑器加上KaTeX解析功能
 * 
 * @package KaTeXForDefaultEditor 
 * @author ZigZagK
 * @version 1.0.0
 * @link https://zigzagk.top
 */
class KaTeXForDefaultEditor_Plugin implements Typecho_Plugin_Interface
{
	/**
	 * 激活插件方法,如果激活失败,直接抛出异常
	 * 
	 * @access public
	 * @return void
	 * @throws Typecho_Plugin_Exception
	 */
	public static function activate(){
		Typecho_Plugin::factory('admin/header.php')->header = array('KaTeXForDefaultEditor_Plugin', 'AddCSS');
		Typecho_Plugin::factory('admin/footer.php')->end = array('KaTeXForDefaultEditor_Plugin', 'AddJS');
	}
	
	/**
	 * 禁用插件方法,如果禁用失败,直接抛出异常
	 * 
	 * @static
	 * @access public
	 * @return void
	 * @throws Typecho_Plugin_Exception
	 */
	public static function deactivate(){}
	
	/**
	 * 获取插件配置面板
	 * 
	 * @access public
	 * @param Typecho_Widget_Helper_Form $form 配置面板
	 * @return void
	 */
	public static function config(Typecho_Widget_Helper_Form $form){
        $display = new Typecho_Widget_Helper_Form_Element_Text('display',NULL,'$$',_t('行间公式识别符'));
        $form->addInput($display);
        $undisplay = new Typecho_Widget_Helper_Form_Element_Text('undisplay',NULL,'$',_t('行内公式识别符'));
        $form->addInput($undisplay);
	}
	
	/**
	 * 个人用户的配置面板
	 * 
	 * @access public
	 * @param Typecho_Widget_Helper_Form $form
	 * @return void
	 */
	public static function personalConfig(Typecho_Widget_Helper_Form $form){}
	
	/**
	 * 插件实现方法
	 * 
	 * @access public
	 * @return void
	 */
	public static function AddCSS($header){
		return $header.'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.1/dist/katex.min.css" integrity="sha384-dbVIfZGuN1Yq7/1Ocstc1lUEm+AT+/rCkibIcC/OmWo5f0EA48Vf8CytHzGrSwbQ" crossorigin="anonymous">';
	}
	public static function AddJS(){
		echo '<script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.1/dist/katex.min.js" integrity="sha384-2BKqo+exmr9su6dir+qCw08N2ZKRucY4PrGQPPWU1A7FtlCGjmEGFqXCv5nyM5Ij" crossorigin="anonymous"></script><script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.1/dist/contrib/auto-render.min.js" integrity="sha384-kWPLUVMOks5AQFrykwIup5lo0m3iMkkHrD0uJ4H5cjeGihAutqP0yW0J6dpFiVkI" crossorigin="anonymous"></script><script>document.addEventListener("DOMContentLoaded", function(){renderMathInElement(document.getElementById("wmd-preview"),{delimiters:[{left:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->display.'",right:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->display.'",display:true},{left:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->undisplay.'",right:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->undisplay.'",display:false}]});});</script><script>$("textarea#text").bind("input propertychange",function(event){setTimeout(\'renderMathInElement(document.getElementById("wmd-preview"),{delimiters:[{left:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->display.'",right:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->display.'",display:true},{left:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->undisplay.'",right:"'.Typecho_Widget::widget('Widget_Options')->plugin('KaTeXForDefaultEditor')->undisplay.'",display:false}]})\',50);});</script>';
	}
}
