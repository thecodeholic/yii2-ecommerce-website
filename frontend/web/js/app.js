/**
 * Created by TheCodeholic on 12/12/2020.
 */
$(function(){
  const $cartQuantity = $('#cart-quantity');
  const $addToCart = $('.btn-add-to-cart');
  $addToCart.click(ev => {
    ev.preventDefault();
    const $this = $(ev.target);
    const id = $this.closest('.product-item').data('key');
    console.log(id);
    $.ajax({
      method: 'POST',
      url: $this.attr('href'),
      data: {id},
      success: function(){
        console.log(arguments)
        $cartQuantity.text(parseInt($cartQuantity.text() || 0) + 1);
      }
    })
  })
});