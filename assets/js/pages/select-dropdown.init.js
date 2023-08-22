document.addEventListener("DOMContentLoaded", function() {
	$.validator.setDefaults({ ignore: ":hidden:not(.choices__input)" }) 
    var e = document.querySelectorAll("[data-trigger]");
    for (i = 0; i < e.length; ++i) {
        var a = e[i];
        new Choices(a, {
            placeholderValue: null,
            searchPlaceholderValue: "This is a search placeholder",
            prependValue: null,
	    	appendValue: null,
        })
    }
});