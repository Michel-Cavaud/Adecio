/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
// Define changes to default configuration here.
// For complete reference see:
// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

    // The toolbar groups arrangement, optimized for a single toolbar row.
    config.toolbarGroups = [
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
        {name: 'forms'},
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
        {name: 'styles'},
        {name: 'insert'},
        {name: 'links'},
        {name: 'colors'},
    ];

    //config.coreStyles_italic = { element: 'i', overrides: 'em' };
    CKEDITOR.config.coreStyles_italic = {
        element: 'span',
             attributes: { 'class': 'Italic'
            }
     };
    config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

    config.removeDialogTabs = 'link:advanced';
    config.colorButton_colors = '000,FFF,00737f,464646,cce2e5,f7dfe4,e83c69,ecebec';
    config.font_names = 'Dosis;Krub, sans-serif';
    config.fontSize_sizes = 'Très petit/0.6rem;Petit/0.8rem;Normal/1rem;Grand/1.25rem;Plus grand/1.5rem;Très grand/1.75rem';

    config.extraPlugins = 'nbsp';


};

CKEDITOR.on('dialogDefinition', function (ev) {
//Take the dialog name and its definition from the event data.
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
//Check if the definition is from the dialog we're
//interested in (the 'link' dialog).
    if (dialogName == 'link') {
//       Remove the 'Upload' and 'Advanced' tabs from the 'Link' dialog.
//       dialogDefinition.removeContents('upload');
//       dialogDefinition.removeContents('advanced');
//Get a reference to the 'Link Info' tab.
        var infoTab = dialogDefinition.getContents('info');
//Remove unnecessary widgets from the 'Link Info' tab.

//Get a reference to the "Target" tab and set default to '_blank'
        var targetTab = dialogDefinition.getContents('target');
        var targetField = targetTab.get('linkTargetType');
        targetField['default'] = '_blank';
    }
});

