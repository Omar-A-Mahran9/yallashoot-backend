function order() {
    document.getElementById("submi").style.display = "none";
    document.getElementById("pleaseWait").style.display = "block";
    let orderId = document.getElementById("order_id");
    loadingAlert(__("Data in processing now..."));
    $.ajax({
        type: "GET",
        url: "/dashboard/finance-approvals/create",
        data: {
            "_token ": " <?php echo csrf_token() ?>",
            order_id: orderId.value,
        },
        success: function (data) {
            if (data.sex == "male") {
                $insurance = parseInt(
                    document.getElementById("maleInsurance").value
                );
            } else if (data.sex == "female") {
                $insurance = parseInt(
                    document.getElementById("femaleInsurance").value
                );
            } else {
                $insurance = 0;
            }

            if (Object.keys(data).length > 0) {
                document.getElementById("insurance_cost_inp").value =
                    ($insurance / 100) * data.car.price;
                $(".order-detail").show();
                $("#footer-submit").show();
                $("#other_order_id").show();
                $("#order-id").hide();
                document.getElementById("order_id_inp").value = data.id;
                document.getElementById("client_name_inp").value = data.name
                    ? data.name
                    : "Not have Client name ";
                document.getElementById("client_name").innerHTML =
                    data.name + " ";

                document.getElementById("car_name").value = data.car
                    ? data.car.name
                    : "Not have Car";
                document.getElementById("car_name_inp").innerHTML = data.car
                    ? data.car.name + " "
                    : "Not have Car";

                document.getElementById("city").value = data.city
                    ? data.city.name
                    : "Not have City ";
                document.getElementById("order_inp").innerHTML = data.id + " ";
                document.getElementById("order_type").innerHTML =
                    `${__(data.order_details_car.type)}` + " ";
                document.getElementById("city_inp").innerHTML =
                    data.city.name + " ";

                document.getElementById("phone").value = data.phone
                    ? data.phone
                    : "Not have Phone";
                document.getElementById("phone_inp").innerHTML =
                    data.phone + " ";

                document.getElementById("car_color").value = data.car.color.name
                    ? data.car.color.name
                    : "Not have color";
                document.getElementById("car_color_inp").innerHTML = data.car
                    .color.name
                    ? data.car.color.name + " "
                    : "Not have color";
                document.getElementById("financing_entity").value = data
                    .order_details_car.bank
                    ? data.order_details_car.bank.name
                    : null;
                document.getElementById("financing_entity_inp").innerHTML = data
                    .order_details_car.bank
                    ? data.order_details_car.bank.name + " "
                    : data.order_details_car.payment_type;
                document.getElementById("approval_amount_inp").value =
                    data.price ? data.price : 0;
                // document.getElementById("Main_car_cost_inp").value = data.car
                //     .Main_car_cost
                //     ? data.car.Main_car_cost
                //     : 0;
                calculate();
            } else {
                errorAlert(__("Order number not found"), 5000);
                document.getElementById("submi").style.display = "block";
                document.getElementById("pleaseWait").style.display = "none";
            }
            document.getElementById("submi").style.display = "block";
            document.getElementById("pleaseWait").style.display = "none";
        },
    });
}

function order_again() {
    $(".order-detail").hide();
    $("#footer-submit").hide();
    $("#other_order_id").hide();
    $("#order-id").show();
}
let totalRemainingPrice = 0;
let discountAmount = 0;
let totalAbstractAmountPlate = 0;
let totalRemainingPriceDiscountAmount = 0;
let totalRemainingPriceCashbackAmount = 0;

