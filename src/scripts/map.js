'use strict';

/**
 * Reference in the topojson library
 * for use in processing the US TopoJson
 * file.
 */
const topojson = require('topojson');

/**
 * Build an extended d3 object from d3, the d3-geo library, and the
 * d3-geo-projection library.
 */
const d3 = Object.assign( {}, require('d3'), require('d3-geo'), require('d3-geo-projection') );


/**
 * This is a small helper function to make testing for the existance
 * of a selection in jQuery a little more readable
 *
 * @param mapSelector a selector that pulls the elements for rendering from the page
 * @return boolean true if there are valid map elements on the page.
 *
 */
function pageHasMap( mapSelector ) { return $( mapSelector ).length > 0; }


/**
 * This is a simple helper function that turns our map of the US governmental extent
 * into a map of just the continental US by excluding Hawaii, Alaska, and PR. The set
 * of excluded states is specified in the `config.js` file.
 *
 * @param mapdata the topojson map.
 * @param config the config object passed to this map module
 * @return topojson a truncated topojson object.
 */
function continentalUsa( mapdata, config ) {

    mapdata.objects.cb_2013_us_state_20m.geometries =
        mapdata.objects.cb_2013_us_state_20m.geometries.filter( function( d ) { return config.excludedStates.indexOf(d.id) === -1; });

    return mapdata;
}


/**
 * The Map class consumes a fixed set of mapdata and a configuration object
 * and manages rendering the map in a specified set of elements in the DOM.
 *
 * @param mapdata the topojson map.
 * @param config the config object (see `config.js`)
 */
var Map = function( mapdata, config ) {
    if ( !(this instanceof Map)) { return new Map( mapdata, config ); }
    var self = this;

    self.width = $( config.mapSelector ).width();

    self.height = config.mapAspectRatio * self.width;

    self.translation = [ self.width / 2, self.height / 2 ];

    self.scale = [ self.width * config.scaleRatio ];

    self.fontSize = config.fontSize * (self.width / config.mapIdealWidth);

    self.config = config;

    self.mapdata = mapdata;

    self.svg = null;

    self.initialized = false;

};


/**
 * Returns the canonical projection for this map renderer. This renderer uses
 * the Albers Equal Area Projection, localized around the United States.
 *
 * This routine depends on a specified translation and scale, which is managed by
 * the Map module.
 *
 * @return d3.projection
 */
Map.prototype.projection = function() { return d3.geoAlbersUsa().translate( this.translation ).scale( this.scale ); };


/**
 * The path function builds a d3.geoPath object for to render the underlying topojson US map.
 *
 * This routine depends on a specified projection which is managed by the Map module.
 *
 * @return d3.geoPath
 */
Map.prototype.path = function( ) { return d3.geoPath().projection( this.projection( ) ); };


/**
 * Given a raw API response from the `wp/v2/partners` endpoint of the wordpress API,
 * this routine ensures that the passed set of partners has a defined location,
 * and belongs to the taxonomy specified in `config.js`.
 *
 * If the routine finds a taxonomy member without a specified location and Map is instantiated in DEBUG mode,
 * this routine logs a warning to the console.
 *
 * @param partners JSON an api response from WP API
 * @return the set of valid partners for map plotting.
 */
Map.prototype.validPartners = function( partners ) {

    const researchPartnersTaxonomy = this.config.researchPartnersTaxonomy;
    const DEBUG = this.config.debug;

    return partners.filter( function( d ) {

        const is_research = d.partner_role.indexOf( researchPartnersTaxonomy ) !== -1;
        const has_location = d.acf.partner_location !== '';

        if ( DEBUG && is_research && !has_location ) { console.warn(`[Map] Warning: partner ${d.slug} does not have a location specified.`); }

        return is_research && has_location;

    });
};


/**
 * Given a set of valid partners, this routine further reduces the given set to those with valid logos.
 * This is a seperate parse routine because we'd like to render markers for partners without logos,
 * but hovering should only work if the partner has a logo.
 *
 * If the routine finds a partner without a valid logo and Map is instantiated in DEBUG mode, it logs a warning to the console.
 *
 * @param partners JSON the set of valid partners for plotting on the map
 * @return the set of valid partners for infobox rendering.
 */
Map.prototype.partnersWithLogos = function( partners ) {

    const DEBUG = this.config.debug;

    return partners.filter( function( d ) {

        const has_logo = typeof d.acf.partner_logo !== 'undefined';
        const is_imagelike = typeof d.acf.partner_logo.sizes !== 'undefined';

        if ( DEBUG && !(has_logo && is_imagelike) ) { console.warn(`[Map] Warning: partner '${d.slug}' does not have a valid logo.`); }

        return has_logo && is_imagelike;
    });
};


