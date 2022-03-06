$(document).ready(function(){
    $('.add-product-button').click(function(){
        $('.product-count').text((_, present) => parseInt(present) + 1)
    })
})
