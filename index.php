<?php
    //TCPDF読み込む
    require_once('./tcpdf/tcpdf.php');
    //TCPDFのインスタンス化
    $pdf = new TCPDF();
    //ヘッダを出力なしに
    $pdf->SetPrintHeader(false);
    //TTFフォント読み込み
    $font = new TCPDF_FONTS();
    $huifont = $font->AddTTFfont('./font/HuiFont29.ttf'); 
    $pdf->setFont($huifont,14);
    
    //ページ追加
    $pdf->AddPage();
    //文字出力 0は余白高さ
    $pdf->Write(0,'〒336-0027');
    //改行出力
    $pdf->Ln();
    $pdf->Write(0,'埼玉県さいたま市南区沼影');

    //フォントサイズ変更
    $pdf->Ln();
    $pdf->setFontSize(20);
    $pdf->Write(0,'呂 飛');
    $pdf->SetFontSize(14);
    $pdf->Write(11,'様');

    //x座標を設定
    $pdf->Ln();
    $pdf->setX(120);
    $pdf->Write(0,'〒160-0023');
    $pdf->Ln();
    $pdf->setX(120);
    $pdf->Write(0,'東京都新宿区西新宿1-7-3');
    $pdf->Ln();
    $pdf->setX(120);
    $pdf->Write(0,'TEL:03-3344-XXXX');
    $pdf->Ln();
    $pdf->setX(120);
    $pdf->Write(0,'FAX:03-3344-XXXX');

    $pdf->Ln(15);
    $pdf->Write(0,'下記の通り、領収いたしました。');
    $pdf->Ln();

    $kinngaku = "1001";
    $pdf->Write(10,'合計金額');
    $pdf->Setx(65);
    $pdf->Write(13,"{$kinngaku}円");
    $pdf->Ln();
    //線描画
    $pdf->Line(
        $pdf->GetX(),
        $pdf->GetY() -3,
        200,
        $pdf->GetY() -3
    );
    $pdf->Ln();


    $data = "";
    for($i=0;$i<9;$i++){
        $data .=
        '<tr>
        <td>あああ</td>
        <td class="number">25</td>
        <td class="number">20</td>
        <td class="number">500</td>
        </tr>';
    }
        //css
$css=<<<EOS
<style>
th{
background-color:black;
color:white;
text-align:center;
}
td.number{
text-align:right;
}
td{
border:1px solib black;
}
</style>
EOS;
    //TABLE
$table=<<<EOT
<table cellpadding="5">
<tr>
<th>内容</th>
<th>単価</th>
<th>数量</th>
<th>金額</th>
</tr>
$data
</table>
EOT;
$pdf->WriteHTML($css.$table);
$table2 = <<<EOT
<table>
<tr>
<th>小計</th>
<td class="number">4000</td>
</tr>
<tr>
<th>消費税</th>
<td class="number">80</td>
</tr>
</table>
EOT;
// $pdf->WriteHTML($css.$table2);
$pdf->SetFooterMargin(10);
$pdf->WriteHTMLcell(
    100,20,100,$pdf->GetY(),
    $css.$table2
);

//矩形描画
$pdf->Ln();
$pdf->Rect(
    $pdf->GetX(),
    $pdf->GetY(),
    180,
    30
);
$pdf->Write(0,'備考');
$pdf->image("./img/hal.jpg",175,17,20,20);

    //HTML出力
    $pdf ->Output();
?>