/**
 * This routine is responsible for drawing all the partners to the map,
 * and mouting the appropriate event handlers on the rendered elements.
 *
 * @param partners JSON the set of valid partners for plotting on the map.
 *
 */
Map.prototype.drawPartners = function( partners ) {

    const projection = this.projection();
    const fontSize = this.fontSize;
    const offsetSize = fontSize * this.config.typeOffsetMultiplier;
    const mapSelector = this.config.mapSelector;
    const fadeDelay = this.config.transitionDuration;

    this.svg.append('g')
        .attr('class', 'partners')
        .selectAll('.partner')
        .data( partners )
        .enter()
            .append('g')
            .attr('class', 'partner')
            .attr('data-location', function( d ) { return '#' + d.slug; })
            .attr('transform', function(d) {
                return 'translate(' + projection([ parseFloat(d.acf.partner_location.lng), parseFloat(d.acf.partner_location.lat) ]) + ')';
            })
                .append('a')
                .attr('href', function( d ) { return d.acf.partner_link; })
                .attr('target', '_blank')
                    .append('text')
                    .attr('class', 'partner-label')
                    .attr('font-size', fontSize + 'px' )
                    .attr('transform', 'translate(' + offsetSize + ',0)' )
                    .text(',');

    d3.select( mapSelector )
      .selectAll('.partner-info')
      .data( this.partnersWithLogos( partners ) )
      .enter()
        .append('div')
        .attr('id', function( d ) { return d.slug; })
        .attr('class', 'partner-info')
            .append('img')
            .attr('src', function( d ) { return d.acf.partner_logo.sizes.medium; });



    $( '.partner' ).on('mouseover', function() {

        var map = $( mapSelector );
        var marker = $(this);
        var info = $( marker.data().location );

        var screenX = (marker.offset().left + (marker.outerWidth() / 2) - offsetSize) - map.offset().left - (info.outerWidth() / 2);
        var screenY = marker.offset().top - map.offset().top - info.outerHeight() - 25;

        info.css({ top: screenY + 'px', left: screenX + 'px' });
        info.animate({ opacity: 1 }, fadeDelay);

    });



    $( '.partner' ).on('mouseout', function() {

        var marker = $(this);
        var info = $( marker.data().location );

        info.animate({ opacity: 0 }, fadeDelay, function() {
            info.css({ top: '-100%', left: '0%' });
        });
    });

};


/**
 * This routine selects and prepares the target svg container for rendering.
 * This routine is idempotent.
 */
Map.prototype.init = function() {
    if ( !this.initialized ) {

        this.svg =
            d3.select( this.config.mapSelector ).append('svg')
              .attr('viewBox', ['0 0 ', this.width, ' ', this.height ].join('') )
              .attr('preserveAspectRatio', 'xMidYMid meet')
              .attr('class', 'map');

        this.initialized = true;

    }

};


/**
 * This routine takes care of drawing the map, rendering the partners on the map
 * and setting up the partners info boxes for hovering.
 */
Map.prototype.draw = function(  ) {

    if ( !this.initialized ) { throw new Error('[Map] Error – .draw() was called before .init(), to the svg hasn\'t been instantiated. '); }

    var self = this;

    this.svg.append('path')
        .datum( topojson.feature( this.mapdata, this.mapdata.objects.cb_2013_us_state_20m ) )
        .attr('d', this.path() )
        .attr('class', 'map-lines');

    $.ajax({
        dataType: 'json',
        crossDomain: false,
        method: 'GET',
        url: this.config.partnersEndpoint,
        success: function( result ) {
            self.drawPartners( self.validPartners( result ) );
        }
    });

};


/**
 * This instantiating function decides whether the page is in need of the Map class,
 * and delegates to the Map class if so. Otherwise, it does nothing.
 */
function map( config ) {
    if ( config.debug ) { console.log( 'map.js loaded, and ...' ); }

    $( document ).ready( function() {
        if ( pageHasMap( config.mapSelector ) ) {

            if ( config.debug ) { console.log( 'map.js executing.' ); }

            const mapdata = continentalUsa( require('./us-map.json'), config );

            var map = new Map( mapdata, config );

            map.init();
            map.draw();

        } else {

            if ( config.debug ) { console.log('map.js not executing.'); }

        }
    });

}


export { map };
