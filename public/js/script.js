const btnBurger = document.getElementById('btn-burger');
const burgerMenu = document.getElementById('burger-menu');
const btnSearch = document.getElementById('btn-search');
const searchBarLarge = document.getElementById('search-bar-large');
const btnProfile = document.getElementById('btn-profile');
const profileMenu = document.getElementsByClassName('profile-menu')

// Menyembunyikan menu apabila melakukan klik di luar navbar
document.addEventListener('click', (event) => {
    if (!document.getElementsByTagName('nav')[0].contains(event.target)) {
        hideBurger();
        hideSearchBarLarge();
        hideProfileMenu();
    }
})

// Membuka atau menutup burger menu
btnBurger.addEventListener('click', () => {
    if (burgerMenu.classList.contains('hidden')) {
        burgerMenu.classList.remove('hidden');
        btnBurger.classList.add('open');
        setTimeout(() => {
            burgerMenu.classList.remove('scale-y-0');
        }, 150);
    } else {
        burgerMenu.classList.add('scale-y-0');
        setTimeout(() => {
            btnBurger.classList.remove('open');
            burgerMenu.classList.add('hidden');
        }, 150);
    }
    hideSearchBarLarge();
    hideProfileMenu();
})

// Membuka atau menutup search bar (large)
btnSearch.addEventListener('click', () => {
    if (searchBarLarge.classList.contains('hidden')) {
        searchBarLarge.classList.remove('hidden');
        setTimeout(() => {
            searchBarLarge.classList.remove('scale-y-0');
        }, 150);
    } else {
        searchBarLarge.classList.add('scale-y-0');
        setTimeout(() => {
            searchBarLarge.classList.add('hidden');
        }, 150);
    }
    hideBurger();
    hideProfileMenu();
})

// Membuka atau menutup menu profil
btnProfile.addEventListener('click', () => {
    for (let index = 0; index < profileMenu.length; index++) {
        if (profileMenu[index].classList.contains('hidden')) {
            profileMenu[index].classList.remove('hidden');
            setTimeout(() => {
                profileMenu[index].classList.remove('scale-y-0')
            }, 150);
        } else {
            profileMenu[index].classList.add('scale-y-0');
            setTimeout(() => {
                profileMenu[index].classList.add('hidden');
            }, 150);
        }
    }
    hideBurger();
    hideSearchBarLarge();
}, false)

// Menyembunyikan burger menu
function hideBurger() {
    burgerMenu.classList.add('scale-y-0');
    setTimeout(() => {
        btnBurger.classList.remove('open');
        burgerMenu.classList.add('hidden');
    }, 150);
}

// Menyembunyikan search bar (large)
function hideSearchBarLarge() {
    searchBarLarge.classList.add('scale-y-0');
    setTimeout(() => {
        searchBarLarge.classList.add('hidden');
    }, 150);
}

// Menyembunyikan profile menu
function hideProfileMenu() {
    for (let index = 0; index < profileMenu.length; index++) {
        profileMenu[index].classList.add('scale-y-0');
        setTimeout(() => {
            profileMenu[index].classList.add('hidden');
        }, 150);
    }
}