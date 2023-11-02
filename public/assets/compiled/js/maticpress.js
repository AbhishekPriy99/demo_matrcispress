const initServerSideDatatable = (_data) => {
    table = $(_data.target).DataTable({
        buttons: [
            'print',
            'postExcel',
            'postCsv',
            'postPdf',
        ],
        aaSorting: [],
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: _data.route,
            type: 'GET',
            data: _data.searchTerm
        },
        columns: _data.columns,
        "order": _data.order
    });
}

const loadContent = (content_url) => {
    $('.maticpress-content').load(content_url);
}

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    if( $('.maticpress-content').length > 0 ){
        let content_url = $('input[name=maticpress-content-url]').val();
        loadContent(content_url);
    }
    
    $('body').on('click', `[data-bs-toggle="modal"]`, function (event) {
        event.preventDefault();
        let button = $(this);
        let recipient = button.attr('data-bs-whatever');
        let dataUrl = button.attr('href');
        let modal = $(button.attr('data-bs-target'));
        modal.find('.modal-title').text(recipient);
        $.get(dataUrl, function (response) {
            if (response.success == 200) {
                modal.find('.modal-body').html(response.html);
                modal.modal('show');
            }
        });
    });

    $('body').on('click', '.maticpress-delete', function(e){
        e.preventDefault();
        let _this = $(this);
        let _route = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: _route,
                    type: 'POST',
                    data:{
                        _method:'DELETE',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                res.message,
                                'success'
                            );
                            if( typeof table !== 'undefined' ){
                                table.table().draw();
                            }
                            if( _this.attr('reload-content') ){
                                console.log('ddd');
                                let content_url = $('input[name=maticpress-content-url]').val();
                                loadContent(content_url);
                            }
                        }else{
                            Swal.fire({
                                text: res.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    }
                });
             
            }
        });
        return false;
    });

    $('body').on('change', '.maticpress-change-status', function(e){
        e.preventDefault();
        let _this = $(this);
        let _route = $(this).attr('data-url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: _route,
                    type: 'GET',
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire(
                                '',
                                res.message,
                                'success'
                            );
                        }else{
                            Swal.fire({
                                text: res.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    }
                });
             
            }else{
                _this.prop('checked', !_this.prop("checked"));
            }
        });
        return false;
    });

    $('body').on('submit', '.maticpress-ajax-form', function (e) {
        e.preventDefault();
        let _this = $(this);
        let _button = _this.find('[type=submit]');
        let formData = new FormData(_this[0]);
        let url = _this.attr('action');
        let _method = _this.attr('method');
        $.ajax({
            url: url,
            method: _method,
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                _button.attr('disabled', true);
                _button.find('.indicator-label').hide();
                _button.find('.indicator-progress').show();
                _this.find('.form-error').remove();
            },
            success: function (data) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    if (data.status == 200) {
                        if(!_this.hasClass('update')){
                        _this[0].reset();
                        }
                        Swal.fire({
                            html: data.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }else{
                        Swal.fire({
                            html: data.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }

                    if (_this.attr('data-redirect-url')) {
                        setTimeout(() => {
                            window.location.href = _this.attr('data-redirect-url');
                        }, 2000);
                    }

                    if (_this.attr('data-modal-form')) {
                        $(_this.attr('data-modal-form')).modal('hide');
                        if( typeof table !== 'undefined' ){
                            table.table().draw();
                        }
                    }

                    if( _this.attr('reload-content') ){
                        let content_url = $('input[name=maticpress-content-url]').val();
                        loadContent(content_url);
                    }

                    if(data.clickTarget){
                        $(data.clickTarget).click();
                    }
                }
            },
            error: function (xhr) { // if error occured
                if (xhr.responseJSON.errors) {
                    var i = 1;
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        let errorElement = $(`[name="${key}"]`);
                        if(i == 1){
                            errorElement.focus();
                            i++;
                        }
                        if (key.includes('.')) {
                            let parts = key.split('.');
                            let result = parts.reduce((acc, part) => {
                                return acc ? acc + `[${part}]` : `${part}`;
                            }, '');
                            errorElement = $(`[name="${result}"]`);
                            if ((errorElement.parents('div.file-error').length > 0)) {
                                errorElement.parents('div.file-error').find('.error-file').after(`<small id="postcode-error" class="text-danger">${value[0]}</small>`);
                            } else if (errorElement.parents('div.input-group').length > 0) {
                                errorElement.parents('div.input-group').after(`<small id="postcode-error" class="text-danger">${value[0]}</small>`);
                            } else if (errorElement.length > 0) {
                                errorElement.after(`<small id="${key}-error" class="text-danger">${value[0]}</small>`);
                            } else {
                                Swal.fire({
                                    text: value[0],
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                return false;
                            }
                        } else {
                            if ((errorElement.parents('div.file-error').length > 0)) {
                                errorElement.parents('div.file-error').find('.error-file').after(`<span id="postcode-error" class="text-danger form-error">${value[0]}</span>`);
                            } else if (errorElement.parents('div.input-group').length > 0) {
                                errorElement.parents('div.input-group').after(`<span id="postcode-error" class="text-danger form-error">${value[0]}</span>`);
                            } else if (errorElement.length > 0) {
                                errorElement.after(`<span id="${key}-error" class="text-danger form-error">${value[0]}</span>`);
                            } else {
                                Swal.fire({
                                    text: value[0],
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        text: xhr.responseJSON.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            },
            complete: function () {
                _button.attr('disabled', false);
                _button.find('.indicator-label').show();
                _button.find('.indicator-progress').hide();
            },
        });
        return false;
    });

}); 