const searchWidget = document.querySelector('.sidebar__widget-search');
const searchButton = searchWidget.querySelector('.search__button');
const searchInput = searchWidget.querySelector('.search__input');

searchButton.addEventListener('mouseover', () => {
  searchInput.classList.add('search_hovered');
});

searchButton.addEventListener('mouseout', () => {
  searchInput.classList.remove('search_hovered');
});

searchInput.addEventListener('focusin', () => {
  searchInput.classList.add('search__input_focused');
});

searchInput.addEventListener('focusout', () => {
  searchInput.classList.remove('search__input_focused');
});