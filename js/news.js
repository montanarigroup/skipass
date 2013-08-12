$( document ).bind( 'mobileinit', function(){
  $.mobile.loader.prototype.options.text = "loading";
  $.mobile.loader.prototype.options.textVisible = false;
  $.mobile.loader.prototype.options.theme = "a";
  $.mobile.loader.prototype.options.html = "";
});

$(document).on("pageinit", "#page_news", function(evt){
    $.mobile.loading('show');
/*
    var theme = $.mobile.loader.prototype.options.theme,
        msgText = "",
        textVisible = false,
        textonly = false;
        html = "";

    $.mobile.loading( "show", {
        text: msgText,
        textVisible: textVisible,
        theme: theme,
        textonly: textonly,
        html: html
    });
*/
    $.get('http://www.montanarigroup.it/skipass/proxy.php?url=news', function(data){
        $('#news').append(data).trigger("create");
        $.mobile.loading('hide');
    });
});
