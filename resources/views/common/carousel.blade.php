
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>	
$(document).ready(function() {
	$('.owl-carousel').owlCarousel({
	@if(App::getLocale() === 'ar')
	rtl:true,
	@endif
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    center: true,
    loop: true,
    margin: 10,
    nav:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
        },
        1000:{
            items:3,
        }
    }
})
});
</script>
