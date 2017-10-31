Responsiville.Responsiveelement = function ( options ) {

	// Responsiville must be initialised.

	if ( ! Responsiville.Main.getInstance() ) {

		throw new Error( 'Responsiville instantiation error: the framework has not been initialised, call new Responsiville::Main() and then Responsiville::init().' );

	}

	// General settings setup.

	this.enabled       = false;
	this.options       = jQuery.extend( this.options, Responsiville.Responsiveelement.defaults, options );
	this.codeName      = 'responsiville.responsiveelement';
	this.responsiville = Responsiville.Main.getInstance();

	// Cache important DOM elements.

	this.$body       = this.responsiville.$body;
	this.$element    = jQuery( this.options.element );

	// The previous and current breakpoint of the element;
	
	this.previousBreakpoint = null;
	this.currentBreakpoint  = null;

	// If no element found raise an error.
	
	if ( this.$element.length === 0 ) {

		this.log( 'Responsiville.Responsiveelement instantiation error: no element found (' + this.options.element + ').' );
		return;

	}

	if ( this.$element.length > 1 ) {

		this.log( 'Responsiville.Responsiveelement instantiation error: more than one elements found (' + this.options.element + ').' );
		return;

	}

	// Check for developer settings inside the element's data attributes.

	for ( var key in this.options ) {

		var value = this.$element.data( 'responsiville-responsiveelement-' + key );

		if ( typeof value !== 'undefined' ) {
			this.options[key] = value;
		}

	}

    // Uniqueue element slug.
	
	if ( this.options.slug == '' ) {
        Responsiville.Responsiveelement.elementsCounter = Responsiville.Responsiveelement.elementsCounter !== undefined ? ++Responsiville.Responsiveelement.elementsCounter : 0;
        this.options.slug = this.codeName.replace( '.', '-' ) + '-' + Responsiville.Responsiveelement.elementsCounter;
    }

	// Sort the breakpoints by ascending width
	
	this.options.breakpoints.sort( function( breakpointA, breakpointB ) {
		return breakpointA.width - breakpointB.width;
	});


	// Take special care for enter/leave breakpoints possibly given as HTML data attributes.
	
	var htmlBreakpoints = Responsiville.determineEnableDisableBreakpoints({ 
		enter: this.$element.data( 'responsiville-responsiveelement-enter' ),
		leave: this.$element.data( 'responsiville-responsiveelement-leave' ) 
	});

	if ( htmlBreakpoints !== null ) {
		this.options.enter = htmlBreakpoints.enter;
		this.options.leave = htmlBreakpoints.leave;
	}



	// Add this object as the main element's data attribute for API usage.
	
	this.$element.data( 'responsiville-api', this );
	this.$element.data( 'responsiville-responsiveelement-api', this );



	// Uniquely identify this element.

	this.$element.addClass( this.options.slug );



	// Images inside the responsive element.

	this.$images = this.$element.find( 'img' );



	// Initialises the responsive element.
		
	this.setupEvents();

	// Enable right away if necessary.
	
	if ( this.responsiville.is( this.options.enter ) ) {
		this.enable();
	}

	this.log( 'responsivelements initialised' );



	/**
	 * Called after the module has been initialised.
	 * 
	 * @event Responsiville.Responsiveelement#init
	 */

	this.fireEvent( 'init' );

};


// Extend with logging functions.

Responsiville.extend( Responsiville.Responsiveelement, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Responsiveelement, Responsiville.Events );

/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Responsiveelement.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;


/**
 * @property {Object} defaults Default values for this module settings.
 */
Responsiville.Responsiveelement.defaults = {
	breakpoints : Responsiville.Main.getInstance().options.breakpoints,
	debug       : false,
	slug        : '',
	element     : '.responsiville-responsiveelement',
	enter       : 'small, mobile, tablet, laptop, desktop, large, xlarge',
	leave       : ''
};

/**
 * Runs through the page and searches for elements that apply to the current 
 * module in order to apply it to them automatically. Useful for automatically
 * creating elements with this module's behaviour just by setting up the
 * predefined classes and data attributes in HTML elements of the page.
 *
 * @function
 * @static
 * 
 * @return {void}
 */
