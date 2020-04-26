import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

//require('custom');

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';
//import './lib/custom';
//import './lib/custom';
import './components/buttons';
import './my-custom-js/create-patient';
import './my-custom-js/create-indication';
import './my-custom-js/create-colposcopy';
import './my-custom-js/create-studies';
import './my-custom-js/create-laboratories';
import './my-custom-js/globals-module';

$(document).foundation();

//this is for the sidebar arrow icon to work
//this is for the dashboard from dashboard kit but should move it to a custom js file
$('[data-app-dashboard-toggle-shrink]').on('click', function(e) {
  e.preventDefault();
  $(this).parents('.app-dashboard').toggleClass('shrink-medium').toggleClass('shrink-large');
});

//card for patients-all or static-data AGO arrow down icon to togle display none
// more click
$('.card-profile-stats-more-link').click(function(e){
  e.preventDefault();
  if ( $(".card-profile-stats-more-content").is(':hidden') ) {
    $('.card-profile-stats-more-link').find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
  } else {
    $('.card-profile-stats-more-link').find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
  }
  $(this).next('.card-profile-stats-more-content').slideToggle();
});
