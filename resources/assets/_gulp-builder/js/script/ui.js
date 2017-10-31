export let ui = {
//POPUP GALLERY

    /**
     * function opens popup with an item when you click on it
     *
     * @param el - an element which we choose as a gallery item
     */
    galleryPopupInit(el) {
        $(el).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            tLoading: 'Загрузка изображения #%curr%...',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
            }
        });
    },
}