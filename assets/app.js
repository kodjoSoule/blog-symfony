import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.css";
import "font-awesome/css/font-awesome.css";

import AOS from "aos";
import "aos/dist/aos.css";

//swiper slider
import Swiper from "swiper";
// import Swiper styles
import "swiper/css";

document.addEventListener("DOMContentLoaded", function () {
	AOS.init({
		// Exemple d'options :
		offset: 100, // Décalage (offset) par rapport au déclenchement de l'animation
		duration: 800, // Durée de l'animation en millisecondes
		easing: "ease-in-out", // Fonction d'accélération (par exemple, 'ease', 'linear', 'ease-in', 'ease-out', 'ease-in-out')
		delay: 0, // Délai (en millisecondes) avant le début de l'animation
		once: true, //
		mirror: false,
	});

	// import GLightbox from 'glightbox';
	// // Initialisez Glightbox
	// const lightbox = GLightbox({
	//   selector: 'data-glightbox="gallery" '
	// });

	//chart
	// Récupérez les données des articles par jour, mois et année depuis votre service ou votre API
	const articlesByDay = [10, 15, 20, 12, 8, 5, 18];
	const articlesByMonth = [100, 150, 200, 120, 80, 50, 180];
	const articlesByYear = [1000, 1500, 2000, 1200, 800, 500, 1800];

	// Créez un contexte pour le graphique à barres
	const ctx = document.getElementById("article-chart").getContext("2d");

	// Initialisez le graphique à barres avec les données
	new Chart(ctx, {
		type: "bar",
		data: {
			labels: [
				"Lundi",
				"Mardi",
				"Mercredi",
				"Jeudi",
				"Vendredi",
				"Samedi",
				"Dimanche",
			],
			datasets: [
				{
					label: "Articles par jour",
					data: articlesByDay,
					backgroundColor: "rgba(75, 192, 192, 0.2)",
					borderColor: "rgba(75, 192, 192, 1)",
					borderWidth: 1,
				},
				{
					label: "Articles par mois",
					data: articlesByMonth,
					backgroundColor: "rgba(255, 99, 132, 0.2)",
					borderColor: "rgba(255, 99, 132, 1)",
					borderWidth: 1,
				},
				{
					label: "Articles par année",
					data: articlesByYear,
					backgroundColor: "rgba(54, 162, 235, 0.2)",
					borderColor: "rgba(54, 162, 235, 1)",
					borderWidth: 1,
				},
			],
		},
		options: {
			responsive: true,
			scales: {
				y: {
					beginAtZero: true,
				},
			},
		},
	});

	// <!-- Start Line CHart -->
	new Chart(document.querySelector("#lineChart"), {
		type: "line",
		data: {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [
				{
					label: "Line Chart",
					data: [65, 59, 80, 81, 56, 55, 40],
					fill: false,
					borderColor: "rgb(75, 192, 192)",
					tension: 0.1,
				},
			],
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
				},
			},
		},
	});

	// <!-- End Line CHart -->

	/**
	 * Hero Slider
	 */
	var swiper = new Swiper(".sliderFeaturedPosts", {
		spaceBetween: 0,
		speed: 500,
		centeredSlides: true,
		loop: true,
		slideToClickedSlide: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".custom-swiper-button-next",
			prevEl: ".custom-swiper-button-prev",
		},
	});
	// counter
	const counters = document.querySelectorAll(".counter");

	counters.forEach((counter) => {
		counter.innerText = "0";

		const updateCounter = () => {
			const target = +counter.getAttribute("data-target");
			const c = +counter.innerText;

			const increment = target / 200;

			if (c < target) {
				counter.innerText = `${Math.ceil(c + increment)}`;
				setTimeout(updateCounter, 1);
			} else {
				counter.innerText = target;
			}
		};

		updateCounter();
	});
});