function calculate() {
    let amount =
        parseFloat(document.getElementById("approval_amount_inp").value) || 0;
    let plateNumberAmount =
        parseFloat(document.getElementById("plate_no_cost_inp").value) || 0;
    let discountPercent =
        parseFloat(document.getElementById("discount_percent_inp").value) || 0;
    let cashbackPercent =
        parseFloat(document.getElementById("cashback_percent_inp").value) || 0;
    let insuranceCost =
        parseFloat(document.getElementById("insurance_cost_inp").value) || 0;
    let cost = parseFloat(document.getElementById("cost_inp").value) || 0;
    let deliveryCost =
        parseFloat(document.getElementById("delivery_cost_inp").value) || 0;
    let commission =
        parseFloat(document.getElementById("commission_inp").value) || 0;
    let extradetails =
        parseFloat(document.getElementById("extra_details_inp").value) || 0;
    let profitValues = [
        insuranceCost,
        cost,
        deliveryCost,
        commission,
        extradetails,
    ];
    // calculate amount tax
    let tax = parseInt(document.getElementById("tax").value);
    toatal_price_add_plate = amount + plateNumberAmount;

    // totalAbstractAmountPlate = amount - plateNumberAmount;
    taxto = tax / 100 + 1;
    totalTax = Math.round(amount - amount / taxto);
    let carmaincost = document.getElementById("Main_car_cost_inp").value;

    totalRemainingPrice = amount - totalTax - carmaincost;
    document.getElementById("tax_discount_inp").value = totalTax;

    // calculate cashback amount
    cashbackAmount = (toatal_price_add_plate * cashbackPercent) / 100;
    totalRemainingPriceCashbackAmount = totalRemainingPrice - cashbackAmount;
    document.getElementById("cashback_amount_inp").value = cashbackAmount;
    // calculate discount amount
    discountAmount = (toatal_price_add_plate * discountPercent) / 100;
    totalRemainingPriceDiscountAmount =
        totalRemainingPriceCashbackAmount - discountAmount;
    document.getElementById("discount_amount_inp").value = discountAmount;
    // calculate profit
    let sum = profitValues.reduce((total, value) => total + value, 0);
    // document.getElementById("profit_inp").value = Math.max(
    //     totalRemainingPriceDiscountAmount - sum,
    //     0
    // ).toFixed(2);

    document.getElementById("profit_inp").value = document.getElementById(
        "profit_inp"
    ).value = Math.max(totalRemainingPriceDiscountAmount - sum, 0).toFixed(2);

    document.getElementById("result").innerHTML = parseFloat(
        Math.max(totalRemainingPriceDiscountAmount - sum, 0).toFixed(2)
    ).toString();
}

// function changetitle() {
//     csh = document.getElementById("cashback_percent_inp").value;
//     disc = document.getElementById("discount_percent_inp").value;
//     delevry = document.getElementById("delivery_cost_inp").value;
//     if (disc > 0 || csh > 0 || delevry > 0) {
//         document.getElementById("main_title").style.display = "none";
//         document.getElementById("main_title2").style.display = "block";
//     } else {
//         document.getElementById("main_title").style.display = "block";
//         document.getElementById("main_title2").style.display = "none";
//     }
// }
// function order() {
//     let orderId = document.getElementById("order_id");
//     $.ajax({
//         type: "GET",
//         url: "/dashboard/finance-approvals/create",
//         data: {
//             "_token ": " <?php echo csrf_token() ?>",
//             order_id: orderId.value,
//         },
//         success: function (data) {
//             if (data.sex == "male") {
//                 $insurance = parseInt(
//                     document.getElementById("maleInsurance").value
//                 );
//             } else if (data.sex == "female") {
//                 $insurance = parseInt(
//                     document.getElementById("femaleInsurance").value
//                 );
//             } else {
//                 $insurance = 0;
//             }

//             if (Object.keys(data).length > 0) {
//                 document.getElementById("insurance_cost_inp").value =
//                     ($insurance / 100) * data.car.price;
//                 $(".order-detail").show();
//                 $("#footer-submit").show();
//                 $("#other_order_id").show();
//                 $("#order-id").hide();
//                 document.getElementById("order_id_inp").value = data.id;
//                 document.getElementById("client_name_inp").value = data.name
//                     ? data.name
//                     : "Not have Client name ";
//                 document.getElementById("client_name").innerHTML =
//                     data.name + " ";

//                 document.getElementById("car_name").value = data.car
//                     ? data.car.name
//                     : "Not have Car";
//                 document.getElementById("car_name_inp").innerHTML = data.car
//                     ? data.car.name + " "
//                     : "Not have Car";

