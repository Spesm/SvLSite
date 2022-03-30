$(document).ready(function(){

    $('.add-product-button').click(function() {
        $('#product-count').text((_, present) => parseInt(present) + 1)
        $.post('http://localhost/SvLSite/index.php', {product: this.id})
    })

    $('.item-amount .decrement').click(function() {
        id = this.id.substring(4)
        $('#num-' + id).val(function(_, present) {
            if (present > 1) {                
                return parseInt(present) - 1
            } else {
                return 0
            }
        }).trigger('input')
    })

    $('.item-amount .increment').click(function() {
        id = this.id.substring(4)
        $('#num-' + id).val(function(_, present) {
            present = present || 0
            if (present < 999) {                
                return parseInt(present) + 1
            } else {
                return 999
            }
        }).trigger('input')
    })

    $('.item-amount .quantity').on('input', function() {
        sum = 0
        $('.item-amount .quantity').each(function() {
            sum += +$(this).val()
        })
        $('#product-count').text(sum)
        id = this.id.substring(4)
        qty = this.value || 0
        price = $('#ppu-' + id).val()
        $.post('http://localhost/SvLSite/index.php', {product: id, quantity: qty, unitPrice: price}, function(price) {
            $('#sub-' + id).text(price)
        })
    })
})
