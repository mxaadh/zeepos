@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">

            <!-- Header Section -->
            <div class="header-section">
                <table class="header-table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Doc Type</th>
                        <th>Doc No</th>
                        <th>Party</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="date" id="dateInput" onchange="fetchRecord(this.value)"></td>
                        <td>
                            <select>
                                <option>Invoice</option>
                                <option>Return</option>
                            </select>
                        </td>
                        <td><input type="text" id="docNo"></td>
                        <td>
                            <select>
                                <option value="">-- Select Party --</option>
                                @isset($party)
                                    @foreach ($party as $p)
                                        <option value="{{ $p->Partycode }}">{{ $p->Title }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="right-panel"></div>
                <script>
                    let trs = @json($trs);
                    let currentIndex = 0;

                    function fetchRecord(date) {
                        if (!date) return;

                        fetch(`/get-transaction-by-date?date=${date}`)
                            .then(res => res.json())
                            .then(record => {
                                if (!record) {
                                    alert("No record found for selected date");
                                    return;
                                }

                                trs = record;
                                currentIndex = 0;
                                showRecord(currentIndex);
                            });
                    }

                    function showRecord(index) {
                        const record = trs[index];
                        if (!record) return;

                        document.getElementById('docNo').value = record.TrNo || '';

                        // 👇 Fetch and display details using TrID
                        fetch(`/sales-details?tr_id=${record.TrID}`)
                            .then(res => res.json())
                            .then(items => renderDetailTable(items));
                    }

                    function renderDetailTable(items) {
                        const tbody = document.querySelector('.detail-table tbody');
                        tbody.innerHTML = ''; // clear old rows

                        items.forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td><input type="text" value="${item.Item || ''}"></td>
                        <td><select><option>${item.Description || 'Item'}</option></select></td>
                        <td><input type="text" value="${item.Description || ''}"></td>
                        <td><input type="number" value="${item.Quantity_Dr || 0}"></td>
                        <td><input type="text" value="${item.Bonus || 0}"></td>
                        <td><input type="text" value="${item.DiscountPercent || 0}"></td>
                        <td><input type="text" value="${item.Rate || 0}"></td>
                        <td><input type="number" value="${item.GrossAmount || 0}"></td>
                        <td><button class="edit-btn">Edit</button></td>
                    `;
                            tbody.appendChild(row);
                        });
                    }

                    function goFirst() {
                        currentIndex = 0;
                        showRecord(currentIndex);
                    }

                    function goLast() {
                        currentIndex = trs.length - 1;
                        showRecord(currentIndex);
                    }

                    function goPrev() {
                        if (currentIndex > 0) {
                            currentIndex--;
                            showRecord(currentIndex);
                        }
                    }

                    function goNext() {
                        if (currentIndex < trs.length - 1) {
                            currentIndex++;
                            showRecord(currentIndex);
                        }
                    }

                    document.addEventListener('DOMContentLoaded', () => {
                        showRecord(currentIndex);
                    });
                </script>


                <div class="main-buttons">
                    <button class="save-btn">Save</button>
                    <div class="nav-buttons">
                        <button onclick="goFirst()">⏮</button>
                        <button onclick="goPrev()">◀</button>
                        <button onclick="goNext()">▶</button>
                        <button onclick="goLast()">⏭</button>
                        <button class="nav-btn" title="New">+</button>
                    </div>
                </div>
            </div>

            <!-- Input Section -->
            <div class="input-section">
                <div class="input-header">
                    <table class="input-header-table">
                        <thead>
                        <tr>
                            <th>Item No</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Bonus</th>
                            <th>Discount %</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" placeholder="Item No"></td>
                            <td><select>
                                    <option>Item Name</option>
                                </select></td>
                            <td><input type="text" placeholder="Description"></td>
                            <td><input type="number" placeholder="Qty"></td>
                            <td><input type="number" placeholder="Bonus"></td>
                            <td><input type="number" placeholder="Disc %"></td>
                            <td><input type="number" placeholder="Rate"></td>
                            <td><input type="number" placeholder="Amount"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="action-buttons">
                    <button class="action-btn">Save</button>
                    <button class="action-btn">Delete</button>
                </div>
            </div>

            <!-- Detail Section -->
            <div class="input-header" style="background-color:rgb(233, 233, 173); height: 60vh;">
                <table class="detail-table" style="border: 2px solid rgb(233, 233, 173)">
                    <thead>
                    <tr>
                        <th style="border: 2px solid rgb(233, 233, 173)">Item No</th>
                        <th style="border: 2px solid rgb(233, 233, 173)">Item Name</th>
                        <th style="border: 2px solid rgb(233, 233, 173)">Description</th>
                        <th style="border: 2px solid rgb(233, 233, 173)">Quantity</th>
                        <th style="border: 2px solid rgb(233, 233, 173)">Bonus</th>
                        <th style="border: 2px solid rgb(233, 233, 173)">Discount %</th>
                        <th style="border: 2px solid rgb(233, 233, 173)">Rate</th>
                        <th style="border: 2px solid rgb(233, 233, 173)">Amount</th>

                    </tr>
                    </thead>
                    <tbody>
                    @isset($items)
                        @foreach ($items as $item)
                            <tr>
                                <td style="border: 5px solid rgb(233, 233, 173)"><input type="text" value="{{ $item->Item }}">
                                </td>
                                <td style="border: 5px solid rgb(233, 233, 173)"><select>
                                        <option>Item</option>
                                    </select></td>
                                <td style="border: 5px solid rgb(233, 233, 173)"><input type="text"
                                                                                        value="{{ $item->DiscountPercent }}">
                                </td>
                                <td style="border: 5px solid rgb(233, 233, 173)"><input type="number"></td>
                                <td style="border: 5px solid rgb(233, 233, 173)"><input type="text" value="{{ $item->Bonus }}">
                                </td>
                                <td style="border: 5px solid rgb(233, 233, 173)"><input type="text"
                                                                                        value="{{ $item->DiscountPercent }}">
                                </td>
                                <td style="border: 5px solid rgb(233, 233, 173)"><input type="text" value="{{ $item->Rate }}">
                                </td>
                                <td style="border: 5px solid rgb(233, 233, 173)"><input type="number"></td>
                                <td style="border: 5px solid rgb(233, 233, 173)">
                                    <button class="edit-btn">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
                <div class="footer">
                    <div class="total-section">
                        <div class="total-label">Total Amount</div>
                        <input type="text" class="total-input">
                    </div>
                </div>
            </div>

        </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        /*body {*/
        /*    font-family: Arial, sans-serif;*/
        /*    font-size: 8pt;*/
        /*    background-color: #FDFDF9;*/
        /*    margin: 0;*/
        /*    padding: 10px;*/
        /*}*/

        .form-control, .form-select {
            height: 0.1667in;
            font-size: 8pt;
            padding: 2px 6px;
        }

        /*.container {*/
        /*    background-color: #FDFDF9;*/
        /*    padding: 10px;*/
        /*}*/

        .title {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 10px;
            color: #263238;
        }

        .header-section {
            background-color: #00BCD4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-table {
            flex: 1;
            border-collapse: collapse;
        }

        .header-table th {
            background-color: #B71C1C;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #ccc;
        }

        .header-table td {
            padding: 5px;
            border: 1px solid #ccc;
            background-color: white;
        }

        .header-table input, .header-table select {
            width: 100%;
            height: 0.1667in;
            border: none;
            font-size: 8pt;
            padding: 2px;
            box-sizing: border-box;
        }

        .right-panel {
            width: 200px;
            height: 80px;
            background-color: white;
            border: 1px solid #ccc;
        }

        .main-buttons {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 15px;
            font-size: 8pt;
            cursor: pointer;
            margin-bottom: 5px;
            display: block;
        }

        .nav-buttons {
            display: flex;
            gap: 5px;
            margin-top: 5px;
        }

        .nav-btn {
            background-color: #FEC107;
            color: black;
            border: none;
            padding: 5px 10px;
            font-size: 8pt;
            cursor: pointer;
            font-weight: bold;
        }

        .input-header {
            margin-top: 20px;
        }

        .input-header-table {
            border-collapse: collapse;
        }

        .input-header-table th {
            background-color: #000000;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #ccc;
        }

        .input-header-table td {
            padding: 5px;
            border: 1px solid #ccc;
            background-color: white;
        }

        .input-header-table input, .input-header-table select {
            width: 100%;
            height: 0.1667in;
            border: none;
            font-size: 8pt;
            padding: 2px;
            box-sizing: border-box;
        }

        .input-section {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            /* gap: 20px; */
            margin-top: 20px;
        }

        .input-header-table {
            width: 92%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .detail-table {
            width: 90%;
            /* table-layout: fixed;
            border-collapse: collapse; */
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 5px;
        }

        .action-btn {
            background-color: #FEC107;
            color: black;
            border: none;
            padding: 5px 10px;
            font-size: 8pt;
            cursor: pointer;
            font-weight: bold;
            height: 35px;
            width: 150px;
            margin-left: 10px;

        }

        .detail-header {
            margin-top: 20px;
        }

        .detail-header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-header-table th {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #ccc;
        }

        .detail-table {
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .detail-table td {
            padding: 5px;
            border: 1px solid #ccc;
            background-color: white;
        }

        .detail-table th {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #ccc;
        }

        .detail-table input, .detail-table select {
            width: 100%;
            height: 0.1667in;
            border: none;
            font-size: 8pt;
            padding: 2px;
            box-sizing: border-box;
        }

        .detail-table th {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #ccc;
        }

        .edit-btn {
            background-color: #FEC107;
            color: black;
            border: none;
            padding: 3px 8px;
            font-size: 8pt;
            cursor: pointer;
            font-weight: bold;
            height: 20px;
            width: 80px;
            margin-left: 10px;

        }

        .detail-table td:last-child {
            border: none;
            background: transparent;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* margin-top: 10px; */
        }

        .footer-info {
            font-size: 8pt;
            color: #666;
        }

        .total-section {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .total-label {
            background-color: #B71C1C;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 8pt;
        }

        .total-input {
            width: 150px;
            height: 0.1667in;
            border: 1px solid #ccc;
            font-size: 8pt;
            padding: 2px 5px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush
