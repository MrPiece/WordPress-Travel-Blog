const mobileSearchIcon = document.getElementById('search-icon');
const mobileSearchForm = document.querySelector('.header__search-mobile');
const mobileSearchFormInput = mobileSearchForm.querySelector('.header__search-mobile-input');
const mobileBrand = document.querySelector('.header__brand');
const mobileMenu = document.querySelector('.header__menu-icon');

document.addEventListener('click', event => {
  if (event.target == mobileSearchIcon) {
    mobileBrand.style.opacity = '0';
    mobileMenu.style.opacity = '0';
    mobileSearchIcon.style.opacity = '0';

    mobileSearchForm.classList.add('header__search-mobile_active');
    setTimeout(() => {
      mobileSearchForm.style.transform = 'translateX(0px)';
    }, 100);
  } else if (!event.target.closest('#mobile-search')) {
    if ( mobileSearchForm.classList.contains('header__search-mobile_active') ) {
      mobileSearchForm.style.transform = 'translateX(100%)';

      setTimeout(() => {
        mobileSearchForm.classList.remove('header__search-mobile_active');
      }, 300);
    }

    mobileBrand.style.opacity = '1';
    mobileMenu.style.opacity = '1';
    mobileSearchIcon.style.opacity = '1';
  }
});