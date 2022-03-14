$(document).ready(function(){
    $('.add-product-button').click(function(){
        $('.product-count').text((_, present) => parseInt(present) + 1)
        $.post('http://localhost/SvLSite/index.php', {productId: this.id})
    })
})
