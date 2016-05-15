var window_height = 
	$(window).height(), 
	testMobile, 
	loadingError = '<p class="error">The Content cannot be loaded.</p>', 
	current, 
	next, 
	prev, 
	target, 
	hash, 
	url, 
	page, 
	title, 
	projectIndex, 
	scrollPostition, 
	projectLength, 
	ajaxLoading = false, 
	wrapperHeight, 
	pageRefresh = true, 
	content = false, 
	loader = $('div#loader'), 
	portfolioGrid = $('div#portfolio-wrap'), 
	projectContainer = $('div#ajax-content-inner'), 
	projectNav = $('#project-navigation ul'), 
	exitProject = $('div#closeProject a'), 
	easing = 'easeOutExpo', 
	folderName = 'portfolio';

/*----------------------------------------------------*/
// LOAD PROJECT
/*----------------------------------------------------*/
function initializePortfolio() {
	$(window).bind('hashchange', function() {
		hash = $(window.location).attr('hash');
		var root = '#!' + folderName + '/';
		var rootLength = root.length;

		if (hash.substr(0, rootLength) != root) {
			return;
		} else {

			var correction = 50;
			var headerH = $('nav').outerHeight() + correction;
			hash = $(window.location).attr('hash');
			url = hash.replace(/[#\!]/g, '');
			portfolioGrid.find('div.portfolio-item.current').children().removeClass('active');
			portfolioGrid.find('div.portfolio-item.current').removeClass('current');

			/* IF URL IS PASTED IN ADDRESS BAR AND REFRESHED */
			if (pageRefresh == true && hash.substr(0, rootLength) == root) {
				$('html,body').stop().animate({
					scrollTop : (projectContainer.offset().top - 20) + 'px'
				}, 800, 'easeOutExpo', function() {
					loadProject();
				});

				/* CLICKING ON PORTFOLIO GRID OR THROUGH PROJECT NAVIGATION */
			} else if (pageRefresh == false && hash.substr(0, rootLength) == root) {
				$('html,body').stop().animate({
					scrollTop : (projectContainer.offset().top - headerH) + 'px'
				}, 800, 'easeOutExpo', function() {

					if (content == false) {
						loadProject();
					} else {
						projectContainer.animate({
							opacity : 0,
							height : wrapperHeight
						}, function() {
							loadProject();
						});
					}

					projectNav.fadeOut('100');
					exitProject.fadeOut('100');

				});

				/* USING BROWSER BACK BUTTON WITHOUT REFRESHING */
			} else if (hash == '' && pageRefresh == false || hash.substr(0, rootLength) != root && pageRefresh == false || hash.substr(0, rootLength) != root && pageRefresh == true) {
				scrollPostition = hash;
				$('html,body').stop().animate({
					scrollTop : scrollPostition + 'px'
				}, 1000, function() {
					deleteProject();
				});

				/* USING BROWSER BACK BUTTON WITHOUT REFRESHING */
			}

			/* ADD ACTIVE CLASS TO CURRENTLY CLICKED PROJECT */
			portfolioGrid.find('div.portfolio-item .portfolio a[href="#!' + url + '"]').parent().parent().addClass('current');
			portfolioGrid.find('div.portfolio-item.current').find('.portfolio').addClass('active');
		}
	});
	/* LOAD PROJECT */
	function loadProject() {
		loader.fadeIn().removeClass('projectError').html('');

		if (!ajaxLoading) {
			ajaxLoading = true;

			projectContainer.load(url + ' div#ajaxpage', function(xhr, statusText, request) {

				if (statusText == "success") {
					ajaxLoading = false;
					page = $('div#ajaxpage');
					
					$('.flexslider').flexslider({
						animation : "fade",
						slideDirection : "horizontal",
						slideshow : true,
						slideshowSpeed : 3500,
						animationDuration : 500,
						directionNav : true,
						controlNav : true
					});

					jQuery('#ajaxpage').waitForImages(function() {
						hideLoader();
					});

					$(".container").fitVids();
				}
				if (statusText == "error") {
					loader.addClass('projectError').append(loadingError);
					loader.find('p').slideDown();
				}
			});
		}
	}
	
	function hideLoader() {
		loader.fadeOut('fast', function() {
			showProject();
		});
	}

	function showProject() {
		if (content == false) {
			wrapperHeight = projectContainer.children('div#ajaxpage').outerHeight() + 'px';
			projectContainer.animate({
				opacity : 1,
				height : wrapperHeight
			}, function() {
				$(".container").fitVids();
				scrollPostition = $('html,body').scrollTop();
				projectNav.fadeIn();
				exitProject.fadeIn();
				content = true;
			});
		} else {
			wrapperHeight = projectContainer.children('div#ajaxpage').outerHeight() + 'px';
			projectContainer.animate({
				opacity : 1,
				height : wrapperHeight
			}, function() {
				$(".container").fitVids();
				scrollPostition = $('html,body').scrollTop();
				projectNav.fadeIn();
				exitProject.fadeIn();
			});
		}
		projectIndex = portfolioGrid.find('div.portfolio-item.current').index();
		projectLength = $('div.portfolio-item .portfolio').length - 1;

		if (projectIndex == projectLength) {
			$('ul li#nextProject a').addClass('disabled');
			$('ul li#prevProject a').removeClass('disabled');
		} else if (projectIndex == 0) {
			$('ul li#prevProject a').addClass('disabled');
			$('ul li#nextProject a').removeClass('disabled');
		} else {
			$('ul li#nextProject a,ul li#prevProject a').removeClass('disabled');
		}
	}
	
	function deleteProject(closeURL) {
		projectNav.fadeOut(100);
		exitProject.fadeOut(100);
		projectContainer.animate({
			opacity : 0,
			height : '0px'
		});
		projectContainer.empty();

		if ( typeof closeURL != 'undefined' && closeURL != '') {
			location = '#_';
		}
		portfolioGrid.find('div.portfolio-item.current').children().removeClass('active');
		portfolioGrid.find('div.portfolio-item.current').removeClass('current');
	}

	/* LINKING TO PREIOUS AND NEXT PROJECT VIA PROJECT NAVIGATION */
	$('#nextProject a').on('click', function() {

		current = portfolioGrid.find('.portfolio-item.current');
		next = current.next('.portfolio-item');
		target = $(next).children('div').children('a').attr('href');
		$(this).attr('href', target);

		if (next.length === 0) {
			return false;
		}

		current.removeClass('current');
		current.children().removeClass('active');
		next.addClass('current');
		next.children().addClass('active');

	});

	$('#prevProject a').on('click', function() {

		current = portfolioGrid.find('.portfolio-item.current');
		prev = current.prev('.portfolio-item');
		target = $(prev).children('div').children('a').attr('href');
		$(this).attr('href', target);

		if (prev.length === 0) {
			return false;
		}

		current.removeClass('current');
		current.children().removeClass('active');
		prev.addClass('current');
		prev.children().addClass('active');

	});

	/* CLOSE PROJECT */
	$('#closeProject a').on('click', function() {
		
		deleteProject($(this).attr('href'));
		portfolioGrid.find('div.portfolio-item.current').children().removeClass('active');
		loader.fadeOut();
		$('html, body').delay(1000).animate({ scrollTop: $(".portfolio-top").offset().top - 120}, 800);
		return false;

	});

	pageRefresh = false;

};

//BEGIN DOCUMENT.READY FUNCTION
$(document).ready(function() {
	initializePortfolio();
});
//END DOCUMENT.READY FUNCTION

// BEGIN WINDOW.LOAD FUNCTION
$(window).load(function() {
	$('#load').fadeOut().remove();
	$(window).trigger('hashchange');
	$(window).trigger('resize');
	$('[data-spy="scroll"]').each(function() {
		var $spy = $(this).scrollspy('refresh');
	});
});
// END OF WINDOW.LOAD FUNCTION

