<section class="container" style="font-size: 30px; font-weight: bold;">
    <p><?=http_response_code() != 200 ? http_response_code() : $error;?></p>
    <p><?=$message?></p>
</section>