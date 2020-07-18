const posts = document.querySelectorAll('.post');

let trigger = window.matchMedia('(max-width: 1205px) and (min-width: 992px)');
trigger.addListener(removePost);
removePost(trigger);

function removePost(trigger) {
  if (trigger.matches) posts[2].style.display = 'none';
  else posts[2].style.display = 'flex';
}