document.querySelector('video').playbackRate = 0.8;

document.addEventListener("DOMContentLoaded", function () {
    registerEventListeners();
    activateMenu();
});

function registerEventListeners() {
    var thumbnailArray = document.getElementsByClassName("img-thumbnail");

    for (var image of thumbnailArray) {
        // Check if the image is a product image or not
        if (image.classList.contains("product-image")) {
            image.addEventListener("click", redirectToProductDetailPage);
        }
    };

    function redirectToProductDetailPage() {
        var productId = this.dataset.productId;
        window.location.href = "product_detail.php?product_id=" + productId;
    }
}

function activateMenu() {
    const navLinks = document.querySelectorAll("nav a");
    navLinks.forEach(link => {
        if (link.href === location.href) {
            link.classList.add('active');
        }
    });
}
