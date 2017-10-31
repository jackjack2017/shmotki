import { Slider } from '../libs/slider';
import {ui} from './ui';
// import {Sendform} from '../libs/sendform/sendform2';
// import { MfPopup } from '../libs/popup/mfpopup';
// import { AjaxPopup } from '../libs/popup/ajaxPopup';
// import { MagicPopup } from '../libs/popup/magicPopup';
// import {Filter} from '../libs/filter';
// import { GoogleMap } from '../libs/maps/google_map';
$( document ).ready(function() {
    if(NODE_ENV === 'dev'){
        console.log('its dev mode use prod mode for production');
    }
    let projectApp = new App();
    global.app = projectApp;
    projectApp.init();
});


class App{
    // Define global visible variable inside app 
    constructor(){}
    init(){
        //used in Product slider block (Product page)
        ui.galleryPopupInit('.js_gallery-product');

    	new Slider('.js_slider-main', {
            nav: true,
            dots: true,
            items: 4,
            margin: 10
        });

        new Slider('.js_slider-product', {
            nav: false,
            dots: true,
            items: 1,
            touchDrag: false,
            mouseDrag: false,
            dotsContainer: '.js_product-slider-dots-container'
        });

          // new GoogleMap({
          //    identifier:'#map-google',
          //    dataFromView: false,
          //    center:[55.618583, 37.394107],
          //    zoom: 16,
          //    placemarks:[
          //        {
          //            coordinate: [55.618583, 37.394107],
          //            hint:' Москва, Киевское шоссе, 5 км от МКАД',
          //            iconColor: 'red',
          //            baloonCnt: 'safsafa'
          //        },
          //        {
          //            coordinate: [55.6182383, 37.395507],
          //            hint:' Rsfa, Киевское шоссе, 5 км от МКАД',
          //        }
          //    ]
          // });
              
    }
};