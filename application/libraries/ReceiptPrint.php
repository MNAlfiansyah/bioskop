<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// IMPORTANT - Replace the following line with your path to the escpos-php autoload script
require_once __DIR__ . '\..\..\autoload.php';

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;
class ReceiptPrint {
  private $CI;
  private $connector;
  private $printer;
  // TODO: printer settings
  // Make this configurable by printer (32 or 48 probably)
  private $printer_width = 48;
  function __construct()
  {
    $this->CI =& get_instance(); // This allows you to call models or other CI objects with $this->CI->... 
  }
  function connect($print)
  {
   // $profile = CapabilityProfile::load("simple");
    $this->connector = new WindowsPrintConnector($print);
    $this->printer = new Printer($this->connector);
  }
  private function check_connection()
  {
    if (!$this->connector OR !$this->printer OR !is_a($this->printer, 'Mike42\Escpos\Printer')) {
      throw new Exception("Tried to create receipt without being connected to a printer.");
    }
  }
  public function close_after_exception()
  {
    if (isset($this->printer) && is_a($this->printer, 'Mike42\Escpos\Printer')) {
      $this->printer->close();
    }
    $this->connector = null;
    $this->printer = null;
    $this->emc_printer = null;
  }
  // Calls printer->text and adds new line
  private function add_line($text = "", $should_wordwrap = true)
  {
    $text = $should_wordwrap ? wordwrap($text, $this->printer_width) : $text;
    $this->printer->text($text."\n");
  }
  public function print_test_receipt($apa,$total_bayar,$no_meja)
  {
    
    $this->check_connection();
    $this->printer->setJustification(Printer::JUSTIFY_LEFT);
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->add_line("  Aspro Resto");
    $this->add_line("     ASTRO");
    $this->printer->selectPrintMode();

    $this->add_line(); // blank line
    $this->add_line('---------- '.$no_meja.' -----------');
    $this->add_line(); // blank line
    $this->add_line('Nama    Harga    QTY    Total'); 
    $this->add_line('-------------------------------');
    foreach ($apa->result_array() as $i) :
      $no_meja = $i['no_meja'];
      $tanggal = $i['tanggal'];
      $total_harga = $i['total_harga'];
      $qty = $i['qty'];
      $harga = $i['harga'];
      $nama_masakan = $i['nama_masakan'];
      
      $this->add_line($nama_masakan.' '.$harga.' x '.$qty.' '.$total_harga);
      $this->add_line('-------------------------------');
    endforeach;
    $this->add_line('TOTAL Bayar : RP.'.$total_bayar);
    $this->add_line(); // blank line
    $this->add_line(date('Y-m-d'));
    $this->add_line(); // blank line
    $this->add_line(); // blank line
    
    $this->printer->cut(Printer::CUT_PARTIAL);
    $this->printer->close();
  }
}