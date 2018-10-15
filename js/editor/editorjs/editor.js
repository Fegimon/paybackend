    var oEdit1 = new InnovaEditor("oEdit1");

    oEdit1.width ='100%';
    oEdit1.height ='100%';

    /*Add Custom Buttons */
    oEdit1.arrCustomButtons.push(["MyCustomButton", "alert('Custom Command here..')", "Caption..", "btnCustom1.gif"]);

    /*Toolbar Buttons Configuration*/
    oEdit1.groups = [
        ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "CompleteTextDialog", "Styles", "RemoveFormat"]],
        ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
        ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
        ["group4", "", ["CharsDialog", "Line", "SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]],
        ];

    /*Define "InternalLink" & "CustomObject" buttons */
    oEdit1.cmdInternalLink = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom link browser.
    oEdit1.cmdCustomObject = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom file browser.

    /*Enable Custom File Browser */
    oEdit1.fileBrowser = editorPath;

    /*Define "CustomTag" dropdown */
    oEdit1.arrCustomTag = [["First Name", "{%first_name%}"],
        ["Last Name", "{%last_name%}"],
        ["Email", "{%email%}"]]; //Define custom tag selection

    /*Apply stylesheet for the editing content*/

	oEdit1.mode="XHTMLBody";
	oEdit1.returnKeyMode = 2; /* Inserting <DIV>, <P> or <BR> when pressing Enter Key 0:Browser default 1:Div 2:BR 3:P */
	oEdit1.pasteTextOnCtrlV = true; /* MS Word Cleaning and Paste Text */
	
	
	var oEdit2 = new InnovaEditor("oEdit2");

    oEdit2.width ='100%';
    oEdit2.height ='100%';

    /*Add Custom Buttons */
    oEdit2.arrCustomButtons.push(["MyCustomButton", "alert('Custom Command here..')", "Caption..", "btnCustom1.gif"]);

    /*Toolbar Buttons Configuration*/
    oEdit2.groups = [
        ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "CompleteTextDialog", "Styles", "RemoveFormat"]],
        ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
        ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
        ["group4", "", ["CharsDialog", "Line", "SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]],
        ];

    /*Define "InternalLink" & "CustomObject" buttons */
    oEdit2.cmdInternalLink = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom link browser.
    oEdit2.cmdCustomObject = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom file browser.

    /*Enable Custom File Browser */
    oEdit2.fileBrowser = editorPath;

    /*Define "CustomTag" dropdown */
    oEdit2.arrCustomTag = [["First Name", "{%first_name%}"],
        ["Last Name", "{%last_name%}"],
        ["Email", "{%email%}"]]; //Define custom tag selection

    /*Apply stylesheet for the editing content*/

	oEdit2.mode="XHTMLBody";
	oEdit2.returnKeyMode = 2; /* Inserting <DIV>, <P> or <BR> when pressing Enter Key 0:Browser default 1:Div 2:BR 3:P */
	oEdit2.pasteTextOnCtrlV = true; /* MS Word Cleaning and Paste Text */
	
	var oEdit3 = new InnovaEditor("oEdit3");

    oEdit3.width ='100%';
    oEdit3.height ='100%';

    /*Add Custom Buttons */
    oEdit3.arrCustomButtons.push(["MyCustomButton", "alert('Custom Command here..')", "Caption..", "btnCustom1.gif"]);

    /*Toolbar Buttons Configuration*/
    oEdit3.groups = [
        ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "CompleteTextDialog", "Styles", "RemoveFormat"]],
        ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
        ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
        ["group4", "", ["CharsDialog", "Line", "SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]],
        ];

    /*Define "InternalLink" & "CustomObject" buttons */
    oEdit3.cmdInternalLink = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom link browser.
    oEdit3.cmdCustomObject = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom file browser.

    /*Enable Custom File Browser */
    oEdit3.fileBrowser = editorPath;

    /*Define "CustomTag" dropdown */
    oEdit3.arrCustomTag = [["First Name", "{%first_name%}"],
        ["Last Name", "{%last_name%}"],
        ["Email", "{%email%}"]]; //Define custom tag selection

    /*Apply stylesheet for the editing content*/

	oEdit3.mode="XHTMLBody";
	oEdit3.returnKeyMode = 2; /* Inserting <DIV>, <P> or <BR> when pressing Enter Key 0:Browser default 1:Div 2:BR 3:P */
	oEdit3.pasteTextOnCtrlV = true; /* MS Word Cleaning and Paste Text */
	
	var oEdit4 = new InnovaEditor("oEdit4");

    oEdit4.width ='100%';
    oEdit4.height ='100%';

    /*Add Custom Buttons */
    oEdit4.arrCustomButtons.push(["MyCustomButton", "alert('Custom Command here..')", "Caption..", "btnCustom1.gif"]);

    /*Toolbar Buttons Configuration*/
    oEdit4.groups = [
        ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "CompleteTextDialog", "Styles", "RemoveFormat"]],
        ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
        ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
        ["group4", "", ["CharsDialog", "Line", "SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]],
        ];

    /*Define "InternalLink" & "CustomObject" buttons */
    oEdit4.cmdInternalLink = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom link browser.
    oEdit4.cmdCustomObject = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom file browser.

    /*Enable Custom File Browser */
    oEdit4.fileBrowser = editorPath;

    /*Define "CustomTag" dropdown */
    oEdit4.arrCustomTag = [["First Name", "{%first_name%}"],
        ["Last Name", "{%last_name%}"],
        ["Email", "{%email%}"]]; //Define custom tag selection

    /*Apply stylesheet for the editing content*/

	oEdit4.mode="XHTMLBody";
	oEdit4.returnKeyMode = 2; /* Inserting <DIV>, <P> or <BR> when pressing Enter Key 0:Browser default 1:Div 2:BR 3:P */
	oEdit4.pasteTextOnCtrlV = true; /* MS Word Cleaning and Paste Text */
	
	var oEdit5 = new InnovaEditor("oEdit5");

    oEdit5.width ='100%';
    oEdit5.height ='100%';

    /*Add Custom Buttons */
    oEdit5.arrCustomButtons.push(["MyCustomButton", "alert('Custom Command here..')", "Caption..", "btnCustom1.gif"]);

    /*Toolbar Buttons Configuration*/
    oEdit5.groups = [
        ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "CompleteTextDialog", "Styles", "RemoveFormat"]],
        ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
        ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
        ["group4", "", ["CharsDialog", "Line", "SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]],
        ];

    /*Define "InternalLink" & "CustomObject" buttons */
    oEdit5.cmdInternalLink = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom link browser.
    oEdit5.cmdCustomObject = "modalDialog('my_custom_dialog.htm',650,350)"; //Command to open your custom file browser.

    /*Enable Custom File Browser */
    oEdit5.fileBrowser = editorPath;

    /*Define "CustomTag" dropdown */
    oEdit5.arrCustomTag = [["First Name", "{%first_name%}"],
        ["Last Name", "{%last_name%}"],
        ["Email", "{%email%}"]]; //Define custom tag selection

    /*Apply stylesheet for the editing content*/

	oEdit5.mode="XHTMLBody";
	oEdit5.returnKeyMode = 2; /* Inserting <DIV>, <P> or <BR> when pressing Enter Key 0:Browser default 1:Div 2:BR 3:P */
	oEdit5.pasteTextOnCtrlV = true; /* MS Word Cleaning and Paste Text */