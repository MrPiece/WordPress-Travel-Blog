<?php get_header(); ?>

<main class="single">
  <div class="container">
    <section class="contacts">
        <div class="contacts__text">
          <h1>Let me know your blog experience!</h1>
          <p><?= get_post_field('post_content', $post->ID) ?></p>
        </div>

        <?= do_shortcode('[contact-form-7 id="101" title="Main contact form"]') ?>

        <!-- <form action="" method="post" class="contact-form">
          <label for="full-name">Your full name</label>
          <input type="text" name="full-name" id="full-name">

          <label for="email">Your email address</label>
          <input type="email" name="email" id="email">

          <label for="title">Your message title</label>
          <input type="text" name="title" id="title">

          <label for="message">Your message text</label>
          <textarea name="message" id="message" cols="30" rows="10"></textarea>

          <button type="submit" class="action-button">Send the message</button>
        </form> -->
    </section>
  </div>
</main>

<?php get_footer() ?>