$(document).ready(function() {
    var body = document.getElementsByTagName('body')[0];
    var removeLoading = function() {
        // In a production application you would remove the loading class when your
        // application is initialized and ready to go.  Here we just artificially wait
        // 3 seconds before removing the class.
        setTimeout(function() {
            body.className = body.className.replace(/loading/, '', );
        });
    };
    removeLoading();
    $('#examp').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            customize: function(xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row c[r^="C"]', sheet).attr('s', '2');
            }
        }]
    });
    //proCatSummarys('2016');
    //proCatdep('2016');
    //proCatPro('2016');
    //proCatRent('2016');
});
var emp = "";
function employee() {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'emp'
        },
        type: "post",
        success: function(data) {
            var employee = jQuery.parseJSON(data);
            emp = jQuery.parseJSON(data);
            $('#e_attend').children('option').remove();
            $('#e_assign').children('option').remove();
            $('#p_attend').children('option').remove();
            $('#p_assign').children('option').remove();
            $('#p_attend').children('option').remove();
            $('#rentcollectedby').children('option').remove();
            $('#rentdepositedby').children('option').remove();
            $.each(employee, function(key, value) {
                $('#e_attend').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#e_assign').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#p_attend').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#p_assign').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#p_collect_by').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#p_deposit_by').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#e_attend1').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#e_assign1').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#e_e_attend').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#e_e_assign').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#rentcollectedby').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#rentdepositedby').append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
}
//alert('a');
employee();
$(".text_special").keypress(function(evt) {
    if (evt.which < 48 || evt.which > 57) {
    } else {
        evt.preventDefault();
    }
});
$(".onlynumber").keypress(function(evt) {
    if (evt.which < 48 || evt.which > 57) {
    } else {
        evt.preventDefault();
    }
});
function gotbrandlist() {
    var obj = document.getElementById("repbrand");
    if (obj == null) return;
    $("#productbrand").empty();
    $.ajax({
        url: "config/systemparamaters.php",
        data: {
            "type": "brandlist"
        },
        type: "post",
        success: function(data) {
            opt = document.createElement("option");
            opt.value = '0';
            opt.text = 'All';
            obj.appendChild(opt);
            var selectValues = JSON.parse(data);
            for (var i = 0; i <= selectValues.length; i++) {
                opt = document.createElement("option");
                opt.value = selectValues[i].brand_id;
                opt.text = selectValues[i].name;
                obj.appendChild(opt);
            }
        }
    });
}
gotbrandlist();
function vendorlist() {
    var obj = document.getElementById("repvendor");
    if (obj == null) return;
    $("#vendorbrand").empty();
    $.ajax({
        url: 'config/systemparamaters.php',
        data: {
            "type": "vendorlist"
        },
        type: "post",
        success: function(data) {
            opt = document.createElement("option");
            opt.value = '0';
            opt.text = 'All';
            obj.appendChild(opt);
            var selectValues = JSON.parse(data);
            for (var i = 0; i <= selectValues.length; i++) {
                opt = document.createElement("option");
                opt.value = selectValues[i].vendor_id;
                opt.text = selectValues[i].name;
                obj.appendChild(opt);
            }
        }
    });
}
vendorlist();
function reportCustmerTrendSummary(year) {
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            year: year,
            type: 'trend'
        },
        type: "post",
        success: function(data) {
            var r_a_data = jQuery.parseJSON(data);
            //console.log(r_a_data);
            $("#c_opn1").html('0');
            $("#c_opn2").html('0');
            $("#c_opn3").html('0');
            $("#c_opn4").html('0');
            $("#c_opn5").html('0');
            $("#c_opn6").html('0');
            $("#c_opn7").html('0');
            $("#c_opn8").html('0');
            $("#c_opn9").html('0');
            $("#c_opn10").html('0');
            $("#c_opn11").html('0');
            $("#c_opn12").html('0');
            $("#c_add1").html('0');
            $("#c_add2").html('0');
            $("#c_add3").html('0');
            $("#c_add4").html('0');
            $("#c_add5").html('0');
            $("#c_add6").html('0');
            $("#c_add7").html('0');
            $("#c_add8").html('0');
            $("#c_add9").html('0');
            $("#c_add10").html('0');
            $("#c_add11").html('0');
            $("#c_add12").html('0');
            $("#c_clo1").html('0');
            $("#c_clo2").html('0');
            $("#c_clo3").html('0');
            $("#c_clo4").html('0');
            $("#c_clo5").html('0');
            $("#c_clo6").html('0');
            $("#c_clo7").html('0');
            $("#c_clo8").html('0');
            $("#c_clo9").html('0');
            $("#c_clo10").html('0');
            $("#c_clo11").html('0');
            $("#c_clo12").html('0');
            $.each(r_a_data["add"], function(key, value) {
                //console.log("#c_opn"+(parseInt(value.month)-1)+"");
                $("#c_opn" + (parseInt(value.month) + 1) + "").html(value.cou);
            });
            $.each(r_a_data["add"], function(key, value) {
                $("#c_add" + value.month + "").html(value.cou);
            });
            $.each(r_a_data["clo"], function(key, value) {
                $("#c_clo" + value.month + "").html(value.cou);
            });
        }
    });
}
reportCustmerTrendSummary('2016');
function reportCustmerSummary(year) {
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            year: year,
            type: 'gen'
        },
        type: "post",
        success: function(data) {
            var r_data = jQuery.parseJSON(data);
            $("#c_mon1").html('0');
            $("#c_mon2").html('0');
            $("#c_mon3").html('0');
            $("#c_mon4").html('0');
            $("#c_mon5").html('0');
            $("#c_mon6").html('0');
            $("#c_mon7").html('0');
            $("#c_mon8").html('0');
            $("#c_mon9").html('0');
            $("#c_mon10").html('0');
            $("#c_mon11").html('0');
            $("#c_mon12").html('0');
            $.each(r_data, function(key, value) {
                $("#c_mon" + value.month + "").html(value.cou);
                //console.log(value);
            });
        }
    });
}
reportCustmerSummary('2016');
//closure And Refund list
function reportProductTrendSummary(year) {
    $("#n_p1").html('0');
    $("#n_p2").html('0');
    $("#n_p3").html('0');
    $("#n_p4").html('0');
    $("#n_p5").html('0');
    $("#n_p6").html('0');
    $("#n_p7").html('0');
    $("#n_p8").html('0');
    $("#n_p9").html('0');
    $("#n_p10").html('0');
    $("#n_p11").html('0');
    $("#n_p12").html('0');
    $("#p_c1").html('0');
    $("#p_c2").html('0');
    $("#p_c3").html('0');
    $("#p_c4").html('0');
    $("#p_c5").html('0');
    $("#p_c6").html('0');
    $("#p_c7").html('0');
    $("#p_c8").html('0');
    $("#p_c9").html('0');
    $("#p_c10").html('0');
    $("#p_c11").html('0');
    $("#p_c12").html('0');
    $("#m1").html('0');
    $("#m2").html('0');
    $("#m3").html('0');
    $("#m4").html('0');
    $("#m5").html('0');
    $("#m6").html('0');
    $("#m7").html('0');
    $("#m8").html('0');
    $("#m9").html('0');
    $("#m10").html('0');
    $("#m11").html('0');
    $("#m12").html('0');
    $("#c1").html('0');
    $("#c2").html('0');
    $("#c3").html('0');
    $("#c4").html('0');
    $("#c5").html('0');
    $("#c6").html('0');
    $("#c7").html('0');
    $("#c8").html('0');
    $("#c9").html('0');
    $("#c10").html('0');
    $("#c11").html('0');
    $("#c12").html('0');
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            year: year,
            type: 'product'
        },
        type: "post",
        success: function(data) {
            var r_a_data = jQuery.parseJSON(data);
            //console.log(r_a_data);
            $.each(r_a_data["pro"], function(key, value) {
                $("#n_p" + value.month + "").html(value.cou);
                $("#p_c" + value.month + "").html(value.pc);
            });
            $.each(r_a_data["map"], function(key, value) {
                $("#m" + value.month + "").html(value.cou);
            });
            $.each(r_a_data["close"], function(key, value) {
                $("#c" + value.month + "").html(value.cou);
            });
        }
    });
}
//reportProductTrendSummary('2016');
function reportClient() {
    var sta = $("#c_state2").val();
    var cit = $("#c_city2").val();
    var zon = $("#c_zone2").val();
    var are = $("#c_area2").val();
    var age = $("#r_age").val();
    var gen = $("#r_gen").val();
    var mar = $("#r_mar").val();
    var yea = $("#r_year").val();
    var r_vint = $("#r_vint").val();
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            sta: sta,
            cit: cit,
            zon: zon,
            are: are,
            age: age,
            gen: gen,
            mar: mar,
            yea: yea,
            type: 'repcli',
            r_vint: r_vint
        },
        type: "post",
        success: function(data) {
            var r_data = jQuery.parseJSON(data);
            $("#c_mon1").html('0');
            $("#c_mon2").html('0');
            $("#c_mon3").html('0');
            $("#c_mon4").html('0');
            $("#c_mon5").html('0');
            $("#c_mon6").html('0');
            $("#c_mon7").html('0');
            $("#c_mon8").html('0');
            $("#c_mon9").html('0');
            $("#c_mon10").html('0');
            $("#c_mon11").html('0');
            $("#c_mon12").html('0');
            $.each(r_data, function(key, value) {
                $("#c_mon" + value.month + "").html(value.cou);
                //console.log(value);
            });
        }
    });
}
function repRent() {
    var r_ven = $("#repvendor").val();
    var r_bd = $("#repbrand").val();
    var yea = $("#r_year").val();
    //var da = 0;
    $('#pro_cat_rent tbody').remove();
    var statusdetails = "";
    event.preventDefault();
    $.ajax({
        url: "config/systemparamaters.php",
        data: {
            "type": "productsubcatlist"
        },
        type: "post",
        success: function(data) {
            // console.log(JSON.parse(data));
            var data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                var row = $('<tbody>' +
                    '<tr>' +
                    '<td><span id="">' + data[i].pr_sub_name + '</span></td>' +
                    '<td><span id="j' + data[i].pr_sub_id + '1">0</span></td>' +
                    '<td><span id="f' + data[i].pr_sub_id + '2">0</span></td>' +
                    '<td><span id="m' + data[i].pr_sub_id + '3">0</span></td>' +
                    '<td><span id="a' + data[i].pr_sub_id + '4">0</span></td>' +
                    '<td><span id="my' + data[i].pr_sub_id + '5">0</span></td>' +
                    '<td><span id="jun' + data[i].pr_sub_id + '6">0</span></td>' +
                    '<td><span id="ju' + data[i].pr_sub_id + '7">0</span></td>' +
                    '<td><span id="aug' + data[i].pr_sub_id + '8">0</span></td>' +
                    '<td><span id="s' + data[i].pr_sub_id + '9">0</span></td>' +
                    '<td><span id="o' + data[i].pr_sub_id + '10">0</span></td>' +
                    '<td><span id="n' + data[i].pr_sub_id + '11">0</span></td>' +
                    '<td><span id="d' + data[i].pr_sub_id + '12">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '013">0</span></td>' +
                    '</tr>' +
                    '</tbody>');
                $('#pro_cat_rent').append(row);
            }
            var row = $('<tbody>' +
                '<tr>' +
                '<td><span id="">Total</span></td>' +
                '<td><span id="mt1">0</span></td>' +
                '<td><span id="mt2">0</span></td>' +
                '<td><span id="mt3">0</span></td>' +
                '<td><span id="mt4">0</span></td>' +
                '<td><span id="mt5">0</span></td>' +
                '<td><span id="mt6">0</span></td>' +
                '<td><span id="mt7">0</span></td>' +
                '<td><span id="mt8">0</span></td>' +
                '<td><span id="mt9">0</span></td>' +
                '<td><span id="mt10">0</span></td>' +
                '<td><span id="mt11">0</span></td>' +
                '<td><span id="mt12">0</span></td>' +
                '<td><span id="mt013">0</span></td>' +
                '</tr>' +
                '</tbody>');
            $('#pro_cat_rent').append(row);
        }
    });
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            yea: yea,
            type: 'f_ren',
            r_ven: r_ven,
            r_bd: r_bd
        },
        type: "post",
        success: function(data) {
            // console.log(data);
            var productSum = jQuery.parseJSON(data);
            //console.log(productSum);
            for (var i = 0; i < productSum.length; i++) {
                productSum[i].rent_cost
                if (productSum[i].re_month == '1') {
                    var m1 = parseInt($('#pro_cat_rent #j' + productSum[i].pr_sub_id + '1').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #j' + productSum[i].pr_sub_id + '1').html(m1);
                    var mt1 = parseInt($('#pro_cat_rent #mt1').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt1').html(mt1);
                }
                if (productSum[i].re_month == '2') {
                    var m2 = parseInt($('#pro_cat_rent #f' + productSum[i].pr_sub_id + '2').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #f' + productSum[i].pr_sub_id + '2').html(m2);
                    var mt2 = parseInt($('#pro_cat_rent #mt2').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt2').html(mt2);
                }
                if (productSum[i].re_month == '3') {
                    var m3 = parseInt($('#pro_cat_rent #m' + productSum[i].pr_sub_id + '3').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #m' + productSum[i].pr_sub_id + '3').html(m3);
                    var mt3 = parseInt($('#pro_cat_rent #mt3').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt3').html(mt3);
                }
                if (productSum[i].re_month == '4') {
                    var m4 = parseInt($('#pro_cat_rent #a' + productSum[i].pr_sub_id + '4').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #a' + productSum[i].pr_sub_id + '4').html(m4);
                    var mt4 = parseInt($('#pro_cat_rent #mt4').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt4').html(mt4);
                }
                if (productSum[i].re_month == '5') {
                    var m5 = parseInt($('#pro_cat_rent #my' + productSum[i].pr_sub_id + '5').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #my' + productSum[i].pr_sub_id + '5').html(m5);
                    var mt5 = parseInt($('#pro_cat_rent #mt5').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt5').html(mt5);
                }
                if (productSum[i].re_month == '6') {
                    var m6 = parseInt($('#pro_cat_rent #jun' + productSum[i].pr_sub_id + '6').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #jun' + productSum[i].pr_sub_id + '6').html(m6);
                    var mt6 = parseInt($('#pro_cat_rent #mt6').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt6').html(mt6);
                }
                if (productSum[i].re_month == '7') {
                    var m7 = parseInt($('#pro_cat_rent #ju' + productSum[i].pr_sub_id + '7').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #ju' + productSum[i].pr_sub_id + '7').html(m7);
                    var mt7 = parseInt($('#pro_cat_rent #mt7').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt7').html(mt7);
                }
                if (productSum[i].re_month == '8') {
                    var m8 = parseInt($('#pro_cat_rent #aug' + productSum[i].pr_sub_id + '8').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #aug' + productSum[i].pr_sub_id + '8').html(m8);
                    var mt8 = parseInt($('#pro_cat_rent #mt8').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt8').html(mt8);
                }
                if (productSum[i].re_month == '9') {
                    var m9 = parseInt($('#pro_cat_rent #s' + productSum[i].pr_sub_id + '9').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #s' + productSum[i].pr_sub_id + '9').html(m9);
                    var mt9 = parseInt($('#pro_cat_rent #mt9').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt9').html(mt9);
                }
                if (productSum[i].re_month == '10') {
                    //console.log(productSum[i].rent_cost);
                    var m10 = parseInt($('#pro_cat_rent #o' + productSum[i].pr_sub_id + '10').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #o' + productSum[i].pr_sub_id + '10').html(m10);
                    var mt10 = parseInt($('#pro_cat_rent #mt10').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt10').html(mt10);
                }
                if (productSum[i].re_month == '11') {
                    var m11 = parseInt($('#pro_cat_rent #n' + productSum[i].pr_sub_id + '11').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #n' + productSum[i].pr_sub_id + '11').html(m11);
                    var mt11 = parseInt($('#pro_cat_rent #mt11').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt11').html(mt11);
                }
                if (productSum[i].re_month == '12') {
                    var m12 = parseInt($('#pro_cat_rent #d' + productSum[i].pr_sub_id + '12').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #d' + productSum[i].pr_sub_id + '12').html(m12);
                    var mt12 = parseInt($('#pro_cat_rent #mt12').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt12').html(mt12);
                }
                var m13 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '013').html()) + parseInt(productSum[i].rent_cost);
                $('#pro_cat_rent #' + productSum[i].pr_sub_id + '013').html(m13);
                var mt13 = parseInt($('#pro_cat_rent #mt013').html()) + parseInt(productSum[i].rent_cost);
                $('#pro_cat_rent #mt013').html(mt13);
            }
            //
            for (var i = 0; i < productSum.length; i++) {
                if (productSum[i].re_month == '1') {
                    var m1 = $('#pro_cat_rent #j' + productSum[i].pr_sub_id + '1').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        // console.log(res);
                        $('#pro_cat_rent #j' + productSum[i].pr_sub_id + '1').html(res);
                        var mt1 = $('#pro_cat_rent #mt1').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt1').html(res);
                        }
                    }
                }
                if (productSum[i].re_month == '2') {
                    //start
                    var m1 = $('#pro_cat_rent #f' + productSum[i].pr_sub_id + '2').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #f' + productSum[i].pr_sub_id + '2').html(res);
                        var mt1 = $('#pro_cat_rent #mt2').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt2').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '3') {
                    //start
                    var m1 = $('#pro_cat_rent #m' + productSum[i].pr_sub_id + '3').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #m' + productSum[i].pr_sub_id + '3').html(res);
                        var mt1 = $('#pro_cat_rent #mt3').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt3').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '4') {
                    //start
                    var m1 = $('#pro_cat_rent #a' + productSum[i].pr_sub_id + '4').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #a' + productSum[i].pr_sub_id + '4').html(res);
                        var mt1 = $('#pro_cat_rent #mt4').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt4').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '5') {
                    //start
                    var m1 = $('#pro_cat_rent #my' + productSum[i].pr_sub_id + '5').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #my' + productSum[i].pr_sub_id + '5').html(res);
                        var mt1 = $('#pro_cat_rent #mt5').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt5').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '6') {
                    //start
                    var m1 = $('#pro_cat_rent #jun' + productSum[i].pr_sub_id + '6').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #jun' + productSum[i].pr_sub_id + '6').html(res);
                        var mt1 = $('#pro_cat_rent #mt6').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt6').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '7') {
                    //start
                    var m1 = $('#pro_cat_rent #ju' + productSum[i].pr_sub_id + '7').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #ju' + productSum[i].pr_sub_id + '7').html(res);
                        var mt1 = $('#pro_cat_rent #mt7').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt2').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '8') {
                    //start
                    var m1 = $('#pro_cat_rent #aug' + productSum[i].pr_sub_id + '8').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #aug' + productSum[i].pr_sub_id + '8').html(res);
                        var mt1 = $('#pro_cat_rent #mt8').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt8').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '9') {
                    //start
                    var m1 = $('#pro_cat_rent #s' + productSum[i].pr_sub_id + '9').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #s' + productSum[i].pr_sub_id + '9').html(res);
                        var mt1 = $('#pro_cat_rent #mt9').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt9').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '10') {
                    //start
                    var m1 = $('#pro_cat_rent #o' + productSum[i].pr_sub_id + '10').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #0' + productSum[i].pr_sub_id + '10').html(res);
                        var mt1 = $('#pro_cat_rent #mt10').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt10').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '11') {
                    //start
                    var m1 = $('#pro_cat_rent #n' + productSum[i].pr_sub_id + '11').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #n' + productSum[i].pr_sub_id + '11').html(res);
                        var mt1 = $('#pro_cat_rent #mt11').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt11').html(res);
                        }
                    } //end
                }
                if (productSum[i].re_month == '12') {
                    //start
                    var m1 = $('#pro_cat_rent #d' + productSum[i].pr_sub_id + '12').html();
                    if (m1.indexOf(',') !== -1) {
                        // would be true. Period found in file name
                    } else {
                        // Original string contains 7
                        var x = m1;
                        x = x.toString();
                        var lastThree = x.substring(x.length - 3);
                        var otherNumbers = x.substring(0, x.length - 3);
                        if (otherNumbers != '')
                            lastThree = ',' + lastThree;
                        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                        //console.log(res);
                        $('#pro_cat_rent #d' + productSum[i].pr_sub_id + '12').html(res);
                        var mt1 = $('#pro_cat_rent #mt12').html();
                        if (mt1.indexOf(',') !== -1) {} else {
                            var x = mt1;
                            x = x.toString();
                            var lastThree = x.substring(x.length - 3);
                            var otherNumbers = x.substring(0, x.length - 3);
                            if (otherNumbers != '')
                                lastThree = ',' + lastThree;
                            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                            $('#pro_cat_rent #mt12').html(res);
                        }
                    } //end
                }
                var m13 = $('#pro_cat_rent #' + productSum[i].pr_sub_id + '013').html();
                if (m13.indexOf(',') !== -1) {} else {
                    var x = m13;
                    x = x.toString();
                    var lastThree = x.substring(x.length - 3);
                    var otherNumbers = x.substring(0, x.length - 3);
                    if (otherNumbers != '')
                        lastThree = ',' + lastThree;
                    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '013').html(res);
                } //end
                var mt13 = $('#pro_cat_rent #mt013').html();
                if (mt13.indexOf(',') !== -1) {} else {
                    var x = mt13;
                    x = x.toString();
                    var lastThree = x.substring(x.length - 3);
                    var otherNumbers = x.substring(0, x.length - 3);
                    if (otherNumbers != '')
                        lastThree = ',' + lastThree;
                    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                    $('#pro_cat_rent #mt013').html(res);
                } //end
            }
        }
    });
}
function advRent() {
    var r_ven = $("#repvendor").val();
    var r_bd = $("#repbrand").val();
    var yea = $("#r_year").val();
    //var da = 0;
    var da = 0;
    $('#pro_cat_adv tbody').remove();
    var statusdetails = "";
    event.preventDefault();
    $.ajax({
        url: "config/systemparamaters.php",
        data: {
            "type": "productsubcatlist"
        },
        type: "post",
        success: function(data) {
            //console.log(JSON.parse(data));
            var data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                var row = $('<tbody>' +
                    '<tr>' +
                    '<td><span id="">' + data[i].pr_sub_name + '</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '1">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '2">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '3">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '4">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '5">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '6">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '7">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '8">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '9">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '10">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '11">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '12">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '013">0</span></td>' +
                    '</tr>' +
                    '</tbody>');
                $('#pro_cat_adv').append(row);
            }
            var row = $('<tbody>' +
                '<tr>' +
                '<td><span id="">Total</span></td>' +
                '<td><span id="mt1">0</span></td>' +
                '<td><span id="mt2">0</span></td>' +
                '<td><span id="mt3">0</span></td>' +
                '<td><span id="mt4">0</span></td>' +
                '<td><span id="mt5">0</span></td>' +
                '<td><span id="mt6">0</span></td>' +
                '<td><span id="mt7">0</span></td>' +
                '<td><span id="mt8">0</span></td>' +
                '<td><span id="mt9">0</span></td>' +
                '<td><span id="mt10">0</span></td>' +
                '<td><span id="mt11">0</span></td>' +
                '<td><span id="mt12">0</span></td>' +
                '<td><span id="mt013">0</span></td>' +
                '</tr>' +
                '</tbody>');
            $('#pro_cat_adv').append(row);
            $.ajax({
                url: 'config/clientreport.php',
                data: {
                    yea: yea,
                    type: 'f_cat',
                    r_ven: r_ven,
                    r_bd: r_bd
                },
                type: "post",
                success: function(data) {
                    // console.log(data);
                    var productSum = jQuery.parseJSON(data);
                    //console.log(productSum);
                    for (var i = 0; i < productSum.length; i++) {
                        if (productSum[i].month == '1') {
                            var m1 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m1);
                            var mt1 = parseInt($('#pro_cat_adv #mt1').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt1').html(mt1);
                        }
                        if (productSum[i].month == '2') {
                            var m2 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '2').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m2);
                            var mt2 = parseInt($('#pro_cat_adv #mt2').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt2').html(mt2);
                        }
                        if (productSum[i].month == '3') {
                            var m3 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '3').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '3').html(m3);
                            var mt3 = parseInt($('#pro_cat_adv #mt3').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt3').html(mt3);
                        }
                        if (productSum[i].month == '4') {
                            var m4 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '4').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '4').html(m4);
                            var mt4 = parseInt($('#pro_cat_adv #mt4').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt4').html(mt4);
                        }
                        if (productSum[i].month == '5') {
                            var m5 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '5').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '5').html(m5);
                            var mt5 = parseInt($('#pro_cat_adv #mt5').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt5').html(mt5);
                        }
                        if (productSum[i].month == '6') {
                            //console.log(productSum[i].month);
                            var m6 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '6').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '6').html(m6);
                            var mt6 = parseInt($('#pro_cat_adv #mt6').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt6').html(mt6);
                        }
                        if (productSum[i].month == '7') {
                            var m7 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '7').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '7').html(m7);
                            var mt7 = parseInt($('#pro_cat_adv #mt7').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt7').html(mt7);
                        }
                        if (productSum[i].month == '8') {
                            var m8 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '8').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '8').html(m8);
                            var mt8 = parseInt($('#pro_cat_adv #mt8').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt8').html(mt8);
                        }
                        if (productSum[i].month == '9') {
                            var m9 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '9').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '9').html(m9);
                            var mt9 = parseInt($('#pro_cat_adv #mt9').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt9').html(mt9);
                        }
                        if (productSum[i].month == '10') {
                            var m10 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '10').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m10);
                            var mt10 = parseInt($('#pro_cat_adv #mt10').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt10').html(mt10);
                        }
                        if (productSum[i].month == '11') {
                            var m11 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '11').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m11);
                            var mt11 = parseInt($('#pro_cat_adv #mt11').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt11').html(mt11);
                        }
                        if (productSum[i].month == '12') {
                            var m12 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '12').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m12);
                            var mt12 = parseInt($('#pro_cat_adv #mt12').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                            $('#pro_cat_adv #mt12').html(mt12);
                        }
                        var m13 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '013').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                        $('#pro_cat_adv #' + productSum[i].pr_sub_id + '013').html(m13);
                        var mt13 = parseInt($('#pro_cat_adv #mt013').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                        $('#pro_cat_adv #mt013').html(mt13);
                    }
                }
            });
        }
    });
}
function proCatSummarys(year) {
    var da = 0;
    $('#pro_cat_sum tbody').remove();
    var statusdetails = "";
    event.preventDefault();
    $.ajax({
        url: "config/systemparamaters.php",
        data: {
            "type": "productsubcatlist"
        },
        type: "post",
        success: function(data) {
            //console.log(JSON.parse(data));
            var data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                var row = $('<tbody>' +
                    '<tr>' +
                    '<td><span id="">' + data[i].pr_sub_name + '</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '1">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '2">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '3">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '4">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '5">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '6">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '7">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '8">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '9">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '10">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '11">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '12">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '13">0</span></td>' +
                    '</tr>' +
                    '</tbody>');
                $('#pro_cat_sum').append(row);
            }
            var row = $('<tbody>' +
                '<tr>' +
                '<td><span id="">Total</span></td>' +
                '<td><span id="mt1">0</span></td>' +
                '<td><span id="mt2">0</span></td>' +
                '<td><span id="mt3">0</span></td>' +
                '<td><span id="mt4">0</span></td>' +
                '<td><span id="mt5">0</span></td>' +
                '<td><span id="mt6">0</span></td>' +
                '<td><span id="mt7">0</span></td>' +
                '<td><span id="mt8">0</span></td>' +
                '<td><span id="mt9">0</span></td>' +
                '<td><span id="mt10">0</span></td>' +
                '<td><span id="mt11">0</span></td>' +
                '<td><span id="mt12">0</span></td>' +
                '<td><span id="mt013">0</span></td>' +
                '</tr>' +
                '</tbody>');
            $('#pro_cat_sum').append(row);
            $.ajax({
                url: 'config/clientreport.php',
                data: {
                    year: year,
                    type: 'cat'
                },
                type: "post",
                success: function(data) {
                    // console.log(data);
                    var productSum = jQuery.parseJSON(data);
                    //console.log(productSum);
                    for (var i = 0; i < productSum.length; i++) {
                        if (productSum[i].month == '1') {
                            var m1 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '1').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '1').html(m1);
                            var mt1 = parseInt($('#pro_cat_sum #mt1').html()) + 1;
                            $('#pro_cat_sum #mt1').html(mt1);
                        }
                        if (productSum[i].month == '2') {
                            var m2 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '2').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '1').html(m2);
                            var mt2 = parseInt($('#pro_cat_sum #mt2').html()) + 1;
                            $('#pro_cat_sum #mt2').html(mt2);
                        }
                        if (productSum[i].month == '3') {
                            var m3 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '3').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '3').html(m3);
                            var mt3 = parseInt($('#pro_cat_sum #mt3').html()) + 1;
                            $('#pro_cat_sum #mt3').html(mt3);
                        }
                        if (productSum[i].month == '4') {
                            var m4 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '4').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '4').html(m4);
                            var mt4 = parseInt($('#pro_cat_sum #mt4').html()) + 1;
                            $('#pro_cat_sum #mt4').html(mt4);
                        }
                        if (productSum[i].month == '5') {
                            var m5 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '5').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '5').html(m5);
                            var mt5 = parseInt($('#pro_cat_sum #mt5').html()) + 1;
                            $('#pro_cat_sum #mt5').html(mt5);
                        }
                        if (productSum[i].month == '6') {
                            var m6 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '6').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '6').html(m6);
                            //console.log($('#36').html());
                            var mt6 = parseInt($('#pro_cat_sum #mt6').html()) + 1;
                            $('#pro_cat_sum #mt6').html(mt6);
                        }
                        if (productSum[i].month == '7') {
                            var m7 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '7').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '7').html(m7);
                            var mt7 = parseInt($('#pro_cat_sum #mt7').html()) + 1;
                            $('#pro_cat_sum #mt7').html(mt7);
                        }
                        if (productSum[i].month == '8') {
                            var m8 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '8').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '8').html(m8);
                            var mt8 = parseInt($('#pro_cat_sum #mt8').html()) + 1;
                            $('#pro_cat_sum #mt8').html(mt8);
                        }
                        if (productSum[i].month == '9') {
                            var m9 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '9').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '9').html(m9);
                            var mt9 = parseInt($('#pro_cat_sum #mt9').html()) + 1;
                            $('#pro_cat_sum #mt9').html(mt9);
                        }
                        if (productSum[i].month == '10') {
                            var m10 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '10').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '1').html(m10);
                            var mt10 = parseInt($('#pro_cat_sum #mt10').html()) + 1;
                            $('#pro_cat_sum #mt10').html(mt10);
                        }
                        if (productSum[i].month == '11') {
                            var m11 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '11').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '1').html(m11);
                            var mt11 = parseInt($('#pro_cat_sum #mt11').html()) + 1;
                            $('#pro_cat_sum #mt11').html(mt11);
                        }
                        if (productSum[i].month == '12') {
                            var m12 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '12').html()) + 1;
                            $('#pro_cat_sum #' + productSum[i].pr_sub_id + '1').html(m12);
                            var mt12 = parseInt($('#pro_cat_sum #mt12').html()) + 1;
                            $('#pro_cat_sum #mt12').html(mt12);
                        }
                        var m13 = parseInt($('#pro_cat_sum #' + productSum[i].pr_sub_id + '013').html()) + 1;
                        $('#pro_cat_sum #' + productSum[i].pr_sub_id + '013').html(m13);
                        var mt13 = parseInt($('#pro_cat_sum #mt013').html()) + 1;
                        $('#pro_cat_sum #mt013').html(mt13);
                    }
                }
            });
        }
    });
}
function proCatdep(year) {
    var da = 0;
    $('#pro_cat_adv tbody').remove();
    var statusdetails = "";
    event.preventDefault();
    $.ajax({
        url: "config/systemparamaters.php",
        data: {
            "type": "productsubcatlist"
        },
        type: "post",
        success: function(data) {
            //console.log(JSON.parse(data));
            var data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                var row = $('<tbody>' +
                    '<tr>' +
                    '<td><span id="">' + data[i].pr_sub_name + '</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '1">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '2">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '3">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '4">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '5">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '6">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '7">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '8">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '9">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '10">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '11">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '12">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '013">0</span></td>' +
                    '</tr>' +
                    '</tbody>');
                $('#pro_cat_adv').append(row);
            }
            var row = $('<tbody>' +
                '<tr>' +
                '<td><span id="">Total</span></td>' +
                '<td><span id="mt1">0</span></td>' +
                '<td><span id="mt2">0</span></td>' +
                '<td><span id="mt3">0</span></td>' +
                '<td><span id="mt4">0</span></td>' +
                '<td><span id="mt5">0</span></td>' +
                '<td><span id="mt6">0</span></td>' +
                '<td><span id="mt7">0</span></td>' +
                '<td><span id="mt8">0</span></td>' +
                '<td><span id="mt9">0</span></td>' +
                '<td><span id="mt10">0</span></td>' +
                '<td><span id="mt11">0</span></td>' +
                '<td><span id="mt12">0</span></td>' +
                '<td><span id="mt013">0</span></td>' +
                '</tr>' +
                '</tbody>');
            $('#pro_cat_adv').append(row);
        }
    });
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            year: year,
            type: 'cat'
        },
        type: "post",
        success: function(data) {
            // console.log(data);
            var productSum = jQuery.parseJSON(data);
            //console.log(productSum);
            for (var i = 0; i < productSum.length; i++) {
                if (productSum[i].month == '1') {
                    var m1 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m1);
                    var mt1 = parseInt($('#pro_cat_adv #mt1').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt1').html(mt1);
                }
                if (productSum[i].month == '2') {
                    var m2 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '2').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m2);
                    var mt2 = parseInt($('#pro_cat_adv #mt2').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt2').html(mt2);
                }
                if (productSum[i].month == '3') {
                    var m3 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '3').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '3').html(m3);
                    var mt3 = parseInt($('#pro_cat_adv #mt3').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt3').html(mt3);
                }
                if (productSum[i].month == '4') {
                    var m4 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '4').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '4').html(m4);
                    var mt4 = parseInt($('#pro_cat_adv #mt4').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt4').html(mt4);
                }
                if (productSum[i].month == '5') {
                    var m5 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '5').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '5').html(m5);
                    var mt5 = parseInt($('#pro_cat_adv #mt5').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt5').html(mt5);
                }
                if (productSum[i].month == '6') {
                    var m6 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '6').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '6').html(m6);
                    var mt6 = parseInt($('#pro_cat_adv #mt6').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt6').html(mt6);
                }
                if (productSum[i].month == '7') {
                    var m7 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '7').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '7').html(m7);
                    var mt7 = parseInt($('#pro_cat_adv #mt7').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt7').html(mt7);
                }
                if (productSum[i].month == '8') {
                    var m8 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '8').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '8').html(m8);
                    var mt8 = parseInt($('#pro_cat_adv #mt8').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt8').html(mt8);
                }
                if (productSum[i].month == '9') {
                    var m9 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '9').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '9').html(m9);
                    var mt9 = parseInt($('#pro_cat_adv #mt9').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt9').html(mt9);
                }
                if (productSum[i].month == '10') {
                    var m10 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '10').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m10);
                    var mt10 = parseInt($('#pro_cat_adv #mt10').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt10').html(mt10);
                }
                if (productSum[i].month == '11') {
                    var m11 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '11').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m11);
                    var mt11 = parseInt($('#pro_cat_adv #mt11').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt11').html(mt11);
                }
                if (productSum[i].month == '12') {
                    var m12 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '12').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #' + productSum[i].pr_sub_id + '1').html(m12);
                    var mt12 = parseInt($('#pro_cat_adv #mt12').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                    $('#pro_cat_adv #mt12').html(mt12);
                }
                var m13 = parseInt($('#pro_cat_adv #' + productSum[i].pr_sub_id + '013').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                $('#pro_cat_adv #' + productSum[i].pr_sub_id + '013').html(m13);
                var mt13 = parseInt($('#pro_cat_adv #mt013').html()) + parseInt(productSum[i].actual_security_deposit_amount);
                $('#pro_cat_adv #mt013').html(mt13);
            }
        }
    });
}
function proCatPro(year) {
    //var da = 0;
    $('#pro_cat_pro tbody').remove();
    var statusdetails = "";
    event.preventDefault();
    $.ajax({
        url: "config/systemparamaters.php",
        data: {
            "type": "productsubcatlist"
        },
        type: "post",
        success: function(data) {
            //console.log(JSON.parse(data));
            var data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                var row = $('<tbody>' +
                    '<tr>' +
                    '<td><span id="">' + data[i].pr_sub_name + '</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '1">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '2">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '3">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '4">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '5">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '6">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '7">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '8">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '9">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '10">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '11">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '12">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '013">0</span></td>' +
                    '</tr>' +
                    '</tbody>');
                $('#pro_cat_pro').append(row);
            }
            var row = $('<tbody>' +
                '<tr>' +
                '<td><span id="">Total</span></td>' +
                '<td><span id="mt1">0</span></td>' +
                '<td><span id="mt2">0</span></td>' +
                '<td><span id="mt3">0</span></td>' +
                '<td><span id="mt4">0</span></td>' +
                '<td><span id="mt5">0</span></td>' +
                '<td><span id="mt6">0</span></td>' +
                '<td><span id="mt7">0</span></td>' +
                '<td><span id="mt8">0</span></td>' +
                '<td><span id="mt9">0</span></td>' +
                '<td><span id="mt10">0</span></td>' +
                '<td><span id="mt11">0</span></td>' +
                '<td><span id="mt12">0</span></td>' +
                '<td><span id="mt013">0</span></td>' +
                '</tr>' +
                '</tbody>');
            $('#pro_cat_pro').append(row);
            $.ajax({
                url: 'config/clientreport.php',
                data: {
                    year: year,
                    type: 'cat'
                },
                type: "post",
                success: function(data) {
                    // console.log(data);
                    var productSum = jQuery.parseJSON(data);
                    //console.log(productSum);
                    for (var i = 0; i < productSum.length; i++) {
                        if (productSum[i].month == '1') {
                            var m1 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '1').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '1').html(m1);
                            var mt1 = parseInt($('#pro_cat_pro #mt1').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt1').html(mt1);
                        }
                        if (productSum[i].month == '2') {
                            var m2 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '2').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '1').html(m2);
                            var mt2 = parseInt($('#pro_cat_pro #mt2').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt2').html(mt2);
                        }
                        if (productSum[i].month == '3') {
                            var m3 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '3').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '3').html(m3);
                            var mt3 = parseInt($('#pro_cat_pro #mt3').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt3').html(mt3);
                        }
                        if (productSum[i].month == '4') {
                            var m4 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '4').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '4').html(m4);
                            var mt4 = parseInt($('#pro_cat_pro #mt4').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt4').html(mt4);
                        }
                        if (productSum[i].month == '5') {
                            var m5 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '5').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '5').html(m5);
                            var mt5 = parseInt($('#pro_cat_pro #mt5').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt5').html(mt5);
                        }
                        if (productSum[i].month == '6') {
                            var m6 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '6').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '6').html(m6);
                            var mt6 = parseInt($('#pro_cat_pro #mt6').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt6').html(mt6);
                        }
                        if (productSum[i].month == '7') {
                            var m7 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '7').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '7').html(m7);
                            var mt7 = parseInt($('#pro_cat_pro #mt7').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt7').html(mt7);
                        }
                        if (productSum[i].month == '8') {
                            var m8 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '8').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '8').html(m8);
                            var mt8 = parseInt($('#pro_cat_pro #mt8').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt8').html(mt8);
                        }
                        if (productSum[i].month == '9') {
                            var m9 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '9').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '9').html(m9);
                            var mt9 = parseInt($('#pro_cat_pro #mt9').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt9').html(mt9);
                        }
                        if (productSum[i].month == '10') {
                            var m10 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '10').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '1').html(m10);
                            var mt10 = parseInt($('#pro_cat_pro #mt10').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt10').html(mt10);
                        }
                        if (productSum[i].month == '11') {
                            var m11 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '11').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '1').html(m11);
                            var mt11 = parseInt($('#pro_cat_pro #mt11').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt11').html(mt11);
                        }
                        if (productSum[i].month == '12') {
                            var m12 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '12').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #' + productSum[i].pr_sub_id + '1').html(m12);
                            var mt12 = parseInt($('#pro_cat_pro #mt12').html()) + parseInt(productSum[i].actual_processing_fee);
                            $('#pro_cat_pro #mt12').html(mt12);
                        }
                        var m13 = parseInt($('#pro_cat_pro #' + productSum[i].pr_sub_id + '013').html()) + parseInt(productSum[i].actual_processing_fee);
                        $('#pro_cat_pro #' + productSum[i].pr_sub_id + '013').html(m13);
                        var mt13 = parseInt($('#pro_cat_pro #mt013').html()) + parseInt(productSum[i].actual_processing_fee);
                        $('#pro_cat_pro #mt013').html(m13);
                    }
                }
            });
        }
    });
}
function proCatRent(year) {
    //var da = 0;
    $('#pro_cat_rent tbody').remove();
    var statusdetails = "";
    event.preventDefault();
    $.ajax({
        url: "config/systemparamaters.php",
        data: {
            "type": "productsubcatlist"
        },
        type: "post",
        success: function(data) {
            //console.log(JSON.parse(data));
            var data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                var row = $('<tbody>' +
                    '<tr>' +
                    '<td><span id="">' + data[i].pr_sub_name + '</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '1">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '2">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '3">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '4">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '5">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '6">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '7">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '8">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '9">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '10">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '11">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '12">0</span></td>' +
                    '<td><span id="' + data[i].pr_sub_id + '013">0</span></td>' +
                    '</tr>' +
                    '</tbody>');
                $('#pro_cat_rent').append(row);
            }
            var row = $('<tbody>' +
                '<tr>' +
                '<td><span id="">Total</span></td>' +
                '<td><span id="mt1">0</span></td>' +
                '<td><span id="mt2">0</span></td>' +
                '<td><span id="mt3">0</span></td>' +
                '<td><span id="mt4">0</span></td>' +
                '<td><span id="mt5">0</span></td>' +
                '<td><span id="mt6">0</span></td>' +
                '<td><span id="mt7">0</span></td>' +
                '<td><span id="mt8">0</span></td>' +
                '<td><span id="mt9">0</span></td>' +
                '<td><span id="mt10">0</span></td>' +
                '<td><span id="mt11">0</span></td>' +
                '<td><span id="mt12">0</span></td>' +
                '<td><span id="mt013">0</span></td>' +
                '</tr>' +
                '</tbody>');
            $('#pro_cat_rent').append(row);
        }
    });
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            year: year,
            type: 'ren'
        },
        type: "post",
        success: function(data) {
            // console.log(data);
            var productSum = jQuery.parseJSON(data);
            // console.log(productSum);
            for (var i = 0; i < productSum.length; i++) {
                if (productSum[i].re_month == '1') {
                    var m1 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '1').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '1').html(m1);
                    var mt1 = parseInt($('#pro_cat_rent #mt1').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt1').html(mt1);
                }
                if (productSum[i].re_month == '2') {
                    var m2 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '2').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '1').html(m2);
                    var mt2 = parseInt($('#pro_cat_rent #mt2').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt2').html(mt2);
                }
                if (productSum[i].re_month == '3') {
                    var m3 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '3').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '3').html(m3);
                    var mt3 = parseInt($('#pro_cat_rent #mt3').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt3').html(mt3);
                }
                if (productSum[i].re_month == '4') {
                    var m4 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '4').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '4').html(m4);
                    var mt4 = parseInt($('#pro_cat_rent #mt4').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt4').html(mt4);
                }
                if (productSum[i].re_month == '5') {
                    var m5 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '5').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '5').html(m5);
                    var mt5 = parseInt($('#pro_cat_rent #mt5').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt5').html(mt5);
                }
                if (productSum[i].re_month == '6') {
                    var m6 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '6').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '6').html(m6);
                    var mt6 = parseInt($('#pro_cat_rent #mt6').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt6').html(mt6);
                }
                if (productSum[i].re_month == '7') {
                    var m7 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '7').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '7').html(m7);
                    var mt7 = parseInt($('#pro_cat_rent #mt7').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt7').html(mt7);
                }
                if (productSum[i].re_month == '8') {
                    var m8 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '8').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '8').html(m8);
                    var mt8 = parseInt($('#pro_cat_rent #mt8').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt8').html(mt8);
                }
                if (productSum[i].re_month == '9') {
                    var m9 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '9').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '9').html(m9);
                    var mt9 = parseInt($('#pro_cat_rent #mt9').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt9').html(mt9);
                }
                if (productSum[i].re_month == '10') {
                    var m10 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '10').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '1').html(m10);
                    var mt10 = parseInt($('#pro_cat_rent #mt10').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt10').html(mt10);
                }
                if (productSum[i].re_month == '11') {
                    var m11 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '11').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '1').html(m11);
                    var mt11 = parseInt($('#pro_cat_rent #mt11').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt11').html(mt11);
                }
                if (productSum[i].re_month == '12') {
                    var m12 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '12').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #' + productSum[i].pr_sub_id + '1').html(m12);
                    var mt12 = parseInt($('#pro_cat_rent #mt12').html()) + parseInt(productSum[i].rent_cost);
                    $('#pro_cat_rent #mt12').html(mt12);
                }
                var m13 = parseInt($('#pro_cat_rent #' + productSum[i].pr_sub_id + '013').html()) + parseInt(productSum[i].rent_cost);
                $('#pro_cat_rent #' + productSum[i].pr_sub_id + '013').html(m13);
                var mt13 = parseInt($('#pro_cat_rent #mt013').html()) + parseInt(productSum[i].rent_cost);
                $('#pro_cat_rent #mt013').html(mt13);
            }
        }
    });
}
function reportReturnList(year) {
    $.ajax({
        url: 'config/clientreport.php',
        data: {
            year: year,
            type: 'return'
        },
        type: "post",
        success: function(data) {
            var r_a_data = jQuery.parseJSON(data);
            //console.log(r_a_data);
            $("#r_ret1").html('0');
            $("#r_ret2").html('0');
            $("#r_ret3").html('0');
            $("#r_ret4").html('0');
            $("#r_ret5").html('0');
            $("#r_ret6").html('0');
            $("#r_ret7").html('0');
            $("#r_ret8").html('0');
            $("#r_ret9").html('0');
            $("#r_ret10").html('0');
            $("#r_ret11").html('0');
            $("#r_ret12").html('0');
            $.each(r_a_data, function(key, value) {
                $("#r_ret" + value.month + "").html(value.cou);
            });
        }
    });
}
reportReturnList('2016');
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#mappedList').DataTable({
        'ajax': {
            'url': 'config/mapped_product_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Refund List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Refund List'
        }],
        'language': [{
            'infoEmpty': 'No entries to show'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],

        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#mappedList tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#mappedList').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#mappedList thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#mappedList tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#mappedList tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});


$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#mappedListRefund').DataTable({
        'ajax': {
            'url': 'config/mapped_product_list1.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Refund List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Refund List'
        }],
        'language': [{
            'infoEmpty': 'No entries to show'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],

        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#mappedList tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#mappedList').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#mappedList thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#mappedList tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#mappedList tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#closecustomer').DataTable({
        'ajax': {
            'url': 'config/close_customer_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Refund List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Refund List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        dom: 'Bfrtip',
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#mappedList tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#mappedList').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#mappedList thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#mappedList tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#mappedList tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
//customer add
var obj;
function reset_page() {
    location.reload();
}
function updateDataTableSelectAllCtrl(table) {
    var $table = table.table().node();
    var $chkbox_all = $('tbody input[type="checkbox"]', $table);
    var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
    var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);
    // If none of the checkboxes are checked
    if ($chkbox_checked.length === 0) {
        chkbox_select_all.checked = false;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }
        // If all of the checkboxes are checked
    } else if ($chkbox_checked.length === $chkbox_all.length) {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }
        // If some of the checkboxes are checked
    } else {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = true;
        }
    }
}
//Invoice table
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#example').DataTable({
        'ajax': {
            'url': 'config/get_customer_sys_par.php'
        },
        'dom': 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength'
        ],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#example tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#example').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#example thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#example tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
    // Handle form submission event
    // $('#frm-example').submit(function(e){
    $('.sndnoti').click(function(e) {
        e.preventDefault();
        //console.log($(this).attr('sndtype'));
        $.each(rows_selected, function(index, rowId) {
        });
        var ddd = rows_selected.join(",");
        //console.log(ddd);
        if ($(this).attr('sndtype') == 'email') {
            if (ddd.length == 0) {
                alert('Please Select The Coustomer');
            } else {
                $.ajax({
                    url: 'TCPDF-master/examples/example_061.php',
                    data: {
                        c_id: ddd
                    },
                    type: "post",
                    success: function(data) {
                        alert('Message Sent Successfully');
                        $("#pend input[name='select_all']").trigger("click");
                        $("#example input[name='select_all']").trigger("click");

                        // location.reload();
                    }
                });
            }
        } else {
            if (ddd.length == 0) {
                alert('Please Select The Coustomer');
            } else {
                $.ajax({
                    url: 'config/smsSender.php',
                    data: {
                        c_id: ddd
                    },
                    type: "post",
                    success: function(data) {
                        alert('Message Sent Successfully');
                        //location.reload();
                       $("#pend input[name='select_all']").trigger("click");
                        $("#example input[name='select_all']").trigger("click");
                    }
                });
            }
        }
    });
});
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#pend').DataTable({
        'ajax': {
            'url': 'config/get_pending_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Invoice List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Invoice List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#pend tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#pend').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#pend thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#pend tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#pend tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
    // Handle form submission event
    // $('#frm-example').submit(function(e){
    $('.sndnotit').click(function(e) {
        e.preventDefault();
        //alert('ab');
        //console.log($(this).attr('sndtype'));
        $.each(rows_selected, function(index, rowId) {
        });
        var ddd = rows_selected.join(",");
        //console.log(ddd);
        if ($(this).attr('sndtype') == 'email') {
            if (ddd.length == 0) {
                alert('Please Select The Coustomer');
            } else {
                $.ajax({
                    url: 'TCPDF-master/examples/example_061.php',
                    data: {
                        c_id: ddd
                    },
                    type: "post",
                    success: function(data) {
                        alert('Message Sent Successfully');
                        $("#pend input[name='select_all']").trigger("click");
                        $("#example input[name='select_all']").trigger("click");
                        //location.reload();
                    }
                });
            }
        } else {
            if (ddd.length == 0) {
                alert('Please Select The Coustomer');
            } else {
                $.ajax({
                    url: 'config/smsSenderfollow.php',
                    data: {
                        c_id: ddd
                    },
                    type: "post",
                    success: function(data) {
                        alert('Message Sent Successfully');
                       $("#pend input[name='select_all']").trigger("click");
                        $("#example input[name='select_all']").trigger("click");
                        //location.reload();
                    }
                });
            }
        }
    });
});
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#rejectedEnquiry').DataTable({
        'ajax': {
            'url': 'config/rejectedenq.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Invoice List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Invoice List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#rejectedEnquiry tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#rejectedEnquiry').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#rejectedEnquiry thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#rejectedEnquiry tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#rejectedEnquiry tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
    // Handle form submission event
    // $('#frm-example').submit(function(e){
    $('.sndnotit').click(function(e) {
        e.preventDefault();
        //alert('ab');
        //console.log($(this).attr('sndtype'));
        $.each(rows_selected, function(index, rowId) {
        });
        var ddd = rows_selected.join(",");
        // console.log(ddd);
        if ($(this).attr('sndtype') == 'email') {
            if (ddd.length == 0) {
                alert('Please Select The Coustomer');
            } else {
                $.ajax({
                    url: 'TCPDF-master/examples/example_061.php',
                    data: {
                        c_id: ddd
                    },
                    type: "post",
                    success: function(data) {
                        alert('Message Sent Successfully');
                        $("#pend input[name='select_all']").trigger("click");
                        $("#example input[name='select_all']").trigger("click");
                        //location.reload();
                    }
                });
            }
        } else {
            if (ddd.length == 0) {
                alert('Please Select The Coustomer');
            } else {
                $.ajax({
                    url: 'config/smsSenderfollow.php',
                    data: {
                        c_id: ddd
                    },
                    type: "post",
                    success: function(data) {
                        alert('Message Sent Successfully');
                        $("#pend input[name='select_all']").trigger("click");
                        $("#example input[name='select_all']").trigger("click");
                        //location.reload();
                    }
                });
            }
        }
    });
});
//
function genrateInvoice() {

  //generate invoice
  if (confirm("are you sure")) {
    $.ajax({
        url: 'config/genrateInvoice.php',
        data: "username=test",
        type: "post",
        success: function(data) {
            //console.log(data);
            location.reload();
        }
    });
  }

}
//customer select list
function getNativity() {
    $.ajax({
        url: 'config/customer_select_box_data.php',
        data: "type_name=1",
        type: "post",
        success: function(data) {
            var nativity_data = jQuery.parseJSON(data);
            $('#c_nativity').children('option').remove();
            $.each(nativity_data, function(key, value) {
                $('#c_nativity').append('<option value="' + value.id + '">' + value.name + '</option>')
            });
        }
    });
}
getNativity();
function getState() {
    $.ajax({
        url: 'config/customer_select_box_data.php',
        data: "type_name=2",
        type: "post",
        success: function(data) {
            var nativity_data = jQuery.parseJSON(data);
            $('#c_state').children('option').remove();
            $('#c_state1').children('option').remove();
            $('#c_state2').children('option').remove();
            $('#c_state2').append('<option value="0" >All</option>');
            $.each(nativity_data, function(key, value) {
                $('#c_state').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#c_state1').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#c_state2').append('<option value="' + value.id + '">' + value.name + '</option>');
            });
            var id = $('#c_state').val();
            getCity(id);
        }
    });
}
getState();
function getCity(state_id) {
    $.ajax({
        url: 'config/customer_select_box_data.php',
        data: {
            type_name: "3",
            state_id: state_id
        },
        type: "post",
        success: function(data) {
            var nativity_data = jQuery.parseJSON(data);
            $('#c_city').children('option').remove();
            $('#c_city1').children('option').remove();
            $('#c_city2').children('option').remove();
            $('#c_city2').append('<option value="0" >All</option>');
            if (nativity_data.length === 0) {
                $('#c_city2').children('option').remove();
                $('#c_city').append('<option value="0">-- No city --</option>');
                $('#c_city1').append('<option value="0">-- No city --</option>');
                $('#c_city2').append('<option value="0">-- No city --</option>');
            }
            $.each(nativity_data, function(key, value) {
                $('#c_city').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#c_city1').append('<option value="' + value.id + '">' + value.name + '</option>');
                $('#c_city2').append('<option value="' + value.id + '">' + value.name + '</option>');
            });
            var id = $('#c_city').val();
            getZone(id);
        }
    });
}
function getZone(city_id) {
    $.ajax({
        url: 'config/customer_select_box_data.php',
        data: {
            type_name: "4",
            city_id: city_id
        },
        type: "post",
        success: function(data) {
            var nativity_data = jQuery.parseJSON(data);
            $('#c_zone').children('option').remove();
            $('#c_zone1').children('option').remove();
            $('#c_zone2').children('option').remove();
            $('#c_zone2').append('<option value="0" >All</option>');
            if (nativity_data.length === 0) {
                $('#c_zone2').children('option').remove();
                $('#c_zone').append('<option value="0">-- No Zone --</option>')
                $('#c_zone1').append('<option value="0">-- No Zone --</option>')
                $('#c_zone2').append('<option value="0">-- No Zone --</option>')
            }
            $.each(nativity_data, function(key, value) {
                $('#c_zone').append('<option value="' + value.id + '">' + value.name + '</option>')
                $('#c_zone1').append('<option value="' + value.id + '">' + value.name + '</option>')
                $('#c_zone2').append('<option value="' + value.id + '">' + value.name + '</option>')
            });
            var id = $('#c_zone').val();
            getArea(id);
        }
    });
}
function getArea(zone_id) {
  //alert(zone_id);
    $.ajax({
        url: 'config/customer_select_box_data.php',
        data: {
            type_name: "5",
            zone_id: zone_id
        },
        type: "post",
        success: function(data) {
            var nativity_data = jQuery.parseJSON(data);
            $('#c_area').children('option').remove();
            $('#c_area1').children('option').remove();
            $('#c_area2').children('option').remove();
            $('#c_area2').append('<option value="0" >All</option>');
            if (nativity_data.length === 0) {
                $('#c_area2').children('option').remove();
                $('#c_area').append('<option value="0">-- No Area --</option>')
                $('#c_area1').append('<option value="0">-- No Area --</option>')
                $('#c_area2').append('<option value="0">-- No Area --</option>')
            }

            $.each(nativity_data, function(key, value) {
              var sel ="";
              if(ara != 0 && value.id == ara)
              {
                sel = "selected"
              }

                $('#c_area').append('<option '+sel+'  value="' + value.id + '">' + value.name + '</option>')
                $('#c_area1').append('<option '+sel+' value="' + value.id + '">' + value.name + '</option>')
                $('#c_area2').append('<option '+sel+' value="' + value.id + '">' + value.name + '</option>')
            });
            ara =0;
        }
    });
}
//mobile no checking
function existingCheck(value, type) {
    $.ajax({
        url: 'config/existing_check.php',
        data: {
            value: value,
            type: type
        },
        type: "post",
        success: function(data) {
            var checked_data = jQuery.parseJSON(data);
            if (checked_data.length > 0) {
                alert('Already Exit');
            }
        }
    });
}
//mobile
var a = 1;
function add_mobile() {
    a++;
    $('#mobile_table').append('<tr ><td><select class="form-control" name="c_mobile_type[]">' +
        '<option>Primary</option>' +
        '<option>Secondary</option>' +
        ' </select></td>' +
        '<td>' +
        '<div class="form-group">' +
        '<div class="col-sm-10">' +
        '<input type="text" class="form-control" id="mobile" placeholder="Mobile" name="c_mobile_no[]" onchange="existingCheck(this.value,\'mobile\')">' +
        ' </div>' +
        '</div>	' +
        '</td>' +
        '<td class="action-link"> <a class="m_remove" style="cursor:pointer"> <i class="fa fa-trash-o"  aria-hidden="true" ></i></a></td>' +
        '</tr>')
};
$(document).on('click', '.m_remove', function() {
    $(this).closest('tr').remove();
    return false;
});
var b = 1;
function add_address() {
    b++;
    $('#address_table').append('<tr><td><select class="form-control" name="c_address_type[]">' +
            '<option>Permanent</option>' +
            '<option>Communication</option>' +
            '  </select></td>' +
            '<td>' +
            '<div class="form-group">' +
            ' <div class="col-sm-10">' +
            '  <textarea class="form-control" rows="3" id="permanent_address" placeholder="Enter. . ." name="c_address[]"></textarea>' +
            ' </div>' +
            '</div>' +
            '</td>' +
            '<td class="action-link"> <a class="a_remove"> <i class="fa fa-trash-o"  aria-hidden="true"></i></a></td>' +
            '</tr>')
        //alert(a);
};
$(document).on('click', '.a_remove', function() {
    $(this).closest('tr').remove();
    return false;
});
//customer table
//customer c_table
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#customer').DataTable({
        'ajax': {
            'url': 'config/customer_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Customer List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Customer List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#customer tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#customer').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#customer thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#customer tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#customer tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
