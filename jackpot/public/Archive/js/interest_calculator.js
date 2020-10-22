jQuery(document).ready(function($) {
  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
      decimalCount = Math.abs(decimalCount);
      decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

      const negativeSign = amount < 0 ? "-" : "";

      let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
      let j = (i.length > 3) ? i.length % 3 : 0;

      var result = negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
      while (result.indexOf(decimal) >= 0 && (result.endsWith("0") || result.endsWith(decimal))) {
        result = result.substr(0, result.length - 1);
      }
      return result;
    } catch (e) {
      return "";
    }
  };
  $(".interest-calculation").each(function() {
    var $container = $(this);
    var $price = $container.find("[name=price]");
    var $loanRate = $container.find("[name=loan_rate]");
    var $tenor = $container.find("[name=tenor]");
    var $annualInterestRate = $container.find("[name=annual_interest_rate]");
    var $payType = $container.find("[name=pay_type]");
    var $priceNumber = $container.find(".price-number");
    var $paymentBefore = $container.find(".payment-before");
    var $originPayment = $container.find(".origin-payment");
    var $interestPayment = $container.find(".interest-payment");
    var interestChart;
    var rawData = {};
    var interestCalculationData = {};

    reloadInterestCalculation ();
    $price.change(reloadInterestCalculation);
    $loanRate.change(reloadInterestCalculation);
    $tenor.change(reloadInterestCalculation);
    $annualInterestRate.change(reloadInterestCalculation);
    $payType.change(reloadInterestCalculation);

    function reloadInterestCalculation () {
      var price = $price.val(); price = !price ? 0 : parseFloat(price) * 1000000000;
      var loanRate = $loanRate.val(); loanRate = !loanRate ? 0 : parseFloat(loanRate);
      var tenor = $tenor.val(); tenor = !tenor ? 0 : parseFloat(tenor);
      var annualInterestRate = $annualInterestRate.val(); annualInterestRate = !annualInterestRate ? 0 : parseFloat(annualInterestRate);
      var payType = $payType.filter(":checked").val();

      rawData = { price: price, loanRate: loanRate, tenor: tenor, annualInterestRate: annualInterestRate, payType: payType };
      interestCalculationData = interestCalculation (rawData);

      var maxUpdate = 10;
      updateChart ();
      var intervalUpdate = setInterval(function () {
        maxUpdate --;
        if (maxUpdate === 0) return clearInterval(intervalUpdate);
        updateChart ();
      }, 100);
      function updateChart () {
        if (interestChart) {
          interestChart.data.datasets[0].data = [
            interestCalculationData.sumPaymentBefore,
            interestCalculationData.sumOriginPayment,
            interestCalculationData.sumInterestPayment
          ]
          interestChart.update();
          $priceNumber.text(formatMoney((interestCalculationData.sumPaymentBefore
            + interestCalculationData.sumOriginPayment
            + interestCalculationData.sumInterestPayment)/1000000000
          ));
          $paymentBefore.text(formatMoney(interestCalculationData.sumPaymentBefore));
          $originPayment.text(formatMoney(interestCalculationData.sumOriginPayment));
          $interestPayment.text(formatMoney(interestCalculationData.sumInterestPayment));
          clearInterval(intervalUpdate);
        }
      }
    }

    /** Thông tin tính lãi
    * @param: { price: number, loanRate: number, tenor: number, annualInterestRate: number, payType: string }
    * @output: {
    *     data: Array<{ period: number, debtBefore: number, interestPayment: number, originPayment: number, debtAfter: number, sumPayment: number }>
    *     sumPaymentBefore: number,
    *     sumOriginPayment: number,
    *     sumInterestPayment: number
    * }
    */
    function interestCalculation (args) {
      var payType = args.payType;
      if (payType === "dngd") return interestCalculationDNGD(args);
      if (payType === "ht") return interestCalculationHT(args);
    }

    function interestCalculationHT (args) {
      var price = args.price;
      var loanRate = args.loanRate;
      var tenor = args.tenor;
      var annualInterestRate = args.annualInterestRate;

      var periods = Math.ceil(tenor * 12);


      var sumInterestPayment = 0;
      var sumPaymentBefore = price - loanRate * price / 100;
      var sumOriginPayment = loanRate * price / 100;

      var debtBefore = loanRate * price / 100;
      var interestPayment = debtBefore * annualInterestRate / 100 / 12;
      var originPayment = debtBefore / periods;
      var sumPayment = interestPayment + originPayment;
      sumInterestPayment = interestPayment * periods;

      var data = [];
      for( var period = 1; period <= periods; period ++ ) {
        var debtAfter = debtBefore - originPayment;
        data.push({
          period: period,
          debtBefore: Math.round(debtBefore),
          interestPayment: Math.round(interestPayment),
          originPayment: Math.round(originPayment),
          debtAfter: Math.round(debtAfter),
          sumPayment: Math.round(sumPayment)
        });
        debtBefore = debtAfter
      }

      return {
        data: data,
        sumPaymentBefore: Math.round(sumPaymentBefore),
        sumOriginPayment: Math.round(sumOriginPayment),
        sumInterestPayment: Math.round(sumInterestPayment)
      }
    }
    function interestCalculationDNGD (args) {
      var price = args.price;
      var loanRate = args.loanRate;
      var tenor = args.tenor;
      var annualInterestRate = args.annualInterestRate;
      var payType = args.payType;

      var periods = Math.ceil(tenor * 12);

      var sumInterestPayment = 0;
      var sumPaymentBefore = price - loanRate * price / 100;
      var sumOriginPayment = loanRate * price / 100;

      var data = [];
      var debtBefore = loanRate * price / 100;
      var originPayment = debtBefore / periods;

      for( var period = 1; period <= periods; period ++ ) {
        var interestPayment = debtBefore * annualInterestRate / 100 / 12;
        var debtAfter = debtBefore - originPayment;
        var sumPayment = originPayment + interestPayment;
        data.push({
          period: period,
          debtBefore: Math.round(debtBefore),
          interestPayment: Math.round(interestPayment),
          originPayment: Math.round(originPayment),
          debtAfter: Math.round(debtAfter),
          sumPayment: Math.round(sumPayment)
        });
        sumInterestPayment += interestPayment;
        debtBefore = debtAfter
      }

      return {
        data: data,
        sumPaymentBefore: Math.round(sumPaymentBefore),
        sumOriginPayment: Math.round(sumOriginPayment),
        sumInterestPayment: Math.round(sumInterestPayment)
      }
    }

    function exportTableToCSV(filename) {
      var csv = '\ufeff';
      var colDelim = ',';
      var rowDelim = '\r\n';

      csv += ["Giá trị sản phẩm", rawData.price].join(colDelim) + rowDelim;
      csv += ["Thanh toán lần đầu", interestCalculationData.sumOriginPayment].join(colDelim) + rowDelim;
      csv += ["Hỗ trợ vay", interestCalculationData.sumPaymentBefore, rawData.loanRate + "%"].join(colDelim) + rowDelim;
      csv += ["Lãi suất năm", rawData.annualInterestRate + "%"].join(colDelim) + rowDelim;
      csv += ["Thời hạn vay (năm)", rawData.tenor].join(colDelim) + rowDelim;
      csv += ["Tổng lãi", interestCalculationData.sumInterestPayment].join(colDelim) + rowDelim;
      csv += rowDelim;
      csv += ["Kỳ thanh toán","Dư nợ đầu kỳ","Lãi thanh toán","Gốc thanh toán","Dư nợ cuối kỳ","Tổng thanh toán"].join(colDelim) + rowDelim;

      var data = interestCalculationData.data ? interestCalculationData.data : [];

      data.forEach(function(info) {
        csv += [
          info.period,
          info.debtBefore,
          info.interestPayment,
          info.originPayment,
          info.debtAfter,
          info.sumPayment
        ].join(colDelim) + rowDelim;
      })

      if (window.Blob && window.URL) {
        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8' });
        var csvUrl = URL.createObjectURL(blob);
        window.location.replace(csvUrl);
        // $(this).attr({ 'download': filename, 'href': csvUrl });
      } else {
        var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
        window.location.replace(csvData);
        // $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank'});
      }
    }

    $container.find(".download").on('click', function(event) {
      $container.find(".popup-download").addClass("open");
      return false;
    });
    $container.find(".popup-download .close").click(function () {
      $container.find(".popup-download").removeClass("open");
    })

    var labels = ["Cần trả trước", "Gốc cần trả", "Lãi cần trả"];
    interestChart = new Chart($container.find(".chart")[0], {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [1, 1, 1],
          backgroundColor: [
              '#AC2408',
              '#8A0381',
              '#D28500'
          ],
          borderColor: [
              '#AC2408',
              '#8A0381',
              '#D28500'
          ],
          borderWidth: 1,
          weight: 100
        }]
      },
      options: {
        cutoutPercentage: 88,
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              var datasetIndex = tooltipItem.datasetIndex;
              var index = tooltipItem.index;
              var value = data.datasets[datasetIndex].data[index];
              var label = labels[index] + ": " + formatMoney(value);
              return label;
            }
          }
        }
      }
    });

    $container.find(".form").each(function () {
      var $form = $(this);
      var $fields = $form.find(".input");
      var messages = {};
      var rules = {};

      $fields.each(function () {
        var $field = $(this);
        var name = $field.attr("name");
        var data = $field.data();
        rules[name] = {};
        messages[name] = {}
        Object.keys(data).forEach(function (key) {
          if (key.startsWith("rule_")) {
            var ruleName = key.substring(5);
            var ruleValue = data[key];
            rules[name][ruleName] = ruleValue;
          } else if (key.startsWith("message_")) {
            var ruleName = key.substring(8);
            var message = data[key];
            messages[name][ruleName] = message;
          }
        })
      });
      function adaptData ($from, dataArray) {
        for (var i = 0; i < dataArray.length; i++) {
          var name = dataArray[i].name;
          if ($form.find("[name='"+name+"']").attr("type") === "checkbox")
            dataArray[i].value = dataArray[i].value ? 1 : 0;
          if ($form.find("[name='"+name+"']").hasClass("datepicker")){
            var value = dataArray[i].value;
            if (value) {
              var times = value.split("/");
              if (times.length === 3) {
                dataArray[i].value = times[1] + "/" + times[0] + "/" + times[2];
              }
            }
          }
        }
        return dataArray;
      }
      $form.validate({
        messages: messages,
        rules: rules,
        submitHandler: function(form) {
  
                var filename = 'tinh-lai-my-kim-land.csv';
                exportTableToCSV(filename);
             
        return false;
        }
      })
    });

  })
});
