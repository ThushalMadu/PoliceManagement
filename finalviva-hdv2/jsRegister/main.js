(function ($) {
  $("#meal_preference")
    .parent()
    .append(
      '<ul class="list-item" id="newmeal_preference" name="meal_preference"></ul>'
    );
  $("#meal_preference option").each(function () {
    $("#newmeal_preference").append(
      '<li value="' + $(this).val() + '">' + $(this).text() + "</li>"
    );
  });
  $("#meal_preference").remove();
  $("#newmeal_preference").attr("id", "meal_preference");
  $("#meal_preference li").first().addClass("init");
  $("#meal_preference").on("click", ".init", function () {
    $(this).closest("#meal_preference").children("li:not(.init)").toggle();
  });

  var allOptions = $("#meal_preference").children("li:not(.init)");
  $("#meal_preference").on("click", "li:not(.init)", function () {
    allOptions.removeClass("selected");
    $(this).addClass("selected");
    $("#meal_preference").children(".init").html($(this).html());
    allOptions.toggle();
  });

  var marginSlider = document.getElementById("slider-margin");
  if (marginSlider != undefined) {
    noUiSlider.create(marginSlider, {
      start: [500],
      step: 10,
      connect: [true, false],
      tooltips: [true],
      range: {
        min: 0,
        max: 1000,
      },
      format: wNumb({
        decimals: 0,
        thousand: ",",
        prefix: "$ ",
      }),
    });
  }
  $(function () {
    $('[type="reset"]').on("click", function (e) {
      e.preventDefault(); //We don't want the reset function to fire normally.
      var $this = $(this),
        $form = $this.parent("form"),
        $input = $form.find(":input:not(:submit):not(:reset)");
      $input.each((i, item) => {
        var $item = $(item);

        if ($item.is(":checkbox") || $item.is(":radio")) {
          $item.prop("checked", false);
        } else {
          $item.val("");
        }
      });
    });
  });

  $("#register-form").validate({
    rules: {
      first_name: {
        required: true,
        digits: false
      },
      driverLicNo: {
        required: true,
      },
      nic: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      phone_number: {
        required: true,
        number: true,
        maxlength: 10
      },
      address: {
        required: true,
        // minlength: 5,
      },
      pass: {
        required: true,

      },
      compass: {
        required: true,
        // equalTo: "#pass",
      },
    },
    messages: {
      first_name: {
        required: "Name field is required",
        digits: "Only Acept Characters",
      },
      driverLicNo: {
        required: "Driver Licence field is required",
      },
      address: {
        required: "Address field is required",
      },
      email: {
        required: "Email field is required",
        email: "Enter Valid Email ",
      },
      pass: {
        required: "Enter Password Field",

      },
      compass: {
        required: "Enter Confirmation Password Field",
        // equalTo: "Password Should be Match",
      },
      nic: {
        required: "Enter NIC Field",
      }
    },
    onfocusout: function (element) {
      $(element).valid();
    },
    errorElement: "div",
    errorLabelContainer: ".errorTxt",
  });

  jQuery.extend(jQuery.validator.messages, {
    required: "",
    remote: "",
    email: "",
    url: "",
    date: "",
    dateISO: "",
    number: "",
    digits: "",
    creditcard: "",
    equalTo: "",
  });
})(jQuery);
