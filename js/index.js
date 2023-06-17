$(document).ready(function(){

    //add to cart - db approach
    $(document).on("click", ".add_Cart", function(e){
        e.preventDefault();
        var form = $(this).closest(".form-submit");
        var id = form.find(".hidden_pid").val();
        var name = form.find(".hidden_name").val();
        var price = form.find(".hidden_price").val();
        var img = form.find(".hidden_img").val();
        var code = form.find(".hidden_code").val();

        $.ajax({
            url: "action.php",
            method: "post",
            data: {pid:id, pname:name, pprice:price, pimg:img, pcode:code},
            success: function(response){
                location.reload();
                load_cart_item_number();
            }
        });
    });

    // calculate cart items added (to be display in navbar as number)

    load_cart_item_number();

    function load_cart_item_number() {
        $.ajax({
            url: "action.php",
            method: "get",
            data: {cartItem: "cart_item"},
            success: function(response){
                $("#cart-item").html(response);
            }
        });
    }

    // update cart item - db approach
    $(".itemQty").on("change", function(){
        var hide = $(this).closest("tr");

        var id = hide.find(".pid").val();
        var price = hide.find(".pprice").val();
        var qty = hide.find(".itemQty").val();
        location.reload(true);

        $.ajax({
            url: "action.php",
            method: "post",
            data: {pqty:qty, pid:id, pprice: price},
            success: function(response){
                console.log(response);
            }
        });
    });

    //checkout
        $("#placeOrder").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: "action.php",
                method: "post",
                data: $("form").serialize()+"&action=order",
                success: function(response){
                    window.location.href = "show_order.php";
                    // $("#showOrder").html(response);
                }
            });
        });


    //--------------------------------------------------

    //add items to wishlist
    $('.add-to-wishlist').click(function(e){
        e.preventDefault();
        var p_id = $(this).attr('data-id');
        $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {addWishlist:p_id},
            success: function(data){
                location.reload();
            }
        });
    });

    //remove items from wishlist
    $('.remove-wishlist-item').click(function(e){
        e.preventDefault();
        var p_id = $(this).attr('data-id');
        $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {removeWishlistItem:p_id},
            success: function(data){
                location.reload();
            }
        });
    });

    //User Registration
    // $('#register_sign_up').submit(function(e){
    //     e.preventDefault();
    //     $('.alert').hide();
    //     var f_name = $(".first_name").val();
    //     var l_name = $(".last_name").val();
    //     var username = $(".user_name").val();
    //     var password = $(".pass_word").val();
    //     var mobile = $(".mobile").val();
    //     var address = $(".address").val();
    //     var city = $(".city").val();

    //     if (f_name == '' || l_name == '' || username == '' || password == '' || mobile == '' || address == '' || city == ''){
    //         $('#register_sign_up').append('<div class="alert alert-danger">Please Fill All The Fields</div>');
    //     }else{
    //         var formdata = new FormData(this);
    //         formdata.append('create','1');
    //         $.ajax({
    //         url:"user.php",
    //         type:"POST",
    //         data: formdata,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success:function(response){
    //             $('.alert').hide();
    //             var res = response;
    //             if(res.hasOwnProperty('success')){
    //                 $('#register_sign_up').append('<div class="alert alert-success">'+res.success+'</div>');
    //                 setTimeout(function(){ window.location.href = 'index.php'; }, 1500);
    //             }else if(res.hasOwnProperty('error')){
    //                 $('#register_sign_up').append('<div class="alert alert-danger">'+res.error+'</div>');
    //             }
    //         }
    //     });
    //     }
    // });

    // // User Login
    // $('#loginUser').submit(function(e){
    //     e.preventDefault();
    //     var username = $('.username').val();
    //     var password = $('.password').val();
    //     if(username == '' || password == ''){
    //         $('#userLogin_form .modal-body').append('<div class="alert alert-danger">Please Fill All The Fields.</div>');
    //     }else{
    //         $.ajax({
    //             url: 'user.php',
    //             method: 'POST',
    //             data: {login:'1',username:username,password:password},
    //             dataType: 'json',
    //             success: function(response){
    //                 $('.alert').hide();
    //                 console.log(response);
    //                 var res = response;
    //                 if(res.hasOwnProperty('success')){
    //                     $('#userLogin_form .modal-body').append('<div class="alert alert-success">LoggedIn Successfully.</div>');
    //                     setTimeout(function(){ location.reload(); }, 1000);
    //                 }else if(res.hasOwnProperty('error')){
    //                     $('#userLogin_form .modal-body').append('<div class="alert alert-danger">'+res.error+'</div>');
    //                 }

    //             }
    //         });
    //     }
    // });

    // //User Logout
    // $('.user_logout').click(function(e){
    //     e.preventDefault();
    //     var user_logout = 1;
    //     $.ajax({
    //         url: 'user.php',
    //         method: 'POST',
    //         data: {user_logout:user_logout},
    //         success: function(response){
    //             if(response == 'true'){
    //                 location.reload();
    //             }
    //         }
    //     });
    // });
});

const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}

// // Product Search Function
// const search = () => {
//     const searchBox = document.getElementById('search-item').value.toUpperCase();
//     const storeItems = document.getElementById('pro-container');
//     const product = document.querySelectorAll('pro');
//     const pname = storeItems.getElementsByTagName('h5');

//     for(var i = 0; i < pname.length; i++) {
//         let match = product[i].getElementsByTagName('h5')[0];

//         if(match){
//             let textValue = match.textContent || match.innerHTML;

//             if(textValue.toUpperCase().indexOf(searchBox) > -1) {
//                 product[i].style.display = "";
//             } else {
//                 product[i].style.display = "none";
//             }
//         }
//     }
// }


// account dropdown
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// Get the modal
// var modal = document.getElementById("userLogin_Form");

// // Get the button that opens the modal
// var loginFormBtn = document.getElementById("loginForm");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks on the button, open the modal
// loginFormBtn.onclick = function() {
//   modal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }