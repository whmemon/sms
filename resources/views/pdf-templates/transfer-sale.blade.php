<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Transfer Letter — {{$SOCIETY_NAME}}</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style>
    /* --- Page setup --- */
    @page { size: A4; margin: 10mm; }
    html, body {
      height: 100%;
      margin: 2px 20px 10px 30px;
      padding: 0;
      font-family: "DejaVu Sans", "Helvetica", Arial, sans-serif;
      color: #111;
    }
    body { font-size: 12pt; line-height: 1.35; }

    /* --- Container --- */
    .page {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      padding: 10px 18px;
      box-sizing: border-box;
    }

    /* --- Header / Letterhead --- */
    .letterhead {
      display: flex;
      align-items: center;
      gap: 16px;
      border-bottom: 2px solid #222;
      padding-bottom: 10px;
      margin-bottom: 18px;
    }
    .logo {
      width: 110px;
      height: 110px;
      background: #eee;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: #666;
    }
    .society-info { flex: 1; }
    .society-info h1 {
      margin: 0;
      font-size: 18pt;
      letter-spacing: 0.3px;
    }
    .society-info .meta {
      font-size: 9.5pt;
      color: #333;
      margin-top: 1px;
    }

    /* --- Title --- */
    .doc-title {
      text-align: center;
      margin: 5px 10px 5px 0px;
      font-weight: 700;
      font-size: 14pt;
    }

    /* --- Body layout --- */
    .meta-row { margin-bottom: 10px; }
    .meta-row .left { float: left; margin-left: 10px; }
    .meta-row .right { float: right; }
    .clear { clear: both; }

    table.info {
      width: 100%;
      border-collapse: collapse;
      margin: 2px 0 14px 0;
    }
    table.info th, table.info td {
      border: 1px solid #bbb;
      padding: 8px 10px;
      text-align: left;
      vertical-align: top;
      font-size: 11pt;
    }
    table.info th {
      background: #f4f4f4;
      width: 35%;
    }

    p { margin: 10px 10px 10px 10px;
     text-align: justify;
  text-justify: inter-word;}

    /* --- Signatures Section (Left + Right alignment) --- */
    .signatures {
      margin-top: 60px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }
    .sig-left {
      text-align: left;
    }
    .sig-right {
      text-align: right;
    }
    .sig-line {
      margin-top: 40px;
      border-top: 1px solid #000;
      padding-top: 6px;
      font-weight: bold;
      font-size: 11pt;
      display: inline-block;
    }
    .stamp {
      margin-top: 1px;
      font-size: 10pt;
      color: #555;
    }

    /* --- Footer --- */
    .footer {
      margin-top: 10px;
      font-size: 8.5pt;
      color: #333;
      border-top: 1px dashed #ddd;
      padding-top: 2px;
    }

    /* --- Print adjustments --- */
    @media print {
      body { -webkit-print-color-adjust: exact; }
      .logo { background: transparent !important; }
      a[href]:after { content: ""; }
    }
  </style>
</head>
<body>
  <div class="page">

    <!-- LETTERHEAD -->
    <div class="letterhead">


    <div class="society-info">
        <table><tr><td><img  width="80" src="{{ public_path('logo.jpeg') }}" alt="Logo"></td><td><h1>{{$SOCIETY_NAME }}</h1></td></tr></table>

        <div class="meta">
          {{$SOCIETY_ADDRESS_LINE1}} | Phone: {{$SOCIETY_PHONE}} &nbsp; | &nbsp; Email: {{$SOCIETY_EMAIL}} | Reg No.: {{$SOCIETY_REG_NO}}
        </div>
      </div>
    </div>

    <!-- DOCUMENT TITLE -->

  <div class="doc-title">
    <table width="100%">
      <tr>
        <td><div align="center"><strong>TRANSFER LETTER (BY SALE) </strong></div></td>
        <td style="padding-right:10px"><div align="right"><img  width="60" height="60" src="{{ public_path('qrcode/'.$REFERENCE_NUMBER ) }}.svg" alt="Logo"></div></td>
      </tr>
    </table>
  </div>
  <!-- DATE / REF -->
  <div class="meta-row">
      <div class="left"><strong>Date:</strong> {{$TRANSFER_DATE}}</div>
      <div class="right"><strong>Ref. No.:</strong> {{$REFERENCE_NUMBER}}</div>
      <div class="clear"></div>
    </div>

    <!-- TO -->
    <p>
      <strong>To:</strong><br/>

    @foreach ($transferees as $t)
    Mr./Mrs. <strong>{{ $t['transferee_name'] }}</strong><br/>
    CNIC No.: {{ $t['transferee_citizenshipno'] }}<br/>
    Address: {{ $t['transferee_address'] }},{{ $t['transferee_district'] }}<br/>

    <br/>
    @endforeach


    </p>


    <!-- SUBJECT -->
    <p><strong>Subject:</strong> Transfer of Plot No. <strong>{{$PLOT_TYPE}}-{{$PLOT_NO}}</strong> situated in <strong>{{$SOCIETY_NAME}}</strong> through sale.</p>

    <!-- BODY -->
    <p>
      This is to inform you that pursuant to the provisions of the <em>Sindh Cooperative
      Housing Societies Act, 2020</em> and the registered Bye-laws of <strong>{{$SOCIETY_NAME}}</strong>,
      the Management Committee has approved the transfer of the property in your
      name.
    </p>

    <p>
      Accordingly, the above plot stands <strong>transferred</strong> in the name of
      <strong>TRANSFEREES</strong> with effect from <strong>{{$EFFECTIVE_DATE}}</strong>, and the membership records of the Society have been updated accordingly.
    </p>

    <p>
      You are now recognized as a lawful member and owner of the above property within the Society, subject to observance of all Bye-laws, rules, and regulations of the Society and the <em>Sindh Cooperative Housing Societies Act, 2020</em>.
    </p>

    <!-- SIGNATURES -->
    <table width="100%"><tr><td><div class="sig-left flush-left">
        <div class="sig-line">HONORARY SECRETARY</div><br/>
        <div class="stamp">Signature &amp; Society Stamp</div>
      </div></td><td><div class="sig-right flush-right">
        <div class="sig-line">CHAIRMAN</div><br/>
        <div class="stamp">Signature &amp; Society Stamp</div>
      </div></td></tr></table>


    </div>

    <div style="height:18px"></div>

    <!-- FOOTER -->
    <div class="footer">
      Note: This letter is issued after verification of submitted documents. Any subsequent discrepancy in documents may result in cancellation of this transfer subject to the Society's Bye-laws.
      Visit https://ppowchs.org.pk for more information.
    </div>

  </div>
</body>
</html>
