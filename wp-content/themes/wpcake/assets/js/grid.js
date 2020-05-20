
// Masonry effect added to core Galleries
var container = document.querySelector('.blog .content-inner');
var msnry;
// initialize Masonry after all images have loaded
if(container != undefined){
    imagesLoaded( container, function() {
        msnry = new Masonry( container, {
          itemSelector: '.blog.wpcake-blog-grid .post',
          columnWidth: '.blog.wpcake-blog-grid .post',
          gutter: 10,
        });
    });
}
