$(document).ready(function(){

    $('.add-product').click(function() {
        $('#product-count').text((_, present) => parseInt(present) + 1)
        $.post('http://localhost/SvLSite/index.php', {product: this.id})
    })

    $('.item-amount .decrement').click(function() {
        id = this.id.substring(4)
        $('#num-' + id).val(function(_, current) {
            if (current > 1) {                
                return parseInt(current) - 1
            } else {
                return 0
            }
        }).trigger('input')
    })

    $('.item-amount .increment').click(function() {
        id = this.id.substring(4)
        $('#num-' + id).val(function(_, current) {
            current = current || 0
            if (current < 999) {                
                return parseInt(current) + 1
            } else {
                return 999
            }
        }).trigger('input')
    })

    $('.item-amount .quantity').on('input', function() {
        countCartItems()
        id = this.id.substring(4)
        qty = this.value || 0
        $.post('http://localhost/SvLSite/index.php', {product: id, quantity: qty}, function(data) {
            pricing = JSON.parse(data)
            $('#sub-' + id).text(pricing['product-subtotal'])
            $('#total-price').text(pricing['cart-total'])
        })
    })

    $('.item-delete .fa-trash').click(function() {
        id = this.id.substring(4)
        productName = $('#name-' + id).val()
        if (confirm("Are you sure you want to discard " + productName + " from your cart?")) {
            $('#div-' + id).remove()
            countCartItems()
            $.post('http://localhost/SvLSite/index.php', {product: id, delete: true}, function(totalPrice) {
                $('#total-price').text(totalPrice)
            })
        }
    })
})

function countCartItems() {
    sum = 0
    $('.item-amount .quantity').each(function() {
        sum += +$(this).val()
    })
    $('#product-count').text(sum)
    $('#item-count').text(sum + ' items')
}
