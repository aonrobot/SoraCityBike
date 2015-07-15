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
	
	config.extraPlugins = 'panelbutton';
	
	config.extraPlugins = 'floatpanel';
	
	config.extraPlugins = 'stylescombo';
	
	config.extraPlugins = 'colorbutton';
	
	config.filebrowserBrowseUrl = roxyFileman;
	
    config.filebrowserImageBrowseUrl = roxyFileman+'?type=image';
    
    config.removeDialogTabs =  'link:upload;image:upload';
	
};
