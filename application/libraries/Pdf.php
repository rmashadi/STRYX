<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf {
    public function __construct() {
        parent::__construct();
        
        // Set options here, if needed
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $this->setOptions($options);
    }
}
