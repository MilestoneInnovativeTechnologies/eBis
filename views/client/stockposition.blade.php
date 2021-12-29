<!DOCTYPE html>
<html>
<head>
  <link rel='stylesheet' type='text/css' href="public/css/style.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script>
    function showsearch(){
      $("#searchboxdiv").show();
      $("#searchdiv").hide();
    }
    function hidesearch(){
      $("#searchboxdiv").hide('slow');
      $("#searchdiv").show();
    }

    var nowDate     = new Date();
    var nowDay      = ((nowDate.getDate().toString().length) == 1) ? '0'+(nowDate.getDate()) : (nowDate.getDate());
    var nowMonth    = ((nowDate.getMonth().toString().length) == 1) ? '0'+(nowDate.getMonth()+1) : (nowDate.getMonth()+1);
    var nowYear     = nowDate.getFullYear();
    var lastDay     = new Date(nowDate.getFullYear(), nowDate.getMonth() + 1, 0); //using to make last day of month

    function getToday(){
      var formattoDay  = nowYear + "-" + nowMonth + "-" + nowDay;
      $(".datetype").prop('checked', false);
      $("#today").prop("checked", true);
      $('#fromdate').val(formattoDay)
      $('#todate').val(formattoDay);
    }
    function getThismonth(){
      var formatfirstDay  = nowYear + "-" + nowMonth + "-" + '01';
      var formatlastDay  = nowYear + "-" + nowMonth + "-" + lastDay.getDate();
      $(".datetype").prop('checked', false);
      $("#month").prop("checked", true);
      $('#fromdate').val(formatfirstDay)
      $('#todate').val(formatlastDay);
    }
    function getThisyear(){
      var formatfirstDay  = nowYear + "-" + '01' + "-" + '01';
      var formatlastDay  = nowYear + "-" + '12' + "-" + '31';
      $(".datetype").prop('checked', false);
      $("#year").prop("checked", true);
      $('#fromdate').val(formatfirstDay)
      $('#todate').val(formatlastDay);
    }
    function selectCustom(){
      $(".datetype").prop('checked', false);
      $("#custom").prop("checked", true);
    }

    function getvalues(){
      var category = $('#category').val();
      var brand = $('#brand').val();
      var item = $('#item').val();
      var type3 = $('input[name="type3"]:checked').val();
      var fromdate = $("#fromdate").val();
      var todate = $("#todate").val();
      $.ajax({type: "POST",  url: '/ajaxStockposition',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          "type3": type3,
          "fromdate": fromdate,
          "todate": todate,
          "category": category,
          "brand": brand,
          "item": item
        },
          success: function(result){
            var jobj=JSON.parse(result);
            //console.log(jobj.data);
            var htmlString = '';
            var i; var k; var l; var n;
            var Opening; var PurchaseOrder; var Purchase; var PurchaseReturn;
            var SalesOrder; var Sales; var SalesReturn;
            var Other; var closing;

            var quantitydecimal = jobj['setupvalues'][0]['QUANTITY_DECIMAL'];
            var ratedecimal = jobj['setupvalues'][0]['RATE_DECIMAL'];
            var amountdecimal = jobj['setupvalues'][0]['AMOUNT_DECIMAL'];
            var kSort=[];
            for(i in jobj.result){
              kSort[kSort.length]=i;
            }
            kSort.sort();
            for(i of kSort){
              k=jobj.result[i];
              //console.log('code:'+k[0]+'\t'+'name:'+k[1]+'\t'+'qty:'+k[2]+'\t'+'rate:'+k[3]);
              htmlString+="<div class='row'><div class='auto-column'><div class='col60-vline bold'>"+k[0]+"</div><div class='col25-right-bold-vline'>"+k[1]+"</div><div class='col25-right-bold-vline'>"+k[2]+"</div><div class='col25-right-bold-vline'>"+k[3]+"</div><div class='col25-right-bold-vline'>"+k[4]+"</div><div class='col25-right-bold-vline'>"+k[5]+"</div><div class='col25-right-bold-vline'>"+k[6]+"</div><div class='col25-right-bold-vline'>"+k[7]+"</div><div class='col25-right-bold-vline'>"+k[8]+"</div><div class='col25-right-bold'>"+k[9]+"</div></div><hr></div>";
              for(l in jobj.data[i]) {
                n=jobj.data[i][l];
                Opening = parseFloat(n.Opening).toFixed(amountdecimal);
                PurchaseOrder = parseFloat(n.PurchaseOrder).toFixed(amountdecimal);
                Purchase = parseFloat(n.Purchase).toFixed(amountdecimal);
                PurchaseReturn = parseFloat(n.PurchaseReturn).toFixed(amountdecimal);
                SalesOrder = parseFloat(n.SalesOrder).toFixed(amountdecimal);
                Sales = parseFloat(n.Sales).toFixed(amountdecimal);
                SalesReturn = parseFloat(n.SalesReturn).toFixed(amountdecimal);
                Other = parseFloat(n.Other).toFixed(amountdecimal);
                closing = n.Opening + n.Purchase - n.PurchaseReturn - n.Sales + parseFloat(n.SalesReturn) + parseFloat(n.Other);
                closing = parseFloat(closing).toFixed(amountdecimal);
                htmlString+="<div class='row'><div class='auto-column'><div class='col60-vline'>"+n.ITEMNAME+"</div><div class='col25-right-vline'>"+Opening+"</div><div class='col25-right-vline'>"+PurchaseOrder+"</div><div class='col25-right-vline'>"+Purchase+"</div><div class='col25-right-vline'>"+PurchaseReturn+"</div><div class='col25-right-vline'>"+SalesOrder+"</div><div class='col25-right-vline'>"+Sales+"</div><div class='col25-right-vline'>"+SalesReturn+"</div><div class='col25-right-vline'>"+Other+"</div><div class='col25-right'>"+closing+"</div></div></div>";
              }
            }
            $('#content').html(htmlString);
          },
        error: function () {
          alert("Error !!");
        }
      });
      hidesearch();
    }
    $(document).ready(function(){
      $("#searchboxdiv").hide();
    });
  </script>
  <title>eBis :: Stock Report</title>
