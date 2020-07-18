// TODO: Height changes before transition ends, that causes problems when you click fast

const accordionTrigger = window.matchMedia('(max-width: 992px)');
accordionTrigger.addListener(launch);
launch(accordionTrigger);


function launch() {
  if (accordionTrigger.matches) {
    const mobileDropmenu = document.querySelector('.mobile-dropmenu');
    mobileDropmenu.addEventListener('click', pickTarget);
  }
}


function pickTarget(event) {
  const dropmenu = event.target.closest('.mobile-dropmenu');
  const dropmenuOptions = event.target.closest('.mobile-dropmenu__options');
  const accordion = event.target.closest('.accordion');

  if (dropmenuOptions) 
    toggleOptions(dropmenu, event.target.closest('[id^="list-button"]'));
  else if (accordion) 
    toggleAccordion(dropmenu, accordion, event.target.closest('.accordion__button'));
}


function toggleOptions(dropmenu, option) {
  if (option) {
    const arrow = option.querySelector('.arrow-down');
    const diffArrow = option.nextElementSibling 
      ? option.nextElementSibling.querySelector('.arrow-down') 
      : option.previousElementSibling.querySelector('.arrow-down');

    arrow.classList.toggle('opened');
    diffArrow.classList.remove('opened');

    const containerPostfix = option.matches('[id$="sort"]') ? 'sort' : 'filter';
    const container = dropmenu.querySelector(`#list-container-${containerPostfix}`);
    const toHideContainer = container.nextElementSibling
      ? container.nextElementSibling
      : container.previousElementSibling;

    container.style.display = 'block';
    toHideContainer.style.display = 'none';
    let newHeight = 0;
    
    if (dropmenu.dataset.open != `${containerPostfix}` || !dropmenu.dataset.open) {
      newHeight = +dropmenu.dataset.height + container.clientHeight;
      dropmenu.dataset.open = `${containerPostfix}`;
    } else {
      newHeight = dropmenu.dataset.height;
      dropmenu.dataset.open = 'false';
    }

    dropmenu.style.height = `${newHeight}px`;
  }
}


function toggleAccordion(dropmenu, accordion, button) {
  if (button) {
    const panelHeight = accordion.querySelector('.accordion__panel').clientHeight;
    const buttonArrow = button.querySelector('.accordion__arrow');
    let accordionHeight = 0;
    let dropmenuHeight = 0;

    if (accordion.dataset.open == 'true') {
      accordionHeight = +accordion.dataset.height;
      dropmenuHeight = dropmenu.clientHeight - panelHeight;
      accordion.dataset.open = 'false';
    } else {
      accordionHeight = +accordion.dataset.height + panelHeight;
      dropmenuHeight = dropmenu.clientHeight + panelHeight;
      accordion.dataset.open = 'true';
    }

    dropmenu.style.height = `${dropmenuHeight}px`
    accordion.style.height = `${accordionHeight}px`;
  }
}