Responsiville.Responsiveelement.autoRun = function () {

	jQuery( Responsiville.Responsiveelement.defaults.element ).each( function () {

		new Responsiville.Responsiveelement({
			debug     : Responsiville.Main.getInstance().options.debug,
			element  : this
		});
		
	});

};

/**
 * Sets up event handlers necessary for the object to function properly. 
 * 
 * @return {void}
 */

Responsiville.Responsiveelement.prototype.setupEvents = function () {

	var k, length;

	// Register to be enabled on the required breakpoints.
	
	var breakpointsEnter = Responsiville.splitAndTrim( this.options.enter );

	for ( k=0, length=breakpointsEnter.length; k<length; k++ ) {
		this.responsiville.on( 'enter.' + breakpointsEnter[k], this.getBoundFunction( this.enable ) );
	}

	// Register to be disabled on the required breakpoints.

	var breakpointsLeave = Responsiville.splitAndTrim( this.options.leave );

	for ( k=0, length=breakpointsLeave.length; k<length; k++ ) {
		this.responsiville.on( 'enter.' + breakpointsLeave[k], this.getBoundFunction( this.disable ) );
	}

	// Check which images have loaded and wait for the rest of them.
	
	for ( k=0, length=this.$images.length; k < length; k++ ) {

		var image = this.$images.eq( k ).get( 0 );

		if ( Responsiville.hasImageLoaded( image ) ) {

			this.imagesLoaded++;

		} else {

			image.onload  = this.getBoundFunction( this.imageLoaded );
			image.onerror = this.getBoundFunction( this.imageError );

		}

	}

};

/**
 * Enables the responsive element.
 *
 * @fires Responsiville.Responsiveelement#enabled
 * 
 * @return {void}
 */

Responsiville.Responsiveelement.prototype.enable = function () {

	if ( this.enabled ) {
		return;
	}

	this.log( 'enable responsiveelement' );

	this.enabled = true;

	// Process element on resize.
	
	this.responsiville.on( 'resize', this.getBoundFunction( this.processElement ) );

	/**
	 * Called after the module has been enabled.
	 * 
	 * @event Responsiville.Responsiveelement#enabled
	 */

	this.fireEvent( 'enabled' );
	
	this.processElement();

};

/**
 * Disables the responsive element.
 * 
 * @fires Responsiville.Responsiveelement#disabled
 * 
 * @return {void}
 */

Responsiville.Responsiveelement.prototype.disable = function () {

	if ( ! this.enabled ) {
		return;
	}

	this.log( 'disable responsiveelement' );

	this.enabled = false;

	// Process element on resize.
	
	this.responsiville.off( 'resize', this.getBoundFunction( this.processElement ) );

	var removeClasses = '';
	var breakpoint;

	for ( var k = 0; k < this.options.breakpoints.length; k++ ) {

		breakpoint = this.options.breakpoints[k];
		removeClasses += breakpoint.name + ' ';

	}

	this.$element.removeClass( removeClasses );

	/**
	 * Called after the module has been disabled.
	 * 
	 * @event Responsiville.Responsiveelement#disabled
	 */
	
	this.fireEvent( 'disabled' );

};

/**
 * Callback that runs when an image inside the responsive element
 * has successfully loaded.
 * 
 * @fires Responsiville.Responsiveelement#image.loaded
 * 
 * @param {Event} event The image loaded event that originally fired.
 * 
 * @return {void}
 */

Responsiville.Responsiveelement.prototype.imageLoaded = function ( event ) {

	this.imagesLoaded++;

	if ( this.enabled && this.imagesLoaded == this.$images.length ) {

		this.processElement();

	}



	/**
	 * Called after an image inside the responsive element has loaded.
	 * 
	 * @event Responsiville.Responsiveelement#image.loaded
	 */

	this.fireEvent( 'image.loaded', [ event ] );

};

/**
 * Runs when an image inside the responsive element has aborted loading due to
 * any error.
 * 
 * @fires Responsiville.Responsiveelement#image.error
 * 
 * @param {Event} event The image error event that originally fired.
 * 
 * @return {void}
 */