</head>
<body>

<div class="container">
  <div class="border">
    <div class="row">
      <div class="report-header1 bold">
        Company Name
      </div>
      <div class="report-header2 bold">
        @php
        function newDate($originalDate){
            return $newDate = date("d-m-Y", strtotime($originalDate));
        }
          if($type1 == "stockposition"){
              $headingtxt = 'Stock Report for the period '.newDate($date2).' to '.newDate($date3);
          }else{
              $headingtxt = 'Stock Report as on '.newDate($date1);
          }
          echo $headingtxt;
        @endphp

      </div>
      @php
        $quantitydecimal = $setupvalues[0]['QUANTITY_DECIMAL'];
        $ratedecimal = $setupvalues[0]['RATE_DECIMAL'];
        $amountdecimal = $setupvalues[0]['AMOUNT_DECIMAL'];
        $multibranch = $setupvalues[0]['MULTIBRANCH'];
        @endphp
      <div class="col25" id="searchdiv">
        <a class="search" onclick="showsearch();">Search</a>
      </div>
      <hr>
    </div>
    <div  id="searchboxdiv">
    <div class="top-box-small">
      <div class="box" id="type3Div">
        <input type="radio" id="type3" name="type3" value="category" checked>
        <label for="category">Category</label> <br>
        <input type="radio" id="type3" name="type3" value="brand">
        <label for="brand">Brand</label> <br>
      </div>


      <div class="box" id="dateDiv1">
        <div class="right-box-label">From Date</div>
        <input type="date" id="fromdate" name="fromdate" value="@php echo date("Y-m-01");@endphp" onclick="selectCustom();"><br>
        <div class="right-box-label">To Date</div>
        <input type="date" id="todate" name="todate" value="@php echo date("Y-m-t");@endphp" onclick="selectCustom();">
      </div>

      <div class="box" id="">
        <input type="radio" id="today" name="datetype" value="today" onclick ="getToday();">
        <label for="today">Today</label>
        <input type="radio" id="month" name="datetype" value="month" onclick ="getThismonth();" checked>
        <label for="month">This Month</label>
        <input type="radio" id="year" name="datetype" value="year" onclick ="getThisyear();">
        <label for="year">This Year</label>
        <input type="radio" id="custom" name="datetype" value="custom" onclick ="getCustom();">
        <label for="custom">Custom</label>
      </div>

      <div class="box-null-right">
        <input type="submit" value="Submit" class="green-button" onclick="getvalues();">
        <a onclick="hidesearch();">
          <input type="button" value="Close" class="red-border-button">
        </a>
      </div>
    </div>
    <div class="top-box-small">
      <div class="box">
        <label>Category</label>
        <select name="category[]" id="category" class="" style='font-size: 12px; font-family: "Verdana", Sans-Serif;' multiple>
          @php
            foreach($dCategory as $key => $object){
                $ccode = $object['CODE'];
                $cname = $object['NAME'];
                echo "<option value=".$ccode.">".$ccode.str_repeat('&nbsp;', 10).$cname ."</option>";
            }
          @endphp
        </select>
      </div>
      <div class="box">
        <label>Brand</label>
        <select name="brand1[]" id="brand" class="" style='font-size: 12px; font-family: "Verdana", Sans-Serif;' multiple>
          @php
            foreach ($dBrand as $key => $object) {
                $bcode = $object['CODE'];
                $bname = $object['NAME'];
                echo "<option value=".$bcode.">".$bcode.str_repeat('&nbsp;', 10).$bname ."</option>";
            }
          @endphp
        </select>
      </div>
      <div class="box">
        <label>Item</label>
        <select name="item1[]" id="item" class="" style='font-size: 12px; font-family: "Verdana", Sans-Serif;' multiple>
          @php
            foreach ($dItem as $key => $object) {
                $icode = $object['CODE'];
                $iname = $object['NARRATION'];
                echo "<option value=".$icode.">".$icode.str_repeat('&nbsp;', 10).$iname ."</option>";
            }
          @endphp
        </select>
      </div>
    </div>
    <div class="row"><hr></div>

    </div>


    <div class="row">
      <div class="auto-column">
        <div class="col60-center bold vline">Item Name</div>
        <div class="col25-center-bold-vline">Opening</div>
        <div class="col25-center-bold-vline">Purchase Order</div>
        <div class="col25-center-bold-vline">Purchase</div>
        <div class="col25-center-bold-vline">Purchase Return</div>
        <div class="col25-center-bold-vline">Sales Order</div>
        <div class="col25-center-bold-vline">Sales</div>
        <div class="col25-center-bold-vline">Sales Return</div>
        <div class="col25-center-bold-vline">Other</div>
        <div class="col25-center-bold">Closing</div>
      </div>
      <hr>
    </div>

    <div id="content">

      @foreach($data as $code => $object)
        @php
          if($type3=="category"){
            $code=$object[0]['GROUP1CODE'];
            $name=$object[0]['GROUP1NAME'];
          }else{
            $code=$object[0]['GROUP2CODE'];
            $name=$object[0]['GROUP2NAME'];
          }
        @endphp
    <div class="row">
      <div class="auto-column">
        <div class="col60-vline bold">{{$name}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][1], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][2], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][3], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][4], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][5], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][6], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][7], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold-vline">{{number_format((float)$result[$code][8], $amountdecimal, '.', ',')}}</div>
        <div class="col25-right-bold">{{number_format((float)$result[$code][9], $amountdecimal, '.', ',')}}</div>
      </div>
      <hr>
    </div>
    @foreach($object as $obj)
          <div class="row">
          <div class="auto-column">
            <div class="col60-vline">{{$obj['ITEMNAME']}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['Opening'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['PurchaseOrder'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['Purchase'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['PurchaseReturn'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['SalesOrder'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['Sales'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['SalesReturn'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right-vline">{{number_format((float)$obj['Other'], $amountdecimal, '.', ',')}}</div>
            <div class="col25-right">{{number_format((float)($obj['Opening'] + $obj['PurchaseOrder'] + $obj['Purchase'] - $obj['PurchaseReturn'] - $obj['SalesOrder'] - $obj['Sales'] + $obj['SalesReturn'] + $obj['Other']), $amountdecimal, '.', ',')}}</div>
          </div>
          </div>
      @endforeach
      <hr>
    @endforeach


    </div>


  </div>
</div>
</body>
</html>


