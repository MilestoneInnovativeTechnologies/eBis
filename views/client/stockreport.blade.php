<!DOCTYPE html>
<html>
<head>
  <link rel='stylesheet' type='text/css' href="public/css/style.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    var itemhtml = '';
    var categoryhtml = '';
    var brandhtml = '';
    $(document).ready(function(){
      $("#itemButton").css("background-color", "white");
      itemhtml = $('#item1').html();
      categoryhtml = $('#category1').html();
      brandhtml = $('#brand1').html();
      $('input[type=radio][name=type1]').change(function() {
        var optionValue = $(this).val();
        switch(optionValue) {
          case 'stockstatus':
            $(".box").hide();
            $("#dateDiv2").hide()
            $("#type1Div").show();
            $("#type2Div").show();
            $("#type3Div").show();
            $("#type4Div").show();
            $("#discountDiv").show();
            $("#dateDiv1").show()
            break;
          case 'stockposition':
            $(".box").hide();
            $("#dateDiv1").hide()
            $("#type1Div").show();
            $("#type3Div").show();
            $("#dateDiv2").show()
            break;
          case 'allocation':
            $(".box").hide();
            $("#dateDiv2").hide()
            $("#type1Div").show();
            $("#type3Div").show();
            $("#type4Div").show();
            $("#dateDiv1").show()
            break;
          case 'taxation':
            $(".box").hide();
            $("#dateDiv2").hide()
            $("#type1Div").show();
            $("#type2Div").show();
            $("#dateDiv1").show()
            break;
          case 'store':
            $(".box").hide();
            $("#dateDiv2").hide()
            $("#type1Div").show();
            $("#dateDiv1").show()
            break;
          case 'ageing':
            $(".box").hide();
            $("#dateDiv2").hide()
            $("#type1Div").show();
            $("#type5Div").show();
            $("#type6Div").show();
            $("#dateDiv1").show()
            break;
        }
      });
    });
    function itemChange(){
      $(".bottom-button").css("background-color", "#F3F1F1");
      $("#itemButton").css("background-color", "white");
      $(".bottom-foot").hide();
      $("#itemSelectDiv").show();
    }
    function categoryChange(){
      $(".bottom-button").css("background-color", "#F3F1F1");
      $("#categoryButton").css("background-color", "white");
      $(".bottom-foot").hide();
      $("#categorySelectDiv").show();
    }
    function brandChange(){
      $(".bottom-button").css("background-color", "#F3F1F1");
      $("#brandButton").css("background-color", "white");
      $(".bottom-foot").hide();
      $("#brandSelectDiv").show();
    }
    function giveallitems(){
      $('#item2').html(itemhtml);
      $('#item1').html([]);
      $('#item2 option').prop('selected', true);
    }
    function backallitems(){
      $('#item1').html(itemhtml);
      $('#item2').html([]);
    }
    function giveoneitem(){
      var optionValue = $('#item1').find(":selected").val();
      if (optionValue != null){
        var optionText = $('#item1').find(":selected").text();
        $('#item1').find('option:selected').remove().end();
        $('#item2').append($('<option selected>').val(optionValue).text(optionText));
      }
    }
    function backoneitem(){
      var optionValue = $('#item2').find(":selected").val();
      if (optionValue != null){
        var optionText = $('#item2').find(":selected").text();
        $('#item2').find('option:selected').remove().end();
        $('#item1').append($('<option>').val(optionValue).text(optionText));
      }
    }
    function giveallcategory(){
      $('#category2').html(categoryhtml);
      $('#category1').html([]);
      $('#category2 option').prop('selected', true);
    }
    function backallcategory(){
      $('#category1').html(categoryhtml);
      $('#category2').html([]);
    }
    function giveonecategory(){
      var optionValue = $('#category1').find(":selected").val();
      if (optionValue != null){
        var optionText = $('#category1').find(":selected").text();
        $('#category1').find('option:selected').remove().end();
        $('#category2').append($('<option selected>').val(optionValue).text(optionText))
      }
    }
    function backonecategory(){
      var optionValue = $('#category2').find(":selected").val();
      if (optionValue != null){
        var optionText = $('#category2').find(":selected").text();
        $('#category2').find('option:selected').remove().end();
        $('#category1').append($('<option>').val(optionValue).text(optionText))
      }
    }
    function giveallbrands(){
      $('#brand2').html(brandhtml);
      $('#brand1').html([]);
      $('#brand2 option').prop('selected', true);
    }
    function backallbrands(){
      $('#brand1').html(brandhtml);
      $('#brand2').html([]);
    }
    function giveonebrand(){
      var optionValue = $('#brand1').find(":selected").val();
      if (optionValue != null){
        var optionText = $('#brand1').find(":selected").text();
        $('#brand1').find('option:selected').remove().end();
        $('#brand2').append($('<option selected>').val(optionValue).text(optionText));
      }
    }
    function backonebrand(){
      var optionValue = $('#brand2').find(":selected").val();
      if (optionValue != null){
        var optionText = $('#brand2').find(":selected").text();
        $('#brand2').find('option:selected').remove().end();
        $('#brand1').append($('<option selected>').val(optionValue).text(optionText));
      }
    }
  </script>
  <title>eBis :: Stock Report</title>
