<?php

$share_title = get_the_title();
$encoded_title = urlencode($share_title);
$encoded_link = urlencode(get_permalink());
$encoded_tweet_url = urlencode(get_permalink());
$encoded_tweet_text = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
// links
$facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $encoded_link;
$twitter = 'https://twitter.com/intent/tweet?url=' . $encoded_tweet_url . '&text=' . $encoded_tweet_text;
$whatsapp = 'https://wa.me/?text=' . $encoded_link;
$linkedin = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . $encoded_link . '&amp;title=' . $encoded_title;
$mailshare = 'https://www.addtoany.com/add_to/email?linkurl='. rawurlencode( home_url() ) . $encoded_link. '&linkname=' . $encoded_title .'&linknote=';
?>
<p class="social__title"><b>Share This</b></p>
<div class="social social--color">
    <a href="<?= $linkedin; ?>" target="_blank" class="social__link">
        <svg class="icon"><use xlink:href="#icon-linkedin"></use></svg>
    </a>
    <a href="<?= $facebook; ?>" target="_blank" class="social__link">
        <svg class="icon"><use xlink:href="#icon-facebook"></use></svg>
    </a>
    <a href="<?= $twitter; ?>" target="_blank" class="social__link">
        <svg class="icon"><use xlink:href="#icon-twitter"></use></svg>
    </a>
</div>
