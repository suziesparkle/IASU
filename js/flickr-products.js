// JavaScript Document
var cache = [];
$(function(){
	
	$(".iasu_flickr_thumb a").each(function(i) {
		// preload the images <- doesn't seem to be working
		var cacheImage = document.createElement('img');
		cacheImage.src = $(this).attr("href");
     	cache.push(cacheImage);
		
		//alert($(this).attr("href"));
    	$(this).click(function(e) {
			e.preventDefault();
			$(".iasu_flickr_thumb").removeClass("current");
			$(this).parent().addClass("current");
			imgsrc = $(this).attr("href");
			$('#iasu_flickr_img_title').html($(this).find("img").attr("alt"));
			
			$('#iasu_flickr_img').attr("src", imgsrc); 
			// TO DO
			// create a dummy image, load it, then replace the current one.
			
			$('#iasu_flickr_img_link').attr("href" , imgsrc.replace(".jpg", "_b.jpg"));
			return false;
        });
	});
});