function scribd_render()
{
    function findAllScribd(regexPattern, sourceString) {
        var output = []
        var match
        var regexPatternWithGlobal = RegExp(regexPattern,"g")
        while (match = regexPatternWithGlobal.exec(sourceString)) {
            delete match.input
            output.push(match)
        } 
        return output
    }

    function processScribdext()
    {
        var element = $('[itemprop="articleSection"]')[0];
        if(element){
            var text = element.innerHTML;
            var matches = findAllScribd(/<[a][^>]*>(https?:\/\/(?:www\.)?scribd\.com\/(?:.*doc|document)\/([^\/]+).*)<\/[a]>/, text);

            if (matches.length > 0) {
                for (var i = 0; i < matches.length; i++) {
                    var scribd_tag = matches[i][0];
                    var scribd_url = matches[i][1];
                    var scribd_id = matches[i][2];

                    if (scribd_url != null && scribd_id != null){
                        var iframe = '<iframe width="100%" height="600" src="https://www.scribd.com/embeds/'+ scribd_id +'/content?start_page=1&view_mode=lis" frameborder="0" allowfullscreen></iframe>';

                        text = text.replace(scribd_tag, iframe);
                    }
                }
            }
            element.innerHTML = text;
        }
    }  
    processScribdext();
}
scribd_render();