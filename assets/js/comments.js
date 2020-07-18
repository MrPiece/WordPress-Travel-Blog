const commentLists = document.querySelectorAll('.comments__list');

commentLists.forEach(list => {
  let depth = list.dataset.depth;
  list.style.marginLeft = `${depth * 30}px`;
});