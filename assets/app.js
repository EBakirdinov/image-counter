document.addEventListener('DOMContentLoaded', function () {
    let images = document.querySelectorAll('img');
    let totalSize = 0;

    function getFileSize(url) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.responseType = "arraybuffer";
        
        xhr.onreadystatechange = function() {
            if(this.readyState == this.DONE) {
                totalSize +=  this.response.byteLength  / 1024 / 1024;

                document.querySelector('span.size > span').innerText = totalSize.toFixed(1);
            };
        };

        xhr.send(null);
    };

    images.forEach(function (image) {
        getFileSize(image.src);
    }); 
});