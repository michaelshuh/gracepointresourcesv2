jQuery(function(){
    jQuery('#nav-single a').addClass('btn btn-info');
    boxes = jQuery('.about.well');
    maxHeight = Math.max.apply(
      Math, boxes.map(function() {
            return jQuery(this).height();
      }).get());
    boxes.height(maxHeight);
});
