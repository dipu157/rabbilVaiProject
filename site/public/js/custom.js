// Owl Carousel Start..................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
// Owl Carousel End..................

// Contact Save 

$('#contactSaveBtnId').click(function(){
    var name = $('#contact_nameId').val();
    var mobile = $('#contact_mobileId').val();
    var email = $('#contact_emailId').val();
    var message = $('#contact_msgId').val();

    SaveContact(name,mobile,email,message);
})

function SaveContact(name,mobile,email,message){

    if(name.length==0){
    $('#contactSaveBtnId').html("Input Your Name");
    setTimeout(function(){
        $('#contactSaveBtnId').html("পাঠিয়ে দিন");
    },2000)
  }else if (email.length==0){
    toastr.error('Description Required');
  }else {
    axios.post('/contactSave',{
        'contact_name':name, 
        'contact_mobile':mobile,
        'contact_email':email,
        'contact_message':message,
    })
    .then(function (response){
        if (response.status == 200) {
            $('#contactSaveBtnId').html("Send Successfully");
        setTimeout(function(){
        $('#contactSaveBtnId').html("পাঠিয়ে দিন");
    },2000)
        }
    })
    .catch(function (error){

    })
}
}