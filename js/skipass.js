var url = "http://www.montanarigroup.it/skipass/";

$(document).on("pageinit", "#page_skipass", function(evt){
    $.get(url+'programma.html', function(data){
        $('#page_skipass_programma').append(data).trigger("create");
    });
    
    $.get(url+'ospitalita.html', function(data){
        $('#page_skipass_ospitalita').append(data).trigger("create");
    });
    var mappa = '<iframe width="260" height="290" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?f=q&amp;source=s_q&amp;hl=it&amp;geocode=&amp;q=VIALE+VIRGILIO,+70%2F90+-+41100+MODENA&amp;aq=&amp;sll=44.654047,10.862775&amp;sspn=0.011173,0.021307&amp;ie=UTF8&amp;hq=&amp;hnear=Viale+Virgilio,+70,+41123+Modena,+Emilia-Romagna&amp;t=m&amp;ll=44.654673,10.858955&amp;spn=0.017706,0.02223&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.it/maps?f=q&amp;source=embed&amp;hl=it&amp;geocode=&amp;q=VIALE+VIRGILIO,+70%2F90+-+41100+MODENA&amp;aq=&amp;sll=44.654047,10.862775&amp;sspn=0.011173,0.021307&amp;ie=UTF8&amp;hq=&amp;hnear=Viale+Virgilio,+70,+41123+Modena,+Emilia-Romagna&amp;t=m&amp;ll=44.654673,10.858955&amp;spn=0.017706,0.02223&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Visualizzazione ingrandita della mappa</a></small>';
    $('#page_skipass_dovesiamo').append(mappa).trigger('create');
});

$(document).on("pageinit", "#page_news", function(evt){
    $.get(url+'proxy.php?url=news', function(data){
        $('#news').append(data).trigger("create");
    });
});
