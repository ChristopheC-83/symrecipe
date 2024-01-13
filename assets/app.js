import './bootstrap.js';
import './alert.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


const alerts = document.querySelectorAll(".alert");

if (alerts.length > 0) {
    console.log ("alert !!!")
  alerts.forEach((alert) => {
    setTimeout(() => {
      alert.classList.add("hide");
    }, 3000);
  });
}