//customer c_table
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#Noncustomer').DataTable({
        'ajax': {
            'url': 'config/non_customer_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Non Customer List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Non Customer List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#Noncustomer tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#Noncustomer').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#Noncustomer thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#Noncustomer tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#Noncustomer tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
function backCustomer() {
    $("#edit_view").hide();
    $("#Customer_tab_view").show();
    $("#mappedProduct").hide();
}
function viewCustomer(c_id, c_status) {
    MappedviewCustomer(c_id);
    $("#edit_view").show();
    $("#Customer_tab_view").hide();
    $("#view").html(" Customer Deltails");
    $("#up").css({
        "display": "none"
    });
    $("#adpup").css({
        "display": "none"
    });
    $("#idpup").css({
        "display": "none"
    });
    $("#canup").css({
        "display": "none"
    });
    $("#cidup").css({
        "display": "none"
    });
    $("#csubmit").css({
        "display": "none"
    });
    $('#c_nativity').prop('disabled', true);
    $("#c_type").prop('disabled', true);
    $('#applicantname').prop('disabled', true);
    $('#datepicker2').prop('disabled', true);
    $("#optionsRadios1").prop("disabled", true);
    $("#optionsRadios2").prop("disabled", true);
    $("#optionsRadio1").prop("disabled", true);
    $("#optionsRadio2").prop("disabled", true);
    $("#c_res_status").prop("disabled", true);
    $("#enquiryemail").prop("disabled", true);
    $("#c_state").prop("disabled", true);
    $("#c_city").prop("disabled", true);
    $("#c_zone").prop("disabled", true);
    $("#c_area").prop("disabled", true);
    $("#cname").prop("disabled", true);
    $("#designation").prop("disabled", true);
    $("#department").prop("disabled", true);
    $("#alternateemail").prop("disabled", true);
    $("#ename").prop("disabled", true);
    $("#enquiryemails").prop("disabled", true);
    $("#emobile").prop("disabled", true);
    $("#eaddress").prop("disabled", true);
    $("#rname").prop("disabled", true);
    $("#remail").prop("disabled", true);
    $("#rmobile").prop("disabled", true);
    $("#raddress").prop("disabled", true);
    $.ajax({
        url: 'config/viewCustomer.php',
        data: {
            c_id: c_id,
            c_status: c_status
        },
        type: "post",
        success: function(data) {
            var view_data = jQuery.parseJSON(data);
            //  $("#applicantname").val();
            $("#c_nativity").val(view_data['gen'][0]['nativity']);
            $("#applicantname").val(view_data['gen'][0]['customer_name']);
            $("#datepicker2").val(view_data['gen'][0]['dob']);
            $("#c_type").val(view_data['gen'][0]['customer_type_id']);
            $("#remark5").val(view_data['gen'][0]['remark']);
            //alert(view_data ['gen'] [0] ['remark']);
            if (view_data['gen'][0]['gender'] == 1) {
                $("#optionsRadios2").prop("checked", true);
            } else {
                $("#optionsRadios1").prop("checked", true);
            }
            if (view_data['gen'][0]['marital_status'] == 1) {
                $("#optionsRadio2").prop("checked", true);
            } else {
                $("#optionsRadio1").prop("checked", true);
            }
            $("#c_res_status").val(view_data['gen'][0]['residential_status']);
            $("#enquiryemail").val(view_data['gen'][0]['email']);
            $("#c_state").val(view_data['gen'][0]['state_id']);
            $("#c_city").val(view_data['gen'][0]['city_id']);
            $("#c_zone").val(view_data['gen'][0]['zone_id']);
              ara = view_data['gen'][0]['area_id'];
            getArea(view_data['gen'][0]['zone_id']);
            $("#c_area").val(view_data['gen'][0]['area_id']);
            $("#c_pincode").val(view_data['gen'][0]['pincode']);
            $("#c_floor").val(view_data['gen'][0]['floor']);
            //professional information
            if (view_data['pro'].length == 0) {
                $("#cname").val("");
                $("#designation").val("");
                $("#department").val("");
                $("#alternateemail").val("");
            } else {
                $("#cname").val(view_data['pro'][0]['company_name']);
                $("#designation").val(view_data['pro'][0]['designation']);
                $("#department").val(view_data['pro'][0]['department']);
                $("#alternateemail").val(view_data['pro'][0]['alternative_email']);
            }
            //reference 1&2
            if (view_data['ref'].length == 2 || view_data['ref'].length == 1) {
                $("#ename").val(view_data['ref'][0]['name']);
                $("#enquiryemails").val(view_data['ref'][0]['email']);
                $("#emobile").val(view_data['ref'][0]['mobile']);
                $("#eaddress").val(view_data['ref'][0]['address']);
                $("#rname").val(view_data['ref'][1]['name']);
                $("#remail").val(view_data['ref'][1]['email']);
                $("#rmobile").val(view_data['ref'][1]['mobile']);
                $("#raddress").val(view_data['ref'][1]['address']);
            } else {
                $("#ename").val("");
                $("#enquiryemails").val("");
                $("#emobile").val("");
                $("#eaddress").val("");
                $("#rname").val("");
                $("#remail").val("");
                $("#rmobile").val("");
                $("#raddress").val("");
            }
            if (view_data['kyc'].length > 0) {
                $("#user").attr('src', 'Documents/customer/' + c_id + '/image/' + view_data["kyc"][0]["path"] + '');
                $("#companyid").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Company Id/' + view_data["kyc"][1]["path"] + '');
                $("#cancelcheque").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Canceled Cheque/' + view_data["kyc"][2]["path"] + '');
                $("#idproof").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Id Proof/' + view_data["kyc"][3]["path"] + '');
                $("#addressproof").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Address Proof/' + view_data["kyc"][4]["path"] + '');
                $("#file").attr('vale', view_data["kyc"][0]["path"]);
                $("#cidfile").attr('vale', view_data["kyc"][1]["path"]);
                $("#cancelfile").attr('vale', view_data["kyc"][2]["path"]);
                $("#idfile").attr('vale', view_data["kyc"][3]["path"]);
                $("#addressfile").attr('vale', view_data["kyc"][4]["path"]);
            } else {
                $("#user").attr('src', '.jpg');
                $("#companyid").attr('src', '.jpg');
                $("#cancelcheque").attr('src', '.jpg');
                $("#idproof").attr('src', '.jpg');
                $("#addressproof").attr('src', '.jpg');
                $("#file").attr('vale', '');
                $("#cidfile").attr('vale', '');
                $("#cancelfile").attr('vale', '');
                $("#idfile").attr('vale', '');
                $("#addressfile").attr('vale', '');
            }
            //documents
            // console.log(view_data ["con"]);
            //mobile
            $("#mobile_table").find("tr:gt(0)").remove();
            $.each(view_data['con'], function(key, value) {
                $('#mobile_table').append('<tr ><td><select class="form-control" id="ty' + key + '" name="c_mobile_type[]" disabled>' +
                    '<option value="Primary">Primary</option>' +
                    '<option value="Secondary">Secondary</option>' +
                    ' </select></td>' +
                    '<td>' +
                    '<div class="form-group">' +
                    '<div class="col-sm-10">' +
                    '<input type="text" class="form-control" id="" placeholder="Mobile" name="c_mobile_no[]" onchange="existingCheck(this.value,\'mobile\')" value="' + value.mobile + '" disabled>' +
                    ' </div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="action-link"> <a class="m_remove" style="cursor:pointer"> <i class="fa fa-trash-o"  aria-hidden="true" ></i></a></td>' +
                    '</tr>');
                $('#ty' + key + '').val(value.type);
            });
            //address
            $("#address_table").find("tr:gt(0)").remove();
            $.each(view_data['add'], function(key, value) {
                $('#address_table').append('<tr><td><select id="tz' + key + '" class="form-control" name="c_address_type[]" disabled>' +
                    '<option value="Permanent">Permanent</option>' +
                    '<option value="Communication">Communication</option>' +
                    '  </select></td>' +
                    '<td>' +
                    '<div class="form-group">' +
                    ' <div class="col-sm-10">' +
                    '  <textarea class="form-control" rows="3" id="permanent_address" placeholder="Enter. . ." name="c_address[]" disabled >' + value.address + '</textarea>' +
                    ' </div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="action-link"> <a class="a_remove"> <i class="fa fa-trash-o"  aria-hidden="true"></i></a></td>' +
                    '</tr>');
                $('#tz' + key + '').val(value.type);
            });
            $(".action-link").css({
                "display": "none"
            });
        }
    });
}
$("#edit_view").hide();
$("#Customer_tab_view").show();
var ara = 0;
function editCustomer(c_id, c_status) {
    MappedviewCustomer(c_id);
    $("#edit_view").show();
    $("#Customer_tab_view").hide();
    $("#customer_id").val(c_id);
    $("#view").html("Edit Customer");
    $("#up").css({
        "display": "block"
    });
    $("#adpup").css({
        "display": "block"
    });
    $("#idpup").css({
        "display": "block"
    });
    $("#canup").css({
        "display": "block"
    });
    $("#cidup").css({
        "display": "block"
    });
    $("#csubmit").css({
        "display": "block"
    });
    $('#c_nativity').prop('disabled', false);
    $("#c_type").prop('disabled', false);
    $('#applicantname').prop('disabled', false);
    $('#datepicker2').prop('disabled', false);
    $("#optionsRadios1").prop("disabled", false);
    $("#optionsRadios2").prop("disabled", false);
    $("#optionsRadio1").prop("disabled", false);
    $("#optionsRadio2").prop("disabled", false);
    $("#c_res_status").prop("disabled", false);
    $("#enquiryemail").prop("disabled", false);
    $("#c_state").prop("disabled", false);
    $("#c_city").prop("disabled", false);
    $("#c_zone").prop("disabled", false);
    $("#c_area").prop("disabled", false);
    $("#cname").prop("disabled", false);
    $("#designation").prop("disabled", false);
    $("#department").prop("disabled", false);
    $("#alternateemail").prop("disabled", false);
    $("#ename").prop("disabled", false);
    $("#enquiryemails").prop("disabled", false);
    $("#emobile").prop("disabled", false);
    $("#eaddress").prop("disabled", false);
    $("#rname").prop("disabled", false);
    $("#remail").prop("disabled", false);
    $("#rmobile").prop("disabled", false);
    $("#raddress").prop("disabled", false);
    $.ajax({
        url: 'config/viewCustomer.php',
        data: {
            c_id: c_id,
            c_status: c_status
        },
        type: "post",
        success: function(data) {
            var view_data = jQuery.parseJSON(data);
            //  $("#applicantname").val();
            $("#c_nativity").val(view_data['gen'][0]['nativity']);
            $("#applicantname").val(view_data['gen'][0]['customer_name']);
            $("#datepicker2").val(view_data['gen'][0]['dob']);
            $("#c_type").val(view_data['gen'][0]['customer_type_id']);
            $("#remark5").val(view_data['gen'][0]['remark']);
            if (view_data['gen'][0]['gender'] == 1) {
                $("#optionsRadios2").prop("checked", true);
            } else {
                $("#optionsRadios1").prop("checked", true);
            }
            if (view_data['gen'][0]['marital_status'] == 1) {
                $("#optionsRadio2").prop("checked", true);
            } else {
                $("#optionsRadio1").prop("checked", true);
            }
            $("#c_res_status").val(view_data['gen'][0]['residential_status']);
            $("#enquiryemail").val(view_data['gen'][0]['email']);
            $("#c_state").val(view_data['gen'][0]['state_id']);
            $("#c_city").val(view_data['gen'][0]['city_id']);
            $("#c_zone").val(view_data['gen'][0]['zone_id']);

            ara = view_data['gen'][0]['area_id'];

            getArea(view_data['gen'][0]['zone_id']);

            $("#c_area").val(view_data['gen'][0]['area_id']);
            $("#c_pincode").val(view_data['gen'][0]['pincode']);
            $("#c_floor").val(view_data['gen'][0]['floor']);
            //professional information
            if (view_data['pro'].length == 0) {
                $("#cname").val("");
                $("#designation").val("");
                $("#department").val("");
                $("#alternateemail").val("");
            } else {
                $("#cname").val(view_data['pro'][0]['company_name']);
                $("#designation").val(view_data['pro'][0]['designation']);
                $("#department").val(view_data['pro'][0]['department']);
                $("#alternateemail").val(view_data['pro'][0]['alternative_email']);
            }
            //reference 1&2
            if (view_data['ref'].length == 2 || view_data['ref'].length == 1) {
                $("#ename").val(view_data['ref'][0]['name']);
                $("#enquiryemails").val(view_data['ref'][0]['email']);
                $("#emobile").val(view_data['ref'][0]['mobile']);
                $("#eaddress").val(view_data['ref'][0]['address']);
                $("#rname").val(view_data['ref'][1]['name']);
                $("#remail").val(view_data['ref'][1]['email']);
                $("#rmobile").val(view_data['ref'][1]['mobile']);
                $("#raddress").val(view_data['ref'][1]['address']);
            } else {
                $("#ename").val("");
                $("#enquiryemails").val("");
                $("#emobile").val("");
                $("#eaddress").val("");
                $("#rname").val("");
                $("#remail").val("");
                $("#rmobile").val("");
                $("#raddress").val("");
            }
            $('#kyclen').val(view_data['kyc'].length);
            if (view_data['kyc'].length > 0) {
                $("#user").attr('src', 'Documents/customer/' + c_id + '/image/' + view_data["kyc"][0]["path"] + '');
                $("#companyid").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Company Id/' + view_data["kyc"][1]["path"] + '');
                $("#cancelcheque").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Canceled Cheque/' + view_data["kyc"][2]["path"] + '');
                $("#idproof").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Id Proof/' + view_data["kyc"][3]["path"] + '');
                $("#addressproof").attr('src', 'Documents/customer/' + c_id + '/Id Proof/Address Proof/' + view_data["kyc"][4]["path"] + '');
                $("#file").attr('vale', view_data["kyc"][0]["path"]);
                $("#cidfile").attr('vale', view_data["kyc"][1]["path"]);
                $("#cancelfile").attr('vale', view_data["kyc"][2]["path"]);
                $("#idfile").attr('vale', view_data["kyc"][3]["path"]);
                $("#addressfile").attr('vale', view_data["kyc"][4]["path"]);
            } else {
                $("#user").attr('src', '.jpg');
                $("#companyid").attr('src', '.jpg');
                $("#cancelcheque").attr('src', '.jpg');
                $("#idproof").attr('src', '.jpg');
                $("#addressproof").attr('src', '.jpg');
                $("#file").attr('vale', '');
                $("#cidfile").attr('vale', '');
                $("#cancelfile").attr('vale', '');
                $("#idfile").attr('vale', '');
                $("#addressfile").attr('vale', '');
            }
            //documents
            //console.log(view_data ["con"]);
            //mobile
            $("#mobile_table").find("tr:gt(0)").remove();
            $.each(view_data['con'], function(key, value) {
                $('#mobile_table').append('<tr ><td><select class="form-control" id="ty' + key + '" name="c_mobile_type[]" >' +
                    '<option value="Primary">Primary</option>' +
                    '<option value="Secondary">Secondary</option>' +
                    ' </select></td>' +
                    '<td>' +
                    '<div class="form-group">' +
                    '<div class="col-sm-10">' +
                    '<input type="text" class="form-control" id="" placeholder="Mobile" name="c_mobile_no[]" onchange="existingCheck(this.value,\'mobile\')" value="' + value.mobile + '" >' +
                    ' </div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="action-link"> <a class="m_remove" style="cursor:pointer"> <i class="fa fa-trash-o"  aria-hidden="true" ></i></a></td>' +
                    '</tr>');
                $('#ty' + key + '').val(value.type);
            });
            //address
            $("#address_table").find("tr:gt(0)").remove();
            $.each(view_data['add'], function(key, value) {
                $('#address_table').append('<tr><td><select id="tz' + key + '" class="form-control" name="c_address_type[]" >' +
                    '<option value="Permanent">Permanent</option>' +
                    '<option value="Communication">Communication</option>' +
                    '  </select></td>' +
                    '<td>' +
                    '<div class="form-group">' +
                    ' <div class="col-sm-10">' +
                    '  <textarea class="form-control" rows="3" id="permanent_address" placeholder="Enter. . ." name="c_address[]"  >' + value.address + '</textarea>' +
                    ' </div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="action-link"> <a class="a_remove"> <i class="fa fa-trash-o"  aria-hidden="true"></i></a></td>' +
                    '</tr>');
                $('#tz' + key + '').val(value.type);
            });
            $(".action-link").css({
                "display": "block"
            });
        }
    });
}
function MappedviewCustomer(id)
{
    // alert('a');
    $.ajax({
        url: 'config/mappedData.php',
        data: {
            c_id: id
        },
        type: "post",
        success: function(data) {
            var asd = 0;
            $('#product_view_cus').empty();
            $('#product_view_cus').append('<thead>' +
                '<tr>' +
                '<th>S.No.</th>' +
                '<th>Product Id</th>' +
                '<th>Rent On </th>' +
                '<th>Rent Cost</th>' +
                '<th>Status</th>' +
                '</tr>' +
                '</thead>');
            var m_pro = jQuery.parseJSON(data);
            $.each(m_pro, function(key, value) {
                asd = asd + 1;
                if (value.is_closure == 0) {
                    var a = key + 1;
                    $('#product_view_cus').append('<tr>' +
                        '<td>' + a + '</td>' +
                        '<td>' + value.product_id + '</td>' +
                        '<td>' + value.rent_on_date + '</td>' +
                        '<td>' + value.rent_cost + '</td>' +
                        '<td>Current</td>' +
                        '</tr>');
                }
                if (value.is_closure == 1 && value.removed_status == 0) {
                    $('#product_view_cus').append('<tr>' +
                        '<td>' + a + '</td>' +
                        '<td>' + value.product_id + '</td>' +
                        '<td>' + value.rent_on_date + '</td>' +
                        '<td>' + value.rent_cost + '</td>' +
                        '<td>Refund</td>' +
                        '</tr>');
                }
                if (value.is_closure == 1 && value.removed_status == 1) {
                    $('#product_view_cus').append('<tr>' +
                        '<td>' + a + '</td>' +
                        '<td>' + value.product_id + '</td>' +
                        '<td>' + value.rent_on_date + '</td>' +
                        '<td>' + value.rent_cost + '</td>' +
                        '<td>Closed</td>' +
                        '</tr>');
                }
            });
            if (asd == 0) {
                $('#product_view_cus').append('<tr>' +
                    '<td colspan="5" style="text-align:center">Product Shouldn\'t Mapped</td>' +
                    '</tr>');
            }
        }
    });
}
$('#direct_customer').on('change', function() {
    this.value = this.checked ? 1 : 0;
}).change();
$('#company_id').on('change', function() {
    this.value = this.checked ? 1 : 0;
}).change();
$('#canceled_cheque').on('change', function() {
    this.value = this.checked ? 1 : 0;
}).change();
$('#id_proof').on('change', function() {
    this.value = this.checked ? 1 : 0;
}).change();
$('#add_proof').on('change', function() {
    this.value = this.checked ? 1 : 0;
}).change();
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#enquiry').DataTable({
        'ajax': {
            'url': 'config/enquiry_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Enquiry List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Enquiry List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#enquiry tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#enquiry').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#enquiry thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#enquiry tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#enquiry tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#servicelist').DataTable({
        'ajax': {
            'url': 'config/servicelist.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Enquiry List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Enquiry List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#enquiry tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#enquiry').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#enquiry thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#enquiry tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#enquiry tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#curServiceList').DataTable({
        'ajax': {
            'url': 'config/curServiceList.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Enquiry List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Enquiry List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [3, 'asc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#enquiry tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#enquiry').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#enquiry thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#enquiry tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#enquiry tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
if (document.getElementById('optionsRadios1') != null) {
    if (document.getElementById('optionsRadios1').checked) {
        $('#new_user').hide();
        $('#exist_user').show();
    }
} else if (document.getElementById('optionsRadios2') != null) {
    if (document.getElementById('optionsRadios2').checked) {
        $('#exist_user').hide();
        $('#new_user').show();
    }
}
function userChange() {
    if (document.getElementById('optionsRadios1').checked) {
        $('#new_user').hide();
        $('#exist_user').show();
    } else if (document.getElementById('optionsRadios2').checked) {
        $('#exist_user').hide();
        $('#new_user').show();
    }
}
//Enquiry for existing user
$("#cus_id").blur(function() {
    var id = $(this).val();
    var id_type = "";
    if (id != "") {
        if (id.length > 5) {
            if (Math.floor(id) == id && $.isNumeric(id)) {
                if (id.length == 10) {
                    id_type = "mobile";
                    $.ajax({
                        url: 'config/getEnquiry.php',
                        data: {
                            value: id,
                            i_type: id_type
                        },
                        type: "post",
                        success: function(data) {
                            var checked_dat = jQuery.parseJSON(data);
                            var checked_data = checked_dat[0].customer_name;
                            if (checked_data === "Invalid_m") {
                                $("#euphone").html("");
                                $("#eunotexist").html("");
                                $("#eunotcus").html("");
                                $("#euinvalid").html("");
                                $("#eumobile").html("This Mobile Number Not Match Any Customer").css("color");
                                $("#eumodal").modal();
                                $("#cus_id").val("");
                                $("#cus_name").val("");
                            } else {
                                $("#cus_name").val(checked_data);
                                $("#cus_id").val(checked_dat[0].customer_id);
                                if (checked_dat[0].enq === "no") {
                                } else {
                                    alert(checked_dat[0].enq);
                                }
                            }
                        }
                    });
                } else {
                    // alert('This not a phone Number');
                    $("#eumobile").html("");
                    $("#eunotexist").html("");
                    $("#eunotcus").html("");
                    $("#euinvalid").html("");
                    $("#euphone").html("This not a phone Number").css("color");
                    $("#eumodal").modal();
                    $("#cus_id").val("");
                    $("#cus_name").val("");
                }
            } else {
                var s = id.substr(0, 2);
                if (s === "pr" && id.length == 6) {
                    id_type = "c_id";
                    $.ajax({
                        url: 'config/getEnquiry.php',
                        data: {
                            value: id,
                            i_type: id_type
                        },
                        type: "post",
                        success: function(data) {
                            var checked_dat = jQuery.parseJSON(data);
                            var checked_data = checked_dat[0].customer_name;
                            if (checked_data === "Invalid_c") {
                                // alert("This Customer Id Does Not Exist");
                                $("#eunotcus").html("");
                                $("#euinvalid").html("");
                                $("#eumobile").html("");
                                $("#euphone").html("");
                                $("#eunotexist").html("This Customer Id Does Not Exist").css("color");
                                $("#eumodal").modal();
                                $("#cus_id").val("");
                                $("#cus_name").val("");
                            } else {
                                $("#cus_name").val(checked_data);
                                if (checked_dat[0].enq === "no") {
                                } else {
                                    alert(checked_dat[0].enq);
                                }
                            }
                        }
                    });
                } else {
                    // alert('This not a customer Id');
                    $("#eumobile").html("");
                    $("#euphone").html("");
                    $("#eunotexist").html("");
                    $("#euinvalid").html("");
                    $("#eunotcus").html("This not a customer Id").css("color");
                    $("#eumodal").modal();
                    $("#cus_id").val("");
                    $("#cus_name").val("");
                }
            }
        } else {
            // alert('You Have entered invalid Id');
            $("#eumobile").html("");
            $("#euphone").html("");
            $("#eunotexist").html("");
            $("#eunotcus").html("");
            $("#euinvalid").html("You Have entered invalid Id").css("color");
            $("#eumodal").modal();
            $("#cus_id").val("");
            $("#cus_name").val("");
        }
    }
});
var category = [];
function getCategory(id_con) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'p_cat'
        },
        type: "post",
        success: function(data) {
            category = jQuery.parseJSON(data);
            $('#e_cat' + id_con + '').children('option').remove();
            $.each(category, function(key, value) {
                $('#e_cat' + id_con + '').append('<option value="' + value.pr_sub_id + '">' + value.pr_sub_name + '</option>')
            });
            var cat_id = $('#e_cat' + id_con + '').val();
            //var id_con ='1';
            getVariant(cat_id, id_con);
        }
    });
}
getCategory('1');
var variant = [];
function getVariant(cat_id, id_con) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'variant',
            cat_id: cat_id
        },
        type: "post",
        success: function(data) {
            variant = jQuery.parseJSON(data);
            $('#e_var' + id_con + '').children('option').remove();
            $.each(variant, function(key, value) {
                $('#e_var' + id_con + '').append('<option value="' + value.ptdvar_id + '">' + value.name + '</option>');
            });
            if (variant.length > 0) {
                getVariantCost(variant[0]["ptdvar_id"], id_con);
            }
        }
    });
}
function getVariantCost(id, id_con) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'variantcost',
            var_id: id
        },
        type: "post",
        success: function(data) {
            var vriant_cost = jQuery.parseJSON(data);
            //console.log(vriant_cost);
            $('#e_tenure' + id_con + '').val(vriant_cost["tenure"]);
            $('#e_rent' + id_con + '').val(vriant_cost["tenure"]);
            $('#e_rent_cost' + id_con + '').val(vriant_cost["rent_cost"]);
            $('#e_security' + id_con + '').val(vriant_cost["security_deposit_price"]);
            $('#e_pro_fee' + id_con + '').val(vriant_cost["processing_fee"]);
            $('#e_ins_fee' + id_con + '').val(vriant_cost["ins_fee"]);
        }
    });
}
function getTenureCost(ten, id_con) {
    var p_var_id = $('#e_var' + id_con + '').val();
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'tenurecost',
            ten: ten,
            p_var_id: p_var_id
        },
        type: "post",
        success: function(data) {
            var vriant_cost = jQuery.parseJSON(data);
            $('#e_tenure' + id_con + '').val(vriant_cost["tenure"]);
            $('#e_rent_cost' + id_con + '').val(vriant_cost["rent_cost"]);
            $('#e_security' + id_con + '').val(vriant_cost["security_deposit_price"]);
            $('#e_pro_fee' + id_con + '').val(vriant_cost["processing_fee"]);
            $('#e_ins_fee' + id_con + '').val(vriant_cost["ins_fee"]);
        }
    });
}
// add variant
var c1 = 1;
function addVariant() {
    c1++;
    $('#c_e_product').append('<tr>' +
        '<td class="midtd headcol"><select id="e_cat' + c1 + '" class="form-control" onchange="getVariant(this.value,\'' + c1 + '\')" name="e_cat[]" >' +
        '</select></td>' +
        '<td class="bigtd headcol1" ><select id="e_var' + c1 + '" class="form-control" name="e_var[]" onchange="getVariantCost(this.value,\'' + c1 + '\')">' +
        '</select></td>' +
        '<td class="headcol2 smalltd quantytb">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="1"  class="form-control" id="e_quan' + c1 + '"  placeholder="Quantity" name="e_quan[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="midtd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        ' <input type="date" class="form-control" id="e_delivery' + c1 + '"  name="e_delivery[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group"> ' +
        '<div class="col-sm-12">' +
        '<input type="number" min="1"  class="form-control" id="e_rent' + c1 + '" onchange="getTenureCost(this.value,\'' + c1 + '\')"  placeholder="In Months" name="e_rent[]">' +
        '</div>' +
        '</div>	' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group"> ' +
        '<div class="col-sm-12">' +
        '<input type="text" class="form-control" id="e_tenure' + c1 + '"   placeholder="In Months" name="e_tenure[]" readonly>' +
        '</div>' +
        '</div>	' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="e_rent_cost' + c1 + '" placeholder="" name="e_rent_cost[]">' +
        '</div>' +
        '</div>	' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="e_security' + c1 + '" placeholder="" name="e_security[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="e_pro_fee' + c1 + '" placeholder="" name="e_pro_fee[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="e_ins_fee' + c1 + '" placeholder="" name="e_ins_fee[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '</td>' +
        '<td class="action-link"><a class="e_v_remove"> <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td>' +
        '</tr>');
    getCategory(c1);
    //alert(a);
};
$(document).on('click', '.e_v_remove', function() {
    $(this).closest('tr').remove();
    return false;
});
//get employee detail
//New Customer Enquiry
var n_category = [];
function getCategoryNew(id_con) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'p_cat'
        },
        type: "post",
        success: function(data) {
            n_category = jQuery.parseJSON(data);
            $('#n_e_cat' + id_con + '').children('option').remove();
            $.each(n_category, function(key, value) {
                $('#n_e_cat' + id_con + '').append('<option value="' + value.pr_sub_id + '">' + value.pr_sub_name + '</option>')
            });
            var cat_id = $('#n_e_cat1').val();
            //var id_con ='1';
            getVariantNew(cat_id, id_con);
        }
    });
}
getCategoryNew('1');
var n_variant = [];
function getVariantNew(cat_id, id_con) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'variant',
            cat_id: cat_id
        },
        type: "post",
        success: function(data) {
            n_variant = jQuery.parseJSON(data);
            $('#n_e_var' + id_con + '').children('option').remove();
            $.each(n_variant, function(key, value) {
                if (value.ptdvar_id != undefined) {
                    $('#n_e_var' + id_con + '').append('<option value="' + value.ptdvar_id + '">' + value.name + '</option>')
                }
            });
            if (n_variant.length > 0) {
                getVariantNewcost(n_variant[0]["ptdvar_id"], id_con);
            }
        }
    });
}
// add variant
var dd = 1;
function addVariantNew() {
    dd++;
    $('#n_c_e_product').append('<tr>' +
        '<td class="midtd"><select id="n_e_cat' + dd + '" class="form-control" onchange="getVariantNew(this.value,\'' + dd + '\')" name="e_cat[]" >' +
        '</select></td>' +
        '<td class="bidtd"><select id="n_e_var' + dd + '" class="form-control" name="e_var[]" onchange="getVariantNewcost(this.value,\'' + dd + '\')">' +
        '</select></td>' +
        '<td class="smalltd" >' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="1"  class="form-control" id="n_e_quan' + dd + '" placeholder="Quantity" name="e_quan[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="midtd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        ' <input type="date" class="form-control" id="n_e_delivery' + dd + '"  name="e_delivery[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group"> ' +
        '<div class="col-sm-12">' +
        '<input type="number" min="1"  class="form-control" id="n_e_rent' + dd + '" placeholder="In Months" onchange="getTenureCostNew(this.value,\'' + dd + '\')"  name="e_rent[]">' +
        '</div>' +
        '</div>	' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group"> ' +
        '<div class="col-sm-12">' +
        '<input type="text" class="form-control" id="n_e_tenure' + dd + '" placeholder="In Months" name="e_tenure[]" readonly>' +
        '</div>' +
        '</div>	' +
        '</td>	' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="n_e_rent_cost' + dd + '" placeholder="" name="e_rent_cost[]">' +
        '</div>' +
        '</div>	' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="n_e_security' + dd + '" placeholder="" name="e_security[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="n_e_pro_fee' + dd + '" placeholder="" name="e_pro_fee[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td class="smalltd">' +
        '<div class="form-group">' +
        '<div class="col-sm-12">' +
        '<input type="number" min="0"  class="form-control" id="n_e_ins_fee' + dd + '" placeholder="" name="e_ins_fee[]">' +
        '</div>' +
        '</div>' +
        '</td>' +
        '</td>' +
        '<td class="action-link"><a class="e_v_remove"> <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td>' +
        '</tr>');
    getCategoryNew(dd);
    getVariantNew('1', dd);
    //alert(a);
};
function getVariantNewcost(id, id_con) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'variantcost',
            var_id: id
        },
        type: "post",
        success: function(data) {
            var vriant_cost = jQuery.parseJSON(data);
            //console.log(vriant_cost);
            $('#n_e_tenure' + id_con + '').val(vriant_cost["tenure"]);
            $('#n_e_rent' + id_con + '').val(vriant_cost["tenure"]);
            $('#n_e_rent_cost' + id_con + '').val(vriant_cost["rent_cost"]);
            $('#n_e_security' + id_con + '').val(vriant_cost["security_deposit_price"]);
            $('#n_e_pro_fee' + id_con + '').val(vriant_cost["processing_fee"]);
            $('#n_e_ins_fee' + id_con + '').val(vriant_cost["ins_fee"]);
        }
    });
}
function getTenureCostNew(ten, id_con) {
    var p_var_id = $('#n_e_var' + id_con + '').val();
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'tenurecost',
            ten: ten,
            p_var_id: p_var_id
        },
        type: "post",
        success: function(data) {
            var vriant_cost = jQuery.parseJSON(data);
            $('#n_e_tenure' + id_con + '').val(vriant_cost["tenure"]);
            $('#n_e_rent_cost' + id_con + '').val(vriant_cost["rent_cost"]);
            $('#n_e_security' + id_con + '').val(vriant_cost["security_deposit_price"]);
            $('#n_e_pro_fee' + id_con + '').val(vriant_cost["processing_fee"]);
            $('#n_e_ins_fee' + id_con + '').val(vriant_cost["ins_fee"]);
        }
    });
}
//Enquiry Modify Funtion
function viewEnquiry(id) {
    $('#equiry_view').show();
    $('#equiry_edit').hide();
    $('#e_table_list').hide();
    $("#e_id").val(id);
    $.ajax({
        url: 'config/enquiry_view_data.php',
        data: {
            e_id: id
        },
        type: "post",
        success: function(data) {
            var enquiryData = jQuery.parseJSON(data);
            $("#cus_id").val(enquiryData['customer_id']);
            if (enquiryData['c_status'] == 1) {
                $("#cus_id").val('New Customer');
            }
            $("#e_cus_name").val(enquiryData['customer_name']);
            $("#e_email").val(enquiryData['email']);
            $("#e_mobile").val(enquiryData['mobile']);
            $("#e_date").val(enquiryData['e_date']);
            $("#e_attend").val(enquiryData['att_by']);
            $("#e_assign").val(enquiryData['att_to']);
            $("#e_f_date").val(enquiryData['f_date']);
            $("#remark").val(enquiryData['remark']);
            var e_product = enquiryData['e_poduct'];
            //console.log(e_product);
            $("#v_c_e_product").find("tr:gt(0)").remove();
            $.each(e_product, function(key, value) {
                $('#v_c_e_product').append('<tr>' +
                    '<td class="midtd "><select id="v_e_cat' + key + '" class="form-control"  name="e_cat[]"  disabled>' +
                    '</select></td>' +
                    '<td class="bigtd "><select id="v_e_var' + key + '" class="form-control" name="e_var[]" onchange="getVariantNewcost(this.value,\'' + key + '\')" disabled>' +
                    '</select></td>' +
                    '<td class=" smalltd quantytb"><div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="v_e_quan' + key + '"  placeholder="Quantity" value="' + value.quantity + '" name="e_quan[]" disabled>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="midtd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    ' <input type="date" class="form-control" id="v_e_delivery' + key + '" value="' + value.expecting_delivery_date + '"  name="e_delivery[]" disabled>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group"> ' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="" value="' + value.rent_months_count + '" name="e_rent[]" disabled>' +
                    '</div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group"> ' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="v_e_rent' + key + '" value="' + value.tenure + '" name="e_rent[]" disabled>' +
                    '</div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="v_e_rent_cost' + key + '" value="' + value.rent_per_month + '" name="e_rent_cost[]" disabled>' +
                    '</div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="v_e_security' + key + '" value="' + value.security_deposit_amount + '" name="e_security[]" disabled>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="v_e_pro_fee' + key + '" value="' + value.processing_fee + '" name="e_pro_fee[]" disabled>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="v_e_ins_fee' + key + '" value="' + value.ins_fee + '" name="e_ins_fee[]" disabled>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '</td>' +
                    '</tr>');
                getCategoryExist(key, value.ptd_sub_catgry_id);
                getVariantExist(value.ptd_sub_catgry_id, key, value.ptdvar_id);
            });
            //var id_con ='1';
        }
    });
}
function getVariantExist(cat_id, id_con, p_id) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'variant',
            cat_id: cat_id
        },
        type: "post",
        success: function(data) {
            n_variant = jQuery.parseJSON(data);
            $('#v_e_var' + id_con + '').children('option').remove();
            $.each(n_variant, function(key, value) {
                if (value.ptdvar_id == p_id) {
                    $('#v_e_var' + id_con + '').append('<option value="' + value.ptdvar_id + '" selected>' + value.name + '</option>');
                } else {
                    $('#v_e_var' + id_con + '').append('<option value="' + value.ptdvar_id + '">' + value.name + '</option>');
                }
            });
        }
    });
}
function getCategoryExist(id_con, id) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'p_cat'
        },
        type: "post",
        success: function(data) {
            n_category = jQuery.parseJSON(data);
            $('#v_e_cat' + id_con + '').children('option').remove();
            $.each(n_category, function(key, value) {
                if (id == value.pr_sub_id) {
                    $('#v_e_cat' + id_con + '').append('<option value="' + value.pr_sub_id + '" selected>' + value.pr_sub_name + '</option>');
                } else {
                    $('#v_e_cat' + id_con + '').append('<option value="' + value.pr_sub_id + '">' + value.pr_sub_name + '</option>');
                }
            });
            var cat_id = $('#n_e_cat1').val();
            //var id_con ='1';
            getVariantNew(cat_id, '1');
        }
    });
}
function showEnqTable() {
    // location.reload();
    $('#equiry_edit').hide();
    $('#equiry_view').hide();
    $('#equiry_payment').hide();
    $('#e_table_list').show();
}
function editEnquiry(id) {
    $("#e_e_id").val(id);
    $('#equiry_edit').show();
    $('#equiry_view').hide();
    $('#e_table_list').hide();
    $.ajax({
        url: 'config/enquiry_view_data.php',
        data: {
            e_id: id
        },
        type: "post",
        success: function(data) {
            var enquiryData = jQuery.parseJSON(data);
            $("#e_cus_id").val(enquiryData['customer_id']);
            if (enquiryData['c_status'] == 1) {
                $("#e_cus_id").val('New Customer');
            }
            $("#e_e_cus_name").val(enquiryData['customer_name']);
            $("#e_e_email").val(enquiryData['email']);
            $("#e_e_mobile").val(enquiryData['mobile']);
            $("#e_e_date").val(enquiryData['e_date']);
            $("#e_e_attend").val(enquiryData['att_by']);
            $("#e_e_assign").val(enquiryData['att_to']);
            $("#e_e_f_date").val(enquiryData['f_date']);
            $("#e_remark").val(enquiryData['remark']);
            var e_product = enquiryData['e_poduct'];
            //console.log(e_product);
            $("#c_e_product").find("tr:gt(0)").remove();
            $.each(e_product, function(key, value) {
                $('#c_e_product').append('<tr>' +
                    '<td class="midtd headcol"><select id="e_e_cat' + key + '" class="form-control"  name="e_cat[]"  disabled>' +
                    '</select></td>' +
                    '<td class="bigtd headcol1"><select id="e_e_var' + key + '" class="form-control" name="e_var[]" onchange="getVariantEditcost(this.value,\'' + key + '\')" >' +
                    '</select></td>' +
                    '<td class="headcol2 smalltd quantytb"><div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="number" min="1" class="form-control" id="e_e_quan' + key + '"  placeholder="Quantity" value="' + value.quantity + '" name="e_quan[]" >' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="midtd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    ' <input type="date" class="form-control" id="e_e_delivery' + key + '" value="' + value.expecting_delivery_date + '"  name="e_delivery[]" >' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group"> ' +
                    '<div class="col-sm-12">' +
                    '<input type="number" min="1" class="form-control" id="e_e_rent' + key + '" value="' + value.rent_months_count + '" name="e_rent[]" onchange ="getTenureCostEdit(this.value,\'' + key + '\')" >' +
                    '</div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group"> ' +
                    '<div class="col-sm-12">' +
                    '<input type="text" class="form-control" id="e_e_tenure' + key + '" value="' + value.tenure + '" name="e_tenure[]" readonly>' +
                    '</div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="number" min="0" class="form-control" id="e_e_rent_cost' + key + '" value="' + value.rent_per_month + '" name="e_rent_cost[]" >' +
                    '</div>' +
                    '</div>	' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="number" min="0"  class="form-control" id="e_e_security' + key + '" value="' + value.security_deposit_amount + '" name="e_security[]" >' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="number" min="0"  class="form-control" id="e_e_pro_fee' + key + '" value="' + value.processing_fee + '" name="e_pro_fee[]" >' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td class="smalltd">' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<input type="number" min="0"  class="form-control" id="e_e_ins_fee' + key + '" value="' + value.ins_fee + '" name="e_ins_fee[]" >' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '</td>' +
                    '<td class="action-link"><a class="e_v_remove"> <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td>' +
                    '</tr>');
                getCategoryEdit(key, value.ptd_sub_catgry_id);
                getVariantEdit(value.ptd_sub_catgry_id, key, value.ptdvar_id);
            });
            //var id_con ='1';
        }
    });
}
function getVariantEdit(cat_id, id_con, p_id) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'variant',
            cat_id: cat_id
        },
        type: "post",
        success: function(data) {
            n_variant = jQuery.parseJSON(data);
            $('#e_e_var' + id_con + '').children('option').remove();
            $.each(n_variant, function(key, value) {
                if (value.ptdvar_id == p_id) {
                    $('#e_e_var' + id_con + '').append('<option value="' + value.ptdvar_id + '" selected>' + value.name + '</option>');
                } else {
                    $('#e_e_var' + id_con + '').append('<option value="' + value.ptdvar_id + '">' + value.name + '</option>');
                }
            });
        }
    });
}
function getCategoryEdit(id_con, id) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'p_cat'
        },
        type: "post",
        success: function(data) {
            n_category = jQuery.parseJSON(data);
            $('#e_e_cat' + id_con + '').children('option').remove();
            $.each(n_category, function(key, value) {
                if (id == value.pr_sub_id) {
                    $('#e_e_cat' + id_con + '').append('<option value="' + value.pr_sub_id + '" selected>' + value.pr_sub_name + '</option>');
                } else {
                    $('#e_e_cat' + id_con + '').append('<option value="' + value.pr_sub_id + '">' + value.pr_sub_name + '</option>');
                }
            });
        }
    });
}
function getVariantEditcost(id, id_con) {
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'variantcost',
            var_id: id
        },
        type: "post",
        success: function(data) {
            var vriant_cost = jQuery.parseJSON(data);
            //console.log(vriant_cost);
            $('#e_e_tenure' + id_con + '').val(vriant_cost["tenure"]);
            $('#e_e_rent' + id_con + '').val(vriant_cost["tenure"]);
            $('#e_e_rent_cost' + id_con + '').val(vriant_cost["rent_cost"]);
            $('#e_e_security' + id_con + '').val(vriant_cost["security_deposit_price"]);
            $('#e_e_pro_fee' + id_con + '').val(vriant_cost["processing_fee"]);
            $('#e_e_ins_fee' + id_con + '').val(vriant_cost["ins_fee"]);
        }
    });
}
function getTenureCostEdit(ten, id_con) {
    var p_var_id = $('#e_e_var' + id_con + '').val();
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'tenurecost',
            ten: ten,
            p_var_id: p_var_id
        },
        type: "post",
        success: function(data) {
            var vriant_cost = jQuery.parseJSON(data);
            $('#e_e_tenure' + id_con + '').val(vriant_cost["tenure"]);
            $('#e_e_rent_cost' + id_con + '').val(vriant_cost["rent_cost"]);
            $('#e_e_security' + id_con + '').val(vriant_cost["security_deposit_price"]);
            $('#e_e_pro_fee' + id_con + '').val(vriant_cost["processing_fee"]);
            $('#e_e_ins_fee' + id_con + '').val(vriant_cost["ins_fee"]);
        }
    });
}
//hide
$('#equiry_edit').hide();
$('#equiry_view').hide();
$('#e_table_list').show();
$(document).on('click', '.e_v_remove', function() {
    $(this).closest('tr').remove();
    return false;
});
$("#equiry_payment").hide();
function enquiryPayment(e_id, e_date, c_status, e_s, e_p, e_i, e_t, e_r, c_id, c_name, mail_status, is_modified) {
    $('#e_table_list').hide();
    $("#equiry_payment").show();
    $('#p_e_date').html(e_date);
    $('#p_s_amo').html(e_s);
    $('#p_p_fee').html(e_p);
    $('#p_i_fee').html(e_i);
    $('#p_total_amount').html(e_t);
    $('#p_r_amount').html(e_r);
    $('#p_e_id').val(e_id);
    $('#p_cus_name').val(c_name);
    if (mail_status == 0) {
        if (is_modified == 0) {
            $('#p_m_status').html("Not Yet Sent");
        } else {
            $('#p_m_status').html("Modified Not Yet Sent");
        }
    }
    if (c_status == 1) {
        $('#p_cus_id').val("Non Customer");
        $('#p_cus_id').css({
            "color": "red"
        });
    } else {
        $('#p_cus_id').val(c_id);
        $('#p_cus_id').css({
            "color": "#555"
        });
    }
    var calcPerc = Math.round((e_r * 100) / e_t);
    if (calcPerc == 0) {
        $('#p_staus').html('' + calcPerc + ' % Received');
        $('#p_staus').css({
            "color": "red"
        });
    }
    if (calcPerc > 0) {
        $('#p_staus').html('' + calcPerc + ' % Received');
        $('#p_staus').css({
            "color": "#FDB63E"
        });
    }
    getPaymentHistory(e_id);
}
/*** Products ***/
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table1 = $('#productlist').DataTable({
        'ajax': {
            'url': 'config/productlist.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Product List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Product List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '';
            }
        }],
        'order': [
            [0, 'desc']
        ],
        'fnRowCallback': function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
    });
    // Array holding selected row IDs
    var rows_selected = [];
    var table1 = $('#re_list').DataTable({
        'ajax': {
            'url': 'config/re_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Product List'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Product List'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '';
            }
        }],
        'order': [
            [0, 'desc']
        ],
        'fnRowCallback': function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
    });
});
//Save Deposit Amount
function saveDepositAmount() {
    var p_e_id = $("#p_e_id").val();
    var p_cus_id = $("#p_cus_id").val();
    var p_rec_amount = $("#p_rec_amount").val();
    var pay_rec_on = $("#pay_rec_on").val();
    var pay_mode = $("#pay_mode").val();
    var p_collect_on = $("#p_collect_on").val();
    var p_collect_by = $("#p_collect_by").val();
    var p_deposit_on = $("#p_deposit_on").val();
    var p_deposit_by = $("#p_deposit_by").val();
    var p_r_amount = $("#p_r_amount").html();
    if (p_rec_amount == "") {
        $('#receivederror').html('<span>Please enter received amount</span>');
    } else {
        $('#receivederror').html('');
    }
    if (pay_rec_on == "") {
        $('#paymenterror').html('<span>Please enter received date</span>');
    } else {
        $('#paymenterror').html('');
    }
    if (p_collect_on == "") {
        $('#collectederror').html('<span>Please enter collected date</span>');
    } else {
        $('#collectederror').html('');
    }
    if (p_deposit_on == "") {
        $('#depositerror').html('<span>Please enter deposited date</span>');
    } else {
        $('#depositerror').html('');
    }
    if (p_rec_amount == "" || pay_rec_on == "" || p_collect_on == "" || p_deposit_on == "") {
        return false;
    }
    $.ajax({
        url: 'config/saveDepositAmount.php',
        data: {
            p_e_id: p_e_id,
            p_cus_id: p_cus_id,
            p_rec_amount: p_rec_amount,
            pay_rec_on: pay_rec_on,
            pay_mode: pay_mode,
            p_collect_on: p_collect_on,
            p_collect_by: p_collect_by,
            p_deposit_on: p_deposit_on,
            p_deposit_by: p_deposit_by,
            p_r_amount: p_r_amount
        },
        type: "post",
        success: function(data) {
            alert("Payment Updated Successfully");
            location.reload();
        }
    });
}
function getPaymentHistory(e_id) {
    var totalamount = $('#p_total_amount').html();
    var recivedamount = $('#p_r_amount').html();
    var pendingamount = totalamount - recivedamount;
    var c_id1 = $('#p_cus_id').val();
    var c_nam = $('#p_cus_name').val();
    $.ajax({
        url: 'config/getEnquiry.php',
        data: {
            i_type: 'payHistory',
            e_id: e_id
        },
        type: "post",
        success: function(data) {
            var payment_history = jQuery.parseJSON(data);
            $("#p_history").empty();
            $("#p_history").append(' <thead>' +
                '<tr>' +
                '<th>Received Amount</th>' +
                '<th>Received On</th>' +
                '<th>Payment Mode</th>' +
                '<th>Collected On</th>' +
                '<th>Collected By</th>' +
                '<th>Deposit On</th>' +
                '<th>Deposit By</th>' +
                '<th>Receipt</th>' +
                '</tr>' +
                '</thead>')
            $.each(payment_history, function(key, value) {
                if (value.reciept_status == 0) {
                    var a = '<td><button class="btn btn-info pull-right" onclick="viewAdvAmt(\'' + value.id + '\',\'' + pendingamount + '\',\'' + value.reiceved_amount + '\',\'' + value.amount_reiceved_on + '\',\'' + value.payment_mode + '\',\'' + c_id1 + '\',\'' + c_nam + '\')">Send</button></td>';
                } else {
                    var a = '<td>Sent</td>';
                }
                $('#p_history').append('<tr>' +
                    '<td><input type="text" class="form-control" id="p_rec_amount' + key + '" disabled> </td>' +
                    '<td><input type="date" class="form-control" id="pay_rec_on' + key + '" disabled> </td>' +
                    '<td>' +
                    '<select class="form-control" id="pay_mode' + key + '" disabled>' +
                    '<option value="1">Cash</option>' +
                    '<option value="2">Cheque</option>' +
                    '<option value="3">Online Transfer</option>' +
                    '</select>' +
                    '</td>' +
                    '<td><input type="date" class="form-control" id="p_collect_on' + key + '" disabled>  </td>' +
                    '<td><select class="form-control" id="p_collect_by' + key + '" name="p_collect_by" disabled>' +
                    '</select></td>' +
                    '<td><input type="date" class="form-control" id="p_deposit_on' + key + '" disabled></td>' +
                    '<td><select class="form-control" id="p_deposit_by' + key + '" disabled>' +
                    '</select></td>' + a + '</tr>');
                $('#p_rec_amount' + key + '').val(value.reiceved_amount);
                $('#pay_rec_on' + key + '').val(value.amount_reiceved_on);
                $('#pay_mode' + key + '').val(value.payment_mode);
                $('#p_collect_on' + key + '').val(value.collected_on);
                $('#p_collect_by' + key + '').val(value.collected_by);
                $('#p_deposit_on' + key + '').val(value.deposit_on);
                //collected_by
                $('p_collect_by' + key + '').children('option').remove();
                $('p_deposit_by' + key + '').children('option').remove();
                $.each(emp, function(ke, valu) {
                    if (value.collected_by == valu.id) {
                        $('#p_collect_by' + key + '').append('<option value="' + valu.id + '" selected>' + valu.name + '</option>');
                    } else {
                        $('#p_collect_by' + key + '').append('<option value="' + valu.id + '">' + valu.name + '</option>');
                    }
                    if (value.deposit_by == valu.id) {
                        $('#p_deposit_by' + key + '').append('<option value="' + valu.id + '" selected>' + valu.name + '</option>');
                    } else {
                        $('#p_deposit_by' + key + '').append('<option value="' + valu.id + '">' + valu.name + '</option>');
                    }
                });
            });
        }
    });
}
function enquiryFinalaze(a_type) {
    if ($("#p_cus_id").val() == 'Non Customer') {
        alert("Non customer enquiry");
    } else
    {
        if (parseFloat($("#p_total_amount").html()) > parseFloat($("#p_r_amount").html())) {
            var cost = parseFloat($("#p_total_amount").html()) - parseFloat($("#p_r_amount").html());
            var cost_type = "pending_cost";
        } else {
            var cost = parseFloat($("#p_r_amount").html()) - parseFloat($("#p_total_amount").html());
            var cost_type = "extra_amount";
        }
        $.ajax({
            url: 'config/enquiryFinalaze.php',
            data: {
                a_type: a_type,
                id: $(p_e_id).val(),
                cost: cost,
                cost_type: cost_type,
                c_id: $("#p_cus_id").val()
            },
            type: "post",
            success: function(data) {
                alert("The enquiry Verified Successfully");
                location.reload();
            }
        });
    }
}
//Verified Enquiry
$(document).ready(function() {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#VerifiedEnquiry').DataTable({
        'ajax': {
            'url': 'config/verified_enquiry_list.php'
        },
        'dom': 'Bfrtip',
        'buttons': [{
            'extend': 'excelHtml5',
            'title': 'Verified Enquiries'
        }, {
            'extend': 'pdfHtml5',
            'title': 'Verified Enquiries'
        }],
        'columnDefs': [{
            'targets': [0],
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function(data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'desc']
        ],
        'rowCallback': function(row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    // Handle click on checkbox
    $('#VerifiedEnquiry tbody').on('click', 'input[type="checkbox"]', function(e) {
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle click on table cells with checkboxes
    $('#VerifiedEnquiry').on('click', 'tbody td, thead th:first-child', function(e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    // Handle click on "Select all" control
    $('#VerifiedEnquiry thead input[name="select_all"]', table.table().container()).on('click', function(e) {
        if (this.checked) {
            $('#VerifiedEnquiry tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#VerifiedEnquiry tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });
    // Handle table draw event
    table.on('draw', function() {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
});
var pro = [];
function productMaping(id, stat) {
    var product = "";
    if (stat == 0) {
        $("#e_e_id").val(id);
        $('#equiry_edit').show();
        $('#equiry_view').hide();
        $('#e_table_list').hide();
        $.ajax({
            url: 'config/enquiry_view_data.php',
            data: {
                e_id: id
            },
            type: "post",
            success: function(data) {
                var enquiryData = jQuery.parseJSON(data);
                $("#e_cus_id").val(enquiryData['customer_id']);
                if (enquiryData['c_status'] == 1) {
                    $("#e_cus_id").val('New Customer');
                }
                $("#e_e_cus_name").val(enquiryData['customer_name']);
                $("#e_e_date").val(enquiryData['e_date']);
                $("#e_e_attend").val(enquiryData['att_by']);
                $("#e_e_assign").val(enquiryData['att_to']);
                $("#e_e_f_date").val(enquiryData['f_date']);
                $("#e_remark").val(enquiryData['remark']);
                var e_product = enquiryData['e_poduct'];
                //console.log(e_product);
                $("#c_e_product").find("tr:gt(0)").remove();
                $.each(e_product, function(key, value) {
                    for (i = 0; i < value.quantity; i++) {
                        $('#c_e_product').append('<tr>' +
                            '<td><select id="e_e_cat' + key + '' + i + '" class="form-control"  name="e_cat[]"  disabled>' +
                            '</select></td>' +
                            '<td><select id="e_e_var' + key + '' + i + '" class="form-control" name="e_var[]" disabled>' +
                            '</select></td>' +
                            '<td><select id="product' + key + '' + i + '" class="form-control" name="e_product[]" onchange="productDisabled(this.value)"  onclick="productEnabled(this.value)">' +
                            '<option value="11aaa" selected="selected">-Please Select-</option>' +
                            '</select></td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<div class="col-sm-10">' +
                            ' <input type="date" class="form-control" id="e_e_delivery' + key + '' + i + '" value="' + value.expecting_delivery_date + '"  name="e_delivery[]" >' +
                            '<input type="text" class="form-control"  value="' + value.rent_per_month + '" name="e_rent_cost[]"  style="display:none">' +
                            '<input type="text" class="form-control"  value="' + value.security_deposit_amount + '" name="e_security[]" style="display:none">' +
                            '<input type="text" class="form-control"  value="' + value.processing_fee + '" name="e_pro_fee[]" style="display:none">' +
                            '<input type="text" class="form-control"  value="' + value.ins_fee + '" name="e_ins_fee[]" style="display:none">' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<div class="col-sm-10">' +
                            ' <input type="date" class="form-control"   name="e_deliveryon[]" >' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<div class="col-sm-10">' +
                            ' <input type="date" class="form-control"   name="e_install[]" >' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<div class="col-sm-10">' +
                            ' <input type="date" class="form-control"   name="e_rent[]" >' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<div class="col-sm-10">' +
                            ' <span style="color:red;">Not Mapped</span>' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '</tr>');
                        getCategoryEdit('' + key + '' + i + '', value.ptd_sub_catgry_id);
                        getVariantEdit(value.ptd_sub_catgry_id, '' + key + '' + i + '', value.ptdvar_id);
                        getVariantEdit(value.ptd_sub_catgry_id, '' + key + '' + i + '', value.ptdvar_id);
                        getProductParVariant('' + key + '' + i + '', value.ptdvar_id);
                    }
                });
                //var id_con ='1';
            }
        });
    } else {
        $.ajax({
            url: 'config/getVerifiedEnquiryView.php',
            data: {
                e_id: id
            },
            type: "post",
            success: function(dat) {
                product = jQuery.parseJSON(dat);
                $.ajax({
                    url: 'config/enquiry_view_data.php',
                    data: {
                        e_id: id
                    },
                    type: "post",
                    success: function(data) {
                        var enquiryData = jQuery.parseJSON(data);
                        $("#e_cus_id").val(enquiryData['customer_id']);
                        if (enquiryData['c_status'] == 1) {
                            $("#e_cus_id").val('New Customer');
                        }
                        $("#e_e_cus_name").val(enquiryData['customer_name']);
                        $("#e_e_date").val(enquiryData['e_date']);
                        $("#e_e_attend").val(enquiryData['att_by']);
                        $("#e_e_assign").val(enquiryData['att_to']);
                        $("#e_e_f_date").val(enquiryData['f_date']);
                        $("#e_remark").val(enquiryData['remark']);
                        var e_product = enquiryData['e_poduct'];
                        $("#c_e_product").find("tr:gt(0)").remove();
                        var l = 0;
                        $.each(e_product, function(key, value) {
                            for (i = 0; i < value.quantity; i++) {
                                if (product[l]["mapped_status"] == 0) {
                                    var statu = '<span style="color:red;">Not Mapped</span>';
                                } else {
                                    var statu = '<span style="color:green;"> Mapped</span>';
                                }
                                $('#c_e_product').append(
                                    '<tr>' +
                                    '<td><select id="e_e_cat' + l + '" class="form-control"  name="e_cat[]"  disabled></select></td>' +
                                    '<td><select id="e_e_var' + l + '" class="form-control" name="e_var[]" disabled></select></td>' +
                                    '<td><select id="product' + l + '" class="form-control" name="e_product[]" onchange="productDisabled(this.value)"  onclick="productEnabled(this.value)">' +
                                    '<option value="11aaa" selected="selected">-Please Select-</option>' +
                                    '</select></td>' +
                                    '<td>' +
                                    '<div class="form-group">' +
                                    '<div class="col-sm-10">' +
                                    '<input type="date" class="form-control" id="e_e_delivery' + l + '"  value="' + value.expecting_delivery_date + '"   name="e_delivery[]" >' +
                                    '<input type="text" class="form-control"  value="' + product[l]["rent_per_month"] + '" name="e_rent_cost[]"  style="display:none">' +
                                    '<input type="text" class="form-control"  value="' + product[l]["actual_security_deposit_amount"] + '" name="e_security[]" style="display:none">' +
                                    '<input type="text" class="form-control"  value="' + product[l]["actual_processing_fee"] + '" name="e_pro_fee[]" style="display:none">' +
                                    '<input type="text" class="form-control"  value="' + product[l]["actual_installation_fee"] + '" name="e_ins_fee[]" style="display:none">' +
                                    '</div>' +
                                    '</div>' +
                                    '</td>' +
                                    '<td>' +
                                    '<div class="form-group">' +
                                    '<div class="col-sm-10">' +
                                    ' <input type="date" class="form-control" value="' + product[l]["delivered_at"] + '"  name="e_deliveryon[]" >' +
                                    '</div>' +
                                    '</div>' +
                                    '</td>' +
                                    '<td>' +
                                    '<div class="form-group">' +
                                    '<div class="col-sm-10">' +
                                    ' <input type="date" class="form-control" value="' + product[l]["installation_date"] + '"  name="e_install[]" >' +
                                    '</div>' +
                                    '</div>' +
                                    '</td>' +
                                    '<td>' +
                                    '<div class="form-group">' +
                                    '<div class="col-sm-10">' +
                                    ' <input type="date" class="form-control"  value="' + product[l]["rent_on_date"] + '"  name="e_rent[]" >' +
                                    '</div>' +
                                    '</div>' +
                                    '</td>' +
                                    '<td>' +
                                    '<div class="form-group">' +
                                    '<div class="col-sm-10">' +
                                    '' + statu + '' +
                                    '</div>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>'
																);
                                getCategoryEdit('' + l + '', value.ptd_sub_catgry_id);
                                getVariantEdit(value.ptd_sub_catgry_id, '' + l + '', value.ptdvar_id);
                                getVariantEdit(value.ptd_sub_catgry_id, '' + l + '', value.ptdvar_id);
                                getProductParVariantverified('' + l + '', value.ptdvar_id, product[l]["product_id"], product[l]["mapped_status"]);
                                l++;
                            }
                        });
                    }
                });
            }
        });
        $("#e_e_id").val(id);
        $('#equiry_edit').show();
        $('#equiry_view').hide();
        $('#e_table_list').hide();
    }
}
function getProductParVariant(a, b) {
    $.ajax({
        url: 'config/getProductParVariant.php',
        data: {
            id: b
        },
        type: "post",
        success: function(data) {
            n_pro = jQuery.parseJSON(data);
            $.each(n_pro, function(key, value) {
                $('#product' + a + '').append('<option value="' + value.product_id + '" >' + value.product_id + '</option>');
            });
        }
    });
}
function getProductParVariantverified(a, b, c, d) {
    //alert(c);
    //alert(d);
    $.ajax({
        url: 'config/getProductParVariant.php',
        data: {
            id: b
        },
        type: "post",
        success: function(data) {
            n_pro = jQuery.parseJSON(data);
            if (c != '11aaa') {
                //alert(parseInt(d));
                $('#product' + a + '').append('<option value="' + c + '"  selected="selected" style="display:none;">' + c + '</option>');
                //$('#product' + a + '').attr("disabled", true);
            } else {
                $.each(n_pro, function(key, value) {
                    //console.log(d);
                    if (value.product_id == c) {
                        $('#product' + a + '').append('<option value="' + value.product_id + '"  selected="selected" style="display:none;">' + value.product_id + '</option>');
                    } else {
                        $('#product' + a + '').append('<option value="' + value.product_id + '" >' + value.product_id + '</option>');
                    }
                });
            }
        }
    });
}
function productDisabled(a) {
    $("select option:contains(" + c + ")").attr("style", "display:block");
    $("select option:contains(" + a + ")").attr("style", "display:none");
}
var c = "";
function productEnabled(a) {
    c = a;
}
//Mapped Product List
var customerStatus;
$("#mappedProduct").hide();
var ex_amount = 0;
var pen_amount = 0;
var aa = 0;
var bb = 0;
function Mapped(id, stat, extra, pending) {
    ex_amount = extra;
    pen_amount = pending;
    customerStatus = stat;
    $("#mappedProduct").show();
    $("#Customer_tab_view").hide();
    $.ajax({
        url: 'config/mappedData.php',
        data: {
            c_id: id
        },
        type: "post",
        success: function(data) {
            $('#excel_exp').empty();
            $('#excel_exp').append('<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right:' +
                '5px;margin-bottom: 10px;" onclick="exporte(\'' + id + '\',\'customer\',\'cus_map_product\')" >' +
                '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Product Details' +
                '</button>' +
                '<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right:' +
                '5px;margin-bottom:10px;" onclick="exporte(\'' + id + '\',\'customer\',\'cus_enq_product\')" >' +
                '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Enquiry Details' +
                '</button>' +
                '<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom:' +
                '10px;" onclick="exporte(\'' + id + '\',\'customer\',\'cus_pay_product\')" >' +
                '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Payment Details ' +
                '</button>' +
                '</button>' +
                '<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom:' +
                '10px;" onclick="exporte(\'' + id + '\',\'customer\',\'cus_refund_product\')" >' +
                '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Refund List ' +
                '</button>' +
                '</button>' +
                '<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom:' +
                '10px;" onclick="exporte(\'' + id + '\',\'customer\',\'cus_ex_product_list\')" >' +
                '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Ex-product list' +
                '</button>');
            $('#mappedData').empty();
            $('#mappedData').append('<thead>' +
                '<tr>' +
                '<th colspan="9" style="font-size:16px;color:#509050">Current Product</th>' +
                '</tr>' +
                '<tr>' +
                '<th colspan="1">S.No.</th>' +
                '<th colspan="1">Product Id</th>' +
                '<th colspan="1">Category</th>' +
                '<th colspan="1">Variant</th>' +
                '<th colspan="1">Status</th>' +
                '<th colspan="2" style="text-align:center">Process</th>' +
                '<th colspan="2" style="text-align:center">Cost</th>' +
                '</tr>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Date</th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Cost</th>' +
                '</tr>' +
                '</thead>');
            var m_pro = jQuery.parseJSON(data);
            var asd = 0;
            var bsd = 0;
            var csd = 0;
            $.each(m_pro, function(key, value) {
                if (value.is_closure == 0) {
                    asd = key + 1;
                    if (value.is_returned == 0) {
                        $('#mappedData').append('<thead>' +
                            '<tr>' +
                            '<td rowspan="6">' + (key + 1) + '</td>' +
                            '<td rowspan="6">' + value.product_id + '</td>' +
                            '<td rowspan="6">' + value.pr_sub_name + '</td>' +
                            '<td rowspan="6">' + value.name + '</td>' +
                            '<td rowspan="6"></td>' +
                            '<td style="text-align:center" rowspan="1">Delivery </td>' +
                            '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Deposit</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Rent on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Processing</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Return on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"><a  data-toggle="modal" data-target="#returnmodal" onclick="returnProduct(\'' + value.product_id + '\',\'' + value.customer_id + '\',\'' + value.closure_date + '\',\'' + value.rent_per_month + '\',\'' + value.rent_cost + '\')" class="btn btn-primary" style="background-color:#509050" >Return</a></td>' +
                            '</tr>' +
                            '</thead>');
                    } else {
                        $('#mappedData').append('<thead>' +
                            '<tr>' +
                            '<td rowspan="6">' + (key + 1) + '</td>' +
                            '<td rowspan="6">' + value.product_id + '</td>' +
                            '<td rowspan="6">' + value.pr_sub_name + '</td>' +
                            '<td rowspan="6">' + value.name + '</td>' +
                            '<td rowspan="6"></td>' +
                            '<td style="text-align:center" rowspan="1">Delivery </td>' +
                            '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Deposit</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Rent on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Processing</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Return on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"><a  data-toggle="modal" data-target="#closuremodal" onclick="closureProduct(\'' + value.product_id + '\',\'' + id + '\',\'' + value.closure_date + '\',\'' + value.rent_per_month + '\',\'' + value.rent_cost + '\')" class="btn btn-primary" style="background-color:#509050" >Closure</a></td>' +
                            '</tr>' +
                            '</thead>');
                    }
                }
            });
            if (asd == 0) {
                $('#mappedData').append('<thead>' +
                    '<tr>' +
                    '<td colspan="9" style="font-size:16px;color:#509050;text-align:center"> No Current Product</td>' +
                    '</tr>');
            }
            $('#refundData').empty();
            $('#refundData').append('<thead>' +
                '<tr>' +
                '<th colspan="9" style="font-size:16px;color:#b57002">Refund List</th>' +
                '</tr>' +
                '<tr>' +
                '<th colspan="1">S.No.</th>' +
                '<th colspan="1">Product Id</th>' +
                '<th colspan="1">Category</th>' +
                '<th colspan="1">Variant</th>' +
                '<th colspan="1">Status</th>' +
                '<th colspan="2" style="text-align:center">Process</th>' +
                '<th colspan="2" style="text-align:center">Cost</th>' +
                '</tr>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Date</th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Cost</th>' +
                '</tr>' +
                '</thead>');
            var m_pro = jQuery.parseJSON(data);
            $.each(m_pro, function(key, value) {
                if (value.is_closure == 1 && value.removed_status == 0) {
                    bsd = key + 1;
                    $('#refundData').append('<thead>' +
                        '<tr>' +
                        '<td rowspan="7">' + (key + 1) + '</td>' +
                        '<td rowspan="7">' + value.product_id + '</td>' +
                        '<td rowspan="7">' + value.pr_sub_name + '</td>' +
                        '<td rowspan="7">' + value.name + '</td>' +
                        '<td rowspan="7"></td>' +
                        '<td style="text-align:center" rowspan="1">Delivery </td>' +
                        '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Deposit</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Rent on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Processing</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Return on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1">Rent Cost</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_cost + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"><a  data-toggle="modal" data-target="#refundModal" onclick="refundProduct(\'' + value.product_id + '\',\'' + id + '\',\'' + value.closure_date + '\',\'' + value.rent_per_month + '\',\'' + value.rent_cost + '\',\'' + value.actual_security_deposit_amount + '\')" class="btn btn-primary" style="background-color:#b57002">Refund</a></td>' +
                        '</tr>' +
                        '</thead>');
                }
            });
            if (bsd == 0) {
                $('#refundData').append('<thead>' +
                    '<tr>' +
                    '<td colspan="9" style="font-size:16px;color:#b57002;text-align:center"> No Refund Pending</td>' +
                    '</tr>');
            }
            $('#usedData').empty();
            $('#usedData').append('<thead>' +
                '<tr>' +
                '<th colspan="9" style="font-size:16px;color:red">Ex Product List</th>' +
                '</tr>' +
                '<tr>' +
                '<th colspan="1">S.No.</th>' +
                '<th colspan="1">Product Id</th>' +
                '<th colspan="1">Category</th>' +
                '<th colspan="1">Variant</th>' +
                '<th colspan="1">Status</th>' +
                '<th colspan="2" style="text-align:center">Process</th>' +
                '<th colspan="2" style="text-align:center">Cost</th>' +
                '</tr>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Date</th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Cost</th>' +
                '</tr>' +
                '</thead>');
            var m_pro = jQuery.parseJSON(data);
            $.each(m_pro, function(key, value) {
                if (value.is_closure == 1 && value.removed_status == 1) {
                    csd = key + 1;
                    $('#usedData').append('<thead>' +
                        '<tr>' +
                        '<td rowspan="7">' + (key + 1) + '</td>' +
                        '<td rowspan="7">' + value.product_id + '</td>' +
                        '<td rowspan="7">' + value.pr_sub_name + '</td>' +
                        '<td rowspan="7">' + value.name + '</td>' +
                        '<td rowspan="7"></td>' +
                        '<td style="text-align:center" rowspan="1">Delivery </td>' +
                        '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Deposit</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Rent on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Processing</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Return on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Closure On</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.closure_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Last Rent Cost</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_cost + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '</tr>' +
                        '</thead>');
                }
            });
            if (csd == 0) {
                $('#usedData').append('<thead>' +
                    '<tr>' +
                    '<td colspan="9" style="font-size:16px;color:red;text-align:center"> No Refund Pending</td>' +
                    '</tr>');
            }
        }
    });
}
function closureProduct(p_id, id, c_date, a, b) {
    aa = a;
    bb = b;
    $("#proId").val(p_id);
    $("#cusId").val(id);
}
$('#closurepro').on('click', function() {
    // alert(aa);
    // alert(bb);
    $.ajax({
        url: 'config/closeAndRefund.php',
        data: {
            p_id: $("#proId").val(),
            type: "close",
            c_date: $("#closuredate").val(),
            "rent": aa,
            "a_ren": bb,
            c_id: $("#cusId").val()
        },
        type: "post",
        success: function(data) {
            Mapped($("#cusId").val(), '1');
            location.reload();
        }
    });
});
var e = 0;
function refundProduct(p_id, id, c_date, r_p, r_cost, s_a) {
    //alert(pen_amount);
    $("#r_proId").val(p_id);
    $("#r_cId").val(id);
    $("#r_closuredate").val(c_date);
    $("#r_pend").val(pen_amount);
    $("#r_rent").val(r_cost);
    $("#r_advance").val(s_a);
    e = (parseFloat(s_a) - (parseFloat(r_cost) + parseFloat(pen_amount))).toFixed(2);
    $("#r_refund").val(e);
    //alert(ex_amount);
    //alert(pen_amount);
}
$('#refundProduct').on('click', function() {
    $.ajax({
        url: 'config/closeAndRefund.php',
        data: {
            p_id: $("#r_proId").val(),
            type: "refund",
            "r_pend": $("#r_pend").val(),
            "refund": e,
            "remark": $("#r_remark").val(),
            c_id: $("#r_cId").val()
        },
        type: "post",
        success: function(data) {
            location.reload();
            Mapped($("#r_cId").val(), '1');
        }
    });
});
$('#closurepro1').on('click', function() {
    // alert(aa);
    // alert(bb);
    var cust_id = $("#cusId").val();
    $.ajax({
        url: 'config/closeAndRefund.php',
        data: {
            p_id: $("#proId").val(),
            type: "close",
            c_date: $("#closuredate").val(),
            "rent": aa,
            "a_ren": bb,
            "cust_id": cust_id
        },
        type: "post",
        success: function(data) {
            location.reload();
            reportProduct($("#proId").val());
        }
    });
});
$('#refundProduct1').on('click', function() {
    $.ajax({
        url: 'config/closeAndRefund.php',
        data: {
            p_id: $("#r_proId").val(),
            type: "refund",
            "r_pend": $("#r_pend").val(),
            "refund": e,
            "remark": $("#r_remark").val(),
            c_id: $("#r_cId").val()
        },
        type: "post",
        success: function(data) {
            location.reload();
            reportProduct($("#r_proId").val());
        }
    });
});
$("#proReport").hide();
function backProduct() {
    $("#listofproductable").show();
    $("#proReport").hide();
}
function reportProduct(p_id, pend_amt) {
    pen_amount = pend_amt;
    $('#excel_exp1').empty();
    $('#excel_exp1').append('<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right:' +
        '5px;margin-bottom: 10px;" onclick="exporte(\'' + p_id + '\',\'customer\',\'pro_map_product\')" >' +
        '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Customer Details' +
        '</button>' +
        '<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right:' +
        '5px;margin-bottom:10px;" onclick="exporte(\'' + p_id + '\',\'customer\',\'pro_enq_product\')" >' +
        '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Enquiry Details' +
        '</button>' +
        '<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom:' +
        '10px;" onclick="exporte(\'' + p_id + '\',\'customer\',\'pro_pay_product\')" >' +
        '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Payment Details ' +
        '</button>' +
        '<button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom:' +
        '10px;" onclick="exporte(\'' + p_id + '\',\'customer\',\'pro_ex_product_list\')" >' +
        '<span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Ex-customer list' +
        '</button>');
    $("#listofproductable").hide();
    $("#proReport").show();
    $.ajax({
        url: 'config/reportProduct.php',
        data: {
            "p_id": p_id
        },
        type: "post",
        success: function(data) {
            var re_product = jQuery.parseJSON(data);
            var t_days = 0;
            var t_cost = 0;
            $.each(re_product["MappedHistory"], function(key, value) {
                t_days = parseInt(t_days) + parseInt(value.to_days);
                t_cost = parseInt(t_cost) + parseInt(value.to_rent)
            });
            $("#pur_date").html(re_product["general"][0]["purchase_date"]);
            $("#pur_cost").html(re_product["general"][0]["purchase_cost"]);
            $("#bill_no").html(re_product["general"][0]["bill_no"]);
            $("#waranty_prieod").html(re_product["general"][0]["warranty_end_date"]);
            $("#c_count").html(re_product["productCount"][0]["COUNT(customer_id)"]);
            $("#r_se_amount").html(re_product["productCount"][0]["sum(actual_security_deposit_amount)"]);
            $("#r_pr_amount").html(re_product["productCount"][0]["sum(actual_processing_fee)"]);
            $("#r_in_amount").html(re_product["productCount"][0]["sum(actual_installation_fee)"]);
            $("#o_day").html(t_days);
            $("#o_rent").html(t_cost);
            $('#mappedData').empty();
            $('#mappedData').append('<thead>' +
                '<tr>' +
                '<th colspan="9" style="font-size:16px;color:#509050">Current Customer</th>' +
                '</tr>' +
                '<tr>' +
                '<th colspan="1">S.No.</th>' +
                '<th colspan="1">Product Id</th>' +
                '<th colspan="1">Category</th>' +
                '<th colspan="1">Variant</th>' +
                '<th colspan="1">Status</th>' +
                '<th colspan="2" style="text-align:center">Process</th>' +
                '<th colspan="2" style="text-align:center">Cost</th>' +
                '</tr>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Date</th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Cost</th>' +
                '</tr>' +
                '</thead>');
            $('#r_history').empty();
            $.each(re_product["rentHistory"], function(key, value) {
                var months = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                var mon = parseInt(value.month - 1);
                //console.log(mon);
                mon = months[mon];
                var sno = key + 1;
                $('#r_history').append('<tr>' +
                    '<td>' + sno + '</td>' +
                    '<td>' + value.customer_id + '</td>' +
                    '<td>' + value.rent_cost + '</td>' +
                    '<td>' + value.recived_rent_cost + '</td>' +
                    '<td>' + mon + ',' + value.year + '</td>' +
                    '</tr>');
            });
            $('#service').empty();
            $.each(re_product["serviceHistory"], function(key, value) {
                var sno = key + 1;
                $('#service').append('<tr>' +
                    '<td>' + sno + '</td>' +
                    '<td>' + value.customer_id + '</td>' +
                    '<td>' + value.amount + '</td>' +
                    '<td>' + value.date + '</td>' +
                    '</tr>');
            });
            $('#transfer').empty();
            $.each(re_product["transportHistory"], function(key, value) {
                var sno = key + 1;
                $('#transfer').append('<tr>' +
                    '<td>' + sno + '</td>' +
                    '<td>' + value.customer_id + '</td>' +
                    '<td>' + value.amount + '</td>' +
                    '<td>' + value.date + '</td>' +
                    '</tr>');
            });
            $('#other').empty();
            $.each(re_product["generalHistory"], function(key, value) {
                var sno = key + 1;
                $('#other').append('<tr>' +
                    '<td>' + sno + '</td>' +
                    '<td>' + value.customer_id + '</td>' +
                    '<td>' + value.amount + '</td>' +
                    '<td>' + value.date + '</td>' +
                    '</tr>');
            });
            var asd = 0;
            var bsd = 0;
            var csd = 0;
            $.each(re_product["MappedHistory"], function(key, value) {
                if (value.is_closure == 0) {
                    asd = key + 1;
                    //console.log(value.is_returned);
                    if (value.is_returned == 0) {
                        $('#mappedData').append('<thead>' +
                            '<tr>' +
                            '<td rowspan="7">' + (key + 1) + '</td>' +
                            '<td rowspan="7">' + value.product_id + '</td>' +
                            '<td rowspan="7">' + value.pr_sub_name + '</td>' +
                            '<td rowspan="7">' + value.name + '</td>' +
                            '<td rowspan="7"></td>' +
                            '<td style="text-align:center" rowspan="1">Delivery </td>' +
                            '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Deposit</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Rent on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Processing</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Return on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Rent Days</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.to_days + '</td>' +
                            '<td style="text-align:center" rowspan="1">Total Rent</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.to_rent + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"><a  data-toggle="modal" data-target="#returnmodal" onclick="returnProduct(\'' + value.product_id + '\',\'' + value.customer_id + '\',\'' + value.closure_date + '\',\'' + value.rent_per_month + '\',\'' + value.rent_cost + '\')" class="btn btn-primary" style="background-color:#509050" >Return</a></td>' +
                            '</tr>' +
                            '</thead>');
                    } else {
                        $('#mappedData').append('<thead>' +
                            '<tr>' +
                            '<td rowspan="7">' + (key + 1) + '</td>' +
                            '<td rowspan="7">' + value.product_id + '</td>' +
                            '<td rowspan="7">' + value.pr_sub_name + '</td>' +
                            '<td rowspan="7">' + value.name + '</td>' +
                            '<td rowspan="7"></td>' +
                            '<td style="text-align:center" rowspan="1">Delivery </td>' +
                            '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Deposit</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Installation</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Rent on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Processing</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Return on</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                            '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1">Rent Days</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.to_days + '</td>' +
                            '<td style="text-align:center" rowspan="1">Total Rent</td>' +
                            '<td style="text-align:center" rowspan="1">' + value.to_rent + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"></td>' +
                            '<td style="text-align:center" rowspan="1"><a  data-toggle="modal" data-target="#closuremodal" onclick="closureProduct(\'' + value.product_id + '\',\'' + value.customer_id + '\',\'' + value.closure_date + '\',\'' + value.rent_per_month + '\',\'' + value.rent_cost + '\')" class="btn btn-primary" style="background-color:#509050" >Closure</a></td>' +
                            '</tr>' +
                            '</thead>');
                    }
                }
            });
            if (asd == 0) {
                $('#mappedData').append('<thead>' +
                    '<tr>' +
                    '<td colspan="9" style="font-size:16px;color:#509050;text-align:center"> No Current Product</td>' +
                    '</tr>');
            }
            $('#refundData').empty();
            $('#refundData').append('<thead>' +
                '<tr>' +
                '<th colspan="9" style="font-size:16px;color:#b57002">Refund List</th>' +
                '</tr>' +
                '<tr>' +
                '<th colspan="1">S.No.</th>' +
                '<th colspan="1">Product Id</th>' +
                '<th colspan="1">Category</th>' +
                '<th colspan="1">Variant</th>' +
                '<th colspan="1">Status</th>' +
                '<th colspan="2" style="text-align:center">Process</th>' +
                '<th colspan="2" style="text-align:center">Cost</th>' +
                '</tr>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Date</th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Cost</th>' +
                '</tr>' +
                '</thead>');
            $.each(re_product["MappedHistory"], function(key, value) {
                if (value.is_closure == 1 && value.removed_status == 0) {
                    bsd = key + 1;
                    $('#refundData').append('<thead>' +
                        '<tr>' +
                        '<td rowspan="8">' + (key + 1) + '</td>' +
                        '<td rowspan="8">' + value.product_id + '</td>' +
                        '<td rowspan="8">' + value.pr_sub_name + '</td>' +
                        '<td rowspan="8">' + value.name + '</td>' +
                        '<td rowspan="8"></td>' +
                        '<td style="text-align:center" rowspan="1">Delivery </td>' +
                        '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Deposit</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Rent on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Processing</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Return on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1">Rent Cost</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_cost + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Rent Days</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.to_days + '</td>' +
                        '<td style="text-align:center" rowspan="1">Total Rent</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.to_rent + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"></td>' +
                        '<td style="text-align:center" rowspan="1"><a  data-toggle="modal" data-target="#refundModal" onclick="refundProduct(\'' + value.product_id + '\',\'' + value.customer_id + '\',\'' + value.closure_date + '\',\'' + value.rent_per_month + '\',\'' + value.rent_cost + '\',\'' + value.actual_security_deposit_amount + '\')" class="btn btn-primary" style="background-color:#b57002">Refund</a></td>' +
                        '</tr>' +
                        '</thead>');
                }
            });
            if (bsd == 0) {
                $('#refundData').append('<thead>' +
                    '<tr>' +
                    '<td colspan="9" style="font-size:16px;color:#b57002;text-align:center"> No Refund Pending</td>' +
                    '</tr>');
            }
            $('#usedData').empty();
            $('#usedData').append('<thead>' +
                '<tr>' +
                '<th colspan="9" style="font-size:16px;color:red">Ex customers  List</th>' +
                '</tr>' +
                '<tr>' +
                '<th colspan="1">Sr.no.</th>' +
                '<th colspan="1">Product Id</th>' +
                '<th colspan="1">Category</th>' +
                '<th colspan="1">Variant</th>' +
                '<th colspan="1">Status</th>' +
                '<th colspan="2" style="text-align:center">Process</th>' +
                '<th colspan="2" style="text-align:center">Cost</th>' +
                '</tr>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Date</th>' +
                '<th style="text-align:center">Type</th>' +
                '<th style="text-align:center">Cost</th>' +
                '</tr>' +
                '</thead>');
            $.each(re_product["MappedHistory"], function(key, value) {
                if (value.is_closure == 1 && value.removed_status == 1) {
                    csd = key + 1;
                    $('#usedData').append('<thead>' +
                        '<tr>' +
                        '<td rowspan="8">' + (key + 1) + '</td>' +
                        '<td rowspan="8">' + value.product_id + '</td>' +
                        '<td rowspan="8">' + value.pr_sub_name + '</td>' +
                        '<td rowspan="8">' + value.name + '</td>' +
                        '<td rowspan="8"></td>' +
                        '<td style="text-align:center" rowspan="1">Delivery </td>' +
                        '<td style="text-align:center" rowspan="1">' + value.delivery_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Deposit</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_security_deposit_amount + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.installation_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Installation</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_installation_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Rent on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_on_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Processing</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.actual_processing_fee + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Return on</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.return_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Rent per Month</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_per_month + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Closure On</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.closure_date + '</td>' +
                        '<td style="text-align:center" rowspan="1">Last Rent Cost</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.rent_cost + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td style="text-align:center" rowspan="1">Rent Days</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.to_days + '</td>' +
                        '<td style="text-align:center" rowspan="1">Total Rent</td>' +
                        '<td style="text-align:center" rowspan="1">' + value.to_rent + '</td>' +
                        '</tr>' +
                        '</thead>');
                }
            });
            if (csd == 0) {
                $('#usedData').append('<thead>' +
                    '<tr>' +
                    '<td colspan="9" style="font-size:16px;color:red;text-align:center"> No Refund Pending</td>' +
                    '</tr>');
            }
        }
    });
}
function returnProduct(p_id, id, c_date, a, b) {
    aa = a;
    bb = b;
    $("#proId1").val(p_id);
    $("#cusId1").val(id);
}
function returnPro() {
    var pro = $("#proId1").val();
    var cus = $("#cusId1").val();
    var r_date = $("#returndate").val();
    var r_remark = $("#returnRemark").val();
    $.ajax({
        url: 'config/returnPro.php',
        data: {
            pro: pro,
            cus: cus,
            r_date: r_date,
            r_remark: r_remark
        },
        type: "post",
        success: function(data) {
            Mapped(cus, '1', ex_amount, pen_amount);
            //location.reload();
        }
    });
}
var c_id = '';
function viewInvoiceCost(id, a, b, c, d, e) {
    $('#t_rent_cost').val(a);
    $('#l_pay_charge').val(d);
    $('#tax').val(e);
    $('#p_amonunt').val(b);
    $('#e_cost').val(c);
    c_id = id;
    $('#amountChange').modal('toggle');
}
function editInvoiceCost(id) {
    var t_rent_cost = $('#t_rent_cost').val();
    var l_pay_charge = $('#l_pay_charge').val();
    var tax = $('#tax').val();
    var p_amonunt = $('#p_amonunt').val();
    var e_cost = $('#e_cost').val();
    //$('#amountChange').modal('toggle');
    $.ajax({
        url: 'config/editInvoiceCost.php',
        data: {
            t_rent_cost: t_rent_cost,
            l_pay_charge: l_pay_charge,
            tax: tax,
            p_amonunt: p_amonunt,
            e_cost: e_cost,
            c_id: c_id
        },
        type: "post",
        success: function(data) {
            location.reload();
        }
    });
}
function viewAdvAmt(id, pen, rev, dat, mod, c_id, c_name) {
    $('#cutomerreceipt').val(c_id);
    $('#receiptname').val(c_name);
    $('#amount').val(pen);
    $('#recvamount').val(rev);
    $('#datepicker9').val(dat);
    $('#paytypeadvance').val(mod);
    $('#d_id').val(id);
    $('#advView').modal('show');
}
var reciv = 0;
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});
function rentFollow(id, name, total, rec, bal, type) {
    reciv = rec;
    $('#cutomerreceipt').val(id);
    $("#cutomerreceipt").prop("disabled", true);
    $('#receiptname').val(name);
    $("#receiptname").prop("disabled", true);
    $("#totalamt").prop("disabled", true);
    $("#totalamt").val(total);
    $("#balance").prop("disabled", true);
    $("#balance").val(bal);
    if (type == 1) {
        $("#receivedamt").val(bal);
        $("#paymenttype").val("Online Transfer");
        $("#rentcolon").val(new Date().toDateInputValue());
        $("#rendepcolon").val(new Date().toDateInputValue());
        //$('#datePicker').val(new Date().toDateInputValue());
    } else {
        $("#receivedamt").val("");
        $("#paymenttype").val("Cash");
        $("#rentcolon").val(new Date().toDateInputValue());
        $("#rendepcolon").val(new Date().toDateInputValue());
        //$('#datePicker').val();
    }
    if (parseInt($("#balance").val()) > 0) {
        // $("#rentFollowBtn" ).prop( "disabled", false );
    } else {
        //$("#rentFollowBtn" ).prop( "disabled", true );
    }
    // $('#amount').val(pen);
    // $('#recvamount').val(rev);
    // $('#datepicker9').val(dat);
    // $('#paytypeadvance').val(mod);
    // $('#d_id').val(id);
    $('#rentfollowup').modal('show');
}
var cu_id = 'a';
function removeCustomer(removeId) {
    // alert(removeId);
    // loading remove button
    $.ajax({
        url: 'config/remove.php',
        type: 'post',
        data: {
            removeId: removeId,
            removeType: 'customer'
        },
        success: function(data) {
                if (data == 'e' || data == 'm') {
                    $('#blockcustomer').modal('show');
                } else {
                    $('#removeProductModal').modal('show');
                    cu_id = data;
                }
            } // /success function
    }); // /ajax fucntion to remove the product
} // /remove product function
var enq_id = 'a';
function removeEnquiry(removeId) {
    // alert(removeId);
    // loading remove button
    $.ajax({
        url: 'config/remove.php',
        type: 'post',
        data: {
            removeId: removeId,
            removeType: 'enquiry'
        },
        success: function(data) {
                if (data == 'm') {
                    $('#removeEnquiryModal').modal('show');
                    enq_id = removeId;
                } else {
                    $('#blockenquiry').modal('show');
                }
            } // /success function
    }); // /ajax fucntion to remove the product
} // /remove product function
function removeEnquiryStatus() {
    $('#removeEnquiryModal').modal('hide');
    // alert(removeId);
    // loading remove button
    $.ajax({
        url: 'config/remove.php',
        type: 'post',
        data: {
            removeId: enq_id,
            removeType: 'removeEnq'
        },
        success: function(data) {
                $('#sucessclose').modal('show');
            } // /success function
    }); // /ajax fucntion to remove the product
}
function closeCustomer() {
    $('#removeProductModal').modal('hide');
    // alert(removeId);
    // loading remove button
    $.ajax({
        url: 'config/remove.php',
        type: 'post',
        data: {
            removeId: cu_id,
            removeType: 'closecus'
        },
        success: function(data) {
                $('#sucessclose').modal('show');
            } // /success function
    }); // /ajax fucntion to remove the product
} // /remove product function
function revoke(removeId) {
    cu_id = removeId;
    // alert(removeId);
    // loading remove button
    $('#revokecus').modal('show');
    // /success function
    // /ajax fucntion to remove the product
} // /remove product function
function revokecus() {
    $('#revokecus').modal('hide');
    // alert(removeId);
    // loading remove button
    $.ajax({
        url: 'config/remove.php',
        type: 'post',
        data: {
            removeId: cu_id,
            removeType: 'movecus'
        },
        success: function(data) {
                $('#successmov').modal('show');
            } // /success function
    }); // /ajax fucntion to remove the product
} // /remove product function
function reloadfn() {
    location.reload();
} // /remove product function
function quot_email() {
    var e_id = $("#p_e_id").val();
    var c_id = $("#p_cus_id").val();
    $.ajax({
        url: 'TCPDF-master/examples/quoteinvoice.php',
        type: 'post',
        data: {
            e_id: e_id,
            c_id: c_id
        },
        success: function(data) {
            alert('Invoice Sent Sucessfully');
            location.reload();
        }
    });
}
var dew = 0;
$(document).on('change', "input[type='date']", function(event) {
    var a = $(this).val();
    var arr = a.split("-");
    if (parseInt(arr[0]) > 2050) {
        $(this).val(dew);
    } else {
        dew = a;
    }
    if (arr[0].length <= 4) {
        dew = a;
    } else {
        $(this).val(dew);
    }
});
$(document).on('keypress', "input[placeholder='Phone ']", function(event) {
    if ($(this).val().length > 9) {
        return false;
    }
    var charCode = (event.which) ? event.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
});
$(document).on('keypress', "input[placeholder='Mobile']", function(event) {
    if ($(this).val().length > 9) {
        return false;
    }
    var charCode = (event.which) ? event.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
});
function backup() {
    $.ajax({
        url: 'config/backup.php',
        type: 'post',
        data: {
            type: 'backup'
        },
        success: function(data) {
                alert('Backup Saved Successfully');
                window.location = 'config/' + jQuery.trim(data) + '.zip';
            } // /success function
    }); // /ajax fucntion to remove the product
}
function exporte(stat, page, type) {
    var year = $("#csvintage").val();
    var repbrand = $("#repbrand").val();
    var repvendor = $("#repvendor").val();
    var r_year = $("#r_year").val();
    $.ajax({
        url: 'config/export.php',
        type: 'post',
        data: {
            stat: stat,
            page: page,
            type: type,
            year: year,
            repbrand: repbrand,
            repvendor: repvendor,
            r_year: r_year
        },
        success: function(data) {
                window.location = "config/" + data + "";
            } // /success function
    }); // /ajax fucntion to remove the product
}
function exportAll() {
    $.ajax({
        url: 'config/exportAll.php',
        type: 'post',
        data: {},
        success: function(data) {
                window.location = "config/" + data + "";
            } // /success function
    }); // /ajax fucntion to remove the product
}
$(document).on('keyup', "input", function(event) {
    $(this).next('.error').html("");
});
$(document).on('keyup', "textarea", function(event) {
    $(this).next('.error').html("");
});