</head>
<body>
<div class="container">
  <form action="makereport" method="post">@csrf
  <div class="top-box">
    <div class="box"  id="type1Div">
      <input type="radio" id="type1" name="type1" value="stockstatus" checked>
      <label for="stockstatus">Stock Status</label> <br>
      <input type="radio" id="type1" name="type1" value="stockposition">
      <label for="stockposition">Stock Position</label> <br>
      <input type="radio" id="type1" name="type1" value="allocation">
      <label for="allocation">Allocation</label> <br>
      <input type="radio" id="type1" name="type1" value="taxation">
      <label for="taxation">Taxation</label> <br>
      <input type="radio" id="type1" name="type1" value="store">
      <label for="store">Store</label> <br>
      <input type="radio" id="type1" name="type1" value="ageing">
      <label for="ageing">Ageing</label>
    </div>
    <div class="box" id="type2Div">
      <input type="radio" id="type2" name="type2" value="summary" checked>
      <label for="summary">Summary</label> <br>
      <input type="radio" id="type2" name="type2" value="details">
      <label for="details">Details</label> <br>
    </div>
    <div class="box" id="type3Div">
      <input type="radio" id="type3" name="type3" value="category" checked>
      <label for="category">Category</label> <br>
      <input type="radio" id="type3" name="type3" value="brand">
      <label for="brand">Brand</label> <br>
    </div>
    <div class="box" id="type4Div">
      <input type="radio" id="type4" name="type4" value="stockitem" checked>
      <label for="stockitem">Stock Item</label> <br>
      <input type="radio" id="type4" name="type4" value="negativestock">
      <label for="negativestock">Negative Stock</label> <br>
      <input type="radio" id="type4" name="type4" value="all">
      <label for="all">All</label> <br>
    </div>
    <div class="box" id="type5Div" style="display: none">
      <input type="radio" id="type5" name="type5" value="monthly" checked>
      <label for="monthly">Monthly</label> <br>
      <input type="radio" id="type5" name="type5" value="yearly">
      <label for="yearly">Yearly</label> <br>
      <input type="radio" id="type5" name="type5" value="slab">
      <label for="slab">Slab</label> <br>
    </div>
    <div class="box" id="type6Div" style="display: none">
      <input type="radio" id="type6" name="type6" value="quantity" checked>
      <label for="quantity">Quantity</label> <br>
      <input type="radio" id="type6" name="type6" value="amount">
      <label for="amount">Amount</label>
    </div>
    <div class="box" id="discountDiv">
      <input type="checkbox" id="discount" name="discount" checked>
      <label for="scales">Discount</label>
    </div>

    <div class="small-right-box" id="dateDiv1">
      <div class="right-box-label">Date</div>
      <input type="date" id="onedate" name="onedate" value="@php echo date("Y-m-d");@endphp"><br>
    </div>

    <div class="black-box" id="dateDiv2" style="display: none">
      <div class="right-box">
        <div class="right-box-label">From Date</div>
        <input type="date" id="fromdate" name="fromdate" value="@php echo date("Y-m-01");@endphp"><br>
        <div class="right-box-label">To Date</div>
        <input type="date" id="todate" name="todate" value="@php echo date("Y-m-t");@endphp"><br>
      </div>
      <div class="right-box">
        <input type="radio" id="today" name="datetype" value="today">
        <label for="today">Today</label>
        <input type="radio" id="month" name="datetype" value="month" checked>
        <label for="month">This Month</label>
        <input type="radio" id="year" name="datetype" value="year">
        <label for="year">This Year</label>
        <input type="radio" id="custom" name="datetype" value="custom">
        <label for="custom">Custom</label>
      </div>
    </div>
    <div class="blank-box">
      <input type="submit" value="View">
      <a href="index.php">
        <input type="button" value="Close">
      </a>
    </div>
  </div>
  <div class="bottom-box">
    <div class="bottom-head">
      <button type="button" class="bottom-button" id="itemButton" onclick="itemChange();">Item</button>
      <button type="button" class="bottom-button" id="categoryButton" onclick="categoryChange();">Category</button>
      <button type="button" class="bottom-button" id="brandButton" onclick="brandChange();">Brand</button>
    </div>
    <div class="bottom-foot" id="itemSelectDiv">

      <div class="bottom-left-box">
      <select name="item1" id="item1" class="bottom-select" style='font-size: 12px; font-family: "Verdana", Sans-Serif;' multiple>
        @php
          $item = DB::table('itemmaster')->pluck('CODE', 'NAME');
          foreach ($item as $name => $code) {
              echo "<option value=".$code.">".$code.str_repeat('&nbsp;', 10).$name ."</option>";
          }
        @endphp
      </select>
      </div>
      <div class="bottom-centre-box">
        <input type="button" class="arrow-top-button" value=">>" onclick="giveallitems()">
        <input type="button" class="arrow-top-button" value=">" onclick="giveoneitem()">
        <div class="div-bottom-button">
          <input type="button" class="arrow-bottom-button" value="<<" onclick="backallitems()">
          <input type="button" class="arrow-bottom-button" value="<" onclick="backoneitem()">
        </div>
      </div>
      <div class="bottom-right-box">
      <select name="item2[]" id="item2" class="bottom-select" multiple>
      </select>
      </div>
    </div>
    <div class="bottom-foot" id="categorySelectDiv" style="display: none">
      <div class="bottom-left-box">
        <select name="category1" id="category1" class="bottom-select" style='font-size: 12px; font-family: "Verdana", Sans-Serif;' multiple>
          @php
            $category = DB::table('itemgroupmaster')->where('CATCODE', '=', 01)->pluck('CODE', 'NAME');
            foreach ($category as $name => $code) {
                echo "<option value=".$code.">".$code.str_repeat('&nbsp;', 10).$name ."</option>";
            }
          @endphp
        </select>
      </div>
      <div class="bottom-centre-box">
        <input type="button" class="arrow-top-button" value=">>" onclick="giveallcategory()">
        <input type="button" class="arrow-top-button" value=">" onclick="giveonecategory()">
        <div class="div-bottom-button">
          <input type="button" class="arrow-bottom-button" value="<<" onclick="backallcategory()">
          <input type="button" class="arrow-bottom-button" value="<" onclick="backonecategory()">
        </div>
      </div>
      <div class="bottom-right-box">
        <select name="category2[]" id="category2" class="bottom-select" multiple>

        </select>
      </div>
    </div>
    <div class="bottom-foot" id="brandSelectDiv" style="display: none">
      <div class="bottom-left-box">
        <select name="brand1" id="brand1" class="bottom-select" style='font-size: 12px; font-family: "Verdana", Sans-Serif;' multiple>
          @php
            $brand = DB::table('itemgroupmaster')->where('CATCODE', '=', 02)->pluck('CODE', 'NAME');
            foreach ($brand as $name => $code) {
                echo "<option value=".$code.">".$code.str_repeat('&nbsp;', 10).$name ."</option>";
            }
          @endphp
        </select>
      </div>
      <div class="bottom-centre-box">
        <input type="button" class="arrow-top-button" value=">>" onclick="giveallbrands()">
        <input type="button" class="arrow-top-button" value=">" onclick="giveonebrand()">
        <div class="div-bottom-button">
          <input type="button" class="arrow-bottom-button" value="<<" onclick="backallbrands()">
          <input type="button" class="arrow-bottom-button" value="<" onclick="backonebrand()">
        </div>
      </div>
      <div class="bottom-right-box">
        <select name="brand2[]" id="brand2" class="bottom-select" multiple>

        </select>
      </div>
    </div>

  </div>
  </form>

</div>
</body>
</html>
