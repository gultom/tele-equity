<?php
App::import('Vendor', 'excel_reader2'); //import statement
class ReadExcelController extends AppController{
	public function show_excel() {
		$data = new Spreadsheet_Excel_Reader('data/data_call.xls', true);
		$this->set('data', $data); 
	 }
}