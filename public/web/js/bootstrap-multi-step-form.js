var step = 1;
var limit = parseInt($(".step").length);
$('.total-steps').text(limit-1);
$('.current-step').text(step);
// ON CLICK BACK BUTTON
$(".back").on("click", function () {
  if (step > 1) {
    step = step - 2;
    $(".next").trigger("click");
  }
  hideButtons(step);
});

// CALCULATE PROGRESS BAR
stepProgress = function (currstep) {
  $('.current-step').text(currstep);
  var percent = parseFloat(100 / $(".step").length) * currstep;
  percent = percent.toFixed();
  $(".progress-bar")
    .css("width", percent + "%")
    .html(percent + "%");
};

// DISPLAY AND HIDE "NEXT", "BACK" AND "SUMBIT" BUTTONS
hideButtons = function (step) {
  var limit = parseInt($(".step").length);
  $(".action").hide();
  if (step < limit) {
    $(".next").show();
  }
  if (step > 1) {
    $(".back").show();
  }
  if (step == limit) {
    $(".next").hide();
    // $(".back").hide();
    $(".steps").hide();
    $(".submit").show();
  }
};

function setFormFields(id) {
  if (id != false) {
    // FILL STEP 2 FORM FIELDS
    d = data.find(x => x.id === id);
    $('#fname').val(d.fname);
    $('#lname').val(d.lname);
    $('#team').val(d.team);
    $('#address').val(d.address);
    $('#tel').val(d.tel);
  } else {
    // EMPTY USER SEARCH INPUT
    $("#txt-search").val('');
    // EMPTY STEP 2 FORM FIELDS
    $('#fname').val('');
    $('#lname').val('');
    $('#team').val('');
    $('#address').val('');
    $('#tel').val('');
  }
}

function checkForm(val) {
  // CHECK IF ALL "REQUIRED" FIELD ALL FILLED IN
  var valid = true;
  $("#" + val + " input:required").each(function () {
    if ($(this).val() === "") {
      $(this).addClass("is-invalid");
      valid = false;
    } else {
      $(this).removeClass("is-invalid");
    }
  });
  return valid;
}

$(document).ready(function () { stepProgress(step); });
  hideButtons(step);
  $(".next").on("click", function () {
    
    var nextstep = false;
    if (step == 1) {
      // validation on certain step
      // nextstep = checkForm("userinfo");
      if($('.exceeded-quantity').length)
      {
          // identify the exceeded items and do something
          errorAlert('exceeded quantity');
      }
      else
        nextstep = true;
    } else if(step == 2) {
      if(!$("#address").val())
        errorAlert(translate("You must choose an address first"));
      else
        nextstep = true;
    }
    else
      nextstep = true;
    if (nextstep == true) {
      $('.current-step').text(step);
      if (step < $(".step").length) {

        $(".step").show().addClass('active');
        $(".step")
          .not(":eq(" + step++ + ")")
          .hide().removeClass('active');
        stepProgress(step);
      }
      hideButtons(step);
    }
});