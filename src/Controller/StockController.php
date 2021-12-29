<?php

namespace Milestone\eBis\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Milestone\eBis\Model\ItemGroupMaster;
use Milestone\eBis\Model\ItemMaster;
use Milestone\eBis\Model\RStock;
use Milestone\eBis\Model\RStockPositions;
use Milestone\eBis\Model\Setup;

class StockController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request) {
      $type1 = $request->input('type1');
      $type2 = $request->input('type2');
      $type3 = $request->input('type3');
      $type4 = $request->input('type4');
      $discount = $request->input('discount');
      //$discount = isset($request->input('discount')) ? 1 : 0;
      $date1 = $request->input('onedate');
      $date2 = $request->input('fromdate');
      $date3 = $request->input('todate');
      $category = $request->input('category2');
      $brand = $request->input('brand2');
      $item = $request->input('item2');
//      $data = $request->all();
//      $collection = RStock::all();

      $dCategory = ItemGroupMaster::select('CODE', 'NAME')->where('CATCODE', '=', '01')->get()->toArray();
      $dBrand = ItemGroupMaster::select('CODE', 'NAME')->where('CATCODE', '=', '02')->get()->toArray();
      $dItem = ItemMaster::select('CODE', 'NARRATION')->get()->toArray();
      switch ($type1) {
        case "stockstatus":
          $collection = RStock::Where('DOCDATE', '<=', $date1);
          $collection = $this->specification($collection, $category, $brand, $item);
          $collection = $this->type4($collection, $type4)->get();
//          $collection = $collection->get();
          $array = $this->stockstatusCategorization($collection, $type3, $discount);
          $data = $array[0]->toArray();
          $result = $array[1]->toArray();
//          $result = $result->toArray();
//          $data = $data->toArray();
          break;
        case "stockposition":
          $collection = RStockPositions::whereBetween('DOCDATE', [$date2, $date3])->get();
          $collection = $this->specification($collection, $category, $brand, $item);
          $array = $this->stockpositionCategorization($collection, $type3);
          $data = $array[0]->toArray();
          $result = $array[1]->toArray();
         //dd($dCategory);
          break;
        case "allocation":
          echo "Your allocation!";
          break;
        case "taxation":
          echo "Your taxation!";
          break;
        case "store":
          echo "Your store!";
          break;
        case "ageing":
          echo "Your ageing!";
          break;
        default:
      }
      $setupvalues = Setup::select('QUANTITY_DECIMAL', 'RATE_DECIMAL', 'AMOUNT_DECIMAL','MULTIBRANCH')
        ->get()->toArray();
      $viewpage = "eBis::".$type1;
      return view($viewpage)->with(['result' => $result])
        ->with(['data' => $data])
        ->with(['type1' => $type1])
        ->with(['type2' => $type2])
        ->with(['type3' => $type3])
        ->with(['discount' => $discount])
        ->with(['date1' => $date1])
        ->with(['date2' => $date2])
        ->with(['date3' => $date3])
        ->with(['dCategory' => $dCategory])
        ->with(['dBrand' => $dBrand])
        ->with(['dItem' => $dItem])
        ->with(['setupvalues' => $setupvalues]);
    }
  function stockpositionCategorization($collection, $type3){
      if ($type3 == 'category') {
        $type = "GROUP1CODE";
        $typeName = "GROUP1NAME";
      } else {
        $type = "GROUP2CODE";
        $typeName = "GROUP2NAME";
      }
      $data = $collection->groupBy($type);
      $result = $data->map(function ($array, $value)use ($typeName) {
      $name = $array[0]->$typeName;
      $totOpening = $array->sum('Opening');
      $totPurchaseorder = $array->sum('PurchaseOrder');
      $totPurchase = $array->sum('Purchase');
      $totPurchasereturn = $array->sum('PurchaseReturn');
      $totSalesorder = $array->sum('SalesOrder');
      $totSales = $array->sum('Sales');
      $totSalesreturn = $array->sum('SalesReturn');
      $totOther = $array->sum('Other');
      $totclosing = $totOpening + $totPurchase - $totPurchasereturn + $totSales - $totSalesreturn + $totOther;
      return [$name, $totOpening, $totPurchaseorder, $totPurchase, $totPurchasereturn, $totSalesorder, $totSales, $totSalesreturn, $totOther, $totclosing];
    });
    return array($data,$result);
  }
  function specification($collection, $category, $brand, $item){
      if(isset($category)){
        $collection = $collection->whereIn('GROUP1CODE', $category);
      }
      if(isset($brand)){
        $collection = $collection->whereIn('GROUP2CODE', $brand);
      }
      if(isset($item)){
        $collection = $collection->whereIn('ITEMCODE', $item);
      }
      return $collection;
  }
  function type4($collection, $type4){
    switch ($type4) {
      case 'stockitem':
        $collection = $collection->where('QTY', '>', '0');
        break;
      case 'negativestock':
        $collection = $collection->where('QTY', '<=', '0');
        break;
      default:
        break;
    }
    return $collection;
  }

  function stockstatusCategorization($collection, $type3, $discount){
    if ($type3 == 'category') {
      $type = "GROUP1CODE";
      $typeName = "GROUP1NAME";
    } else {
      $type = "GROUP2CODE";
      $typeName = "GROUP2NAME";
    }
    $data = $collection->groupBy($type);
    $result = $data->map(function ($array, $value)use ($type, $typeName, $discount) {
      $code = $array[0]->$type;
      $name = $array[0]->$typeName;
      $totQty = $array->sum('QTY');
      if($discount){
        $totSum = $array->sum(function($value){
          return $value->DISCRATE *  $value->QTY;
        });
      }else{
        $totSum = $array->sum(function($value){
          return $value->RATE *  $value->QTY;
        });
      }

      return [$code, $name, $totQty, $totSum];
    });
    return array($data,$result);
  }


  public function ajaxStockstatus(Request $request) {
    $type2 = $request->input('type2');
    $type3 = $request->input('type3');
    $type4 = $request->input('type4');
    $discount = $request->input('discount');
    $date1 = $request->input('date1');
    $category = $request->input('category');
    $brand = $request->input('brand');
    $item = $request->input('item');
    $collection = RStock::Where('DOCDATE', '<=', $date1);
    $collection = $this->specification($collection, $category, $brand, $item);
    $collection = $this->type4($collection, $type4)->get();
    $array = $this->stockstatusCategorization($collection, $type3, $discount);
    $data = $array[0];
    $result = $array[1];
    $setupvalues = Setup::select('QUANTITY_DECIMAL', 'RATE_DECIMAL', 'AMOUNT_DECIMAL', 'MULTIBRANCH')
      ->get()->toArray();
    return json_encode(array('data'=>$data, 'result'=>$result, 'setupvalues'=>$setupvalues));
  }

  public function ajaxStockposition(Request $request) {
    $type3 = $request->input('type3');
    $date2 = $request->input('fromdate');
    $date3 = $request->input('todate');
    $category = $request->input('category');
    $brand = $request->input('brand');
    $item = $request->input('item');
    $collection = RStockPositions::whereBetween('DOCDATE', [$date2, $date3])->get();
    $collection = $this->specification($collection, $category, $brand, $item);
    $array = $this->stockpositionCategorization($collection, $type3);
    $data = $array[0];
    $result = $array[1];
    $setupvalues = Setup::select('QUANTITY_DECIMAL', 'RATE_DECIMAL', 'AMOUNT_DECIMAL', 'MULTIBRANCH')
      ->get()->toArray();
    return json_encode(array('data'=>$data, 'result'=>$result, 'setupvalues'=>$setupvalues));
  }


}

