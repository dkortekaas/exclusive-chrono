
jQuery(function() {
    var newOptions = {
        "Brand": "pa_brand",
        "Model": "pa_model",
        "Diameter": "pa_diameter",
        "Ref-nr": "pa_ref-nr",
        "Year": "pa_year-2",
        "Condition": "pa_condition",
        "Box included": "pa_box-included",
        "Papers included": "pa_papers-included"
    };

    var $el = jQuery('.attribute_taxonomy');
    jQuery('.attribute_taxonomy option:gt(0)').remove();
    jQuery.each(newOptions, function(key,value) {
        $el.append(jQuery('<option></option>')
            .attr('value', value).text(key));
    });
});