//                 document.getElementById("city").value = data.city
//                     ? data.city.name
//                     : "Not have City ";
//                 document.getElementById("order_inp").innerHTML = data.id + " ";
//                 document.getElementById("city_inp").innerHTML =
//                     data.city.name + " ";

//                 document.getElementById("phone").value = data.phone
//                     ? data.phone
//                     : "Not have Phone";
//                 document.getElementById("phone_inp").innerHTML =
//                     data.phone + " ";

//                 document.getElementById("car_color").value = data.car.color.name
//                     ? data.car.color.name
//                     : "Not have color";
//                 document.getElementById("car_color_inp").innerHTML = data.car
//                     .color.name
//                     ? data.car.color.name + " "
//                     : "Not have color";
//                 document.getElementById("financing_entity").value = data
//                     .order_details_car.bank
//                     ? data.order_details_car.bank.name
//                     : null;
//                 document.getElementById("financing_entity_inp").innerHTML = data
//                     .order_details_car.bank
//                     ? data.order_details_car.bank.name + " "
//                     : data.order_details_car.payment_type;
//                 document.getElementById("approval_amount_inp").value = data.car
//                     .price_after_vat
//                     ? data.car.price_after_vat
//                     : 0;
//                 calculate();
//             } else {
//                 errorAlert(__("Order number not found"), 5000);
//             }
//         },
//     });
// }

// function order_again() {
//     $(".order-detail").hide();
//     $("#footer-submit").hide();
//     $("#other_order_id").hide();
//     $("#order-id").show();
// }
// let totalRemainingPrice = 0;
// let discountAmount = 0;
// let totalAbstractAmountPlate = 0;
// let totalRemainingPriceDiscountAmount = 0;
// let totalRemainingPriceCashbackAmount = 0;

// function calculate() {
//     let amount =
//         parseFloat(document.getElementById("approval_amount_inp").value) || 0;
//     let plateNumberAmount =
//         parseFloat(document.getElementById("plate_no_cost_inp").value) || 0;

//     let discountPercent =
//         parseFloat(document.getElementById("discount_percent_inp").value) || 0;
//     let cashbackPercent =
//         parseFloat(document.getElementById("cashback_percent_inp").value) || 0;
//     let insuranceCost =
//         parseFloat(document.getElementById("insurance_cost_inp").value) || 0;
//     let cost = parseFloat(document.getElementById("cost_inp").value) || 0;
//     let deliveryCost =
//         parseFloat(document.getElementById("delivery_cost_inp").value) || 0;
//     let commission =
//         parseFloat(document.getElementById("commission_inp").value) || 0;
//     let extradetails =
//         parseFloat(document.getElementById("extra_details_inp").value) || 0;
//     let profitValues = [
//         insuranceCost,
//         cost,
//         deliveryCost,
//         commission,
//         extradetails,
//     ];
//     // calculate amount tax
//     let tax = parseInt(document.getElementById("tax").value);
//     totalAbstractAmountPlate = amount - plateNumberAmount;
//     totalTax = (totalAbstractAmountPlate * tax) / 100;

//     totalRemainingPrice = totalAbstractAmountPlate - totalTax;

//     document.getElementById("tax_discount_inp").value = totalTax;

//     // calculate discount amount
//     discountAmount = (totalRemainingPrice * discountPercent) / 100;
//     totalRemainingPriceDiscountAmount = totalRemainingPrice - discountAmount;
//     document.getElementById("discount_amount_inp").value = discountAmount;

//     // calculate cashback amount
//     cashbackAmount =
//         (totalRemainingPriceDiscountAmount * cashbackPercent) / 100;
//     totalRemainingPriceCashbackAmount =
//         totalRemainingPriceDiscountAmount - cashbackAmount;
//     document.getElementById("cashback_amount_inp").value = cashbackAmount;

//     // calculate profit
//     let sum = profitValues.reduce((total, value) => total + value, 0);
//     document.getElementById("profit_inp").value = Math.max(
//         totalRemainingPriceCashbackAmount - sum,
//         0
//     ).toFixed(2);

//     document.getElementById("result").innerHTML = parseFloat(
//         Math.max(totalRemainingPriceCashbackAmount - sum, 0).toFixed(2)
//     ).toString();
// }
