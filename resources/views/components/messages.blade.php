@if(session()->has('success_message'))
<div class="d-flex align-items-center p-3 rounded-pill flash-message mt-lg-3">
    <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_8QPlLBySLa.json" background="transparent"
        speed="1" style="width: 50px; height: 50px;" autoplay></lottie-player>
    <span class="mx-2 fw-bold" style="font-family: Roboto">{{ session()->get('success_message') }}</span>
</div>
@endif

@if(session()->has('wishlist'))
<div class="d-flex align-items-center p-3 rounded-pill flash-message mt-lg-3">
    <lottie-player src="https://assets10.lottiefiles.com/private_files/lf30_2putscqk.json" background="transparent"
        speed="1" style="width: 50px; height: 50px;" autoplay></lottie-player>
    <span class="mx-2 fw-bold" style="font-family: Roboto">{{ session()->get('wishlist') }}</span>
</div>
@endif

@if(session()->has('delete'))
<div class="d-flex align-items-center p-3 rounded-pill flash-message mt-lg-3">
    <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_piuormtn.json" background="transparent"
        speed="1" style="width: 50px; height: 50px;" autoplay></lottie-player>
    <span class="mx-2 fw-bold" style="font-family: Roboto">{{ session()->get('delete') }}</span>
</div>
@endif

@if(session()->has('wishlist-error'))
<div class="d-flex align-items-center p-3 rounded-pill flash-message mt-lg-3">
    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_bdnjxekx.json" background="transparent"
        speed="1" style="width: 50px; height: 50px;" autoplay></lottie-player>
    <span class="mx-2 fw-bold" style="font-family: Roboto">{{ session()->get('wishlist-error') }}</span>
</div>
@endif

<script>
    setTimeout(function(){
        var flashMessages = document.getElementsByClassName("flash-message");
        var flashMessage = flashMessages[0];
        flashMessage.style.animation = "slideOutRight 1s ease-in-out forwards";
    }, 1780);
</script>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


<style>
    @media (max-width: 600px) {
        .flash-message {
            top: 10px;
        }
    }

    .flash-message {
        position: fixed;
        right: 20px;
        background-color: #333;
        color: #fff;
        padding: 20px;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 18px;
        z-index: 999;
    }

    @keyframes slideOutRight {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: translateX(100%);
        }
    }
</style>
