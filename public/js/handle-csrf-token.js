function refreshCsrfToken() {
    $.ajax({
        url: '/csrf-token',
        type: 'get',
        error: function(err) {
        },
        success: function(response) {
            console.log(response);
            document.getElementsByName('_token').forEach(function(element) {
                element.value = response.data;
            })
        }
    });
}
