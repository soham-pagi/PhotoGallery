const imageUrl = "https://unsplash.it/1366/768?gravity=center";

(function backgroundImgSlider() {
    fetch(imageUrl)
    .then(response => response.blob())
    .then(imgBlob => {
        const newImgUrl = URL.createObjectURL(imgBlob);
        document.body.background = newImgUrl;
    });
    setTimeout(backgroundImgSlider, 10000);
})();