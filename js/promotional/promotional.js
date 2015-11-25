var Popup = {
	closeurl: '',
    init:function (url, popupCloseUrl) {
        
        var popupBox = $("popup_box");
		var width = 200; 	//Default Width
        var height = 300; 	//Default Height
		this.closeurl = popupCloseUrl;
        
		new Ajax.Request(url, {
            method:'get',
            onSuccess:function (transport) {
                var json = transport.responseText.evalJSON(true);
                if (!json.error) {
                    if (json.width > width) {
                        width = json.width;
                    }
                    if (json.height > height) {
                        height = json.height;
                    }

                    // set size window
                    popupBox.style.width = width + 'px';
                    popupBox.style.height = height + 'px';
                    
					/*popupBox.style.marginLeft = '-' + (width / 2) + 'px';

                    // set position window
                    switch (json.position) {
                        case '2':
                            popupBox.style.marginTop = '-' + (height / 2) + 'px';
                            popupBox.style.top = '50%';
                            break;
                        case '3':
                            popupBox.style.marginTop = '-' + ( parseInt(height) + 40) + 'px';
                            popupBox.style.top = '100%';
                            break;
                        case '1':
                        default:
                            popupBox.style.marginTop = '20px';
                    }
					
                    popupBox.style.left = '50%';*/
                    $('popup_title').innerHTML = json.title;
                    $('popup_html').innerHTML = json.popup_html;

                    Popup.showWindow();

                    //auto hide
                    if (json.auto_hide_time) {
                        setTimeout(function () {
                            Popup.hideWindow();
                        }, parseInt(json.auto_hide_time) * 1000);
                    }
                }
            }
        });
    },

    showWindow:function () {
        Effect.Appear($('popup_layout'), { duration:0.6, from:0.0, to:0.9 });
        Effect.Appear($('popup_box'), { duration:0.6 });
    },

    hideWindow:function () {
		var poupCloseUrl = this.closeurl;
		new Ajax.Request(poupCloseUrl, { method:'post' });
        Effect.Fade($('popup_box'), { duration:0.6 });
        Effect.Fade($('popup_layout'), { duration:0.6 });

    }
}
