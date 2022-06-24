"use strict";

require('./bootstrap');
import Swup from 'swup';
import anime from 'animejs/lib/anime.es.js';
import ProgressBar from 'progressbar.js';
import Typed from 'typed.js';
import { Fancybox } from "@fancyapps/ui";
import Scrollbar from 'smooth-scrollbar';
import OverscrollPlugin from 'smooth-scrollbar/plugins/overscroll';
import Isotope from 'isotope-layout';
import Swiper from 'swiper/bundle';
import { lowerCase } from 'lodash';

var lang = document.getElementsByTagName("html")[0].getAttribute("lang");
const _RTL = lang == 'fa'

new Swup({
	containers: ["#swup", "#swupMenu"],
	animateHistoryBrowsing: true,
	linkSelector: 'a:not([data-no-swup])'
});

new ProgressBar.Line(preloader, {
	strokeWidth: 1.7,
	easing: 'easeInOut',
	duration: 1400,
	delay: 750,
	trailWidth: 1.7,
	svgStyle: {
		width: '100%',
		height: '100%'
	},
	step: (state, bar) => {
		bar.setText(Math.round(bar.value() * 100) + ' %');
	}
}).animate(1);

// progressbars
document.querySelectorAll('.art-cirkle-progress').forEach(function(el) {
	new ProgressBar.Circle(el, {
		strokeWidth: 7,
		easing: 'easeInOut',
		duration: 1400,
		delay: 2000 + ((Math.floor(Math.random() * 9) + 1) * 100),
		trailWidth: 7,
		step: function(state, circle) {
			var value = Math.round(circle.value() * 100);
			if (value === 0) {
				circle.setText('');
			} else {
				circle.setText(value);
			}
		}
	}).animate(el.dataset.value/100);
});

document.querySelectorAll('.art-line-progress .line-progress').forEach(function(el) {
	new ProgressBar.Line(el, {
		strokeWidth: 1.72,
		easing: 'easeInOut',
		duration: 1400,
		delay: 2800,
		trailWidth: 1.72,
		enableRTL: _RTL,
		svgStyle: {
			width: '100%',
			height: '100%'
		},
		step: (state, bar) => {
			bar.setText(Math.round(bar.value() * 100) + ' %');
		}
	}).animate(el.dataset.value/100);
});

// document.querySelector('.art-map-overlay').addEventListener("click", function(e) {
// 	document.querySelector('.art-map-overlay').classList.toggle('art-active');
// });

document.querySelector('.art-info-bar-btn').addEventListener("click", function(e) {
	document.querySelector('.art-info-bar').classList.toggle('art-active');
	document.querySelector('.art-menu-bar-btn').classList.toggle('art-disabled');
});

document.querySelector('.art-menu-bar-btn').addEventListener("click", function(e) {
	document.querySelectorAll('.art-menu-bar-btn, .art-menu-bar').forEach(function (el) {
		el.classList.toggle('art-active');
	});
	document.querySelector('.art-info-bar-btn').classList.toggle('art-disabled');
});

document.querySelectorAll('.art-info-bar-btn, .art-menu-bar-btn').forEach(function (el) {
	el.addEventListener("click", function(e) {
		document.querySelector('.art-content').classList.toggle('art-active');
	});
});

document.querySelectorAll('.art-curtain, .art-mobile-top-bar').forEach(function (el) {
	el.addEventListener("click", function(e) {
		document.querySelectorAll('.art-menu-bar-btn , .art-menu-bar , .art-info-bar , .art-content , .art-menu-bar-btn , .art-info-bar-btn').forEach(function (el) {
			el.classList.remove('art-active');
			el.classList.remove('art-disabled');
		});
	});
});

// reinit
document.addEventListener("swup:contentReplaced", function() {
	init();
});

