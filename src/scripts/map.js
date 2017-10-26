'use strict';


const topojson = require('topojson');

const d3 = Object.assign( {}, require('d3'), require('d3-geo'), require('d3-geo-projection') );




function continentalUsa( mapdata, config ) {

    mapdata.objects.cb_2013_us_state_20m.geometries =
        mapdata.objects.cb_2013_us_state_20m.geometries.filter( function( d ) { return config.excludedStates.indexOf(d.id) === -1; });

    return mapdata;
}


var Map = function( mapdata, config ) {
    if ( !(this instanceof Map)) { return new Map( config ); }
    var self = this;

    self.width = $( config.mapSelector ).width();

    self.height = config.mapAspectRatio * self.width;

    self.translation = [ self.width / 2, self.height / 2 ];

    self.scale = [ self.width * config.scaleRatio ];

    self.fontSize = config.fontSize;

    self.config = config;

    self.mapdata = mapdata;

    self.svg = null;

};



Map.prototype.projection = function( ) { return d3.geoAlbersUsa().translate( this.translation ).scale( this.scale ); };

Map.prototype.path = function( ) { return d3.geoPath().projection( this.projection( ) ); };

Map.prototype.validPartners = function( partners ) {

    var researchPartnersTaxonomy = this.config.researchPartnersTaxonomy;

    return partners.filter( function( d ) {
        return d.partner_role.indexOf( researchPartnersTaxonomy ) !== -1 && d.acf.partner_location !== '';
    });
};

Map.prototype.partnersWithLogos = function( partners ) {
    return partners.filter( function( d ) {
        return typeof d.acf.partner_logo !== 'undefined' && typeof d.acf.partner_logo.sizes !== 'undefined';
    });
};

Map.prototype.drawPartners = function( partners ) {

    var projection = this.projection();
    var fontSize = this.fontSize;
    var offsetSize = fontSize * this.config.typeOffsetMultiplier;
    var mapSelector = this.config.mapSelector;

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
            .attr('src', function( d ) { console.log(d); return d.acf.partner_logo.sizes.medium; });



    $( '.partner' ).on('mouseover', function() {

        var map = $( mapSelector );
        var marker = $(this);
        var info = $( marker.data().location );

        console.log( info );

        var screenX = (marker.offset().left + (marker.outerWidth() / 2) - offsetSize) - map.offset().left - (info.outerWidth() / 2);
        var screenY = marker.offset().top - map.offset().top - info.outerHeight() - 25;

        info.css({ top: screenY + 'px', left: screenX + 'px' });
        info.animate({opacity: 1}, 250);

    });



    $( '.partner' ).on('mouseout', function() {

        var marker = $(this);
        var info = $( marker.data().location );

        info.animate({opacity:0}, 250, function() {
            info.css({ top: '-100%', left: '0%' });
        });
    });

};


Map.prototype.init = function() {
    this.svg =
        d3.select( this.config.mapSelector ).append('svg')
          .attr('viewBox', ['0 0 ', this.width, ' ', this.height ].join('') )
          .attr('preserveAspectRatio', 'xMidYMid meet')
          .attr('class', 'map');
};

Map.prototype.draw = function(  ) {

    var self = this;

    self.svg.append('path')
        .datum( topojson.feature( this.mapdata, this.mapdata.objects.cb_2013_us_state_20m ) )
        .attr('d', this.path() )
        .attr('class', 'map-lines');

    $.ajax({
        dataType: 'json',
        crossDomain: false,
        method: 'GET',
        url: self.config.partnersEndpoint,
        success: function( result ) {
            self.drawPartners( self.validPartners( result ) );
        }
    });

};

/**
 * Small helper function to make testing for the existance
 * of a selection in jQuery a little more readable
 */
function pageHasMap( mapSelector ) { return $( mapSelector ).length > 0; }

function map( config ) {
    console.log( 'map.js loaded, and ...' );

    $( document ).ready( function() {
        if ( pageHasMap( config.mapSelector ) ) {

            console.log( 'map.js executing.' );

            const mapdata = continentalUsa( require('./us-map.json'), config );

            var mapper = new Map( mapdata, config );

            mapper.init();
            mapper.draw();

        } else {
            console.log('map.js not executing.');


        }
    });

}


export { map };
