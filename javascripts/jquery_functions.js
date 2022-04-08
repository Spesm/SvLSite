$(document).ready(function(){

    $('.jq-add-product').click(function(event) {
        event.preventDefault()
        $('#product-count').text((_, present) => parseInt(present) + 1)
        $.post('http://localhost/SvLSite/index.php', {cartProduct: this.id})
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
        $.post('http://localhost/SvLSite/index.php', {cartProduct: id, quantity: qty}, function(data) {
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
            $.post('http://localhost/SvLSite/index.php', {cartProduct: id, delete: true}, function(totalPrice) {
                $('#total-price').text(totalPrice)
            })
        }
    })

    $('.product-dec').click(function() {
        $('.jq-product-qty').val(function(_, qty) {
            if (qty > 1) {     
                calculateProductCost(parseInt(qty) - 1)           
                return parseInt(qty) - 1
            } else {
                return 0
            }
        })
    })

    $('.product-inc').click(function() {
        $('.jq-product-qty').val(function(_, qty) {
            qty = qty || 0
            if (qty < 999) {   
                calculateProductCost(parseInt(qty) + 1)          
                return parseInt(qty) + 1
            } else {
                return 999
            }
        })
    })

    $('.jq-product-qty').on('input', function() {
        qty = this.value
        calculateProductCost(qty)
    })

    $('.jq-add-to-cart').click(function() {
        id = this.id
        qty = $('.jq-product-qty').val() || 0
        $.post('http://localhost/SvLSite/index.php', {cartProduct: id, quantity: qty}, function(data) {
            amount = data['cart-total'] || data
            $('#product-count').text(data)
        })
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

function calculateProductCost(qty) {
    $('.jq-product-qty').val(function() {
        id = this.id
    })
    $('.jq-product-qty').val(qty)
    qty = qty || 0
    $.post('http://localhost/SvLSite/index.php', {pageProduct: id, quantity: qty}, function(productCost) {
        $('.jq-product-cost').text(productCost)
    })
}
