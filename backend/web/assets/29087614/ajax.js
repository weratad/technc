function handleAjaxLink(e) {

    e.preventDefault();

    var
        $link = $(e.target),
        callUrl = $link.attr('href'),
        formId = $link.data('onForm'),
        onDone = $link.data('onDone'),
        onFail = $link.data('onFail'),
        onAlways = $link.data('onAlways'),
        onId = $link.data('onId'),
        ajaxRequest;
    var data = (typeof formId === "string" ? $('#' + formId).serializeArray() : null)
    if($.isNumeric(onId)){
        data.push({name: 'id', value: onId});
    }
    ajaxRequest = $.ajax({
        type: "post",
        dataType: 'json',
        url: callUrl,
        data: data
    });
    // Assign done handler
    if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
        ajaxRequest.done(ajaxCallbacks[onDone]);
    }

    // Assign fail handler
    if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
        ajaxRequest.fail(ajaxCallbacks[onFail]);
    }

    // Assign always handler
    if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
        ajaxRequest.always(ajaxCallbacks[onAlways]);
    }

}
var ajaxCallbacks = {
    'linkFormDone': function (response) {
        // This is called by the link attribute 'data-on-done' => 'linkFormDone';
        // the form name is specified via 'data-form-id' => 'link_form'
        $('#ajax_result_02').html(response.body);
    }
}

