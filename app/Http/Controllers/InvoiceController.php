<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoices.index');
    }

    public function sales()
    {
        $party = \DB::select('SELECT         Partycode, Title
FROM            [ErpZOne_Master].[dbo].[tbl_42_01_Party_DrCr]
WHERE        (DR = 1) AND (Header = 0)');
        $items = \DB::select('SELECT TOP 10


            [DiscountPercent]
            ,[Bonus]
            ,[Rate]
            ,[Description]
            ,[Item]

 FROM [ErpZOne_Master].[dbo].[tbl_40_02_TrDetail_SalePurchase]');

        $trs = \DB::select("
            SELECT [TrID],[TrDate],[TrNo]
            FROM [ErpZOne_Master].[dbo].[tbl_40_02_TR]
            WHERE TrType = 400
            AND TrDate between '1-jun-2025' and '30-jun-2025'
            order by TrDate
        ");

        return view('welcome', compact('party', 'items', 'trs'));
    }

    public function getTransactionByDate(Request $request)
    {
        $record = \DB::select("
            SELECT  TrID, Project, TrType, TrNo, TrDate, TrYear, TrMonth, Description,
            CrossRef, enteredby, enteredon, Editedby, EditedOn, ComputerName, Posted,
            Checked, Checkedby, Approved, ApprovedBy, PartyGroup, Party, Dropped,
            ArApOpening, Invoicedate, Age, Old_id, QRCode, SalesMan, Discount, TaxSubmitted,
            ParentDocNo, TaxAmount, TaxPercent, ChequeNo, ChequeDate, PaymentMethod,
            Department, InvoiceNo, QuotationNo, QuotationDate, DeliveryStatus, DeliveryDate,
            ExciseDuty, ExtraTax, IncidentCharges, Admissible, CVNo, CVDate, BiltyAmount,
            BiltyNo, BiltyDate, ExShop, Imported, IGPNo, IGPDate, Closed, PurposeId,
            VehicleNo, DriverName, DriverCNIC, DCtime, Saved, TimeofSupply, BuyerPONo,
            BuyerPODate, AdvIncomeTax, SecurityDep, GroupFolio, tridref, PaidTo, DriverCellNo

            FROM [ErpZOne_Master].[dbo].[tbl_40_02_TR]

            WHERE (TrType = 400)

            AND (TrDate BETWEEN CONVERT(DATETIME, '2025-06-01 00:00:00', 102)
            AND CONVERT(DATETIME, '2025-06-30 00:00:00', 102))

            ORDER BY TrDate;
        ");

        return response()->json($record);
    }

    public function getSalesDetails(Request $request)
    {
        $trId = $request->query('tr_id'); // get tr_id from URL query parameter

        $data = \DB::select("

                SELECT TrId, Sno, EntrySeq, Deffered, Description, DebitAmount, CreditAmount,
                STaxFurtherAmount, ItemControl, Item, Quantity_Dr, Quantity_Cr, Packing,
                Bonus, Rate, RateIncSTax, Unitm, GrossAmount, DiscountPercent, DiscountAmount,
                SalesTaxPercent, SalesTaxAmount, enteredby, enteredon, EditedBy, EditedOn,
                Amount236G, Rate236H, InvoiceNo, Rate236G, STaxFurther, Amount236H, OtherCharges,
                PList_01, PList_02, PList_03, PList_04, PList_05, PackList, ControlCode, DetailCode,
                POno, POdate, Folio, TRidRef, QtyCr_Actual, Commission, Freight

                FROM [ErpZOne_Master].[dbo].[tbl_40_02_TrDetail_SalePurchase]

                WHERE TrId = ?

        ", [$trId]);

        return response()->json($data);
    }

}
