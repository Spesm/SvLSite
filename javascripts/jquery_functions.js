$(document).ready(function(){
    $('.add-product-button').click(function(){
        $('.product-count').text((_, present) => parseInt(present) + 1)
        console.log(this.id)
        // $.ajax({
        //     type: 'POST',
        //     url: 'http://localhost/SvLSite/scripts/jquery_test.php',
        //     success: function(data) {
        //         alert(data)
        //     }
        // })
        $.post('http://localhost/SvLSite/scripts/jquery_test.php', {id: this.id}, function(data) {
            alert(data)
        })
    })
})