Responsiville.Responsiveelement.prototype.imageError = function ( event ) {

	this.imagesLoaded++;

	if ( this.enabled && this.imagesLoaded == this.$images.length ) {

		this.processElement();

	}



	/**
	 * Called after an image inside the responsive element was unable to load
	 * due to an error.
	 * 
	 * @event Responsiville.Responsiveelement#image.error
	 */

	this.fireEvent( 'image.error', [ event ] );

};

Responsiville.Responsiveelement.prototype.runBreakpointChangeCallbacks = function () {

	// Run all callbacks set on leaving the previous breakpoint.

	this.fireEvent( 'leave.' + this.previousBreakpoint.name, this.$element );

	// Run all callbacks set on entering the current breakpoint.
	
	this.fireEvent( 'enter.' + this.currentBreakpoint.name, this.$element );

};

Responsiville.Responsiveelement.prototype.processElement = function () {

	var k;
	var breakpoint;
	var newBreakpoint;
	var elementWidth;

	/**
	 * Called before processing a responsive element.
	 * 
	 * @event Responsiville.Responsiveelement#processing.element
	 */

	this.fireEvent( 'processing.element' );

	elementWidth = this.$element.outerWidth();

	// If an element has zero width, or is display:none, attempt a best guest by traversing its parents
	if ( elementWidth === 0 ) {

		this.log( 'non-displayed or zero-width element. Checking the element\'s parents.' );

		var $parents = jQuery( this.$element.parents() );

		for ( k = 0; k < $parents.length; k++ ) {

			elementWidth = $parents.eq(k).width();

			if ( $parents.eq(k).css('display') !== 'none' && elementWidth !== 0 ) {

				this.log( 'found displayed parent with non-zero width ' + elementWidth + 'px' );

				break;

			}

		}

	}

	this.log( 'processing element with width ' + elementWidth + 'px' );

	// Calculate the classes to remove
	
	var removeClasses = '';

	for ( k = 0; k < this.options.breakpoints.length; k++ ) {

		breakpoint = this.options.breakpoints[k];
		removeClasses += breakpoint.name + ' ';

	}

	// Calculate the classes to add
	
	var addClasses = '';

	for ( k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

		breakpoint = this.options.breakpoints[k];

		if ( elementWidth > breakpoint.width ) {

			addClasses += breakpoint.name + ' ';

			newBreakpoint = breakpoint;

		} else {

			break;

		}

	}

	if ( elementWidth <= breakpoint.width ) {

		addClasses += breakpoint.name + ' ';

		newBreakpoint = breakpoint;
	}

	this.log( 'removing classes: ' + addClasses );
	this.log( 'adding classes: ' + addClasses );

	this.$element.removeClass( removeClasses );
	this.$element.addClass( addClasses );

	// Sets up current breakpoint the first time the module runs.
	
	var firstRun = false;

	if ( ! this.currentBreakpoint ) {

		firstRun = true;
		this.currentBreakpoint = newBreakpoint;

	}

	var oldBreakpoint = this.currentBreakpoint;

	var breakpointChanged =
		firstRun || //oldBreakpoint is the same as newBreakpoint in this case
		oldBreakpoint.name != newBreakpoint.name; // the trivial case

	if ( breakpointChanged ) {

		this.log( 'breakpoint change detected, from ' + this.currentBreakpoint.name + ' to ' + newBreakpoint.name );

		this.previousBreakpoint = this.currentBreakpoint;
		this.currentBreakpoint = newBreakpoint;

		this.runBreakpointChangeCallbacks();

		/**
		 * Called after a breakpoint change has occured.
		 *
		 * @event Responsiville.Responsiveelement#change
		 */
		
		this.fireEvent( 'change', this.$element );

		/**
		 * Called after a breakpoint change has occured.
		 *
		 * @event Responsiville.Responsiveelement#change.breakpoint
		 */
		this.fireEvent( 'change.breakpoint', this.$element );

	}
	
	/**
	 * Called after processing a responsive element.
	 * 
	 * @event Responsiville.Responsiveelement#processed.element
	 */

	this.fireEvent( 'processed.element' );

	this.log( 'processed element' );

};