function init() {
	Fancybox.defaults.Hash = false;

	Scrollbar.use(OverscrollPlugin);

	Scrollbar.init(document.querySelector('#scrollbar'), {
		damping: 0.05,
		renderByPixel: true,
		continuousScrolling: true,
	});
	
	Scrollbar.init(document.querySelector('#scrollbar2'), {
		damping: 0.05,
		renderByPixel: true,
		continuousScrolling: true,
	});

	let clone = document.querySelector('.current-menu-item a').cloneNode(true); document.querySelector('.art-current-page').appendChild(clone);

	document.querySelectorAll('.menu-item').forEach(function (menuItem) {
		menuItem.addEventListener("click", function(e) {
			e = e || window.event;
			if (e.target.classList.contains("menu-item-has-children")) {
				e.target.querySelectorAll(':scope > .sub-menu').forEach(function (el) {
					el.classList.toggle('art-active');
				});
			} else {
				document.querySelectorAll('.art-menu-bar-btn , .art-menu-bar , .art-info-bar , .art-content , .art-menu-bar-btn , .art-info-bar-btn').forEach(function (el) {
					el.classList.remove('art-active');
					el.classList.remove('art-disabled');
				});
			}
		});
	});

	// counters
	anime({
		targets: '.art-counter-frame',
		opacity: [0, 1],
		duration: 800,
		delay: 2300,
		easing: 'linear',
	});

	anime({
		targets: '.art-counter',
		delay: 1300,
		opacity: [1, 1],
		complete: function(anim) {
			document.querySelectorAll('.art-counter').forEach(function(el) {
				el.Counter = 0;
				animate(el, 0, el.innerHTML, 2000);
			});
		}
	});

	Fancybox.bind('[data-fancybox="diplome"]', {
		transitionDuration: 1200,
		Toolbar: {
			display: [
				"zoom",
				"slideshow",
				"thumbs",
				"close",
			],
			autoEnable: false,
		},
	});
	
	Fancybox.bind('[data-fancybox="gallery"]', {
		transitionDuration: 1200,
		Toolbar: {
			display: [
				"zoom",
				"share",
				"slideshow",
				"thumbs",
				"close",
			],
			autoEnable: false,
		},
	});
	
	Fancybox.bind('[data-fancybox="avatar"]', {
		transitionDuration: 1200,
		Toolbar: {
			display: [
				"zoom",
				"close",
			],
			autoEnable: false,
		},
	});
	
	// display: ["counter", "zoom", "slideshow", "fullscreen", "thumbs", "close"],
	Fancybox.bind('[data-fancybox="recommendation"]', {
		transitionDuration: 1200,
		Toolbar: {
			display: [
				"close"
			],
			autoEnable: false,
		},
		Carousel: {
			Navigation: {
				classNames: {
					main: "fancybox__nav hidden",
					button: "carousel__button hidden",
				}
			},
		}
	});

	// masonry Grid
	if (document.querySelector('.art-grid') !== null)
	{
		var $isotope = new Isotope('.art-grid', {
			// options
			filter: '*',
			itemSelector: '.art-grid-item',
			transitionDuration: '.6s',
			originLeft: !_RTL,
			masonry: {
			}
		});

		// portfolio filter
		document.querySelectorAll('.art-filter a').forEach(function (el) {
			el.addEventListener("click", function(e) {

				var targetElement = e.target || e.srcElement;

				document.querySelector('.art-filter .art-current').classList.remove('art-current');
				targetElement.classList.add('art-current');
				var selector = targetElement.dataset.filter;

				if ($isotope) $isotope.arrange({filter: selector});

				return false;
			});
		});
	}

	// Contact form
	let elements = document.querySelector('.art-input');
	if (elements !== null) {
		elements.addEventListener('keyup', function (e) {
			var targetElement = e.target || e.srcElement;
			if (targetElement.value) {
				targetElement.classList.add('art-active');
			} else {
				targetElement.classList.remove('art-active');
			}
		});
	}

	let contactForm = document.querySelector("#contact-form")
	if (contactForm !== null) {
		contactForm.addEventListener("submit", function(e) {
			anime.timeline({
				easing: 'easeOutExpo',
			}).add({
				targets: '.art-submit',
				opacity: 0,
				scale: .5,
			});

			request({
				method: 'POST',
				url: "/api/contact",
				data: new FormData(contactForm)
			}).then(response => {

				anime.timeline({
					easing: 'easeOutExpo',
				}).add({
					targets: '.art-success',
					scale: 1,
					height: '45px',
				});

			});

			e.preventDefault();

			return false;
		});
	}

	// slider testimonials
	new Swiper('.art-testimonial-slider', {
		autoHeight: true,
		centeredSlides: true,
		slidesPerView: 3,
		spaceBetween: 30,
		speed: 1400,
		autoplay: false,
		autoplaySpeed: 5000,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.art-testi-swiper-next',
			prevEl: '.art-testi-swiper-prev',
		},
		breakpoints: {
			1024: {
				slidesPerView: 3,
			},
			768: {
				slidesPerView: 2,
			},
			320: {
				slidesPerView: 1,
			},
		},
	});

	// slider brands
	new Swiper('.art-brands-slider', {
		autoHeight: true,
		slidesPerView: 6,
		spaceBetween: 20,
		speed: 1600,
		autoplay: true,
		autoplaySpeed: 5000,
		breakpoints: {
			1024: {
				slidesPerView: 5,
			},
			768: {
				slidesPerView: 3,
			},
			320: {
				slidesPerView: 2,
			},
		},
	});

	// slider blog
	new Swiper('.art-blog-slider', {
		slidesPerView: 3,
		spaceBetween: 30,
		speed: 1400,
		autoplay: {
			delay: 4000,
		},
		autoplaySpeed: 5000,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.art-blog-swiper-next',
			prevEl: '.art-blog-swiper-prev',
		},
		breakpoints: {
			1024: {
				slidesPerView: 3,
			},
			768: {
				slidesPerView: 2,
			},
			320: {
				slidesPerView: 1,
			},
		},
	});

	// slider works
	new Swiper('.art-works-slider', {
		slidesPerView: 3,
		spaceBetween: 30,
		speed: 1400,
		autoplay: {
			delay: 4000,
		},
		autoplaySpeed: 5000,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.art-works-swiper-next',
      		prevEl: '.art-works-swiper-prev',
		},
		breakpoints: {
			1024: {
				slidesPerView: 3,
			},
			768: {
				slidesPerView: 2,
			},
			320: {
				slidesPerView: 1,
			},
		},
	});
}

