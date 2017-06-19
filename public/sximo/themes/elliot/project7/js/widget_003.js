(function($)  {
	ddRecommlist = {
	
		// Parent-Element in which every Lightbox is wrapped
		parentElementSelector: '[data-lightbox-field="wrapper-element"]',
		outerWrapperSelector: '[data-lightbox-field="outer-wrapper-element"]',
	
		options: {
		},
		

		_create: function() {
			var self = this,
				options = self.options,
				el      = self.element;


            ddLightbox.attachLightboxes();;


			// Lightbox switcher (fade-in / -out)
			$("#lightbox_basket_trigger").click(function(event) {
				// prevent massive clicking
				if (0 == $('#lightbox_basket').queue("fx").length) {
					// toggle slide basket preview
					$('#lightbox_basket').slideToggle(600, 'easeInOutCubic', function() {
						$("#lightbox_basket_trigger a.link-to-show").toggleClass("active");
						$("#lightbox_basket_trigger a.link-to-hide").toggleClass("active");
						
						if (($('#lightbox_basket:visible').length == 1) && ($('#fixed_wrapper').css("position") != "fixed")) {
							$.scrollTo("#lightbox_basket_wrapper", 600);
						}

						self.toggleShowMoreLinks();

					});
				}
				// prevent default behaviour
				event.preventDefault(event);
				
			});
			
			
			
			// Create the measurement node
			var scrollDiv = document.createElement("div");
			scrollDiv.className = "scrollbar-measure";
			document.body.appendChild(scrollDiv);
			
			// Get the scrollbar width
			var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
			
			// Delete the DIV 
			document.body.removeChild(scrollDiv);
        	if (!($("body.start, body.details")[0])){
				$("#lightbox_basket_trigger a.link-to-show").click(function() {
					$("body").addClass("lightbox_open").css('margin-right', scrollbarWidth);
				});
				$("#lightbox_basket_trigger a.link-to-hide").click(function() {
					$("body").removeClass("lightbox_open").css('margin-right', '0');
				});
			};



			el.addClass("attached");
			
			self.countLightboxes();

			// Binding Show-And-Hide-Links:
			$(el).find("[data-lightbox-field='rename-button']").click(function(event) {
				event.preventDefault($(this));
				self.getSingleLightboxElement(this).find("[data-form-function='renameLightbox']").show();
				self.getSingleLightboxElement(this).find("[data-form-function='renameLightboxFromOverview']").show();
				self.getSingleLightboxElement(this).find(".single_lightbox_title span#lightbox_title, a.lightbox_rename").hide();	
				self.getSingleLightboxElement(this).find("[name='editval[oxrecommlists__oxtitle]']").focus().select();
			});

			// Form Submit in the Lightboxes
			$(el).find("form.sendPerAjax").submit(function(event) {
				event.preventDefault();
				
				
				// If Function is AddToLightbox then first we have to check if there is a lightbox
				if (($(this).data('form-function') == "addArticleToLightbox") && ($("#fixed_wrapper").find(".single_lightbox_wrapper").length == 0)) {
					alert("Please add a new Lightbox first");
					return false;
				}
					
				
				
				// If Function is AddToLightbox first show Layer for Election of Lightbox:
				if (($(this).data('form-function') == "addArticleToLightbox") && ($("#fixed_wrapper").find(".single_lightbox_wrapper").length > 1) && ($(this).parents("#cboxContent").length == 0) && (
				($("#footer_wrapper select[name='masterLightbox']").length == 0) || ($("#footer_wrapper select[name='masterLightbox']").val() == ""))) {

					var sSelectboxCode = null; 
					var oAjaxData = new Object();
					oAjaxData['editval[oxarticles__oxid]'] = $(this).find('[name="editval[oxarticles__oxid]"]').val();
				    $.ajax({
				        async: false, // this time not asynchron, because we need to wait for the values
						dataType: "json",		// as Json
						data: oAjaxData,
						context: $(this),			// Setting the Context to the Form, which was sent
				        url: '?cl=dd_ajax&fnc=dd_getMarkupForAddingToLightbox',
				        success: function (data) {
							var oInstance = ddRecommlist.getInstance(this);		// Getting the actual Instance

							if (data.success) {
					            sSelectboxCode = data.successValue.sMarkupCode;
							} else {
								oInstance.showErrorMessage(data.aError);			// on Error throw it
							}						
				        }
				    });
					
					
 					// Opening Layer
					$.colorbox({ html: sSelectboxCode, open: true })
						.bind('cbox_complete', function(){
							// Binding Widget
							$("#colorbox").find(ddRecommlist.parentElementSelector).ddRecommlist();
						});
						return;
				}
				
				// If adding Article to Lightbox, dont show preloader
				if (($(this).data('form-function') != "addArticleToLightbox")) {				
					$(ddRecommlist.outerWrapperSelector).ddPreloader({opacity: 1, fadeInDuration: 250 });
					$(ddRecommlist.outerWrapperSelector).ddPreloader('start');
				}
		
				
				// For deletion, bring confirm-message
				if (($(this).data('form-function') == "removeLightbox")) {				
					if (!confirm("You really want to delete?")) return;
				}				
				


				// If Function is AddToLightbox then first we have to check if lightbox realy exists...
				if (($(this).data('form-function') == "addArticleToLightbox") && ($("#fixed_wrapper").find(".single_lightbox_wrapper").length == 1)) {
					$(this).find('editval[oxrecommlists__oxid]').val($("#fixed_wrapper").find(".single_lightbox_wrapper").data("lightboxid"));
				}
					

				
				// URL vom Action-Attribute				
				var sUrl = $(this).attr("action");
				
				
				// Ajax Call
				$.ajax({
					url: sUrl,				// URL
					dataType: "json",		// as Json
					type: "POST",			// Send per POST
					data: $(this).serialize(),	// Getting all Input-Fields from Form
					context: $(this),			// Setting the Context to the Form, which was sent
					success: function(data) {	
						var sFunctionName = $(this).data('form-function'); 	// Getting the CallBack-Function from Form-Attribute
						var oInstance = ddRecommlist.getInstance(this);		// Getting the actual Instance
						if (data.success) {
							oInstance[sFunctionName](data, $(this));			// Calling the Function in the Instance
						} else {
							oInstance.showErrorMessage(data.aError);			// on Error throw it
						}						
						
					}
				
				}).done(function() {
					$(ddRecommlist.outerWrapperSelector).ddPreloader('stop');
					$(ddRecommlist.outerWrapperSelector).ddPreloader('destroy');
				});
				
			
			});


            // Show more links on SingleLightbox
        	$(el).find("[data-lightbox-field='single-show-more'] a").click(function(event) {
        	   $(el).find(".single_lightbox_wrapper_right").css("height", "auto");
        	   $(el).find("[data-lightbox-field='single-show-more'] a").css("visibility", "hidden");
        	   event.preventDefault();
        	});


            

		},
	
		// Function for Renaming the Lightbox
		renameLightbox: function( data, self ) {
			$(ddRecommlist.parentElementSelector+'[data-lightboxid="'+data.successValue.oxid+'"]').replaceWith(data.successValue.sMarkupCode);
			$(ddRecommlist.parentElementSelector+'[data-lightboxid="'+data.successValue.oxid+'"]').ddRecommlist();
			self.hide();
		},

		// Function for Renaming the Lightbox
		renameLightboxFromOverview: function( data, self ) {
			$("#active_lightbox_wrapper_multi").find(ddRecommlist.parentElementSelector+'[data-lightboxid="'+data.successValue.oxid+'"]').replaceWith(data.successValue.sMarkupCode);
			$("#active_lightbox_wrapper_multi").find(ddRecommlist.parentElementSelector+'[data-lightboxid="'+data.successValue.oxid+'"]').ddRecommlist();
			self.hide();
		},
		
		
		//Function for Adding a Lightbox
		addLightbox: function( data, self ) {
			$("#lightbox_basket").find((ddRecommlist.outerWrapperSelector)).prepend(data.successValue.sMarkupCode);
			$("#lightbox_basket").find((ddRecommlist.outerWrapperSelector)).children( ddRecommlist.parentElementSelector + ":first").ddRecommlist();
		},
		
		// Removing Lightbox
		removeLightbox: function (data, self) {
			ddRecommlist.getSingleLightboxElement( $(self) ).remove();
			ddRecommlist.countLightboxes();
		},

		//Function for Adding a Lightbox
		removeArticleFromLightbox: function( data, self ) {
			console.log(self);
			console.log(ddRecommlist.getSingleLightboxElement(self).find('[data-lightboxid-articleid="'+data.successValue.oxid+'"]'));
			ddRecommlist.getSingleLightboxElement(self).find('[data-lightboxid-articleid="'+data.successValue.oxid+'"]').remove();
			ddRecommlist.toggleShowMoreLinks();
		},

		//Function for Adding ArticleToLightbox
		addArticleToLightbox: function (data, self) {
			$(ddRecommlist.parentElementSelector+'[data-lightboxid="'+data.successValue.oxid+'"]').replaceWith(data.successValue.sMarkupCode);
			$(ddRecommlist.parentElementSelector+'[data-lightboxid="'+data.successValue.oxid+'"]').ddRecommlist();
			$.colorbox.close();
			
			$("[data-lightbox-field='confirm-message']").show();
			setTimeout(function(){
  				$("[data-lightbox-field='confirm-message']").fadeOut("slow", function () {});
			}, 5000);		

			$("#lightbox_basket_trigger").effect("bounce", { times:2, distance: 50 }, 500);

			ddRecommlist.toggleShowMoreLinks();	
						
		},

		
		// Global Function for Error-Handling
		showErrorMessage: function (aError) {
			alert(aError.Message);
		},
		
		// Get the Instance
		getInstance: function( sSelector ) {
			return this.getSingleLightboxElement(sSelector).data('ddRecommlist');
		},
		
		// Get The Wrapper Element
		getSingleLightboxElement: function ( sSelector ) {
			return $(sSelector).parents(ddRecommlist.parentElementSelector);
		},
		

		toggleShowMoreLinks: function () {
			$(".single_lightbox_wrapper_right ul").each(function() {
				if ($(this).innerHeight() > 140) $(this).next(".single_lightbox_showmore").show();
			});
		},

		countLightboxes: function() {
			$("body").data("lightboxCount", $("#lightbox_basket_content .single_lightbox_wrapper").length);
		},
		
		
		addArticleToLightboxFromSlider: function ( iArticleId ) {
			$(".need_for_adding_from_flash:first").find("input[name='editval[oxarticles__oxid]']").val(iArticleId);
			$(".need_for_adding_from_flash:first").find("form").submit();
		}


	}


	$.widget( 'ui.ddRecommlist', ddRecommlist );

} )( jQuery );
