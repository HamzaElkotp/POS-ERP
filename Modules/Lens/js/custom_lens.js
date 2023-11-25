$(document).ready(function() {
    // alert('hi');


    $(document).on('click', '#get_len_r', function(e) {

        e.preventDefault();

        let len_id = $('#len_id').find(':selected').data('id');
        let sph = $('#sph').val();
        let cyl_r = $('#cyl').val();
        // var cyl;
        // alert(cyl_r);
        switch (cyl_r) {
            case '0.00':
                cyl = 's00';
                // alert(cyl);
                break;
            case '-0.25':
                cyl = '_s25';
                break;
            case '-0.50':
                cyl = '_s50';
                break;
                // case '-0.50':
                //     cyl = '_s50';
                //     break;
            case '-0.75':
                cyl = '_s75';
                break;
            case '-1.00':
                cyl = '_s100';
                break;
            case '-1.25':
                cyl = '_s125';
                break;
            case '-1.50':
                cyl = '_s150';
                break;
            case '-1.75':
                cyl = '_s175';
                break;
            case '-2.00':
                cyl = '_s200';
                break;
            case '-2.25':
                cyl = '_s225';
                break;
            case '-2.50':
                cyl = '_s250';
                break;
            case '-2.75':
                cyl = '_s275';
                break;
            case '-3.00':
                cyl = '_s300';
                break;
            case '-3.25':
                cyl = '_s325';
                break;
            case '-3.50':
                cyl = '_s350';
                break;
            case '-3.75':
                cyl = '_s375';
                break;
            case '-4.00':
                cyl = '_s400';
                break;
            case '-4.25':
                cyl = '_s425';
                break;
            case '-4.50':
                cyl = '_s450';
                break;
            case '-4.75':
                cyl = '_s475';
                break;
            case '-5.00':
                cyl = '_s500';
                break;
            case '-5.25':
                cyl = '_s525';
                break;
            case '-5.50':
                cyl = '_s550';
                break;
            case '-5.75':
                cyl = '_s575';
                break;
            case '-6.00':
                cyl = '_s600';
                break;

            default:
                alert('يجب ادخا Cyl  بشكل صحيح');
        }
        // alert(cyl);

        var url = $(this).data('url');
        var url_price = $(this).data('url-price');
        var url_purch_price = $(this).data('url-purch-price');
        var method = 'get';
        $.ajax({
            url: url + '/' + len_id + '/' + sph + '/' + cyl,
            method: method,
            data: {
                id: len_id
            },

            success: function(response) {

                console.log(response);
                $('#cyl_1_r').val(cyl)
                    // $('#disc_r').val(response[0][cyl])
                $('#sph_1_r').val(response[0]['sph'])
                $('#stock_1_r').val(response[0][cyl])

                let $row = $(this).closest('tr');

                $('#lens_diam_id_r').val(response[0]['id'])

            },
            error: function(e) {
                alert(e);
            }
        });
        $.ajax({
            url: url_price + '/' + len_id + '/' + sph + '/' + cyl,

            method: method,
            data: {
                id: len_id
            },

            success: function(response) {

                console.log(response);
                // $('#price_l').val(response[0]['s00'])
                $('#price_r').val(response[0][cyl])
                $('#sub_total_r').val(response[0][cyl])

            },
            error: function(e) {
                alert(e);
            }
        });
        $.ajax({
            url: url_purch_price + '/' + len_id + '/' + sph + '/' + cyl,

            method: method,
            data: {
                id: len_id
            },

            success: function(response) {

                console.log(response);
                // $('#price_l').val(response[0]['s00'])
                $('#purch_price_r').val(response[0][cyl])

            },
            error: function(e) {
                alert(e);
            }
        });


    });

    $(document).on('click', '#get_len_l', function(e) {

        e.preventDefault();

        let len_id = $('#len_id').find(':selected').data('id');
        let sph = $('#sph1').val();
        let cyl_l = $('#cyl1').val();
        switch (cyl_l) {
            case '0.00':
                cyl = 's00';
                // alert(cyl);

                break;
                // case '+0.25':
                //     cyl = 's25';
                //     break;
                // case '+0.50':
                //     cyl = 's50';
                //     break;
                // case '+0.50':
                //     cyl = 's50';
                //     break;
                // case '+0.75':
                //     cyl = 's75';
                //     break;
                // case '+1.00':
                //     cyl = 's100';
                //     break;
                // case '+1.25':
                //     cyl = 's125';
                //     break;
                // case '+1.50':
                //     cyl = 's150';
                //     break;
                // case '+1.75':
                //     cyl = 's175';
                //     break;
                // case '+2.00':
                //     cyl = 's200';
                //     break;
                // case '+2.25':
                //     cyl = 's225';
                //     break;
                // case '+2.75':
                //     cyl = 's275';
                //     break;
                // case '+3.00':
                //     cyl = 's300';
                //     break;
                // case '+3.25':
                //     cyl = 's325';
                //     break;
                // case '+3.75':
                //     cyl = 's375';
                //     break;
                // case '+4.000':
                //     cyl = 's400';
                //     break;
                // case '+4.25':
                //     cyl = 's425';
                //     break;
                // case '+4.50':
                //     cyl = 's450';
                //     break;
                // case '+4.75':
                //     cyl = 's475';
                //     break;
                // case '+5.00':
                //     cyl = 's500';
                //     break;
                // case '+5.25':
                //     cyl = 's525';
                //     break;
                // case '+5.50':
                //     cyl = 's550';
                //     break;
                // case '+5.75':
                //     cyl = 's575';
                //     break;
                // case '+6.00':
                //     cyl = 's600';
                //     break;

            case '-0.25':
                cyl = '_s25';
                break;
            case '-0.50':
                cyl = '_s50';
                break;
            case '-0.50':
                cyl = '_s50';
                break;
            case '-0.75':
                cyl = '_s75';
                break;
            case '-1.00':
                cyl = '_s100';
                break;
            case '-1.25':
                cyl = '_s125';
                break;
            case '-1.50':
                cyl = '_s150';
                break;
            case '-1.75':
                cyl = '_s175';
                break;
            case '-2.00':
                cyl = '_s200';
                break;
            case '-2.25':
                cyl = '_s225';
                break;
            case '-2.50':
                cyl = '_s250';
                break;
            case '-2.75':
                cyl = '_s275';
                break;
            case '-3.00':
                cyl = '_s300';
                break;
            case '-3.25':
                cyl = '_s325';
                break;
            case '-3.50':
                cyl = '_s350';
                break;
            case '-3.75':
                cyl = '_s375';
                break;
            case '-4.00':
                cyl = '_s400';
                break;
            case '-4.25':
                cyl = '_s425';
                break;
            case '-4.50':
                cyl = '_s450';
                break;
            case '-4.75':
                cyl = '_s475';
                break;
            case '-5.00':
                cyl = '_s500';
                break;
            case '-5.25':
                cyl = '_s525';
                break;
            case '-5.50':
                cyl = '_s550';
                break;
            case '-5.75':
                cyl = '_s575';
                break;
            case '-6.00':
                cyl = '_s600';
                break;

            default:
                alert('يجب ادخال Cyl  بشل صحيح');
        }

        // alert(sph, cyl);

        var url = $(this).data('url');
        var url_price = $(this).data('url-price');
        var url_purch_price = $(this).data('url-purch-price');
        var method = 'get';
        $.ajax({
            url: url + '/' + len_id + '/' + sph + '/' + cyl,
            method: method,
            data: {
                id: len_id
            },

            success: function(response) {

                console.log(response);
                $('#cyl_1_l').val(cyl)
                    // $('#stock_l').val(cyl)
                    // $('#prirce_l').val(response[3][cyl])

                $('#sph_1_l').val(response[0]['sph'])
                $('#stock_l').val(response[0][cyl])
                let $row = $(this).closest('tr');

                $('#lens_diam_id_l').val(response[0]['id'])

            },
            error: function(e) {
                alert(e);
            }
        });
        $.ajax({
            url: url_price + '/' + len_id + '/' + sph + '/' + cyl,

            method: method,
            // data: { id: len_id },

            success: function(response) {

                console.log(response);
                $('#price_l').val(response[0][cyl])
                $('#sub_total_l').val(response[0][cyl])
                    // $('#sph_1_l').val(response[0]['sph'])

            },
            error: function(e) {
                alert(e);
            }
        });
        $.ajax({
            url: url_purch_price + '/' + len_id + '/' + sph + '/' + cyl,

            method: method,
            // data: { id: len_id },

            success: function(response) {

                console.log(response);
                $('#purch_price_l').val(response[0][cyl])
                    // $('#sph_1_l').val(response[0]['sph'])

            },
            error: function(e) {
                alert(e);
            }
        });

    });

    $('.cust').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.cust_mob').focus()
        }

    });

    $('.cust_mob').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.cust_email').focus()
        }

    });

    $('.cust_email').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.sph').focus()
        }

    });

    $('.sph1').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.cyl1').focus().select();
        }

    });

    $('.cyl1').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.axis1').focus()
        }

    });

    $('.axis1').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.add1').focus()
        }

    });

    $('.add1').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.pid_d').focus()
        }

    });

    $('.pid_d').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.sph1').focus()
        }

    });

    $('.sph').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.cyl').focus().select();
        }

    });

    $('.cyl').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.axis').focus()
        }

    });

    $('.axis').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.add').focus()
        }

    });

    $('.add').keydown(function(e) {

        if (event.keyCode === 13) {
            e.preventDefault();

            $('.pid_d').focus()
        }

    });


    $('#lens_l').on('keyup blur', '.disc_l', function() {
        let $row = $(this).closest('tr');
        let unit_price = parseFloat($row.find('.price_l').val()) || 0;

        let max_disc = parseFloat($row.find('.disc_l').val()) || 0;
        let quant_l = parseFloat($row.find('.quant_l').val()) || 0;

        // alert(max_disc);

        $row.find('.sub_total_l').val(unit_price * (1 - max_disc / 100) * quant_l);

        $('#total').val(sum_total('.sub_total'));

        $('#total_due').val(sum_due_total());
    });

    $('#lens_r').on('keyup blur', '.disc_r', function() {
        let $row = $(this).closest('tr');
        let unit_price = parseFloat($row.find('.price_r').val()) || 0;

        let max_disc = parseFloat($row.find('.disc_r').val()) || 0;
        let quant_r = parseFloat($row.find('.quant_r').val()) || 0;

        // alert(max_disc);

        $row.find('.sub_total_r').val(unit_price * (1 - max_disc / 100) * quant_r);

        $('#total').val(sum_total('.sub_total'));

        $('#total_due').val(sum_due_total());
    });

    $('#lens_l').on('keyup blur', '.quant_l', function() {
        let $row = $(this).closest('tr');
        let unit_price = parseFloat($row.find('.price_l').val()) || 0;

        let max_disc = parseFloat($row.find('.disc_l').val()) || 0;
        let quant_l = parseFloat($row.find('.quant_l').val()) || 0;

        // alert(max_disc);

        $row.find('.sub_total_l').val(unit_price * (1 - max_disc / 100) * quant_l);

        $('#total').val(sum_total('.sub_total'));

        $('#total_due').val(sum_due_total());
    });

    $('#lens_r').on('keyup blur', '.quant_r', function() {
        let $row = $(this).closest('tr');
        let unit_price = parseFloat($row.find('.price_r').val()) || 0;

        let max_disc = parseFloat($row.find('.disc_r').val()) || 0;
        let quant_r = parseFloat($row.find('.quant_r').val()) || 0;

        // alert(max_disc);

        $row.find('.sub_total_r').val(unit_price * (1 - max_disc / 100) * quant_r);

        $('#total').val(sum_total('.sub_total'));

        $('#total_due').val(sum_due_total());
    });










});