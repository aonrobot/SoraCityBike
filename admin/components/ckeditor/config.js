/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

var roxyFileman = '/SoraCityBike/admin/components/fileman/index.html'; 

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.extraPlugins = 'widget';
	
	config.extraPlugins = 'lineutils';
	
	config.extraPlugins = 'oembed,widget';
	
	config.extraPlugins = 'notification';
	
	config.extraPlugins = 'wordcount';
	
	config.wordcount = {

        // Whether or not you want to show the Word Count
        showWordCount: true,
    
        // Whether or not you want to show the Char Count
        showCharCount: true,
        
        // Maximum allowed Word Count
        //maxWordCount: 4,
    
        // Maximum allowed Char Count
        //maxCharCount: 10
    };
	
	config.filebrowserBrowseUrl = roxyFileman;
	
    config.filebrowserImageBrowseUrl = roxyFileman+'?type=image';
    
    config.removeDialogTabs =  'link:upload;image:upload';
	
};