// page loading
document.addEventListener("DOMContentLoaded", function() {
	anime({
		targets: '.art-preloader .art-preloader-content',
		opacity: [0, 1],
		delay: 200,
		duration: 600,
		easing: 'linear',
		complete: function(anim) {}
	});
	anime({
		targets: '.art-preloader',
		opacity: [1, 0],
		delay: 2200,
		duration: 400,
		easing: 'linear',
		complete: function(anim) {
			document.querySelector(".art-preloader").style.display = 'none';
		}
	});
});

(window.onload = function () {
	init();
	for (
		var e = document.getElementsByClassName("txt-rotate"), i = 0;
		i < e.length;
		i++
	) {
		var s = e[i].getAttribute("data-rotate"),
			n = e[i].getAttribute("data-speed");
		s && new Typed(e[i], {
			strings: JSON.parse(s),
			typeSpeed: n,
			smartBackspace: true,
			shuffle: true,
			loop: true,
		});
	}
});

function animate(obj, initVal, lastVal, duration) {

    let startTime = null;

    //get the current timestamp and assign it to the currentTime variable
    let currentTime = Date.now();

    //pass the current timestamp to the step function
    const step = (currentTime ) => {

        //if the start time is null, assign the current time to startTime
        if (!startTime) {
              startTime = currentTime ;
        }

        //calculate the value to be used in calculating the number to be displayed
        const progress = Math.min((currentTime  - startTime) / duration, 1);

        //calculate what to be displayed using the value gotten above
        obj.innerHTML = Math.floor(progress * (lastVal - initVal) + initVal);

        //checking to make sure the counter does not exceed the last value (lastVal)
        if (progress < 1) {
              window.requestAnimationFrame(step);
        }
        else{
              window.cancelAnimationFrame(window.requestAnimationFrame(step));
        }
    };

    //start animating
    window.requestAnimationFrame(step);
}

function request({url, method, data}) {
	console.log(url, method, data)
	return new Promise(function(resolve, reject) {
		const xhttp = new XMLHttpRequest();
		xhttp.open(method ?? 'GET', url);
		if (lowerCase(method) == 'post') xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.setRequestHeader("Content-Type", "application/json");

		if (data)
		{
			var object = {};
			data.forEach((value, key) => {
				if(!Reflect.has(object, key)){
					object[key] = value;
					return;
				}
				if(!Array.isArray(object[key])){
					object[key] = [object[key]];    
				}
				object[key].push(value);
			});
			data = JSON.stringify(object);
		}

		xhttp.send(data ?? '');
		xhttp.onload = function() {
			resolve(xhttp.responseText);
		};
	});
}