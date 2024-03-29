'use strict';

var global_config = {
    navHeight: 75,
    mobileNavHeight: 60,
    navPadding: 75,
    transitionDuration: 1000,
    mobileBreakpoint: 768,
    debug: true
};

var config = {
    stickyNav: {
        selector: '#nav',
        navHeight: global_config.headerHeight,
        mobileNavHeight: global_config.headerHeight,
        mobileBreakpoint: global_config.mobileBreakpoint,
        activeOnMobile: true
    },
    linksNewTab: {
    },
    jumpLinks: {
        selector: '.jump',
        navHeight: global_config.navHeight,
        mobileNavHeight: global_config.mobileNavHeight,
        jumpPadding: 0,
        mobileJumpPadding: global_config.navPadding,
        mobileBreakpoint: global_config.mobileBreakpoint,
        transitionDuration: global_config.transitionDuration,
        preventUrlChange: false
    },
    loading: {
        loadDelay: 1500,
        loadingClass: 'loading',
        loadedClass: 'loaded',
    },
    modals: {
        modalClass: 'modal',
        modalCloseClass: 'modal-close',
        modalToggleClass: 'modal-toggle',
        modalOnBodyClass: 'modal-on',
        modalOffBodyClass: 'modal-off'
    },
    scrollSpy: {
        firstElementSelector : '.spy-first',
        spyTargetSelector : '.spy-target',
        spyLinkSelector : '.spy-link',
        spyActiveClass : 'spy-active',
        spyOffset : 50
    },
    menuToggle:{
        menuToggleSelector: '.menu-toggle',
        menuSelector: '#mobile-nav',
        blanketSelector: '#menu-blanket',
        bodyOffClass: 'menu-closed',
        bodyOnClass: 'menu-open'
    },
    slickSlideshows: {
        defaultSelector: '.slick-default',
        slidesToShow: 1,
        dots: true,
        arrows: true,
        autoplay: true,
        fade: true,
        autoplaySpeed: 5000,
        speed: 700
    },
    gradient: {
        navSelector: '#nav',
        navHeight: global_config.navHeight,
        mobileNavHeight: global_config.mobileNavHeight,
        mobileBreakpoint: global_config.mobileBreakpoint
    },
    map: {
        mapSelector: '#map',
        mapAspectRatio: 1/2,
        scaleRatio: 1.1,
        partnersEndpoint: '/wp-json/wp/v2/partners?filter[partner_role]=research-partners&per_page=100',
        researchPartnersTaxonomy: 5,
        excludedStates:  ['Alaska', 'Hawaii', 'Puerto Rico'],
        typeOffsetMultiplier: -1/4,
        fontSize: 32,
        debug: global_config.debug,
        transitionDuration: global_config.transitionDuration / 4,
        mapIdealWidth: 600
    }
};

export { config };
