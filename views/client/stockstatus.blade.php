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
    function summaryhead(){
      $("#storediv").hide();
      $("#unitdiv").hide();
      $("#ratediv").hide();
    }
    function detailshead(){
      $("#storediv").show();
      $("#unitdiv").show();
      $("#ratediv").show();
    }
    function getvalues(){

      var category = $('#category').val();
      var brand = $('#brand').val();
      var item = $('#item').val();
      var type2 = $('input[name="type2"]:checked').val();
      var type3 = $('input[name="type3"]:checked').val();
      var type4 = $('input[name="type4"]:checked').val();
      var discount = $("#discount").is(':checked');
      var adate = $("#onedate").val();
      $.ajax({type: "POST",  url: '/ajaxStockstatus',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          "type2": type2,
          "type3": type3,
          "type4": type4,
          "discount": discount,
          "date1": adate,
          "category": category,
          "brand": brand,
          "item": item
        },
          success: function(result){
            var jobj=JSON.parse(result);
            var qty = 0; var rate = 0; var totqty = 0; var totrate = 0; var newqty = 0;
            var newrate = 0; var tr = 0;
            var htmlString = '';
            var i; var k;
            var quantitydecimal = jobj['setupvalues'][0]['QUANTITY_DECIMAL'];
            var ratedecimal = jobj['setupvalues'][0]['RATE_DECIMAL'];
            var amountdecimal = jobj['setupvalues'][0]['AMOUNT_DECIMAL'];
            var kSort=[];
            if(type2=='summary'){
              summaryhead();
            }else{
              var n; var l ; var amount; var amt; var itemrate; var irate;
              detailshead();
            }
            for(i in jobj.result){
              kSort[kSort.length]=i;
            }
            kSort.sort();
            for(i of kSort){
              k=jobj.result[i];
              //console.log('code:'+k[0]+'\t'+'name:'+k[1]+'\t'+'qty:'+k[2]+'\t'+'rate:'+k[3]);
              qty = k[2];
              totqty = totqty + qty;
              newqty = parseFloat(qty).toFixed(quantitydecimal);
              newqty=Number(newqty).toLocaleString();
              rate = k[3];
              totrate = totrate + rate;
              newrate = parseFloat(rate).toFixed(ratedecimal);
              newrate=Number(newrate).toLocaleString();
              if(type2=='summary'){
                htmlString+="<div class='row'><div class='column'><div class ='col25'>"+k[0]+"</div><div class='col70'>"+k[1]+"</div><div class='col30-right'>"+newqty+"</div><div class='col30-right'>"+newrate+"</div></div><hr></div>";
              }else{
                htmlString+="<div class='row'><div class='column'><div class='col25 bold'>"+k[0]+"</div><div class='col70 bold'>"+k[1]+"</div><div class='col25'></div><div class='col25'></div><div class='col30-right bold'>"+newqty+"</div><div class='col30'></div><div class='col30-right bold'>"+newrate+"</div></div><hr></div>";
                for(l in jobj.data[k[0]]){
                  n=jobj.data[k[0]][l];
                  //console.log('     code:\t'+'name:'+n.ITEMNAME+'\t'+'qty:'+n.QTY+'\t'+'price:'+n.RATE);
                  if(discount==true){
                    itemrate = n.DISCRATE;
                  }else{
                    itemrate = n.RATE;
                  }
                  amount = n.QTY * itemrate;
                  irate = parseFloat(itemrate).toFixed(ratedecimal);
                  irate=Number(irate).toLocaleString();
                  amt = amount.toFixed(amountdecimal);
                  amt=Number(amt).toLocaleString();
                  htmlString+="<div class='row'><div class='column'><div class='col25'>"+n.ITEMCODE+"</div><div class='col70'>"+n.ITEMNAME+"</div><div class='col25'>"+n.STRCODE+"</div><div class='col25'>"+n.UNITCODE+"</div><div class='col30-right'>"+n.QTY+"</div><div class='col30-right'>"+irate+"</div><div class='col30-right'>"+amt+"</div></div></div>";
                }
              }
            }
            if(type2=='summary'){
              totqty=Number(totqty).toLocaleString();
              tr = Number(totrate.toFixed(amountdecimal)).toLocaleString();
              htmlString+="<div class='row'><div class='large-column'><div class='col25'></div><div class='col70-right underline bold'>Total</div> <div class='col30-right underline bold'>"+totqty+"</div> <div class='col30-right underline bold'>"+tr +"</div></div></div>";
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
      <div class="report-header1">
        Company Name
      </div>
      <div class="report-header2">
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
      <div class="box" id="discountDiv">
        <input type="checkbox" id="discount" name="discount" checked>
        <label for="scales">Discount</label>
      </div>
      <div class="box" id="dateDiv1">
        <div class="right-box-label">Date</div>
        <input type="date" id="onedate" name="onedate" value="{{date("Y-m-d")}}">
      </div>
      <div class="box-null">
        <input type="submit" value="Submit" class="green-button" onclick="getvalues();">
        <a onclick="hidesearch();">
          <input type="button" value="Close" class="red-border-button">
        </a>
      </div>
    </div>
    <div class="top-box-small">
      <div class="box">
        <label>Category</label>
        <select name="category[]" id="category" class="custom-select" multiple>
          @php
            $category = DB::table('itemgroupmaster')->where('CATCODE', '=', 01)->pluck('CODE', 'NAME');
            foreach ($category as $name => $code) {
                echo "<option value=".$code.">".$code.str_repeat('&nbsp;', 10).$name ."</option>";
            }
          @endphp
        </select>
      </div>
      <div class="box">
        <label>Brand</label>
        <select name="brand1[]" id="brand" class="custom-select" multiple>
          @php
            $brand = DB::table('itemgroupmaster')->where('CATCODE', '=', 02)->pluck('CODE', 'NAME');
            foreach ($brand as $name => $code) {
                echo "<option value=".$code.">".$code.str_repeat('&nbsp;', 10).$name ."</option>";
            }
          @endphp
        </select>
      </div>
      <div class="box">
        <label>Item</label>
        <select name="item1[]" id="item" class="custom-select"  multiple>
          @php
            $item = DB::table('itemmaster')->pluck('CODE', 'NARRATION');
            foreach ($item as $name => $code) {
                echo "<option value=".$code.">".$code.str_repeat('&nbsp;', 10).$name ."</option>";
            }
          @endphp
        </select>
      </div>
    </div>
    <div class="row"><hr></div>

    </div>


    <div class="row">
      <div class="column">
        <div class="col25 bold">Code</div>
        <div class="col70 bold">Name</div>
        @if ($multibranch == 'Yes')
          <div class="col25 bold" id="storediv">Store</div>
        @endif
          <div class="col25 bold" id="unitdiv">Unit</div>
        <div class="col30-right bold">Quantity</div>
        <div class="col30-right bold" id="ratediv">Rate</div>
        <div class="col30-right bold">Amount</div>
      </div>
      <hr>
    </div>

    <div id="content">

    @if ($type2 == 'summary')
      <script>summaryhead();</script>
    @php
        $totalamount = $totalquantity = 0;
    @endphp
    @foreach($result as $key => $object)
       <div class="row">
         <div class="column">
           <div class="col25">{{$object[0]}}</div>
           <div class="col70">{{$object[1]}}</div>
           <div class="col30-right">{{number_format((float)$object[2], $quantitydecimal, '.', ',')}}</div>
           <div class="col30-right">{{number_format((float)$object[3], $amountdecimal, '.', ',')}}</div>
         </div>
         <hr>
       </div>
         @php
           $totalquantity += $object[2];
           $totalamount += $object[3];
        @endphp
    @endforeach
    <div class="row">
      <div class="large-column">
        <div class="col25"></div>
        <div class="col70-right underline bold">Total</div>
        <div class="col30-right underline bold">{{number_format((float)$totalquantity, $quantitydecimal, '.', ',')}}</div>
        <div class="col30-right underline bold">{{number_format((float)$totalamount, $amountdecimal, '.', ',')}}
        </div>
      </div>
    </div>
    @endif

    @if ($type2 == 'details')
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
      <div class="column">
        <div class="col25 bold">{{$code}}</div>
        <div class="col70 bold">{{$name}}</div>
        <div class="col25"></div>
        <div class="col25"></div>
        <div class="col30-right bold">{{number_format((float)$result[$code][2], $quantitydecimal, '.', ',')}}</div>
        <div class="col30"></div>
        <div class="col30-right bold">{{number_format((float)$result[$code][3], $amountdecimal, '.', ',')}}</div>
      </div>
      <hr>
    </div>
    @foreach($object as $obj)
      @php
        $qty = $obj['QTY'];
        if($discount){
          $rate = $obj['DISCRATE'];
        }else{
          $rate = $obj['DISCRATE'];
        }
        $amount = $qty * $rate;
     @endphp
      <div class="row">
        <div class="column">
          <div class="col25"> {{$obj['ITEMCODE']}}</div>
          <div class="col70">{{$obj['ITEMNAME']}}</div>
          <div class="col25">{{$obj['STRCODE']}}</div>
          <div class="col25">{{$obj['UNITCODE']}}</div>
          <div class="col30-right">{{number_format((float)$qty, $quantitydecimal, '.', ',')}}</div>
          <div class="col30-right">{{number_format((float)$rate, $ratedecimal, '.', ',')}}</div>
          <div class="col30-right">{{number_format((float)$amount, $amountdecimal, '.', ',')}}</div>
        </div>
      </div>
      @endforeach
    @endforeach
    @endif
    </div>


  </div>
</div>
</body>
</html>


