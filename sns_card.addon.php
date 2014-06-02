<?php
/**
 * sns_card.addon.php
 * User: canto87
 * Date: 2014/06/02
 * Time: 21:15
 */
if(!defined('__XE__')) exit();

if($called_position == "before_display_content"){
	$doc_src = Context::get('document_srl');
	$oDocumentModel = &getModel('document');
	$oDocument = $oDocumentModel->getDocument($doc_src);
	$title = cut_str(strip_tags($oDocument->get('title')),70,'');
	$content = cut_str(strip_tags($oDocument->get('content')),200,'');
	$file_list = $oDocument->getUploadedFiles();
	if($file_list){
		$source = $file_list[0]->uploaded_filename;
		if(strlen($source) >= 2 && substr_compare($source, './', 0, 2) === 0)
		{
			$filePath = Context::get('request_uri') . substr($source, 2);

		}
	}
	$meta = '<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="'.$addon_info->twitter.'">
<meta name="twitter:title" content="'.$title.'">
<meta name="twitter:description" content="'.$content.'">
<meta name="twitter:image:src" content="'.$filePath.'">
<meta name="twitter:domain" content="'.Context::getSiteTitle().'">
<meta property="og:title" content="'.$title.'">
<meta property="og:type" content="article">
<meta property="og:url" content="'.Context::get('current_url').'">
<meta property="og:image" content="'.$filePath.'">
<meta property="og:description" content="'.$content.'">';
	Context::addHtmlHeader($meta);
}