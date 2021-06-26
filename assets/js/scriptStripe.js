$(function(){

    const stripe = Stripe("pk_test_51IM8bvL6FL0Y9IWwrJZLsGPtuaPTJLfejlOa3l5JkPqPBUJEKIaAuU9JdR7F7PUaWfTfehfPx02kDsr5DqYefVW600mEMOhTDr");
    const checkoutButton = $('#checkout-button');
    checkoutButton.on('click', function(e){
        e.preventDefault();
        console.log($('#email').val());

        
        $.ajax({
            url:'index.php?action=pay',
            method:'post',
            data:{
                name_meal: $("#prods").val(),
                price: $("#totalMenu").val(),
                email: $("#email").val(),
                firstname_client: $("#firstname").val(),
                name_client: $("#name").val()
            },
            datatype: 'json',
            success:function(session){
                console.log(session);
                return stripe.redirectToCheckout({sessionId: session.id});
            },
            error: function(){
                console.error("fail to send!");
            }
        });
    })
});